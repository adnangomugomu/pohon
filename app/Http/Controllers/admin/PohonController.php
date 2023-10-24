<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Pohon;
use App\Models\Ref_jenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PohonController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Pohon',
            'header' => 'Data Pohon',
            'breadcrumb' => ['Data Pohon', 'index']
        ];
        return view('admin.pohon.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form Data Pohon',
            'header' => 'Form Data Pohon',
            'breadcrumb' => ['Data Pohon', 'form']
        ];

        $data['kecamatan'] = Kecamatan::where('kode_kab', 3309)->get();
        $data['jenis'] = Ref_jenis::all();

        return view('admin.pohon.form', $data);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'nama_indo' => 'required',
                'nama_latin' => 'required',
                'kode_kec' => 'required',
                'kode_kel' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
                'kode' => 'required',
                'jenis_id' => 'required|exists:ref_jenis,id',
                'lokasi' => 'required',
                'tinggi' => 'required',
                'diameter' => 'required',
                'akar' => 'required',
                'kondisi' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'msg' => $validator->getMessageBag()->all(),
                ], 400);
            } else {
                $data = new Pohon();
                $data->nama_indo = $request->nama_indo;
                $data->nama_latin = $request->nama_latin;
                $data->kode_kec = $request->kode_kec;
                $data->kode_kel = $request->kode_kel;
                $data->latitude = $request->latitude;
                $data->longitude = $request->longitude;
                $data->kode = $request->kode;
                $data->jenis_id = $request->jenis_id;
                $data->lokasi = $request->lokasi;
                $data->tinggi = clear_koma($request->tinggi);
                $data->diameter = clear_koma($request->diameter);
                $data->akar = $request->akar;
                $data->kondisi = $request->kondisi;
                $data->detail = $request->detail;
                $data->koordinat = DB::raw("(ST_GeomFromText('POINT($request->longitude $request->latitude)'))");
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
        $row = Pohon::with(['jenis', 'kecamatan', 'kelurahan'])->findOrFail($id);
        if ($row) {
            $data['row'] = $row;
            $html = view('admin.pohon.detail', $data)->render();

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
        $row = Pohon::with(['jenis', 'kecamatan', 'kelurahan'])->findOrFail($id);
        if ($row) {
            $data = [
                'title' => 'Form Data Pohon Update',
                'header' => 'Form Data Pohon Update',
                'breadcrumb' => ['Data Pohon', 'form', 'edit']
            ];

            $data['row'] = $row;
            $data['kecamatan'] = Kecamatan::where('kode_kab', 3309)->get();
            $data['kelurahan'] = Kelurahan::where('kode_kec', $row->kode_kec)->get();
            $data['jenis'] = Ref_jenis::all();

            return view('admin.pohon.formEdit', $data);
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
                'nama_indo' => 'required',
                'nama_latin' => 'required',
                'kode_kec' => 'required',
                'kode_kel' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
                'kode' => 'required',
                'jenis_id' => 'required|exists:ref_jenis,id',
                'lokasi' => 'required',
                'tinggi' => 'required',
                'diameter' => 'required',
                'akar' => 'required',
                'kondisi' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'msg' => $validator->getMessageBag()->all(),
                ], 400);
            } else {
                $data = Pohon::findOrFail($id);
                $data->nama_indo = $request->nama_indo;
                $data->nama_latin = $request->nama_latin;
                $data->kode_kec = $request->kode_kec;
                $data->kode_kel = $request->kode_kel;
                $data->latitude = $request->latitude;
                $data->longitude = $request->longitude;
                $data->kode = $request->kode;
                $data->jenis_id = $request->jenis_id;
                $data->lokasi = $request->lokasi;
                $data->tinggi = clear_koma($request->tinggi);
                $data->diameter = clear_koma($request->diameter);
                $data->akar = $request->akar;
                $data->kondisi = $request->kondisi;
                $data->detail = $request->detail;
                $data->koordinat = DB::raw("(ST_GeomFromText('POINT($request->longitude $request->latitude)'))");
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
        $data = Pohon::findOrFail($id);
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

    public function getDataTable(Request $request)
    {
        $data = Pohon::with(['jenis', 'kecamatan', 'kelurahan'])->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('nama', function ($dt) {
                return $dt->nama_indo .
                    '<div class="text-success">latin :' . $dt->nama_latin . '</div>';
            })
            ->editColumn('lokasi', function ($dt) {
                return 'Kec. ' . $dt->kecamatan->nama
                    . '<div class="text-primary">Kel. ' . $dt->kelurahan->nama . '</div>'
                    . '<div><i class="fa fa-map-signs"></i> ' . $dt->lokasi . '</div>';
            })
            ->editColumn('map', function ($dt) {
                return '<button class="btn btn-primary btn-sm" onclick="lihat_map(\'' . $dt->id . '\')"><i class="fa fa-map"></i> Maps</button>';
            })
            ->editColumn('tombol_foto', function ($dt) {
                return '<button class="btn btn-primary btn-sm" onclick="lihat_foto(\'' . $dt->id . '\')"><i class="fa fa-camera"></i> Foto</button>';
            })
            ->editColumn('isi_data', function ($dt) {
                return 'Tinggi (cm) : ' . rupiah($dt->tinggi, true)
                    . '<div>Diameter (cm) : ' . rupiah($dt->diameter, true) . '</div>';
            })
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
            ->escapeColumns('*')
            ->rawColumns(['map', 'nama', 'tombol_foto', 'lokasi', 'action', 'isi_data'])
            ->make(true);
    } //
}
