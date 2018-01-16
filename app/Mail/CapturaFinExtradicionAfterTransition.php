<?php

namespace App\Mail;

use App\CapturaFinExtradicion;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CapturaFinExtradicionAfterTransition extends Mailable
{
    use Queueable, SerializesModels;

    public $captura_fin_extradicion;
    public $rol;
    public $user;
    public $friendly_workflow_state;
    public $friendly_rol;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(CapturaFinExtradicion $captura_fin_extradicion, $rol, $user)
    {
        $this->captura_fin_extradicion = $captura_fin_extradicion;
        $this->rol = $rol;
        $this->user = $user;
        $this->friendly_workflow_state = ucfirst(implode(" ",explode("_",$this->captura_fin_extradicion->workflow_state)));
        $this->friendly_rol = ucfirst(implode(" ",explode("_",$this->rol)));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.captura_fin_extradicion_after_transition');
    }
}
