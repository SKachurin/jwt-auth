<?php

namespace App\Broadcasting;

use App\Models\User;
use BeyondCode\LaravelWebSockets\WebSockets\Channels\Channel;

class FileParsed
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        new Channel('user');
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param  \App\Models\User  $user
     * @return array|bool
     */
    public function join(User $user)
    {
        return $user->id; // also nothing
    }
}
