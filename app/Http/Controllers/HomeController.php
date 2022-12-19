<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->hasRole('owner')) {
            return view('layouts.owner.home');
        } else if ($request->user()->hasRole('admin')) {
            $user = User::count();
            return view('layouts.admin.home', compact(['user']));
        } else if ($request->user()->hasRole('sales')) {
            return view('layouts.sales.home');
        } else if ($request->user()->hasRole('leader developer')) {
            // $totalproject = Project::where('team_id', Auth::user()->team_id)->where('status', 0)->count();
            // $project = Project::select('*')->orderBy('id', 'desc')->take(5)->get();

            return view('layouts.leader.home');
        } else if ($request->user()->hasRole('frontend developer|backend developer|mobile developer|UI/UX designer')) {
            return view('layouts.developer.home');
        }
    }
}
