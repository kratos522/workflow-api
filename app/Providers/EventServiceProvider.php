<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
     protected $listen = [
         'Brexis\LaravelWorkflow\Events\Leave' => [
             'App\Listeners\WorkflowSubscribers@onLeave',
         ],
         'Brexis\LaravelWorkflow\Events\Guard' => [
             'App\Listeners\WorkflowSubscribers@onGuard',
         ],
         'App\Events\taskBeforeB' => [
             'App\Listeners\TaskB',
         ],
         'App\Events\taskAfterB' => [
             'App\Listeners\TaskB',
         ],
         'App\Events\DenunciaMPAfterTransition' => [
             'App\Listeners\DenunciaMPSubscriber',
         ],
         'App\Events\DenunciaMPBeforeTransition' => [
             'App\Listeners\DenunciaMPSubscriber',
         ],
         'App\Events\DenunciaSSAfterTransition' => [
             'App\Listeners\DenunciaSSSubscriber',
         ],
         'App\Events\DenunciaSSBeforeTransition' => [
             'App\Listeners\DenunciaSSSubscriber',
         ],
         'App\Events\DocumentoAfterTransition' => [
             'App\Listeners\DocumentoSubscriber',
         ],
         'App\Events\DocumentoBeforeTransition' => [
             'App\Listeners\DocumentoSubscriber',
         ],
         'App\Events\ContestacionOficioSSAfterTransition' => [
             'App\Listeners\ContestacionOficioSSSubscriber',
         ],
         'App\Events\ContestacionOficioSSBeforeTransition' => [
             'App\Listeners\ContestacionOficioSSSubscriber',
         ],
         'App\Events\DelitoContraPropiedadSSAfterTransition' => [
             'App\Listeners\DelitoContraPropiedadSSSubscriber',
         ],
         'App\Events\DelitoContraPropiedadSSBeforeTransition' => [
             'App\Listeners\DelitoContraPropiedadSSSubscriber',
         ],
         'App\Events\DenunciaProcesoGeneralSSAfterTransition' => [
             'App\Listeners\DenunciaProcesoGeneralSSSubscriber',
         ],
         'App\Events\DenunciaProcesoGeneralSSBeforeTransition' => [
             'App\Listeners\DenunciaProcesoGeneralSSSubscriber',
         ],
         'App\Events\EstandarizacionSSAfterTransition' => [
             'App\Listeners\EstandarizacionSSSubscriber',
         ],
         'App\Events\EstandarizacionSSBeforeTransition' => [
             'App\Listeners\EstandarizacionSSSubscriber',
         ],
         'App\Events\ExtraerDatoSistemaSSAfterTransition' => [
             'App\Listeners\ExtraerDatoSistemaSSSubscriber',
         ],
         'App\Events\ExtraerDatoSistemaSSBeforeTransition' => [
             'App\Listeners\ExtraerDatoSistemaSSSubscriber',
         ],
         'App\Events\InformeCuadroEstadisticoSSAfterTransition' => [
             'App\Listeners\InformeCuadroEstadisticoSSSubscriber',
         ],
         'App\Events\InformeCuadroEstadisticoSSBeforeTransition' => [
             'App\Listeners\InformeCuadroEstadisticoSSSubscriber',
         ],
         'App\Events\InformeDisciplinarioSSAfterTransition' => [
             'App\Listeners\InformeDisciplinarioSSSubscriber',
         ],
         'App\Events\InformeDisciplinarioSSBeforeTransition' => [
             'App\Listeners\InformeDisciplinarioSSSubscriber',
         ],
         'App\Events\InformeEscenaCrimenSSAfterTransition' => [
             'App\Listeners\InformeEscenaCrimenSSSubscriber',
         ],
         'App\Events\InformeEscenaCrimenSSBeforeTransition' => [
             'App\Listeners\InformeEscenaCrimenSSSubscriber',
         ],
         'App\Events\InformeHomicidioSSAfterTransition' => [
             'App\Listeners\InformeHomicidioSSSubscriber',
         ],
         'App\Events\InformeHomicidioSSBeforeTransition' => [
             'App\Listeners\InformeHomicidioSSSubscriber',
         ],
         'App\Events\InformeLogisticoSSAfterTransition' => [
             'App\Listeners\InformeLogisticoSSSubscriber',
         ],
         'App\Events\InformeLogisticoSSBeforeTransition' => [
             'App\Listeners\InformeLogisticoSSSubscriber',
         ],
         'App\Events\InformePerfilacionCriminalSSAfterTransition' => [
             'App\Listeners\InformePerfilacionCriminalSSSubscriber',
         ],
         'App\Events\InformePerfilacionCriminalSSBeforeTransition' => [
             'App\Listeners\InformePerfilacionCriminalSSSubscriber',
         ],
         'App\Events\InformeURIDSSAfterTransition' => [
             'App\Listeners\InformeURIDSSSubscriber',
         ],
         'App\Events\InformeURIDSSBeforeTransition' => [
             'App\Listeners\InformeURIDSSSubscriber',
         ],
         'App\Events\NotificacionInternaSSAfterTransition' => [
             'App\Listeners\NotificacionInternaSSSubscriber',
         ],
         'App\Events\NotificacionInternaSSBeforeTransition' => [
             'App\Listeners\NotificacionInternaSSSubscriber',
         ],
         'App\Events\NuevaPromocionSSAfterTransition' => [
             'App\Listeners\NuevaPromocionSSSubscriber',
         ],
         'App\Events\NuevaPromocionSSBeforeTransition' => [
             'App\Listeners\NuevaPromocionSSSubscriber',
         ],
         'App\Events\SolicitudAntecedenteSSAfterTransition' => [
             'App\Listeners\SolicitudAntecedenteSSSubscriber',
         ],
         'App\Events\SolicitudAntecedenteSSBeforeTransition' => [
             'App\Listeners\SolicitudAntecedenteSSSubscriber',
         ],
         'App\Events\SolicitudEstructuraCriminalSSAfterTransition' => [
             'App\Listeners\SolicitudEstructuraCriminalSSSubscriber',
         ],
         'App\Events\SolicitudEstructuraCriminalSSBeforeTransition' => [
             'App\Listeners\SolicitudEstructuraCriminalSSSubscriber',
         ],
         'App\Events\SolicitudRecordHistorialAfterTransition' => [
             'App\Listeners\SolicitudRecordHistorialSubscriber',
         ],
         'App\Events\SolicitudRecordHistorialBeforeTransition' => [
             'App\Listeners\SolicitudRecordHistorialSubscriber',
         ],
         'App\Events\SolicitudReveladoFotografiaSSAfterTransition' => [
             'App\Listeners\SolicitudReveladoFotografiaSSSubscriber',
         ],
         'App\Events\SolicitudReveladoFotografiaSSBeforeTransition' => [
             'App\Listeners\SolicitudReveladoFotografiaSSSubscriber',
         ],
         'App\Events\SolicitudRevisarInformacionDigitalSSAfterTransition' => [
             'App\Listeners\SolicitudRevisarInformacionDigitalSSSubscriber',
         ],
         'App\Events\SolicitudRevisarInformacionDigitalSSBeforeTransition' => [
             'App\Listeners\SolicitudRevisarInformacionDigitalSSSubscriber',
         ],
         'App\Events\SolicitudTransporteAlmacenGeneralSSAfterTransition' => [
             'App\Listeners\SolicitudTransporteAlmacenGeneralSSSubscriber',
         ],
         'App\Events\SolicitudTransporteAlmacenGeneralSSBeforeTransition' => [
             'App\Listeners\SolicitudTransporteAlmacenGeneralSSSubscriber',
         ],
     ];

     protected $subscribe = [
         'App\Listeners\WorkflowSubscribers',
         'App\Listeners\TaskB',
         'App\Listeners\DenunciaMPSubscriber',
         'App\Listeners\DenunciaSSSubscriber',
         'App\Listeners\DocumentoSubscriber',
         'App\Listeners\ContestacionOficioSSSubscriber',
         'App\Listeners\DelitoContraPropiedadSSSubscriber',
         'App\Listeners\DenunciaProcesoGeneralSSSubscriber',
         'App\Listeners\EstandarizacionSSSubscriber',
         'App\Listeners\ExtraerDatoSistemaSSSubscriber',
         'App\Listeners\InformeCuadroEstadisticoSSSubscriber',
         'App\Listeners\InformeDisciplinarioSSSubscriber',
         'App\Listeners\InformeEscenaCrimenSSSubscriber',
         'App\Listeners\InformeHomicidioSSSubscriber',
         'App\Listeners\InformeLogisticoSSSubscriber',
         'App\Listeners\InformePerfilacionCriminalSSSubscriber',
         'App\Listeners\InformeURIDSSSubscriber',
         'App\Listeners\NotificacionInternaSSSubscriber',
         'App\Listeners\NuevaPromocionSSSubscriber',
         'App\Listeners\SolicitudAntecedenteSSSubscriber',
         'App\Listeners\SolicitudEstructuraCriminalSSSubscriber',
         'App\Listeners\SolicitudRecordHistorialSubscriber',
         'App\Listeners\SolicitudReveladoFotografiaSSSubscriber',
         'App\Listeners\SolicitudRevisarInformacionDigitalSSSubscriber',
         'App\Listeners\SolicitudTransporteAlmacenGeneralSSSubscriber',
     ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
