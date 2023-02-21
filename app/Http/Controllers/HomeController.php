<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Team;
use App\Models\Todolist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function get_percentage($total, $number)
    {
        if ( $total > 0 ) {
            return round(($number * 100) / $total, 2);
        } else {
            return 0;
        }
    }

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
            return view('layouts.leader.home');
        } else if ($request->user()->hasRole('frontend developer|backend developer|mobile developer|UI/UX designer')) {
            $totalteam = Team::all()->count();
            $team = Team::find(Auth::user()->team_id);
            $totalproject = Project::where('team_id', Auth::user()->team_id)->where('status', 1)->count();

            $project = Project::where('projects.team_id', Auth::user()->team_id)
            ->where('projects.status', 1)
            ->get();
            $task = Todolist::selectRaw('projects.name, todolists.*')
            ->join('projects', 'projects.id', '=', 'todolists.project_id')
            ->where('todolists.member_id', Auth::user()->id)
            ->orderBy('todolists.id', 'DESC')
            ->get();

            $totaltask = Todolist::where('member_id', Auth::user()->id)->count();
            $finishtask = Todolist::where('member_id', Auth::user()->id)->where('status', 2)->count();

            $percentage = self::get_percentage($totaltask, $finishtask);

            $membertask = User::where('team_id', Auth::user()->team_id)->get();
            return view('layouts.developer.home', compact(['totalteam', 'team', 'totalproject', 'task', 'membertask', 'project', 'totaltask', 'finishtask', 'percentage']));
        }
    }
}
