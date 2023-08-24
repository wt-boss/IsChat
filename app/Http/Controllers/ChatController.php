<?php

namespace App\Http\Controllers;

use App\Events\TypingMessageEvent;
use App\Models\Chat;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

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
        $users=User::all()->where('id', '!=',$id);
        $user=User::find($id);
        $chats = $user->chats;
        $chats_users =[];
        $last_messages=[];
        $chat_id=[];
        
        foreach ($chats as $chat) {
            if($chat->messages->last()){
                $chat_user=$chat->users->where('id', '!=',$id)->first();
                if(Cache::has('user-is-online-'.$chat_user->id)){
                    $chat_user->status='ligne';
                    $chat_user->save();
                }
                else{
                    /* $chat_user->update(['status'=>'horsLigne']); */
                    $chat_user->status='horsLine';
                    $chat_user->save();
                }
                $chats_users[$chat->id]=$chat_user;
                $last_messages[$chat->id]=$chat->messages->last()->content;
                $chat_id[$chat->id]=$chat->id;
            }
   
        }   

    
        return inertia('Chat/Index',[
            'chats_users'=>$chats_users,
            'last_messages'=>$last_messages,
            'users'=>$users,
            'chat_id'=>$chat_id
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
                            'auth'=>$auth,
                            'chat'=>$chat,
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
    public function store(Request $request)
    {
        $searchUser = User::find($request->id);
        $searchUserChats = $searchUser->chats;
        $auth= Auth::user() ;
       // dd($searchUserChats[0]->users);
        //dd($searchUser->chats->where('id', '=', $auth->id));
        if($searchUserChats){
            foreach ($searchUserChats as $chat) {
                if($chat->users->where('id', '=', $auth->id)->first()->id??false){
                    return redirect()->to('chat/'.$chat->id);
                }
            }
        }
        $newChat = Chat::create();

        DB::table('chat_user')->insert([
            'chat_id'=>$newChat->id,
            'user_id'=>$searchUser->id
        ]);
        DB::table('chat_user')->insert([
            'chat_id'=>$newChat->id,
            'user_id'=>$auth->id
        ]);

        return redirect()->to('chat/'.$newChat->id);
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
    public function update(Request $request, Chat $chat)
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

    public function typing(Request $request){
        $chat = Chat::find($request->id);
        broadcast(new TypingMessageEvent($chat, true))->toOthers();
        return response()->json(['message'=>'jdjsd']);
    }
}
