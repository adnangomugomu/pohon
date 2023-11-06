<?php

namespace App\Http\Controllers;

use App\Models\Pohon;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $data['title'] = 'Beranda';
        $data['pohon'] = Pohon::with(['foto'])->where('is_verif','1')->limit(6)->get();
        return view('front.home', $data);
    }

    public function dataPohon()
    {
        $data['title'] = 'Data Pohon';
        $data['pohon'] = Pohon::with(['foto'])->where('is_verif','1')->paginate(9);
        return view('front.dataPohon', $data);
    }

    public function detailPohon(Request $request, $id)
    {
        $data['row'] = Pohon::where('is_verif','1')->findOrFail($id);
        $data['title'] = 'Data Pohon';
        return view('front.detailPohon', $data);
    }
}
