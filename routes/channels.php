<?php

use App\Models\ClanUser;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat.{id}', function ($user, $id) { 
    return (int) $user->id === (int) $id;
});

Broadcast::channel('user-status.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// Broadcast::channel('private-chat.user.{id}', function ($user, $id) {
//     return  (int) $user->id === (int) ClanUser::where('user_id', $id)->first()->user_id;
// });
