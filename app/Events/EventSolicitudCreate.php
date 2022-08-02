<?php

namespace App\Events;

use App\Models\Solicitud;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class EventSolicitudCreate implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * @var Solicitud
     */
    public $solicitude;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Solicitud $solicitude)
    {
        //
        $this->solicitude = $solicitude;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {

        return new Channel('solicitudes');
    }
}
