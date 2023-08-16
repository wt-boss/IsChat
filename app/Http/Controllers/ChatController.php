<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Http\Requests\StoreChatRequest;
use App\Http\Requests\UpdateChatRequest;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $id=Auth::user()->id;
        $user=User::find($id);
        $chats = $user->chats;
        $chats_users =[];
        $last_messages=[];

        foreach ($chats as $chat) {
            $users=$chat->users->where('id', '!=',$id)->first();
            $chats_users[$chat->id]=$users;
            $last_messages[$chat->id]=$chat->messages->last()->content;
        }   

     // dd($last_messages);
        return inertia('Chat/Index',[
            'chats_users'=>$chats_users,
            'last_messages'=>$last_messages,
        ]
            

    );
    }

        /**
     * Display the specified resource.
     */
    public function show($id)
    {   $auth=Auth::user()->id;
        $chat= Chat::find($id);
        $user= $chat->users->where('id','!=', $auth)->first();
        $messages= $chat->messages->whereIn('user_id', [$auth, $user->id])->toArray();
       // $messages = [];
        //dd($messages_mixte);
/* 
        for ($i=0; $i <$messages_mixte->length ; $i++) { 
            $messages[$i]=$messages_mixte[$messages_mixte->length-$i-1];
        }

        */
        return inertia('Chat/Show',
                        [
                            'messages'=>$messages,
                            'user'=>$user,
                            'auth'=>$auth
                        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChatRequest $request)
    {
        //
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChatRequest $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chat $chat)
    {
        //
    }
}
