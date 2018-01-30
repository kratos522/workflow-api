<?php

namespace App\Mail;

use App\ReseniaFotografica;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReseniaFotograficaAfterTransition extends Mailable
{
    use Queueable, SerializesModels;

    public $resenia_fotografica;
    public $rol;
    public $user;
    public $friendly_workflow_state;
    public $friendly_rol;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ReseniaFotografica $resenia_fotografica, $rol, $user)
    {
        $this->resenia_fotografica = $resenia_fotografica;
        $this->rol = $rol;
        $this->user = $user;
        $this->friendly_workflow_state = ucfirst(implode(" ",explode("_",$this->resenia_fotografica->workflow_state)));
        $this->friendly_rol = ucfirst(implode(" ",explode("_",$this->rol)));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.resenia_fotografica_after_transition');
    }
}
