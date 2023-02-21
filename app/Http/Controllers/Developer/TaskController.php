<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller;
use App\Models\Todolist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notyet = Todolist::where('status', 0)->where('member_id', Auth::user()->id)->get();
        $progress = Todolist::where('status', 1)->where('member_id', Auth::user()->id)->get();
        $complete = Todolist::where('status', 2)->where('member_id', Auth::user()->id)->get();

        return view('layouts.developer.task.index', compact(['notyet', 'progress', 'complete']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $taskid = $request->taskid;
        $status = $request->status;

        $task = Todolist::find($taskid);
        $task->update([
            'status'    => $status
        ]);

        $response['data'] = $task;

        return response()->json($response);
    }

    /**
     * Get Task
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function gettask(Request $request)
    {
        $task = Todolist::where('member_id', Auth::user()->id)->where('status', 0)->count();

        $response['data'] = $task;

        return response()->json($response);
    }
}
