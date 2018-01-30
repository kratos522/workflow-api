<?php

namespace App\Listeners;

use Gate;
use App\AlbumFotografico;
use App\AlbumFotograficoWorkflow;
use App\Mail\AlbumFotograficoAfterTransition as NotifyTransition;
use Psr\Log\LoggerInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AlbumFotograficoSubscriber
{
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle($event)
    {
        // var_dump($event->task['title'].' was inside handle!');
    }

    public function onBeforeTransition($event) {
        $this->logger->alert('[onBeforeTransition]');
    }

    public function onAfterTransition($event) {
        // dd($event);
        $album_fotografico = AlbumFotografico::find($event->album_fotografico->id);
        $this->logger->alert('[onAfterTransition] to '.$album_fotografico->workflow_state);
        $album_fotografico_workflow = new AlbumFotograficoWorkflow;
        $dependencia_id = $album_fotografico_workflow->dependencia($album_fotografico);
        if (!is_null($dependencia_id)) {
          $users = $album_fotografico_workflow->notification_users($album_fotografico->workflow_state, $dependencia_id);
          // var_dump($users);
          if (!is_null($users)) {
            foreach($users as $u) {
              foreach($u->emails as $email) {
                $user = new \stdClass;
                $user->email = $email;
                $rol = $u->rol;
                $this->logger->alert('[Notify] email: '.$email);
                \Mail::to($user)->send(new NotifyTransition($album_fotografico, $rol, $user->email));
              }
            }
          }
        }
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\RealizarAlbumReconocimientoFotograficoAfterTransition',
            'App\Listeners\AlbumFotograficoSubscriber@onAfterTransition'
        );

        $events->listen(
            'App\Events\RealizarAlbumReconocimientoFotograficoBeforeTransition',
            'App\Listeners\AlbumFotograficoSubscriber@onBeforeTransition'
        );
    }
}
