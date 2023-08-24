<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat.{id}', function ($user) {
  
        return Auth::check();
    });

    Broadcast::channel('user.status.{id}', function ($user) {
          return Auth::check();

    });

    Broadcast::channel('message.typing', function ($user) {
        return Auth::check();

  });

  Broadcast::channel('message.status', function ($user) {
    return Auth::check();

});

