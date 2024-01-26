<?php

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

//Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//    return (int) $user->id === (int) $id;
//});

// Broadcast::channel('my-channel', function ($user) {
//    return true; // You can implement your own authorization logic here
// });

//Broadcast::channel('chat', function ($user) {
//    return Auth::check();
//});



// Broadcast::channel('chat-{user_id}', function ($user, $user_id) {
//     return response()->json([ 
//         'user' => $user,
//         'user_id' => $user_id,
//         'auth_user' => Auth::user()
//     ]);
// });

Broadcast::channel('my-chat-channel', function() {
    return true;
});
