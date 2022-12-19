<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $user = User::find($request->user()->id);
        $team = User::where('team_id', $request->user()->team_id)->get();

        $project  = Project::all();
        $projecttotal = Project::where('team_id', Auth::user()->team_id)->count();

        return view('profile.show', compact(['user', 'team', 'project', 'projecttotal']));
    }

    /**
     * Display the user's profile form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function show(Request $request, $id)
    {
        $user = User::find($id);
        $team = User::where('team_id', $request->user()->team_id)->get();

        $project  = Project::all();
        $projecttotal = Project::where('team_id', Auth::user()->team_id)->count();

        return view('profile.show', compact(['user', 'team', 'project', 'projecttotal']));
    }

    /**
     * Update the user's profile information.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        User::where('id', Auth::user()->id)->update($request->except(['_token', '_method']));

        return redirect()->route('profile.index')->with('success', 'Profile updated !');
    }

    /**
     * Update the user's profile information.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatepassword(Request $request)
    {
        User::where('id', Auth::user()->id)->update([
            'password'  => Hash::make($request->password),
        ]);

        return redirect()->route('profile.index')->with('success', 'Password updated !');
    }

    /**
     * Update the user's profile information.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateimage(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $file = $request->file('image');
        $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());
        unlink(public_path(). '/' .$user->image);
        $image_path = $file->move('storage/users', $filename);

        $user->update([
            'image'  => $image_path,
        ]);

        return response()->json(['success' => 'Profile picture updated !']);
    }

    /**
     * Delete the user's account.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $user = User::find(Auth::user()->id);

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
