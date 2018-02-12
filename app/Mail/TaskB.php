<?php

namespace App\Mail;

use App\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TaskB extends Mailable
{
    use Queueable, SerializesModels;

    public $task;
    public $rol;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Task $task, $rol, $user)
    {
        $this->task = $task;
        $this->rol = $rol;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.task_b');
    }
}
