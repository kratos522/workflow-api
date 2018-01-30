<?php

namespace App\Mail;

use App\VictimaAgresionSexual;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VictimaAgresionSexualAfterTransition extends Mailable
{
    use Queueable, SerializesModels;

    public $victima_agresion_sexual;
    public $rol;
    public $user;
    public $friendly_workflow_state;
    public $friendly_rol;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(VictimaAgresionSexual $victima_agresion_sexual, $rol, $user)
    {
        $this->victima_agresion_sexual = $victima_agresion_sexual;
        $this->rol = $rol;
        $this->user = $user;
        $this->friendly_workflow_state = ucfirst(implode(" ",explode("_",$this->victima_agresion_sexual->workflow_state)));
        $this->friendly_rol = ucfirst(implode(" ",explode("_",$this->rol)));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.victima_agresion_sexual_after_transition');
    }
}
