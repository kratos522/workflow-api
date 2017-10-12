<?php

namespace App\Mail;

use App\DenunciaMP;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DenunciaMPAfterTransition extends Mailable
{
    use Queueable, SerializesModels;

    public $denuncia_mp;
    public $rol;
    public $user;
    public $friendly_workflow_state;
    public $friendly_rol;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(DenunciaMP $denuncia_mp, $rol, $user)
    {
        $this->denuncia_mp = $denuncia_mp;
        $this->rol = $rol;
        $this->user = $user;
        $this->friendly_workflow_state = ucfirst(implode(" ",explode("_",$this->denuncia_mp->workflow_state)));
        $this->friendly_rol = ucfirst(implode(" ",explode("_",$this->rol)));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.denuncia_mp_after_transition');
    }
}
