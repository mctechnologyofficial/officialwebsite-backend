<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project = Project::selectRaw('projects.*, teams.name as teamname')
        ->join('teams', 'teams.id', '=', 'projects.team_id')
        ->orderBy('id', 'desc')
        ->get();

        return view('layouts.admin.project.list', compact(['project']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $team = Team::all();

        return view('layouts.admin.project.add', compact(['team']));
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
            'name'                      => 'required|string',
            'company'                   => 'required|string',
            'programming_language'      => 'required|string',
            'team_id'                   => 'required',
            'leader_id'                 => 'required',
            'github_repository'         => 'required|string',
            'image'                     => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());
            $image_path = $file->move('storage/projects', $filename);
        }else{
            $image_path = null;
        }

        Project::create([
            'name'                      => $attr['name'],
            'companu'                   => $attr['company'],
            'programming_language'      => $attr['programming_language'],
            'team_id'                   => $attr['team_id'],
            'leader_id'                 => $attr['leader_id'],
            'github_repository'         => $attr['github_repository'],
            'image'                     => $image_path,
            'status'                    => 0
        ]);

        return redirect()->route('admin.project.create')->with('success', 'Project has been saved successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $team = Team::all();
        $project = Project::find($id);

        return view('layouts.admin.project.edit', compact(['team', 'project']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $project = Project::find($id);
        $attr = $request->validate([
            'name'                      => 'required|string',
            'programming_language'      => 'required|string',
            'team_id'                   => 'required',
            'leader_id'                 => 'required',
            'github_repository'         => 'required|string',
            'image'                     => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());
            unlink($project->image);
            $image_path = $file->move('storage/projects', $filename);
        }else{
            $image_path = $project->image;
        }

        $project->update([
            'name'                      => $attr['name'],
            'programming_language'      => $attr['programming_language'],
            'team_id'                   => $attr['team_id'],
            'leader_id'                 => $attr['leader_id'],
            'github_repository'         => $attr['github_repository'],
            'image'                     => $image_path,
            'status'                    => 0
        ]);

        return redirect()->route('admin.project.edit', $id)->with('success', 'Project has been updated successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Get user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getUser(Request $request)
    {
        $teamid = $request->teamid;

        $user = User::whereHas(
            'roles', function($q){
                $q->where('name', 'leader developer');
            }
        )
        ->where('team_id', $teamid)
        ->get();

        $response['data'] = $user;

        return response()->json($response);
    }
}
