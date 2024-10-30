<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    function index() {
        return view('dashboard.index');
    }
    
    function dashboardKaprodi() {
        return view('dashboard.index');
    }

    function dashboardDosen() {
        return view('dashboard.index');
    }

    function dashboardMahasiswa() {
        return view('dashboard.index');
    }

}
