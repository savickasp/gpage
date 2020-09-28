<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index');
    }

    public function catalog()
    {
        return view('admin.dashboard.catalog');
    }
}
