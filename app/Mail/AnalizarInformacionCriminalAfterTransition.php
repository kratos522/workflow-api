<?php

namespace App\Mail;

use App\AnalizarInformacionCriminal;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AnalizarInformacionCriminalAfterTransition extends Mailable
{
    use Queueable, SerializesModels;

    public $analizar_informacion_criminal;
    public $rol;
    public $user;
    public $friendly_workflow_state;
    public $friendly_rol;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(AnalizarInformacionCriminal $analizar_informacion_criminal, $rol, $user)
    {
        $this->analizar_informacion_criminal = $analizar_informacion_criminal;
        $this->rol = $rol;
        $this->user = $user;
      $this->friendly_workflow_state = ucfirst(implode(" ",explode("_",$this->analizar_informacion_criminal->workflow_state)));
        $this->friendly_rol = ucfirst(implode(" ",explode("_",$this->rol)));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.analizar_informacion_criminal_after_transition');
    }
}
