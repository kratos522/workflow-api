<?php

namespace App\Mail;

use App\DictamenVehicular;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DictamenVehicularAfterTransition extends Mailable
{
    use Queueable, SerializesModels;

    public $dictamen_vehicular;
    public $rol;
    public $user;
    public $friendly_workflow_state;
    public $friendly_rol;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(DictamenVehicular $dictamen_vehicular, $rol, $user)
    {
        $this->dictamen_vehicular = $dictamen_vehicular;
        $this->rol = $rol;
        $this->user = $user;
        $this->friendly_workflow_state = ucfirst(implode(" ",explode("_",$this->dictamen_vehicular->workflow_state)));
        $this->friendly_rol = ucfirst(implode(" ",explode("_",$this->rol)));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.dictamen_vehicular_after_transition');
    }
}
