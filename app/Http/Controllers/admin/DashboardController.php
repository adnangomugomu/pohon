<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pohon;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'header' => 'Dashboard',
            'breadcrumb' => ['Dashboard', 'index']
        ];

        $data['total_user'] = User::count();
        $data['total_pohon'] = Pohon::count();

        return view('admin.dashboard', $data);
    }
}
