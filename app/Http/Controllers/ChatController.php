<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contact = User::select('*')
        ->where('users.id', '!=', Auth::user()->id)
        ->get();

        $recentchat = Chat::selectRaw('chats.*, users.image, users.name')
        ->join('users', 'users.id', '=', 'chats.from_id')
        ->where('to_id', Auth::user()->id)
        ->where(function($query){
            return $query
            ->where('status', 0)
            ->orWhere('status', 1);
        })
        ->orderBy('chats.id', 'DESC')
        ->groupBy('chats.from_id')
        ->get();
        // dd($user->created_at->diffInDays() < 1 ? 'Today' : ucwords($user->created_at->diffForHumans(['options' => Carbon::ONE_DAY_WORDS])));
        return view('chat.index', compact(['contact', 'recentchat']));
    }

    /**
     * Display Total Unread Chat
     *
     * @param \illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function totalUnreadChat(Request $request)
    {
        $unreadmessage = Chat::where('to_id', Auth::user()->id)->where('status', 0)->count();

        $response['data'] = $unreadmessage;

        return response()->json($response);
    }

    /**
     * Update Total Unread Chat
     *
     * @param \illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateUnreadChat(Request $request)
    {
        $fromid = $request->fromid;
        if($fromid != Auth::user()->id){
            $updateRecentChat = Chat::where('from_id', $fromid)->update([
                'status' => 1
            ]);
        }

        $response['data'] = $updateRecentChat;

        return response()->json($response);
    }

    /**
     * Display Profile Room Chat
     *
     * @param \illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getProfile(Request $request)
    {
        $fromid = $request->fromid;
        $user = User::find($request->fromid);

        if(Cache::has('user-is-online-' . $fromid)){
            $status = "Online";
        }else{
            $status = Carbon::parse($user->last_seen)->diffForHumans();
        }

        $user = User::where('id', $fromid)->get();

        $response['data'] = $user;
        $response['status'] = $status;

        return response()->json($response);
    }

    /**
     * Display Chat
     *
     * @param \illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getChat(Request $request)
    {
        $fromid = $request->fromid;

        $unreadmessage = Chat::where('from_id', $fromid)->orWhere('from_id', Auth::user()->id)->get();

        $response['data'] = $unreadmessage;

        return response()->json($response);
    }

    /**
     * sendChat Chat
     *
     * @param \illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function sendChat(Request $request)
    {
        $message = $request->message;
        $toid = $request->toid;

        $send = Chat::create([
            'from_id'   => Auth::user()->id,
            'to_id'     => $toid,
            'message'   => $message,
            'media'     => null,
            'status'    => 0
        ]);

        $response['data'] = $send;

        return response()->json($response);
    }
}
