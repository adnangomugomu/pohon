<?php

namespace App\Http\Controllers\super_admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Manajemen Role',
            'header' => 'Manajemen Role',
            'breadcrumb' => ['Manajemen Role', 'index']
        ];
        return view('super_admin.role.index', $data);
    }

    public function create()
    {
        $data = [];
        $html = view('super_admin.role.form', $data)->render();

        return response()->json([
            'status' => 'success',
            'html' => $html,
        ], 200);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'nama' => 'required|min:5|unique:role,nama',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'msg' => $validator->getMessageBag()->all(),
                ], 400);
            } else {
                $data = new Role();
                $data->nama = $request->nama;
                $data->save();
                DB::commit();

                return response()->json([
                    'status' => 'success',
                ], 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::warning($e->getMessage());

            return response()->json([
                'status' => 'failed',
                'msg' => 'Terjadi kesalahan',
            ], 500);
        }
    }

    public function show($id)
    {
        $row = Role::findOrFail($id);
        if ($row) {
            $data['row'] = $row;
            $html = view('super_admin.role.detail', $data)->render();

            return response()->json([
                'status' => 'success',
                'html' => $html,
            ], 200);
        } else {
            return response()->json([
                'msg' => 'Data tidak ditemukan',
            ], 400);
        }
    }

    public function edit($id)
    {
        $row = Role::findOrFail($id);
        if ($row) {
            $data['row'] = $row;
            $html = view('super_admin.role.formEdit', $data)->render();

            return response()->json([
                'status' => 'success',
                'html' => $html,
            ], 200);
        } else {
            return response()->json([
                'msg' => 'Data tidak ditemukan',
            ], 400);
        }
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'nama' => 'required|min:5|unique:role,nama',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'msg' => $validator->getMessageBag()->all(),
                ], 400);
            } else {
                $data = Role::findOrFail($id);
                $data->nama = $request->nama;
                $data->save();
                DB::commit();

                return response()->json([
                    'status' => 'success',
                ], 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::warning($e->getMessage());

            return response()->json([
                'status' => 'failed',
                'msg' => 'Terjadi kesalahan',
            ], 500);
        }
    }

    public function destroy($id)
    {
        $data = Role::findOrFail($id);
        if ($data) {
            $data->delete();
            return response()->json([
                'status' => 'success',
                'data' => $data,
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'msg' => 'Data tidak ditemukan'
            ], 400);
        }
    }

    public function getDataTable(Request $request)
    {
        $data = Role::all();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($dt) {
                return '                    
                    <div class="dropdown">
                        <button class="btn btn-outline-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aksi</button>
                        <div class="dropdown-menu">
                            <span class="dropdown-item" onclick="editData(\'' . $dt->id . '\');"><i class="fa fa-edit mr-1"></i> Edit</span>
                            <span class="dropdown-item" onclick="detailData(\'' . $dt->id . '\');"><i class="fa fa-info-circle mr-1"></i> Detail</span>
                        </div>
                    </div>
                ';
            })
            ->escapeColumns('active')
            ->make(true);
    }
}
