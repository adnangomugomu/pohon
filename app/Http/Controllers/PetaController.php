<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PetaController extends Controller
{
    public function index()
    {
        $data['title'] = "Peta Persebaran Data Pohon";
        return view('admin.peta.index', $data);
    }
}
