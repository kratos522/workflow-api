<?php

namespace App\Mail;

use App\CotejamientoDactilar;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CotejamientoDactilarAfterTransition extends Mailable
{
    use Queueable, SerializesModels;

    public $cotejamiento_dactilar;
    public $rol;
    public $user;
    public $friendly_workflow_state;
    public $friendly_rol;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(CotejamientoDactilar $cotejamiento_dactilar, $rol, $user)
    {
        $this->cotejamiento_dactilar = $cotejamiento_dactilar;
        $this->rol = $rol;
        $this->user = $user;
        $this->friendly_workflow_state = ucfirst(implode(" ",explode("_",$this->cotejamiento_dactilar->workflow_state)));
        $this->friendly_rol = ucfirst(implode(" ",explode("_",$this->rol)));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.cotejamiento_dactilar_after_transition');
    }
}
