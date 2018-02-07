<?php

namespace App\Events;

use App\SolicitudAnalisis;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

//este cambio3 va el nombre de esta clase .php
class SolicitudAnalisisBeforeTransition
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
     //el primer cambio1 es elnombre del objeto que tiene el workflow_state
     // el cambio2 es el nombre de la maquina de estado
    public function __construct(SolicitudAnalisis $solicitud_analisis)
    {
        $this->solicitud_analisis = $solicitud_analisis;
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
