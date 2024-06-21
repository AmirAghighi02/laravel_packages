<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('user.{id}', function ($user, $id) {
    info('here '.$id.' :: '.$user->id);

    return (int) $user->id === (int) $id;
});

Broadcast::channel('admin', function ($user) {
    return Auth::check() && Auth::user()->can('manage');
});
