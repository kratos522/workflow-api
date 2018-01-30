<?php

namespace App\Mail;

use App\ExtraccionInformacionTelefonoMovil;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ExtraccionInformacionTelefonoMovilAfterTransition extends Mailable
{
    use Queueable, SerializesModels;

    public $extraccion_informacion_telefono_movil;
    public $rol;
    public $user;
    public $friendly_workflow_state;
    public $friendly_rol;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ExtraccionInformacionTelefonoMovil $extraccion_informacion_telefono_movil, $rol, $user)
    {
        $this->extraccion_informacion_telefono_movil = $extraccion_informacion_telefono_movil;
        $this->rol = $rol;
        $this->user = $user;
        $this->friendly_workflow_state = ucfirst(implode(" ",explode("_",$this->extraccion_informacion_telefono_movil->workflow_state)));
        $this->friendly_rol = ucfirst(implode(" ",explode("_",$this->rol)));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.extraccion_informacion_telefono_movil_after_transition');
    }
}
