<?php

namespace App\Events;

use App\Spell;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SpellCreated
{
    use InteractsWithSockets, SerializesModels;

    public $spell;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Spell $spell)
    {
        $this->spell = $spell;
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
