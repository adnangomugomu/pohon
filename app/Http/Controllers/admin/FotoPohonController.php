<?php

namespace App\Http\Controllers\admin;

use App\Models\Pohon;
use App\Models\Pohon_foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class FotoPohonController extends Controller
{
    public function show(Request $request, $id)
    {
        $data['row'] = Pohon::findOrFail($id);
        $html = view('admin.pohon.foto', $data)->render();

        return response()->json([
            'status' => 'success',
            'html' => $html,
        ], 200);
    }

    public function store(Request $request, $id)
    {
        $row = Pohon::findOrFail($id);

        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'foto' => 'image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            ], [
                'foto.max' => 'Ukuran :attribute maksimal 2048 Kb',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'msg' => $validator->getMessageBag()->all(),
                ], 400);
            } else {
                $data = new Pohon_foto();

                $data->pohon_id = $row->id;
                if ($request->hasFile('foto')) {
                    $photo = $request->file('foto');

                    $filename = time() . '-' . mt_rand(1, 100000) . '.' . $photo->getClientOriginalExtension();
                    $pathSave = $photo->storeAs('public/foto-pohon', $filename);
                    $data->foto = 'storage/foto-pohon/' . $filename;
                }

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

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'caption' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'msg' => $validator->getMessageBag()->all(),
                ], 400);
            } else {
                $data = Pohon_foto::findOrFail($id);
                $data->caption = $request->caption;
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
        $data = Pohon_foto::findOrFail($id);
        if ($data) {
            $data->delete();
            return response()->json([
                'status' => 'success',
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'msg' => 'Data tidak ditemukan'
            ], 400);
        }
    }

    public function getDataTable(Request $request, $id)
    {
        $data = Pohon_foto::where('pohon_id', $id)->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('foto', function ($dt) {
                return '<img class="img img-fluid" style="width:100px;" src="' . asset($dt->foto) . '" />';
            })
            ->editColumn('caption', function ($dt) {
                return '<input type="text" value="' . ($dt->caption) . '" onchange="updateCaption(this,\'' . $dt->id . '\');" class="form-control w-75" placeholder="Caption ...">';
            })
            ->addColumn('action', function ($dt) {
                return '                    
                    <button class="btn btn-danger btn-icon rounded-circle" onclick="hapusFoto(\'' . $dt->id . '\');">
                        <div><i class="fa fa-trash"></i></div>
                    </button>
                ';
            })
            ->escapeColumns('*')
            ->rawColumns(['foto','caption','action'])
            ->make(true);
    }
}
