<?php

namespace App\Http\Controllers;

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

        // $file = $request->image;
        // $namewithextension = $file->getClientOriginalName(); //Name with extension 'filename.jpg'
        // $name = explode('.', $namewithextension)[0]; // Filename 'filename'
        // $extension = $file->getClientOriginalExtension(); //Extension 'jpg'
        // $uploadname = date('Y-m-d H:i:s') . '_' . $name . '.' . $extension;
        // $image_path = $file->move('storage/users', $uploadname);

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
        //
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
        //
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
}
