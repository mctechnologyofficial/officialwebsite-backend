<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if($request->user()->hasRole('owner')){
            return view('layouts.owner.home');
        }else if($request->user()->hasRole('admin')){
            $user = User::count();
            return view('layouts.admin.home', compact(['user']));
        }else if($request->user()->hasRole('sales')){
            return view('layouts.sales.home');
        }else if($request->user()->hasRole('frontend developer|backend developer|mobile developer|UI/UX designer')){
            return view('layouts.developer.home');
        }
    }
}
