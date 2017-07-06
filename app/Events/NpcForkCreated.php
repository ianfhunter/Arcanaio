<?php

namespace App\Events;

use App\Npc;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NpcForkCreated
{
    use InteractsWithSockets, SerializesModels;

    public $npc;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Npc $npc, Npc $forked)
    {
        $this->npc = $npc;
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
