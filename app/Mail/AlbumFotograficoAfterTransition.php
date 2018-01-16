<?php

namespace App\Mail;

use App\AlbumFotografico;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AlbumFotograficoAfterTransition extends Mailable
{
    use Queueable, SerializesModels;

    public $album_fotografico;
    public $rol;
    public $user;
    public $friendly_workflow_state;
    public $friendly_rol;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(AlbumFotografico $album_fotografico, $rol, $user)
    {
        $this->album_fotografico = $album_fotografico;
        $this->rol = $rol;
        $this->user = $user;
        $this->friendly_workflow_state = ucfirst(implode(" ",explode("_",$this->album_fotografico->workflow_state)));
        $this->friendly_rol = ucfirst(implode(" ",explode("_",$this->rol)));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.album_fotografico_after_transition');
    }
}
