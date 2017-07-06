<?php

namespace App\Events;

use App\Monster;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MonsterForkCreated
{
    use InteractsWithSockets, SerializesModels;

    public $monster;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Monster $monster, Monster $forked)
    {
        $this->monster = $monster;
        $this->forked = $forked;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
