<?php

namespace App\Events;

use App\VictimaAgresionSexual;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AtenderLesionadoVictimaAgresionSexualBeforeTransition
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(VictimaAgresionSexual $atender_lesionados_victimas_agresion_sexual_ss)
    {
        $this->atender_lesionados_victimas_agresion_sexual_ss = $atender_lesionados_victimas_agresion_sexual_ss;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
