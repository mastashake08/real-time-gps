<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Device;
class SendCommand implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;
    public $device, $command;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Device $device, $command)
    {
        //
        $this->device = $device;
        $this->command = $command;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('command');
    }
}
