<?php

namespace App\Mail;

use App\DenunciaSS;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DenunciaSSAfterTransition extends Mailable
{
    use Queueable, SerializesModels;

    public $denuncia_ss;
    public $rol;
    public $user;
    public $friendly_workflow_state;
    public $friendly_rol;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(DenunciaSS $denuncia_ss, $rol, $user)
    {
        $this->denuncia_ss = $denuncia_ss;
        $this->rol = $rol;
        $this->user = $user;
        $this->friendly_workflow_state = ucfirst(implode(" ",explode("_",$this->denuncia_ss->workflow_state)));
        $this->friendly_rol = ucfirst(implode(" ",explode("_",$this->rol)));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.denuncia_ss_after_transition');
    }
}
