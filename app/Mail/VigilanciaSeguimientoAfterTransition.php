<?php

namespace App\Mail;

use App\VigilanciaSeguimiento;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VigilanciaSeguimientoAfterTransition extends Mailable
{
    use Queueable, SerializesModels;

    public $vigilancia_seguimiento;
    public $rol;
    public $user;
    public $friendly_workflow_state;
    public $friendly_rol;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(VigilanciaSeguimiento $vigilancia_seguimiento, $rol, $user)
    {
        $this->vigilancia_seguimiento = $vigilancia_seguimiento;
        $this->rol = $rol;
        $this->user = $user;
        $this->friendly_workflow_state = ucfirst(implode(" ",explode("_",$this->vigilancia_seguimiento->workflow_state)));
        $this->friendly_rol = ucfirst(implode(" ",explode("_",$this->rol)));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.vigilancia_seguimiento_after_transition');
    }
}
