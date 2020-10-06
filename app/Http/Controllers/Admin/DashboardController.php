<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Traits\Sidebar\Catalog;

class DashboardController extends Controller
{
    use Catalog;

    public function index()
    {
        return view('admin.dashboard.index');
    }

    public function catalog()
    {
        return view('admin.dashboard.catalog', ['sidebar' => $this->getSidebar()]);
    }
}
