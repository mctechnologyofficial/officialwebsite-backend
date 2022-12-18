<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class MemberController extends Controller
{
    /**
     *
     *  Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $member = User::selectRaw('users.*, teams.name AS teamname')
            ->join('teams', 'teams.id', '=', 'users.team_id')
            ->whereHas('roles', function ($query) {
                $query->where('name', '!=', 'admin');
                $query->where('name', '!=', 'owner');
            })
            ->orderBy('id', 'ASC')
            ->get();

        return view('layouts.admin.member.list', compact(['member']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::whereNot('name', 'owner')->get();
        $team = Team::all();
        return view('layouts.admin.member.add', compact(['role', 'team']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name'      => 'required|string',
            'email'     => 'required|email',
            'password'  => 'required|string',
            'position'  => 'required',
            'team_id'   => 'required',
            'image'     => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        $file = $request->file('image');
        $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());
        $image_path = $file->move('storage/users', $filename);

        $user = User::create([
            'name'      => $attributes['name'],
            'email'     => $attributes['email'],
            'password'  => Hash::make($attributes['password']),
            'team_id'   => $attributes['team_id'],
            'image'     => $image_path,
        ]);

        // assign role
        $role = Role::find($attributes['position']);
        $user->assignRole($role);

        return redirect()->route('admin.member.create')->with('success', 'User has been saved successfully !');
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
        $member = User::find($id);
        $role = Role::whereNot('name', 'owner')->get();
        $team = Team::all();
        return view('layouts.admin.member.edit', compact(['member', 'role', 'team']));
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
        $user = User::find($id);
        $attributes = $request->validate([
            'name'      => 'required|string',
            'email'     => 'required|email',
            'position'  => 'required',
            'team_id'   => 'required',
            'image'     => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());
            unlink($user->image);
            $image_path = $file->move('storage/users', $filename);
        }else{
            $image_path = $user->image;
        }

        $user->update([
            'name'      => $attributes['name'],
            'email'     => $attributes['email'],
            'team_id'   => $attributes['team_id'],
            'image'     => $image_path,
        ]);

        // assign role
        $role = Role::find($attributes['position']);
        $user->assignRole($role);

        return redirect()->route('admin.member.edit', $id)->with('success', 'User has been updated successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();

        return redirect()->route('admin.member.index')->with('success', 'User has been deleted successfuly !');
    }
}
