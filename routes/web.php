<?php

use App\Events\TestEvent;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', static function () {
    Auth::login(User::find(7));

    return view('welcome');
});

Route::get('/send/{id?}', function (?int $id = null) {
    $id = $id ?: random_int(1, 10);
    $message = fake()->email();
    TestEvent::dispatch(User::findOrFail($id)->toArray(), $message);

    return ['id' => $id, 'message' => $message];
});
