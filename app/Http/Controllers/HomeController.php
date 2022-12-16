<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request->user()->hasRole('owner')){
            return view('layouts.owner.home');
        }else if($request->user()->hasRole('admin')){
            return view('layouts.admin.home');
        }else if($request->user()->hasRole('sales')){
            return view('layouts.sales.home');
        }else if($request->user()->hasRole('developer')){
            return view('layouts.developer.home');
        }
    }
}
