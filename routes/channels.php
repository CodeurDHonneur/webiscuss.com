<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\User;
use App\Http\Resources\UserResource;

Broadcast::channel('online', function (User $user) {
    return $user ? new UserResource($user) : null;
});
