<?php

namespace App\Events;

use App\Location;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class LocationForkCreated
{
    use InteractsWithSockets, SerializesModels;

    public $location;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Location $location, Location $forked)
    {
        $this->location = $location;
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
