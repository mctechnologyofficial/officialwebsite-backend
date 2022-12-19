<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Todolist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project = Project::where('team_id', Auth::user()->team_id)->get();

        return view('layouts.leader.project.list', compact(['project']));
    }

    /**
     *
     * Decline project
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function manage($id)
    {
        $project = Project::find($id);
        $member = User::where('team_id', Auth::user()->team_id)
        ->whereHas('roles', function ($query) {
            $query->where('name', '!=', 'leader developer');
        })
        ->get();

        $todolist = User::selectRaw('todolists.*, users.*, teams.name as teamname')
        ->join('todolists', 'todolists.member_id', '=', 'users.id')
        ->join('teams', 'teams.id', '=', 'todolists.team_id')
        ->where('todolists.team_id', Auth::user()->team_id)
        ->where('todolists.project_id', $project->id)
        ->orderBy('todolists.id', 'desc')
        ->get();

        return view('layouts.leader.project.manage', compact(['project', 'todolist', 'member']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attr = $request->validate([
            'project_id'    => 'required',
            'member_id'     => 'required',
            'task'          => 'required'
        ]);

        Todolist::create([
            'team_id'       => Auth::user()->team_id,
            'project_id'    => $attr['project_id'],
            'member_id'     => $attr['member_id'],
            'task'          => $attr['task'],
            'status'        => 0
        ]);

        return redirect()->route('leader.project.manage', $request->project_id)->with('success', 'Task has been saved successfully !');
    }

    /**
     *
     * Decline project
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);

        $project->update([
            'status'    => 2
        ]);

        return redirect()->route('leader.project.index')->with('success', 'You declined the project !');
    }

    /**
     * Accept project
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $project = Project::find($id);

        $project->update([
            'status'    => 1
        ]);

        return redirect()->route('leader.project.index')->with('success', 'You accepted the project !');
    }
}
