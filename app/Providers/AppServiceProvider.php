<?php

namespace App\Providers;

use App\Task;
use App\DenunciaMP;
use App\DenunciaSS;
use App\Documento;
use App\AnalizarInformacionCriminal;
use App\MenorDetenido;
use App\VictimaAgresionSexual;
use App\SolicitudConsulta;
use App\CapturaFinExtradicion;
use App\CotejamientoDactilar;
use App\ExtraccionInformacionTelefonoMovil;
use App\InfiltrarOrganizacionCriminal;
use App\IntervencionComunicacion;
use App\InvestigarDelito;
use App\AlbumFotografico;
use App\DictamenVehicular;
use App\VigilanciaSeguimiento;
use App\RegistroArma;
use App\ReseniaFotografica;
use App\RecepcionarDeclaracion;
use App\ReconocimientoRuedaPersona;
use App\RegistrarOrdenJudicial;
use App\NotaRoja;
use App\SolicitudAllanamiento;
use App\Captura;
use App\RegistroPersona;
use App\Seguimiento;
use App\RetratoHablado;
use App\Tools;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{

    private $available_events;
    private $tools;
    private $log;

    public function __construct()
    {
        $this->available_events = Array("App\Events\\taskBeforeB",
                                        "App\Events\\taskAfterB",
                                        "App\Events\\DenunciaMPAfterTransition",
                                        "App\Events\\DenunciaMPBeforeTransition",
                                        "App\Events\\DenunciaSSAfterTransition",
                                        "App\Events\\DenunciaSSBeforeTransition",
                                        "App\Events\\DocumentoAfterTransition",
                                        "App\Events\\DocumentoBeforeTransition",
                                        //////////////////////////////////////
                                        "App\Events\\AnalizarInformacionCriminalAfterTransition",
                                        "App\Events\\AnalizarInformacionCriminalBeforeTransition",
                                        "App\Events\\AprehencionMenorInfractorAfterTransition",
                                        "App\Events\\AprehencionMenorInfractorBeforeTransition",
                                        "App\Events\\AtenderLesionadoVictimaAgresionSexualAfterTransition",
                                        "App\Events\\AtenderLesionadoVictimaAgresionSexualBeforeTransition",
                                        "App\Events\\SolicitudConsultaAfterTransition",
                                        "App\Events\\SolicitudConsultaBeforeTransition",
                                        "App\Events\\CapturaFinExtradicionAfterTransition",
                                        "App\Events\\CapturaFinExtradicionBeforeTransition",
                                        "App\Events\\CotejamientoDactilarAfterTransition",
                                        "App\Events\\CotejamientoDactilarBeforeTransition",
                                        "App\Events\\ExtraccionInformacionTelefonoMovilAfterTransition",
                                        "App\Events\\ExtraccionInformacionTelefonoMovilBeforeTransition",
                                        "App\Events\\InfiltrarOrganizacionCriminalAfterTransition",
                                        "App\Events\\InfiltrarOrganizacionCriminalBeforeTransition",
                                        "App\Events\\IntervencionComunicacionAfterTransition",
                                        "App\Events\\IntervencionComunicacionBeforeTransition",
                                        "App\Events\\InvestigarDelitoAfterTransition",
                                        "App\Events\\InvestigarDelitoBeforeTransition",
                                        "App\Events\\RealizarAlbumReconocimientoFotograficoAfterTransition",
                                        "App\Events\\RealizarAlbumReconocimientoFotograficoBeforeTransition",
                                        "App\Events\\RealizarDictamenVehicularAfterTransition",
                                        "App\Events\\RealizarDictamenVehicularBeforeTransition",
                                        "App\Events\\RealizarEntregaVigiladaAfterTransition",
                                        "App\Events\\RealizarEntregaVigiladaBeforeTransition",
                                        "App\Events\\RealizarRegistroArmaAfterTransition",
                                        "App\Events\\RealizarRegistroArmaBeforeTransition",
                                        "App\Events\\RealizarReseñaFotograficaAfterTransition",
                                        "App\Events\\RealizarReseñaFotograficaBeforeTransition",
                                        "App\Events\\RecepcionarDeclaracionAfterTransition",
                                        "App\Events\\RecepcionarDeclaracionBeforeTransition",
                                        "App\Events\\ReconocimientoRuedaPersonaAfterTransition",
                                        "App\Events\\ReconocimientoRuedaPersonaBeforeTransition",
                                        "App\Events\\RegistrarOrdenJudicialAfterTransition",
                                        "App\Events\\RegistrarOrdenJudicialBeforeTransition",
                                        "App\Events\\RetencionNotaRojaAfterTransition",
                                        "App\Events\\RetencionNotaRojaBeforeTransition",
                                        "App\Events\\RealizarAllanamientoAfterTransition",
                                        "App\Events\\RealizarAllanamientoBeforeTransition",
                                        "App\Events\\RealizarCapturaAfterTransition",
                                        "App\Events\\RealizarCapturaBeforeTransition",
                                        "App\Events\\RealizarRegistroPersonalAfterTransition",
                                        "App\Events\\RealizarRegistroPersonalBeforeTransition",
                                        "App\Events\\RealizarVigilanciaSeguimientoAfterTransition",
                                        "App\Events\\RealizarVigilanciaSeguimientoBeforeTransition",
                                        "App\Events\\UnidadRetratoHabladoAfterTransition",
                                        "App\Events\\UnidadRetratoHabladoBeforeTransition"
                                      );
        $this->tools = new Tools;
        $this->log = new \Log;
    }

    private function raise_event($event_name, $objeto) {
      $log = new \Log;
      if( $event_name == "task_after" ){
        $event_name = camel_case($event_name . '_' . $objeto->workflow_state) ;
      } else {
        $event_name = ucfirst(camel_case($event_name));
      }
      $event_name = ucfirst(camel_case($event_name)); ## old version = . '_' . $objeto->workflow_state) ;
      $event_name = 'App\Events\\'.$event_name;
      //$log::alert($event_name);
      if (in_array($event_name,$this->available_events)) {
         event(new $event_name($objeto));
      }
    }

    private function after_object($event_name, $objeto) {
      $log = new \Log;
      $log::alert(['AFTER_EVENT']);
      $original = $objeto->getOriginal();
      if (!($original["workflow_state"] == $objeto->workflow_state)) {
        //$log::alert('[AFTER SAVE] original workflow_state '. $original["workflow_state"] . ' changed workflow_state '. $task->workflow_state);
        if (!(is_null($objeto->workflow_state))){
          $this->raise_event($event_name, $objeto);
        }
      }
    }

    private function before_object($event_name, $objeto) {
      $log = new \Log;
      $log::alert(['BEFORE_EVENT']);
      //$original = $objeto->getOriginal();
      //if (!($original["workflow_state"] == $objeto->workflow_state)) {
      if (!(is_null($objeto->workflow_state))){
        $this->raise_event($event_name, $objeto);
      }
    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        { Schema::defaultStringLength(191); }

        DenunciaMP::saving(function ($denuncia_mp) {
             // check has delitos asignados
             $res = $this->tools->DenunciaMPonBeforeTransition($denuncia_mp);
             $this->log::alert('$res@::saving is .. ' . var_export($res, true));
             if ($res) {
               // launch other events for other listeners
               $event_name = "denuncia_m_p_before_transition";
               $result = $this->before_object($event_name, $denuncia_mp);
             }
             return $res;
        });

        DenunciaMP::saved(function ($denuncia_mp) {
             $event_name = "denuncia_m_p_after_transition";
             $res = $this->after_object($event_name, $denuncia_mp);
        });

        DenunciaSS::saving(function ($denuncia_ss) {
             // check has delitos asignados
             $res = $this->tools->DenunciaSSonBeforeTransition($denuncia_ss);
             $this->log::alert('$res@::saving is .. ' . var_export($res, true));
             if ($res) {
               // launch other events for other listeners
               $event_name = "denuncia_s_s_before_transition";
               $result = $this->before_object($event_name, $denuncia_ss);
             }
             return $res;
        });

        DenunciaSS::saved(function ($denuncia_ss) {
             $event_name = "denuncia_s_s_after_transition";
             $res = $this->after_object($event_name, $denuncia_ss);
        });

        Documento::saving(function ($documento) {
             // check has delitos asignados
             $res = $this->tools->DocumentoonBeforeTransition($documento);
             $this->log::alert('$res@::saving is .. ' . var_export($res, true));
             if ($res) {
               // launch other events for other listeners
               $event_name = "documento_before_transition";
               $result = $this->before_object($event_name, $documento);
             }
             return $res;
        });

        Documento::saved(function ($documento) {
             $event_name = "documento_after_transition";
             $res = $this->after_object($event_name, $documento);
        });
        //////////////////////////////////////////////////////////////////////////
        //la variable en rojo analizarinformacion le pongo mejor el nombre del objeto va, por si las moscas
        //siento que algo esto haciendo mal pero que XD
        AnalizarInformacionCriminal::saving(function ($analizar_informacion_criminal) {
             // check has delitos asignados
             $res = $this->tools->AnalizarInformacionCriminalonBeforeTransition($analizar_informacion_criminal);
             $this->log::alert('$res@::saving is .. ' . var_export($res, true));
             if ($res) {
               // launch other events for other listeners
               $event_name = "analizar_informacion_criminal_before_transition";
               $result = $this->before_object($event_name, $analizar_informacion_criminal);
             }
             return $res;
        });
        AnalizarInformacionCriminal::saved(function ($analizar_informacion_criminal) {
             $event_name = "analizar_informacion_criminal_after_transition";
             $res = $this->after_object($event_name, $analizar_informacion_criminal);
        });

        MenorDetenido::saving(function ($menor_detenido) {
             // check has delitos asignados
             $res = $this->tools->MenorDetenidoonBeforeTransition($menor_detenido);
             $this->log::alert('$res@::saving is .. ' . var_export($res, true));
             if ($res) {
               // launch other events for other listeners
               $event_name = "aprehencion_menor_infractor_before_transition";
               $result = $this->before_object($event_name, $menor_detenido);
             }
             return $res;
        });
        MenorDetenido::saved(function ($menor_detenido) {
             $event_name = "aprehencion_menor_infractor_after_transition";
             $res = $this->after_object($event_name, $menor_detenido);
        });

        VictimaAgresionSexual::saving(function ($victima_agresion_sexual) {
             // check has delitos asignados
             $res = $this->tools->VictimaAgresionSexualonBeforeTransition($victima_agresion_sexual);
             $this->log::alert('$res@::saving is .. ' . var_export($res, true));
             if ($res) {
               // launch other events for other listeners
               $event_name = "atender_lesionado_victima_agresion_sexual_before_transition";
               $result = $this->before_object($event_name, $victima_agresion_sexual);
             }
             return $res;
        });
        VictimaAgresionSexual::saved(function ($victima_agresion_sexual) {
             $event_name = "atender_lesionado_victima_agresion_sexual_after_transition";
             $res = $this->after_object($event_name, $victima_agresion_sexual);
        });

        SolicitudConsulta::saving(function ($solicitud_consulta) {
             // check has delitos asignados
             $res = $this->tools->SolicitudConsultaonBeforeTransition($solicitud_consulta);
             $this->log::alert('$res@::saving is .. ' . var_export($res, true));
             if ($res) {
               // launch other events for other listeners
               $event_name = "solicitud_consulta_before_transition";
               $result = $this->before_object($event_name, $solicitud_consulta);
             }
             return $res;
        });
        SolicitudConsulta::saved(function ($solicitud_consulta) {
             $event_name = "solicitud_consulta_after_transition";
             $res = $this->after_object($event_name, $solicitud_consulta);
        });

        CapturaFinExtradicion::saving(function ($captura_fin_extradicion) {
             // check has delitos asignados
             $res = $this->tools->CapturaFinExtradiciononBeforeTransition($captura_fin_extradicion);
             $this->log::alert('$res@::saving is .. ' . var_export($res, true));
             if ($res) {
               // launch other events for other listeners
               $event_name = "captura_fin_extradicion_before_transition";
               $result = $this->before_object($event_name, $captura_fin_extradicion);
             }
             return $res;
        });
        CapturaFinExtradicion::saved(function ($captura_fin_extradicion) {
             $event_name = "captura_fin_extradicion_after_transition";
             $res = $this->after_object($event_name, $captura_fin_extradicion);
        });

        CotejamientoDactilar::saving(function ($cotejamiento_dactilar) {
             // check has delitos asignados
             $res = $this->tools->CotejamientoDactilaronBeforeTransition($cotejamiento_dactilar);
             $this->log::alert('$res@::saving is .. ' . var_export($res, true));
             if ($res) {
               // launch other events for other listeners
               $event_name = "cotejamiento_dactilar_before_transition";
               $result = $this->before_object($event_name, $cotejamiento_dactilar);
             }
             return $res;
        });
        CotejamientoDactilar::saved(function ($cotejamiento_dactilar) {
             $event_name = "cotejamiento_dactilar_after_transition";
             $res = $this->after_object($event_name, $cotejamiento_dactilar);
        });

        ExtraccionInformacionTelefonoMovil::saving(function ($extracion_informacion_telefono_movil) {
             // check has delitos asignados
             $res = $this->tools->ExtraccionInformacionTelefonoMovilonBeforeTransition($extracion_informacion_telefono_movil);
             $this->log::alert('$res@::saving is .. ' . var_export($res, true));
             if ($res) {
               // launch other events for other listeners
               $event_name = "extraccion_informacion_telefono_movil_before_transition";
               $result = $this->before_object($event_name, $extracion_informacion_telefono_movil);
             }
             return $res;
        });
        ExtraccionInformacionTelefonoMovil::saved(function ($extracion_informacion_telefono_movil) {
             $event_name = "extraccion_informacion_telefono_movil_after_transition";
             $res = $this->after_object($event_name, $extracion_informacion_telefono_movil);
        });

        InfiltrarOrganizacionCriminal::saving(function ($infiltrar_organizacion_criminal) {
             // check has delitos asignados
             $res = $this->tools->InfiltrarOrganizacionCriminalonBeforeTransition($infiltrar_organizacion_criminal);
             $this->log::alert('$res@::saving is .. ' . var_export($res, true));
             if ($res) {
               // launch other events for other listeners
               $event_name = "infiltrar_organizacion_criminal_before_transition";
               $result = $this->before_object($event_name, $infiltrar_organizacion_criminal);
             }
             return $res;
        });
        InfiltrarOrganizacionCriminal::saved(function ($infiltrar_organizacion_criminal) {
             $event_name = "infiltrar_organizacion_criminal_after_transition";
             $res = $this->after_object($event_name, $infiltrar_organizacion_criminal);
        });

        IntervencionComunicacion::saving(function ($intervencion_comunicacion) {
             // check has delitos asignados
             $res = $this->tools->IntervencionComunicaciononBeforeTransition($intervencion_comunicacion);
             $this->log::alert('$res@::saving is .. ' . var_export($res, true));
             if ($res) {
               // launch other events for other listeners
               $event_name = "intervencion_comunicacion_before_transition";
               $result = $this->before_object($event_name, $intervencion_comunicacion);
             }
             return $res;
        });
        IntervencionComunicacion::saved(function ($intervencion_comunicacion) {
             $event_name = "intervencion_comunicacion_after_transition";
             $res = $this->after_object($event_name, $intervencion_comunicacion);
        });

        InvestigarDelito::saving(function ($investigar_delito) {
             // check has delitos asignados
             $res = $this->tools->InvestigarDelitoonBeforeTransition($investigar_delito);
             $this->log::alert('$res@::saving is .. ' . var_export($res, true));
             if ($res) {
               // launch other events for other listeners
               $event_name = "investigar_delito_before_transition";
               $result = $this->before_object($event_name, $investigar_delito);
             }
             return $res;
        });
        InvestigarDelito::saved(function ($investigar_delito) {
             $event_name = "investigar_delito_after_transition";
             $res = $this->after_object($event_name, $investigar_delito);
        });

        AlbumFotografico::saving(function ($album_fotografico) {
             // check has delitos asignados
             $res = $this->tools->AlbumFotograficoonBeforeTransition($album_fotografico);
             $this->log::alert('$res@::saving is .. ' . var_export($res, true));
             if ($res) {
               // launch other events for other listeners
               $event_name = "realizar_album_reconocimiento_fotografico_before_transition";
               $result = $this->before_object($event_name, $album_fotografico);
             }
             return $res;
        });
        AlbumFotografico::saved(function ($album_fotografico) {
             $event_name = "realizar_album_reconocimiento_fotografico_after_transition";
             $res = $this->after_object($event_name, $album_fotografico);
        });

        DictamenVehicular::saving(function ($dictamen_vehicular) {
             // check has delitos asignados
             $res = $this->tools->DitamenVehicularonBeforeTransition($dictamen_vehicular);
             $this->log::alert('$res@::saving is .. ' . var_export($res, true));
             if ($res) {
               // launch other events for other listeners
               $event_name = "realizar_dictamen_vehicular_before_transition";
               $result = $this->before_object($event_name, $dictamen_vehicular);
             }
             return $res;
        });
        DictamenVehicular::saved(function ($dictamen_vehicular) {
             $event_name = "realizar_dictamen_vehicular_after_transition";
             $res = $this->after_object($event_name, $dictamen_vehicular);
        });

        VigilanciaSeguimiento::saving(function ($entrega_vigilada) {
             // check has delitos asignados
             $res = $this->tools->VigilanciaSeguimientoonBeforeTransition($entrega_vigilada);
             $this->log::alert('$res@::saving is .. ' . var_export($res, true));
             if ($res) {
               // launch other events for other listeners
               $event_name = "realizar_entrega_vigilada_before_transition";
               $result = $this->before_object($event_name, $entrega_vigilada);
             }
             return $res;
        });
        VigilanciaSeguimiento::saved(function ($entrega_vigilada) {
             $event_name = "realizar_entrega_vigilada_after_transition";
             $res = $this->after_object($event_name, $entrega_vigilada);
        });

        RegistroArma::saving(function ($registro_arma) {
             // check has delitos asignados
             $res = $this->tools->RegistroArmaonBeforeTransition($registro_arma);
             $this->log::alert('$res@::saving is .. ' . var_export($res, true));
             if ($res) {
               // launch other events for other listeners
               $event_name = "realizar_registro_arma_before_transition";
               $result = $this->before_object($event_name, $registro_arma);
             }
             return $res;
        });
        RegistroArma::saved(function ($registro_arma) {
             $event_name = "realizar_registro_arma_after_transition";
             $res = $this->after_object($event_name, $registro_arma);
        });

        ReseniaFotografica::saving(function ($reseña_fotografica) {
             // check has delitos asignados
             $res = $this->tools->ReseniaFotograficaonBeforeTransition($reseña_fotografica);
             $this->log::alert('$res@::saving is .. ' . var_export($res, true));
             if ($res) {
               // launch other events for other listeners
               $event_name = "realizar_reseña_fotografica_before_transition";
               $result = $this->before_object($event_name, $reseña_fotografica);
             }
             return $res;
        });
        ReseniaFotografica::saved(function ($reseña_fotografica) {
             $event_name = "realizar_reseña_fotografica_after_transition";
             $res = $this->after_object($event_name, $reseña_fotografica);
        });

        RecepcionarDeclaracion::saving(function ($recepcionar_declaraciones) {
             // check has delitos asignados
             $res = $this->tools->RecepcionarDeclaraciononBeforeTransition($recepcionar_declaraciones);
             $this->log::alert('$res@::saving is .. ' . var_export($res, true));
             if ($res) {
               // launch other events for other listeners
               $event_name = "recepcionar_declaracion_before_transition";
               $result = $this->before_object($event_name, $recepcionar_declaraciones);
             }
             return $res;
        });
        RecepcionarDeclaracion::saved(function ($recepcionar_declaraciones) {
             $event_name = "recepcionar_declaracion_after_transition";
             $res = $this->after_object($event_name, $recepcionar_declaraciones);
        });

        ReconocimientoRuedaPersona::saving(function ($reconocimiento_rueda_persona) {
             // check has delitos asignados
             $res = $this->tools->ReconocimientoRuedaPersonaonBeforeTransition($reconocimiento_rueda_persona);
             $this->log::alert('$res@::saving is .. ' . var_export($res, true));
             if ($res) {
               // launch other events for other listeners
               $event_name = "reconocimiento_rueda_persona_before_transition";
               $result = $this->before_object($event_name, $reconocimiento_rueda_persona);
             }
             return $res;
        });
        ReconocimientoRuedaPersona::saved(function ($reconocimiento_rueda_persona) {
             $event_name = "reconocimiento_rueda_persona_after_transition";
             $res = $this->after_object($event_name, $reconocimiento_rueda_persona);
        });

        RegistrarOrdenJudicial::saving(function ($registrar_orden_judicial) {
             // check has delitos asignados
             $res = $this->tools->RegistrarOrdenJudicialonBeforeTransition($registrar_orden_judicial);
             $this->log::alert('$res@::saving is .. ' . var_export($res, true));
             if ($res) {
               // launch other events for other listeners
               $event_name = "registrar_orden_judicial_before_transition";
               $result = $this->before_object($event_name, $registrar_orden_judicial);
             }
             return $res;
        });
        RegistrarOrdenJudicial::saved(function ($registrar_orden_judicial) {
             $event_name = "registrar_orden_judicial_after_transition";
             $res = $this->after_object($event_name, $registrar_orden_judicial);
        });

        NotaRoja::saving(function ($nota_roja) {
             // check has delitos asignados
             $res = $this->tools->NotaRojaonBeforeTransition($nota_roja);
             $this->log::alert('$res@::saving is .. ' . var_export($res, true));
             if ($res) {
               // launch other events for other listeners
               $event_name = "retencion_nota_roja_before_transition";
               $result = $this->before_object($event_name, $nota_roja);
             }
             return $res;
        });
        NotaRoja::saved(function ($nota_roja) {
             $event_name = "retencion_nota_roja_after_transition";
             $res = $this->after_object($event_name, $nota_roja);
        });

        SolicitudAllanamiento::saving(function ($solicitud_allanamiento) {
             // check has delitos asignados
             $res = $this->tools->SolicitudAllanamientoonBeforeTransition($solicitud_allanamiento);
             $this->log::alert('$res@::saving is .. ' . var_export($res, true));
             if ($res) {
               // launch other events for other listeners
               $event_name = "realizar_allanamiento_before_transition";
               $result = $this->before_object($event_name, $solicitud_allanamiento);
             }
             return $res;
        });
        SolicitudAllanamiento::saved(function ($solicitud_allanamiento) {
             $event_name = "realizar_allanamiento_after_transition";
             $res = $this->after_object($event_name, $solicitud_allanamiento);
        });

        Captura::saving(function ($captura) {
             // check has delitos asignados
             $res = $this->tools->CapturaonBeforeTransition($captura);
             $this->log::alert('$res@::saving is .. ' . var_export($res, true));
             if ($res) {
               // launch other events for other listeners
               $event_name = "realizar_captura_before_transition";
               $result = $this->before_object($event_name, $captura);
             }
             return $res;
        });
        Captura::saved(function ($captura) {
             $event_name = "realizar_captura_after_transition";
             $res = $this->after_object($event_name, $captura);
        });

        RegistroPersona::saving(function ($registro_persona) {
             // check has delitos asignados
             $res = $this->tools->RegistroPersonaonBeforeTransition($registro_persona);
             $this->log::alert('$res@::saving is .. ' . var_export($res, true));
             if ($res) {
               // launch other events for other listeners
               $event_name = "realizar_registro_personal_before_transition";
               $result = $this->before_object($event_name, $registro_persona);
             }
             return $res;
        });
        RegistroPersona::saved(function ($registro_persona) {
             $event_name = "realizar_registro_personal_after_transition";
             $res = $this->after_object($event_name, $registro_persona);
        });

        Seguimiento::saving(function ($seguimiento) {
             // check has delitos asignados
             $res = $this->tools->SeguimientoonBeforeTransition($seguimiento);
             $this->log::alert('$res@::saving is .. ' . var_export($res, true));
             if ($res) {
               // launch other events for other listeners
               $event_name = "realizar_vigilancia_seguimiento_before_transition";
               $result = $this->before_object($event_name, $seguimiento);
             }
             return $res;
        });
        Seguimiento::saved(function ($seguimiento) {
             $event_name = "realizar_vigilancia_seguimiento_after_transition";
             $res = $this->after_object($event_name, $seguimiento);
        });

        RetratoHablado::saving(function ($retrato_hablado) {
             // check has delitos asignados
             $res = $this->tools->RetratoHabladoonBeforeTransition($retrato_hablado);
             $this->log::alert('$res@::saving is .. ' . var_export($res, true));
             if ($res) {
               // launch other events for other listeners
               $event_name = "unidad_retrato_hablado_before_transition";
               $result = $this->before_object($event_name, $retrato_hablado);
             }
             return $res;
        });
        RetratoHablado::saved(function ($retrato_hablado) {
             $event_name = "unidad_retrato_hablado_after_transition";
             $res = $this->after_object($event_name, $retrato_hablado);
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    // Task::saving(function ($task) {
    //     //  $event_name = "task_before";
    //     //  $log = new \Log;
    //     //  $original = $task->getOriginal();
    //     //  if (!($original["workflow_state"] == $task->workflow_state)) {
    //     //    //$log::alert('[BEFORE SAVE] original workflow_state '. $original["workflow_state"] . ' changed workflow_state '. $task->workflow_state);
    //     //    if (!(is_null($task->workflow_state))){
    //     //      $this->raise_event($event_name, $task);
    //     //    }
    //     //  }
    // });
    //
    // Task::saved(function ($task) {
    //      $event_name = "task_after";
    //      $res = $this->after_object($event_name, $task);
    //     //  $log = new \Log;
    //     //  $original = $task->getOriginal();
    //     //  if (!($original["workflow_state"] == $task->workflow_state)) {
    //     //    //$log::alert('[AFTER SAVE] original workflow_state '. $original["workflow_state"] . ' changed workflow_state '. $task->workflow_state);
    //     //    if (!(is_null($task->workflow_state))){
    //     //      $this->raise_event($event_name, $task);
    //     //    }
    //     //  }
    // });

}
