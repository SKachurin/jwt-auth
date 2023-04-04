<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FileParsed implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {

        new Channel('file_parsed'); //even is firing but not going through. even direct with tinker
        // direct event with 127.0.0.1/laravel-websockets works fine
        // also Failed to listen on "tcp://0.0.0.0:6001": Address in use
        // after downgrade pushier to 7.0.2 from 7.2


    }
    public function broadcastAs()
    {
        return 'file.message';
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->message,

        ];
    }
}
