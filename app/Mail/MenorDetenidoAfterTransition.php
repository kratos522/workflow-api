<?php

namespace App\Mail;

use App\MenorDetenido;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MenorDetenidoAfterTransition extends Mailable
{
    use Queueable, SerializesModels;

    public $menor_detenido;
    public $rol;
    public $user;
    public $friendly_workflow_state;
    public $friendly_rol;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(MenorDetenido $menor_detenido, $rol, $user)
    {
        $this->menor_detenido = $menor_detenido;
        $this->rol = $rol;
        $this->user = $user;
        $this->friendly_workflow_state = ucfirst(implode(" ",explode("_",$this->menor_detenido->workflow_state)));
        $this->friendly_rol = ucfirst(implode(" ",explode("_",$this->rol)));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.menor_detenido_after_transition');
    }
}
