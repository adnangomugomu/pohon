<?php

namespace App\Http\Controllers\super_admin;

use App\Http\Controllers\Controller;
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

        return view('super_admin.dashboard', $data);
    }
}
