<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function home()
    {
        $navbar = 1;
        return view('front.home', ['navbar' => $navbar ?? null]);
    }
}
