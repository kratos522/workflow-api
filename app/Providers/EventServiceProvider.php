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
         ////////////////////////////////////////
         'App\Events\AnalizarInformacionCriminalAfterTransition' => [
             'App\Listeners\AnalizarInformacionCriminalSubscriber',
         ],
         'App\Events\AnalizarInformacionCriminalBeforeTransition' => [
             'App\Listeners\AnalizarInformacionCriminalSubscriber',
         ],

         'App\Events\AprehencionMenorInfractorAfterTransition' => [
             'App\Listeners\MenorDetenidoSubscriber',
         ],
         'App\Events\AprehencionMenorInfractorBeforeTransition' => [
             'App\Listeners\MenorDetenidoSubscriber',
         ],

         'App\Events\AtenderLesionadoVictimaAgresionSexualAfterTransition' => [
             'App\Listeners\VictimaAgresionSexualSubscriber',
         ],
         'App\Events\AtenderLesionadoVictimaAgresionSexualBeforeTransition' => [
             'App\Listeners\VictimaAgresionSexualSubscriber',
         ],

         'App\Events\SolicitudConsultaAfterTransition' => [
             'App\Listeners\SolicitudConsultaSubscriber',
         ],
         'App\Events\SolicitudConsultaBeforeTransition' => [
             'App\Listeners\SolicitudConsultaSubscriber',
         ],

         'App\Events\CapturaFinExtradicionAfterTransition' => [
             'App\Listeners\CapturaFinExtradicionSubscriber',
         ],
         'App\Events\CapturaFinExtradicionBeforeTransition' => [
             'App\Listeners\CapturaFinExtradicionSubscriber',
         ],

         'App\Events\CotejamientoDactilarAfterTransition' => [
             'App\Listeners\CotejamientoDactilarSubscriber',
         ],
         'App\Events\CotejamientoDactilarBeforeTransition' => [
             'App\Listeners\CotejamientoDactilarSubscriber',
         ],

         'App\Events\ExtraccionInformacionTelefonoMovilAfterTransition' => [
             'App\Listeners\ExtraccionInformacionTelefonoMovilSubscriber',
         ],
         'App\Events\ExtraccionInformacionTelefonoMovilBeforeTransition' => [
             'App\Listeners\ExtraccionInformacionTelefonoMovilSubscriber',
         ],

         'App\Events\InfiltrarOrganizacionCriminalAfterTransition' => [
             'App\Listeners\InfiltrarOrganizacionCriminalSubscriber',
         ],
         'App\Events\InfiltrarOrganizacionCriminalBeforeTransition' => [
             'App\Listeners\InfiltrarOrganizacionCriminalSubscriber',
         ],

         'App\Events\IntervencionComunicacionAfterTransition' => [
             'App\Listeners\IntervencionComunicacionSubscriber',
         ],
         'App\Events\IntervencionComunicacionBeforeTransition' => [
             'App\Listeners\IntervencionComunicacionSubscriber',
         ],

         'App\Events\InvestigarDelitoAfterTransition' => [
             'App\Listeners\InvestigarDelitoSubscriber',
         ],
         'App\Events\InvestigarDelitoBeforeTransition' => [
             'App\Listeners\InvestigarDelitoSubscriber',
         ],

         'App\Events\RealizarAlbumReconocimientoFotograficoAfterTransition' => [
             'App\Listeners\AlbumFotograficoSubscriber',
         ],
         'App\Events\RealizarAlbumReconocimientoFotograficoBeforeTransition' => [
             'App\Listeners\AlbumFotograficoSubscriber',
         ],

         'App\Events\RealizarDictamenVehicularAfterTransition' => [
             'App\Listeners\DitamenVehicularSubscriber',
         ],
         'App\Events\RealizarDictamenVehicularBeforeTransition' => [
             'App\Listeners\DitamenVehicularSubscriber',
         ],

         'App\Events\RealizarEntregaVigiladaAfterTransition' => [
             'App\Listeners\VigilanciaSeguimientoSubscriber',
         ],
         'App\Events\RealizarEntregaVigiladaBeforeTransition' => [
             'App\Listeners\VigilanciaSeguimientoSubscriber',
         ],

         'App\Events\RealizarRegistroArmaAfterTransition' => [
             'App\Listeners\RegistroArmaSubscriber',
         ],
         'App\Events\RealizarRegistroArmaBeforeTransition' => [
             'App\Listeners\RegistroArmaSubscriber',
         ],

         'App\Events\RealizarReseñaFotograficaAfterTransition' => [
             'App\Listeners\ReseniaFotograficaSubscriber',
         ],
         'App\Events\RealizarReseñaFotograficaBeforeTransition' => [
             'App\Listeners\ReseniaFotograficaSubscriber',
         ],

         'App\Events\RecepcionarDeclaracionAfterTransition' => [
             'App\Listeners\RecepcionarDeclaracionSubscriber',
         ],
         'App\Events\RecepcionarDeclaracionBeforeTransition' => [
             'App\Listeners\RecepcionarDeclaracionSubscriber',
         ],

         'App\Events\ReconocimientoRuedaPersonaAfterTransition' => [
             'App\Listeners\ReconocimientoRuedaPersonaSubscriber',
         ],
         'App\Events\ReconocimientoRuedaPersonaBeforeTransition' => [
             'App\Listeners\ReconocimientoRuedaPersonaSubscriber',
         ],

         'App\Events\RegistrarOrdenJudicialAfterTransition' => [
             'App\Listeners\RegistrarOrdenJudicialSubscriber',
         ],
         'App\Events\RegistrarOrdenJudicialBeforeTransition' => [
             'App\Listeners\RegistrarOrdenJudicialSubscriber',
         ],

         'App\Events\RetencionNotaRojaAfterTransition' => [
             'App\Listeners\NotaRojaSubscriber',
         ],
         'App\Events\RetencionNotaRojaBeforeTransition' => [
             'App\Listeners\NotaRojaSubscriber',
         ],

         'App\Events\RealizarAllanamientoAfterTransition' => [
             'App\Listeners\SolicitudAllanamientoSubscriber',
         ],
         'App\Events\RealizarAllanamientoBeforeTransition' => [
             'App\Listeners\SolicitudAllanamientoSubscriber',
         ],

         'App\Events\RealizarCapturaAfterTransition' => [
             'App\Listeners\CapturaSubscriber',
         ],
         'App\Events\RealizarCapturaBeforeTransition' => [
             'App\Listeners\CapturaSubscriber',
         ],

         'App\Events\RealizarRegistroPersonalAfterTransition' => [
             'App\Listeners\RegistroPersonaSubscriber',
         ],
         'App\Events\RealizarRegistroPersonalBeforeTransition' => [
             'App\Listeners\RegistroPersonaSubscriber',
         ],

         'App\Events\RealizarVigilanciaSeguimientoAfterTransition' => [
             'App\Listeners\SeguimientoSubscriber',
         ],
         'App\Events\RealizarVigilanciaSeguimientoBeforeTransition' => [
             'App\Listeners\SeguimientoSubscriber',
         ],

         'App\Events\UnidadRetratoHabladoAfterTransition' => [
             'App\Listeners\RetratoHabladoSubscriber',
         ],
         'App\Events\UnidadRetratoHabladoBeforeTransition' => [
             'App\Listeners\RetratoHabladoSubscriber',
         ],
     ];

     protected $subscribe = [
         'App\Listeners\WorkflowSubscribers',
         'App\Listeners\TaskB',
         'App\Listeners\DenunciaMPSubscriber',
         'App\Listeners\DenunciaSSSubscriber',
         'App\Listeners\DocumentoSubscriber',
         //////////////////////////////////
         'App\Listeners\AnalizarInformacionCriminalSubscriber',
         'App\Listeners\MenorDetenidoSubscriber',
         'App\Listeners\VictimaAgresionSexualSubscriber',
         'App\Listeners\SolicitudConsultaSubscriber',
         'App\Listeners\CapturaFinExtradicionSubscriber',
         'App\Listeners\CotejamientoDactilarSubscriber',
         'App\Listeners\ExtraccionInformacionTelefonoMovilSubscriber',
         'App\Listeners\InfiltrarOrganizacionCriminalSubscriber',
         'App\Listeners\IntervencionComunicacionSubscriber',
         'App\Listeners\InvestigarDelitoSubscriber',
         'App\Listeners\AlbumFotograficoSubscriber',
         'App\Listeners\DitamenVehicularSubscriber',
         'App\Listeners\VigilanciaSeguimientoSubscriber',
         'App\Listeners\RegistroArmaSubscriber',
         'App\Listeners\ReseniaFotograficaSubscriber',
         'App\Listeners\RecepcionarDeclaracionSubscriber',
         'App\Listeners\ReconocimientoRuedaPersonaSubscriber',
         'App\Listeners\RegistrarOrdenJudicialSubscriber',
         'App\Listeners\NotaRojaSubscriber',
         'App\Listeners\SolicitudAllanamientoSubscriber',
         'App\Listeners\CapturaSubscriber',
         'App\Listeners\RegistroPersonaSubscriber',
         'App\Listeners\SeguimientoSubscriber',
         'App\Listeners\RetratoHabladoSubscriber',
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
