<?php

namespace App\Http\Controllers;

use App\Models\Pohon;
use Illuminate\Http\Request;

class PetaController extends Controller
{
    public function index()
    {
        $data['title'] = "Peta Persebaran Data Pohon";
        $data['pohon'] = Pohon::all();
        return view('admin.peta.index', $data);
    }

    public function geoJson()
    {
        $data = Pohon::with(['jenis', 'kecamatan', 'kelurahan', 'foto'])->get();

        $geoJSON = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        foreach ($data as $item) {
            $feature = [
                'type' => 'Feature',
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [$item->longitude, $item->latitude],
                ],
                'properties' => [
                    'id' => $item->id,
                    'nama_indo' => $item->nama_indo,
                    'nama_latin' => $item->nama_latin,
                    'kecamatan' => $item->kecamatan->nama,
                    'kelurahan' => $item->kelurahan->nama,
                    'latitude' => $item->latitude,
                    'longitude' => $item->longitude,
                    'kode' => $item->kode,
                    'jenis' => $item->jenis->nama,
                    'lokasi' => $item->lokasi,
                    'tinggi' => $item->tinggi,
                    'diameter' => $item->diameter,
                    'akar' => $item->akar,
                    'kondisi' => $item->kondisi,
                    'detail' => $item->detail,
                    'is_verif' => $item->is_verif,
                    'tanggal_verif' => $item->tgl_verif,
                    'dibuat_pada' => $item->created_at,
                    'foto' => $item->foto,
                ],
            ];

            $geoJSON['features'][] = $feature;
        }

        return json_encode($geoJSON);
    }

    public function jarak(Request $request)
    {
        $latitude = $request->lat;
        $longitude = $request->long;

        $data = Pohon::withJarak($latitude, $longitude)->get();

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ], 200);
    }
}
