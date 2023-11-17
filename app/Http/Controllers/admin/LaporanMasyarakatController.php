<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Yajra\DataTables\Facades\DataTables;

class LaporanMasyarakatController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Laporan Masyarakat',
            'header' => 'Laporan Masyarakat',
            'breadcrumb' => ['Laporan', 'Masyarakat', 'index']
        ];
        return view('admin.laporan_masyarakat.index', $data);
    }

    public function show($id)
    {
        $row = Laporan::with('status')->findOrFail($id);
        if ($row) {
            $data['row'] = $row;
            $html = view('admin.laporan_masyarakat.detail', $data)->render();

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

    public function destroy($id)
    {
        $data = Laporan::findOrFail($id);
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

    public function verifikasi(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'jenis' => 'required|in:proses,selesai',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'msg' => $validator->getMessageBag()->all(),
                ], 400);
            } else {
                $data = Laporan::findOrFail($id);

                if ($request->jenis == 'proses') {
                    $data->status_id = '2';
                } else {
                    $data->status_id = '3';
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

    public function export()
    {
        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->createSheet(0);
        $sheet->setTitle('LAPORAN INTERNAL');
        $sheet->setCellValue('A1', 'REKAP LAPORAN MASYARAKAT');

        // judul
        $sheet->setCellValue('A3', 'NO');
        $sheet->setCellValue('B3', 'NAMA INDONESIA');
        $sheet->setCellValue('C3', 'NOMER HP');
        $sheet->setCellValue('D3', 'EMAIL');
        $sheet->setCellValue('E3', 'DESKRIPSI');
        $sheet->setCellValue('F3', 'STATUS');
        $sheet->setCellValue('G3', 'TANGGAL LAPORAN');
        $sheet->setCellValue('H3', 'JENIS ADUAN');
        $sheet->setCellValue('I3', 'LAMPIRAN');
        // end judul
        $sheet->getStyle('A3:I3')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('A3:I3')->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'FF9902',
                ],
            ],
        ]);

        $sheet->getStyle('A3:H3')->getAlignment()->setHorizontal('center');

        foreach (['B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'] as $column) $sheet->getColumnDimension($column)->setAutoSize(true);

        $awal = 4;
        $no = 1;

        $data = Laporan::with(['status', 'aduan'])->where('jenis', 'masyarakat')->get();

        foreach ($data as $row) {
            $sheet
                ->setCellValue('A' . $awal, $no++)
                ->setCellValue('B' . $awal, $row->nama)
                ->setCellValue('C' . $awal, $row->no_hp)
                ->setCellValue('D' . $awal, $row->email)
                ->setCellValue('E' . $awal, $row->deskripsi)
                ->setCellValue('F' . $awal, $row->status->nama)
                ->setCellValue('G' . $awal, $row->created_at)
                ->setCellValue('H' . $awal, $row->aduan->nama)
            ->setCellValue('I' . $awal, "Buka Lampiran");
            $sheet->getCell('I' . $awal)->getHyperlink()->setUrl(asset($row->foto))->setTooltip('Buka Lampiran');;
            $sheet->getStyle('A' . $awal . ':I' . $awal)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $awal++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Internal.xlsx"');
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
        $data = Laporan::with(['status', 'aduan'])->where('jenis', 'masyarakat')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($dt) {
                if ($dt->status_id == 1) $color = 'text-danger';
                elseif ($dt->status_id == 2) $color = 'text-warning';
                elseif ($dt->status_id == 3) $color = 'text-success';
                return '<div class="' . $color . '">' . $dt->status->nama . '</div>';
            })
            ->addColumn('tgl_laporan', function ($dt) {
                return $dt->created_at;
            })
            ->addColumn('action', function ($dt) {
                return '                    
                    <div class="dropdown">
                        <button class="btn btn-outline-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aksi</button>
                        <div class="dropdown-menu">
                            <span class="dropdown-item" onclick="detailData(\'' . $dt->id . '\');"><i class="fa fa-info-circle mr-1"></i> Detail</span>
                        </div>
                    </div>
                ';
            })
            ->escapeColumns('*')
            ->rawColumns(['action', 'status', 'tgl_laporan'])
            ->make(true);
    }
}
