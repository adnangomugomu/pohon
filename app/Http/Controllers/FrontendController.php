<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Pohon;
use App\Models\Ref_aduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class FrontendController extends Controller
{
    public function index()
    {
        $data['title'] = 'Beranda';
        $data['pohon'] = Pohon::with(['foto'])->where('is_verif', '1')->limit(6)->get();
        return view('front.home', $data);
    }

    public function dataPohon()
    {
        $data['title'] = 'Data Pohon';
        $data['pohon'] = Pohon::with(['foto'])->where('is_verif', '1')->paginate(9);
        return view('front.dataPohon', $data);
    }

    public function detailPohon(Request $request, $id)
    {
        $data['title'] = 'Data Pohon';
        $data['row'] = Pohon::where('is_verif', '1')->findOrFail($id);
        return view('front.detailPohon', $data);
    }

    public function Aduan()
    {
        $data['title'] = 'Aduan Masyarakat';
        $data['laporan'] = Laporan::with(['status'])->orderBy('id', 'desc')->paginate(9);
        $data['aduan'] = Ref_aduan::all();
        return view('front.aduan', $data);
    }

    public function aduanStore(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'nama' => 'required|min:8',
                'email' => 'required|min:5|email:rfc,dns',
                'no_hp' => 'required|min:5|numeric',
                'deskripsi' => 'required|min:5',
                'aduan_id' => 'required|exists:ref_aduan,id',
                'latitude' => 'required',
                'longitude' => 'required',
                'foto' => 'required|image|mimes:jpg,jpeg,png,webp,gif|max:5048',
            ], [
                'foto.max' => 'Ukuran :attribute maksimal 5048 Kb',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'msg' => $validator->getMessageBag()->all(),
                ], 400);
            } else {
                $data = new Laporan();
                $data->nama = htmlspecialchars($request->nama);
                $data->email = htmlspecialchars($request->email);
                $data->no_hp = htmlspecialchars($request->no_hp);
                $data->deskripsi = htmlspecialchars($request->deskripsi);
                $data->jenis = 'masyarakat';
                $data->status_id = 1;

                $data->aduan_id = htmlspecialchars($request->aduan_id);
                $data->latitude = htmlspecialchars($request->latitude);
                $data->longitude = htmlspecialchars($request->longitude);
                $long = $request->longitude;
                $lat = $request->latitude;
                $data->koordinat = DB::raw("(ST_GeomFromText('POINT($long $lat)'))");

                if ($request->hasFile('foto')) {
                    $photo = $request->file('foto');

                    $filename = time() . '-' . mt_rand(1, 100000) . '.' . $photo->getClientOriginalExtension();
                    $pathSave = $photo->storeAs('public/foto-laporan', $filename);
                    $data->foto = 'storage/foto-laporan/' . $filename;
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
                'e' => $e,
            ], 500);
        }
    }
}
