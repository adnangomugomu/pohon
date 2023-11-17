<?php

namespace App\Http\Controllers\admin;

use App\Models\Pohon;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Ref_jenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Ref_akar;
use App\Models\Ref_kondisi;
use App\Models\Ref_tajuk;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Fill;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

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
        $data['akar'] = Ref_akar::all();
        $data['kondisi'] = Ref_kondisi::all();
        $data['tajuk'] = Ref_tajuk::all();

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
                'akar_id' => 'required|exists:ref_akar,id',
                'kondisi_id' => 'required|exists:ref_kondisi,id',
                'tajuk_id' => 'required|exists:ref_tajuk,id',
                'lokasi' => 'required',
                'tinggi' => 'required',
                'utara' => 'required',
                'selatan' => 'required',
                'timur' => 'required',
                'barat' => 'required',
                'diameter' => 'required',
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
                $data->utara = clear_koma($request->utara);
                $data->selatan = clear_koma($request->selatan);
                $data->timur = clear_koma($request->timur);
                $data->barat = clear_koma($request->barat);
                $data->akar_id = $request->akar_id;
                $data->kondisi_id = $request->kondisi_id;
                $data->tajuk_id = $request->tajuk_id;
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
        $row = Pohon::with(['jenis', 'kecamatan', 'kelurahan', 'akar', 'kondisi', 'tajuk', 'foto'])->findOrFail($id);
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
        $row = Pohon::with(['jenis', 'kecamatan', 'kelurahan'])->where('is_verif', '0')->findOrFail($id);
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
            $data['akar'] = Ref_akar::all();
            $data['kondisi'] = Ref_kondisi::all();

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
                'akar_id' => 'required|exists:ref_akar,id',
                'kondisi_id' => 'required|exists:ref_kondisi,id',
                'tajuk_id' => 'required|exists:ref_tajuk,id',
                'lokasi' => 'required',
                'tinggi' => 'required',
                'utara' => 'required',
                'selatan' => 'required',
                'timur' => 'required',
                'barat' => 'required',
                'diameter' => 'required',
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
                $data->utara = clear_koma($request->utara);
                $data->selatan = clear_koma($request->selatan);
                $data->timur = clear_koma($request->timur);
                $data->barat = clear_koma($request->barat);
                $data->akar_id = $request->akar_id;
                $data->kondisi_id = $request->kondisi_id;
                $data->tajuk_id = $request->tajuk_id;
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

    public function verifikasi(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'jenis' => 'required|in:verif,batal',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'msg' => $validator->getMessageBag()->all(),
                ], 400);
            } else {
                $data = Pohon::findOrFail($id);

                if ($request->jenis == 'verif') {
                    $data->is_verif = '1';
                } else {
                    $data->is_verif = '0';
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

    public function peta(Request $request, $id)
    {
        $data['row'] = Pohon::findOrFail($id);
        $html = view('admin.pohon.peta', $data)->render();

        return response()->json([
            'status' => 'success',
            'html' => $html,
        ], 200);
    }

    public function export()
    {
        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->createSheet(0);
        $sheet->setTitle('DATA POHON');
        $sheet->setCellValue('A1', 'REKAP DATA POHON');

        // judul
        $sheet->setCellValue('A3', 'NO');
        $sheet->setCellValue('B3', 'NAMA INDONESIA');
        $sheet->setCellValue('C3', 'NAMA LATIN');
        $sheet->setCellValue('D3', 'KECAMATAN');
        $sheet->setCellValue('E3', 'KELURAHAN');
        $sheet->setCellValue('F3', 'LOKASI');
        $sheet->setCellValue('G3', 'KODE');
        $sheet->setCellValue('H3', 'JENIS POHON');
        $sheet->setCellValue('I3', 'TINGGI (cm)');
        $sheet->setCellValue('J3', 'DIAMETER (cm)');
        $sheet->setCellValue('K3', 'AKAR');
        $sheet->setCellValue('L3', 'KONDISI');
        $sheet->setCellValue('M3', 'DETAIL POHON');
        $sheet->setCellValue('N3', 'TAJUK');
        $sheet->setCellValue('O3', 'UTARA (m)');
        $sheet->setCellValue('P3', 'TIMUR (m)');
        $sheet->setCellValue('Q3', 'SELATAN (m)');
        $sheet->setCellValue('R3', 'BARAT (m)');
        // end judul
        $sheet->getStyle('A3:R3')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('A3:R3')->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'FF9902',
                ],
            ],
        ]);

        $sheet->getStyle('A3:M3')->getAlignment()->setHorizontal('center');

        foreach (['B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R'] as $column) $sheet->getColumnDimension($column)->setAutoSize(true);

        $awal = 4;
        $no = 1;

        $data = Pohon::with(['jenis', 'kecamatan', 'kelurahan', 'tajuk'])->get();

        foreach ($data as $row) {
            $sheet
                ->setCellValue('A' . $awal, $no++)
                ->setCellValue('B' . $awal, $row->nama_indo)
                ->setCellValue('C' . $awal, $row->nama_latin)
                ->setCellValue('D' . $awal, $row->kecamatan->nama)
                ->setCellValue('E' . $awal, $row->kelurahan->nama)
                ->setCellValue('F' . $awal, $row->lokasi)
                ->setCellValue('G' . $awal, $row->kode)
                ->setCellValue('H' . $awal, $row->jenis->nama)
                ->setCellValue('I' . $awal, $row->tinggi)
                ->setCellValue('J' . $awal, $row->diameter)
                ->setCellValue('K' . $awal, $row->akar->nama)
                ->setCellValue('L' . $awal, $row->kondisi->nama)
                ->setCellValue('M' . $awal, $row->detail)
                ->setCellValue('N' . $awal, $row->tajuk->nama)
                ->setCellValue('O' . $awal, $row->utara)
                ->setCellValue('P' . $awal, $row->timur)
                ->setCellValue('Q' . $awal, $row->selatan)
                ->setCellValue('R' . $awal, $row->barat);
            $sheet->getStyle('A' . $awal . ':R' . $awal)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $awal++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Rekap Data Pohon.xlsx"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');

        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

    public function getDataTable(Request $request)
    {
        $data = Pohon::with(['jenis', 'kecamatan', 'kelurahan', 'akar', 'kondisi'])->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('nama', function ($dt) {
                return $dt->nama_indo
                    . '<div>Latin :<span class="text-info">' . $dt->nama_latin . '</span></div>'
                    . '<div>Kode :<span class="text-warning">' . $dt->kode . '</span></div>';
            })
            ->editColumn('lokasi', function ($dt) {
                return 'Kec. ' . $dt->kecamatan->nama
                    . '<div class="text-primary">Kel. ' . $dt->kelurahan->nama . '</div>'
                    . '<div><i class="fa fa-map-signs"></i> ' . $dt->lokasi . '</div>';
            })
            ->editColumn('map', function ($dt) {
                return '<button class="btn btn-primary btn-sm" onclick="lihat_map(\'' . $dt->id . '\')"><i class="fa fa-map"></i> Maps</button>'
                    . '<div class="mt-1">
                        <button class="btn btn-primary btn-sm ml-1" onclick="lihat_foto(\'' . $dt->id . '\')"><i class="fa fa-camera"></i> Foto</button>
                    </div>';
            })
            ->editColumn('is_verif', function ($dt) {
                if ($dt->is_verif == '0') {
                    return '<div class="text-danger">Belum Diverifikasi</div>';
                } else {
                    return '<div class="text-success">Terverifikasi</div>';
                }
            })
            ->editColumn('isi_data', function ($dt) {
                return 'Tinggi (cm) : ' . rupiah($dt->tinggi, true)
                    . '<div>Diameter (cm) : ' . rupiah($dt->diameter, true) . '</div>';
            })
            ->addColumn('action', function ($dt) {
                if ($dt->is_verif == 0) {
                    $btn_is_verif = '<span class="dropdown-item text-success" onclick="verif(\'verif\',\'' . $dt->id . '\');"><i class="fa fa-check mr-1"></i> Verifikasi</span>';
                    $btn_edit = '<span class="dropdown-item" onclick="editData(\'' . $dt->id . '\');"><i class="fa fa-edit mr-1"></i> Edit</span>';
                } else {
                    $btn_is_verif = '<span class="dropdown-item text-danger" onclick="verif(\'batal\',\'' . $dt->id . '\');"><i class="fa fa-times mr-1"></i> Batalkan Verifikasi</span>';
                    $btn_edit = '';
                }

                return '                    
                    <div class="dropdown">
                        <button class="btn btn-outline-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aksi</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            ' . $btn_edit . '
                            <span class="dropdown-item" onclick="detailData(\'' . $dt->id . '\');"><i class="fa fa-info-circle mr-1"></i> Detail</span>
                            ' . $btn_is_verif . '
                        </div>
                    </div>
                ';
            })
            ->escapeColumns('*')
            ->rawColumns(['map', 'nama', 'is_verif', 'lokasi', 'action', 'isi_data'])
            ->make(true);
    }
}
