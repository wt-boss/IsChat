<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Chat;
use App\Models\User;
use App\Models\Message;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Sequence;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
     
         $users=User::factory(5)->create();
         $test_user= \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
         ]);
         $chats = Chat::factory()->count(5)->create();

         foreach ($chats as $chat) {
            $ids=[6,$chat->id];
            DB::table('chat_user')->insert([
                'user_id'=>6,
                'chat_id'=>$chat->id
            ]);
  
            DB::table('chat_user')->insert([
                'user_id'=>$chat->id,
                'chat_id'=>$chat->id
            ]);

            Message::factory(10)->sequence(fn (Sequence $sequence) => [ 'chat_id'=>$chat->id,
                                                                        'user_id'=>$ids[array_rand($ids,1)]])->create();
         }

         




         
 
    }
}
