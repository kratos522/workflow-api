<?php

return [
    'dummy_workflow'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\Task'],
        'places'        => ['a', 'b', 'c'],
        'transitions'   => [
            't1' => [
                'from' => 'a',
                'to'   => 'b',
            ],
            't2' => [
                'from' => 'b',
                'to'   => 'c',
            ],
            't3' => [
                'from' => 'a',
                'to'   => 'c',
            ]
        ]
    ],
    'denuncia_mp'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\DenunciaMP'],
        'places'        => [
                          	'nueva',
                          	'pendiente_evaluar',
                          	'delitos_asignados',
                          	'auto_elaborado',
                          	'fiscales_asignados',
                          	'pendiente_autorizacion_auto_cierre_administrativo',
                          	'pendiente_recibir_notificacion_auto_cierre_firmada',
                          	'pendiente_recibir_notificacion_de_conformidad_auto_cierre',
                            'pendiente_aceptacion_apelacion_auto_cierre',
                          	'entregada_a_fiscalia_correspondiente',
                          	'entregada_a_maadeh',
                          	'auto_cierre_aceptado',
                          	'apelacion_aceptada'
                          ],
        'transitions'   => [
            'remitir_a_evaluacion' => [
                'from' => 'nueva',
                'to'   => 'pendiente_evaluar',
            ],
            'asignar_delitos' => [
                'from' => 'pendiente_evaluar',
                'to'   => 'delitos_asignados',
            ],
            'elaborar_auto' => [
                'from' => 'delitos_asignados',
                'to'   => 'auto_elaborado',
            ],
            'asignar_fiscales' => [
                'from' => 'auto_elaborado',
                'to'   => 'fiscales_asignados',
            ],
            'entregar_expediente_fiscalia' => [
                'from' => 'fiscales_asignados',
                'to'   => 'entregada_a_fiscalia_correspondiente',
            ],
            'aplicar_auto_cierre' => [
                'from' => 'pendiente_evaluar',
                'to'   => 'pendiente_autorizacion_auto_cierre_administrativo',
            ],
            'autorizar_auto_cierre' => [
                'from' => 'pendiente_autorizacion_auto_cierre_administrativo',
                'to'   => 'pendiente_recibir_notificacion_auto_cierre_firmada',
            ],
            'solicitar_conformidad_auto_cierre' => [
                'from' => 'pendiente_recibir_notificacion_auto_cierre_firmada',
                'to'   => 'pendiente_recibir_notificacion_de_conformidad_auto_cierre',
            ],
            'aceptar_auto_cierre' => [
                'from' => 'pendiente_recibir_notificacion_de_conformidad_auto_cierre',
                'to'   => 'auto_cierre_aceptado',
            ],
            'apelar_auto_cierre' => [
                'from' => 'pendiente_recibir_notificacion_de_conformidad_auto_cierre',
                'to'   => 'pendiente_aceptacion_apelacion_auto_cierre',
            ],
            'aceptar_apelacion_auto_cierre' => [
                'from' => 'pendiente_aceptacion_apelacion_auto_cierre',
                'to'   => 'apelacion_aceptada',
            ],
            'entregar_a_maadeh' => [
                'from' => 'pendiente_recibir_notificacion_de_conformidad_auto_cierre',
                'to'   => 'entregada_a_maadeh',
            ]
        ]
    ],
    'denuncia_ss'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\DenunciaSS'],
        'places'        => [
                          	'nueva',
                            'pendiente_revision',
                            'delitos_tipificados',
                            'aceptada',
                            'no_aceptada',
                            'descripcion_hechos_firmados',
                            'remitida_ministerio_publico'
                          ],
        'transitions'   => [
            'recibir_denuncia' => [
                'from' => 'nueva',
                'to'   => 'pendiente_revision',
            ],
            'tipificar_delitos' => [
                'from' => 'pendiente_revision',
                'to'   => 'delitos_tipificados',
            ],
            'desestimar' => [
                'from' => 'delitos_tipificados',
                'to'   => 'no_aceptada',
            ],
            'aceptar_denuncia' => [
                'from' => 'delitos_tipificados',
                'to'   => 'aceptada',
            ],
            'firmar_descripcion_hechos' => [
                'from' => 'aceptada',
                'to'   => 'descripcion_hechos_firmados',
            ],
            'remitir_ministerio_publico' => [
                'from' => 'descripcion_hechos_firmados',
                'to'   => 'remitida_ministerio_publico',
            ]
        ]
    ],
    'recepcion_documento'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\Documento'],
        'places'        => [
                          	'nuevo',
                            'recibido',
                            'dependencia_asignada',
                            'remitido'
                          ],
        'transitions'   => [
            'recibir_documento' => [
                'from' => 'nuevo',
                'to'   => 'recibido',
            ],
            'asignar_dependencia' => [
                'from' => 'recibido',
                'to'   => 'dependencia_asignada',
            ],
            'remitir' => [
                'from' => 'dependencia_asignada',
                'to'   => 'remitido',
            ]
        ]
    ],
    ////////////////////////////////////////
    'analizar_informacion_criminal_ss'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\AnalizarInformacionCriminal'],
        'places'        => [
                          	'nueva',
                            'informacion_clasificada',
                            'informacion_solicitada',
                            'producto_elaborado',
                            'producto_entregado'
                          ],
        'transitions'   => [
            'clasificar_documento' => [
                'from' => 'nueva',
                'to'   => 'informacion_clasificada',
            ],
            'solicitar_documento' => [
                'from' => 'informacion_clasificada',
                'to'   => 'informacion_solicitada',
            ],
            'elaborar_producto' => [
                'from' => 'informacion_solicitada',
                'to'   => 'producto_elaborado',
            ],
            'entregar_producto' => [
                'from' => 'producto_elaborado',
                'to'   => 'producto_entregado',
            ]
        ]
    ],
    'aprehencion_menor_infractor'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\MenorDetenido'],
        'places'        => [
                            'requerimiento_fiscal_recibido',
                            'menor_registrado',
                            'diligencia_asignada',
                            'procesamiento_escena_crimen_asignada',
                            'escena_crimen_procesada',
                            'remitido_fiscalia_niniez',
                            'diligencia_completada',
                            'remitido_juzgado_niniez',
                            'remitido_medicina_forense',
                            'informe_final_remitido',
                            'remitido_centro_especializado'
                          ],
        'transitions'   => [
            'recepcionar_requerimiento' => [
                'from' => 'requerimiento_fiscal_recibido',
                'to'   => 'menor_registrado',
            ],
            'asignar_diligencia' => [
                'from' => 'menor_registrado',
                'to'   => 'diligencia_asignada',
            ],
            'asignar_procesamiento_escena' => [
                'from' => 'menor_registrado',
                'to'   => 'procesamiento_escena_crimen_asignada',
            ],
            'procesar_escena_crimen' => [
                'from' => 'procesamiento_escena_crimen_asignada',
                'to'   => 'escena_crimen_procesada',
            ],
            'remitir_ministerio_publico' => [
                'from' => 'escena_crimen_procesada',
                'to'   => 'remitido_fiscalia_niniez',
            ],
            'completar_diligencia' => [
                'from' => 'escena_crimen_procesada',
                'to'   => 'diligencia_completada',
            ],
            'hacer_diligencia' => [
                'from' => 'diligencia_asignada',
                'to'   => 'diligencia_completada',
            ],
            'remitir_juzgado' => [
                'from' => 'diligencia_completada',
                'to'   => 'remitido_juzgado_niniez',
            ],
            'remitir_medicina_forense' => [
                'from' => 'remitido_juzgado_niniez',
                'to'   => 'remitido_medicina_forense',
            ],
            'elaborar_informe' => [
                'from' => 'remitido_medicina_forense',
                'to'   => 'informe_final_remitido',
            ],
            'traslado_centro_especializado' => [
                'from' => 'informe_final_remitido',
                'to'   => 'remitido_centro_especializado',
            ]
        ]
    ],
    'atender_lesionado_victima_agresion_sexual_ss'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\VictimaAgresionSexual'],
        'places'        => [
                          	'nuevo',
                            'victima_ubicada',
                            'victima_remitida_medicina_forense',
                            'declaraciones_testigos_tomada',
                            'sospechosos_individualizados',
                            'toma_muestras_solicitada',
                            'perito_medicina_forense_solicitado',
                            'resultados_recepcionados',
                            'escena_crimen_procesada',
                            'informe_final_enviado'
                          ],
        'transitions'   => [
            'ubicar_victima' => [
                'from' => 'nuevo',
                'to'   => 'victima_ubicada',
            ],
            'trasladar_victima' => [
                'from' => 'victima_ubicada',
                'to'   => 'victima_remitida_medicina_forense',
            ],
            'individualizar_sospechosos' => [
                'from' => 'victima_remitida_medicina_forense',
                'to'   => 'sospechosos_individualizados',
            ],
            'tomar_declaraciones' => [
                'from' => 'victima_remitida_medicina_forense',
                'to'   => 'declaraciones_testigos_tomada',
            ],
            'individualizar_sospechoso' => [
                'from' => 'declaraciones_testigos_tomada',
                'to'   => 'sospechosos_individualizados',
            ],
            'solicitar_toma_muestras' => [
                'from' => 'victima_remitida_medicina_forense',
                'to'   => 'toma_muestras_solicitada',
            ],
            'solicitar_perito' => [
                'from' => 'victima_remitida_medicina_forense',
                'to'   => 'perito_medicina_forense_solicitado',
            ],
            'solicitar_perito_forense' => [
                'from' => 'toma_muestras_solicitada',
                'to'   => 'perito_medicina_forense_solicitado',
            ],
            'recibir_resultados' => [
                'from' => 'perito_medicina_forense_solicitado',
                'to'   => 'resultados_recepcionados',
            ],
            'procesar_escena_crimen' => [
                'from' => 'resultados_recepcionados',
                'to'   => 'escena_crimen_procesada',
            ],
            'enviar_informe' => [
                'from' => 'escena_crimen_procesada',
                'to'   => 'informe_final_enviado',
            ]
        ]
    ],
    'solicitud_consulta_ss'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\SolicitudConsulta'],
        'places'        => [
                          	'nueva',
                            'informacion_recibida',
                            'peticion_imposible_cumplir_informada',
                            'informacion_necesaria_buscada',
                            'registro_control_realizado',
                            'requerimiento_respondido',
                            'informe_entregado'
                          ],
        'transitions'   => [
            'recibir_documento' => [
                'from' => 'nueva',
                'to'   => 'informacion_recibida',
            ],
            'peticion_denegada' => [
                'from' => 'nueva',
                'to'   => 'peticion_imposible_cumplir_informada',
            ],
            'buscar_informacion' => [
                'from' => 'nueva',
                'to'   => 'informacion_necesaria_buscada',
            ],
            'registrar_control' => [
                'from' => 'informacion_necesaria_buscada',
                'to'   => 'registro_control_realizado',
            ],
            'responder_requerimiento' => [
                'from' => 'informacion_necesaria_buscada',
                'to'   => 'requerimiento_respondido',
            ],
            'notificar_requerimiento' => [
                'from' => 'registro_control_realizado',
                'to'   => 'requerimiento_respondido',
            ],
            'contestar_requerimiento' => [
                'from' => 'informacion_recibida',
                'to'   => 'requerimiento_respondido',
            ],
            'enviar_informe' => [
                'from' => 'requerimiento_respondido',
                'to'   => 'informe_entregado',
            ]
        ]
    ],
    'captura_fin_extradicion'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\CapturaFinExtradicion'],
        'places'        => [
                          	'orden_captura_recibida',
                            'captura_realizada',
                            'captura_registrada',
                            'informe_captura_enviado',
                            'capturado_remitido_ministerio_publico',
                            'informe_remision_enviado',
                            'informe_final_enviado'
                          ],
        'transitions'   => [
            'ejecutar_captura' => [
                'from' => 'orden_captura_recibida',
                'to'   => 'captura_realizada',
            ],
            'registrar_captura' => [
                'from' => 'captura_realizada',
                'to'   => 'captura_registrada',
            ],
            'enviar_informe_captura' => [
                'from' => 'captura_registrada',
                'to'   => 'informe_captura_enviado',
            ],
            'remitir_capturado' => [
                'from' => 'informe_captura_enviado',
                'to'   => 'capturado_remitido_ministerio_publico',
            ],
            'enviar_informe_remision' => [
                'from' => 'capturado_remitido_ministerio_publico',
                'to'   => 'informe_remision_enviado',
            ],
            'enviar_informe_final' => [
                'from' => 'informe_remision_enviado',
                'to'   => 'informe_final_enviado',
            ]
        ]
    ],
    'cotejamiento_dactilar'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\CotejamientoDactilar'],
        'places'        => [
                          	'nuevo',
                            'solicitud_revisada',
                            'solicitud_devuelta',
                            'cotejamiento_realizado',
                            'informe_cotejamiento_enviado'
                          ],
        'transitions'   => [
            'recibir_solicitud' => [
                'from' => 'nuevo',
                'to'   => 'solicitud_revisada',
            ],
            'denegar_solicitud' => [
                'from' => 'solicitud_revisada',
                'to'   => 'solicitud_devuelta',
            ],
            'aceptar_solicitud' => [
                'from' => 'solicitud_revisada',
                'to'   => 'cotejamiento_realizado',
            ],
            'informe_cotejamiento_realizado' => [
                'from' => 'cotejamiento_realizado',
                'to'   => 'informe_cotejamiento_enviado',
            ]
        ]
    ],
    'extraccion_informacion_telefono_movil'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\ExtraccionInformacionTelefonoMovil'],
        'places'        => [
                          	'nueva',
                            'solicitud_recibida',
                            'informe_entregado'
                          ],
        'transitions'   => [
            'recibir_documento' => [
                'from' => 'nueva',
                'to'   => 'solicitud_recibida',
            ],
            'entregar_informe' => [
                'from' => 'solicitud_recibida',
                'to'   => 'informe_entregado',
            ]
        ]
    ],
    'infiltrar_organizacion_criminal'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\InfiltrarOrganizacionCriminal'],
        'places'        => [
                          	'nueva',
                            'fiscal_notificado',
                            'infiltracion_realizada',
                            'allanamiento_realizado',
                            'escena_crimen_procesada',
                            'evidencias_encontradas_registradas',
                            'evidencias_remitidas_ministerio_publico',
                            'informe_remision_enviado',
                            'infiltracion_finalizada',
                            'informe_final_enviado'
                          ],
        'transitions'   => [
            'notificar_fiscal' => [
                'from' => 'nueva',
                'to'   => 'fiscal_notificado',
            ],
            'realizar_infiltracion' => [
                'from' => 'fiscal_notificado',
                'to'   => 'infiltracion_realizada',
            ],
            'terminar_infiltracion' => [
                'from' => 'infiltracion_realizada',
                'to'   => 'infiltracion_finalizada',
            ],
            'realizar_allanamiento' => [
                'from' => 'infiltracion_realizada',
                'to'   => 'allanamiento_realizado',
            ],
            'procesar_escena_crimen' => [
                'from' => 'allanamiento_realizado',
                'to'   => 'escena_crimen_procesada',
            ],
            'registrar_evidencias' => [
                'from' => 'escena_crimen_procesada',
                'to'   => 'evidencias_encontradas_registradas',
            ],
            'trasladar_evidencias' => [
                'from' => 'evidencias_encontradas_registradas',
                'to'   => 'evidencias_remitidas_ministerio_publico',
            ],
            'enviar_informe_remision_evidencias' => [
                'from' => 'evidencias_remitidas_ministerio_publico',
                'to'   => 'informe_remision_enviado',
            ],
            'finalizar_infiltracion' => [
                'from' => 'informe_remision_enviado',
                'to'   => 'infiltracion_finalizada',
            ],
            'enviar_informe_final' => [
                'from' => 'infiltracion_finalizada',
                'to'   => 'informe_final_enviado',
            ]
        ]
    ],
    'intervencion_comunicacion'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\IntervencionComunicacion'],
        'places'        => [
                          	'nueva',
                            'solicitud_recibida',
                            'comunicacion_intervenida',
                            'informe_diligencias_enviado',
                            'intervencion_finalizada'
                          ],
        'transitions'   => [
            'recibir_solicitud' => [
                'from' => 'nueva',
                'to'   => 'solicitud_recibida',
            ],
            'intervenir_comunicacion' => [
                'from' => 'solicitud_recibida',
                'to'   => 'comunicacion_intervenida',
            ],
            'enviar_informe' => [
                'from' => 'comunicacion_intervenida',
                'to'   => 'informe_diligencias_enviado',
            ],
            'finalizar_intervencion' => [
                'from' => 'informe_diligencias_enviado',
                'to'   => 'intervencion_finalizada',
            ]
        ]
    ],
    'investigar_delito_ss'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\InvestigarDelito'],
        'places'        => [
                          	'nuevo',
                            'informacion_hecho_recibida',
                            'proceso_denuncia_ejecutado',
                            'requerimiento_fiscal_recepcionado',
                            'diligencia_denuncia_fuente_no_formal_realizada',
                            'diligencias_investigativas_realizadas',
                            'informe_investigativo_presentado',
                            'requerimiento_fiscal_asignado',
                            'requerimiento_fiscal_ejecutado',
                            'informe_final_enviado'
                          ],
        'transitions'   => [
            'informacion_recibida' => [
                'from' => 'nuevo',
                'to'   => 'informacion_hecho_recibida',
            ],
            'ejecutar_proceso_denuncia' => [
                'from' => 'informacion_hecho_recibida',
                'to'   => 'proceso_denuncia_ejecutado',
            ],
            'requerimiento_recibido' => [
                'from' => 'nuevo',
                'to'   => 'requerimiento_fiscal_recepcionado',
            ],
            'asignar_requerimiento' => [
                'from' => 'requerimiento_fiscal_recepcionado',
                'to'   => 'requerimiento_fiscal_asignado',
            ],
            'ejecutar_requerimiento' => [
                'from' => 'requerimiento_fiscal_asignado',
                'to'   => 'requerimiento_fiscal_ejecutado',
            ],
            'enviar_informe' => [
                'from' => 'requerimiento_fiscal_ejecutado',
                'to'   => 'informe_final_enviado',
            ],
            'realizar_diligencias' => [
                'from' => 'informacion_hecho_recibida',
                'to'   => 'diligencia_denuncia_fuente_no_formal_realizada',
            ],
            'realizar_diligencias_investigativas' => [
                'from' => 'diligencia_denuncia_fuente_no_formal_realizada',
                'to'   => 'diligencias_investigativas_realizadas',
            ],
            'presentar_informe_investigativo' => [
                'from' => 'diligencia_denuncia_fuente_no_formal_realizada',
                'to'   => 'informe_investigativo_presentado',
            ],
            'ejecutar_requerimiento_fiscal' => [
                'from' => 'informe_investigativo_presentado',
                'to'   => 'requerimiento_fiscal_ejecutado',
            ]
        ]
    ],
    'realizar_album_reconocimiento_fotografico'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\AlbumFotografico'],
        'places'        => [
                          	'nuevo',
                            'solicitud_recepcionada',
                            'tecnico_especializado_asignado',
                            'material_fotografico_recepcionado',
                            'material_fotografico_no_acto_devuelto',
                            'album_fotografico_enviado'
                          ],
        'transitions'   => [
            'recibir_solicitud' => [
                'from' => 'nuevo',
                'to'   => 'solicitud_recepcionada',
            ],
            'asignar_tecnico' => [
                'from' => 'solicitud_recepcionada',
                'to'   => 'tecnico_especializado_asignado',
            ],
            'recibir_material_fotografico' => [
                'from' => 'tecnico_especializado_asignado',
                'to'   => 'material_fotografico_recepcionado',
            ],
            'devolver_material_no_acto' => [
                'from' => 'material_fotografico_recepcionado',
                'to'   => 'material_fotografico_no_acto_devuelto',
            ],
            'enviar_album' => [
                'from' => 'material_fotografico_recepcionado',
                'to'   => 'album_fotografico_enviado',
            ]
        ]
    ],
    'realizar_dictamen_vehicular'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\DictamenVehicular'],
        'places'        => [
                          	'nuevo',
                            'requerimiento_recepcionado',
                            'tarea_asignada',
                            'dictamen_enviado'
                          ],
        'transitions'   => [
            'recibir_requerimiento' => [
                'from' => 'nuevo',
                'to'   => 'requerimiento_recepcionado',
            ],
            'asignar_requerimiento' => [
                'from' => 'requerimiento_recepcionado',
                'to'   => 'tarea_asignada',
            ],
            'enviar_dictamen' => [
                'from' => 'tarea_asignada',
                'to'   => 'dictamen_enviado',
            ]
        ]
    ],
    'realizar_entrega_vigilada'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\VigilanciaSeguimiento'],
        'places'        => [
                          	'nueva',
                            'investigador_asignado',
                            'informacion_caso_evaluada',
                            'caso_archivado',
                            'requerimiento_fiscal_recepcionado',
                            'diligencias_ejecutadas',
                            'captura_registrada',
                            'diligencias_investigativas_realizadas',
                            'escena_crimen_procesada',
                            'autorizacion_retirar_indicios_solicitada',
                            'retiro_indicios_autorizado',
                            'informe_retiro_indicios_enviado',
                            'informe_entrega_evidencias_enviado',
                            'informe_enviado',
                            'citacion_audiencia_enviada',
                            'informe_audiencia_presentado'
                          ],
        'transitions'   => [
            'asignar_investigador' => [
                'from' => 'nueva',
                'to'   => 'investigador_asignado',
            ],
            'evaluar_caso' => [
                'from' => 'nueva',
                'to'   => 'informacion_caso_evaluada',
            ],
            'archivar_caso' => [
                'from' => 'informacion_caso_evaluada',
                'to'   => 'caso_archivado',
            ],
            'realizar_informe_caso' => [
                'from' => 'informacion_caso_evaluada',
                'to'   => 'informe_enviado',
            ],
            'recibir_requerimiento' => [
                'from' => 'informe_enviado',
                'to'   => 'requerimiento_fiscal_recepcionado',
            ],
            'ejecutar_diligencias' => [
                'from' => 'requerimiento_fiscal_recepcionado',
                'to'   => 'diligencias_ejecutadas',
            ],
            'registrar_captura' => [
                'from' => 'diligencias_ejecutadas',
                'to'   => 'captura_registrada',
            ],
            'enviar_informe_captura' => [
                'from' => 'captura_registrada',
                'to'   => 'informe_enviado',
            ],
            'realizar_diligencias_investigativas' => [
                'from' => 'informe_enviado',
                'to'   => 'diligencias_investigativas_realizadas',
            ],
            'procesar_escena_crimen' => [
                'from' => 'diligencias_investigativas_realizadas',
                'to'   => 'escena_crimen_procesada',
            ],
            'procesamiento_escena_crimen' => [
                'from' => 'informe_enviado',
                'to'   => 'escena_crimen_procesada',
            ],
            'ejecutar_procesamiento_escena_crimen' => [
                'from' => 'diligencias_ejecutadas',
                'to'   => 'escena_crimen_procesada',
            ],
            'procesar_escena' => [
                'from' => 'investigador_asignado',
                'to'   => 'escena_crimen_procesada',
            ],
            'solicitar_autorizacion_retitar_indicios' => [
                'from' => 'escena_crimen_procesada',
                'to'   => 'autorizacion_retirar_indicios_solicitada',
            ],
            'aprobar_solicitud_retiro_indicios' => [
                'from' => 'autorizacion_retirar_indicios_solicitada',
                'to'   => 'retiro_indicios_autorizado',
            ],
            'enviar_informe_retiro_indicios' => [
                'from' => 'retiro_indicios_autorizado',
                'to'   => 'informe_retiro_indicios_enviado',
            ],
            'enviar_informe_entrega_evidencias' => [
                'from' => 'informe_retiro_indicios_enviado',
                'to'   => 'informe_entrega_evidencias_enviado',
            ],
            'enviar_informe_investigativo' => [
                'from' => 'informe_entrega_evidencias_enviado',
                'to'   => 'informe_enviado',
            ],
            'enviar_informe_diligencias' => [
                'from' => 'diligencias_ejecutadas',
                'to'   => 'informe_enviado',
            ],
            'remitir_informe_investigativo' => [
                'from' => 'investigador_asignado',
                'to'   => 'informe_enviado',
            ],
            'enviar_citacion_audiencia' => [
                'from' => 'informe_enviado',
                'to'   => 'citacion_audiencia_enviada',
            ],
            'realizar_informe_audiencia' => [
                'from' => 'citacion_audiencia_enviada',
                'to'   => 'informe_audiencia_presentado',
            ]
        ]
    ],
    'realizar_registro_arma'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\RegistroArma'],
        'places'        => [
                          	'nuevo',
                            'antecedentes_verificados',
                            'propietario_capturado',
                            'informe_captura_enviado',
                            'propietario_remitido_asesoria_legal',
                            'enviar_informe_decomiso',
                            'arma_registrada'
                          ],
        'transitions'   => [
            'verificar_antecedentes' => [
                'from' => 'nuevo',
                'to'   => 'antecedentes_verificados',
            ],
            'capturar_propietario' => [
                'from' => 'antecedentes_verificados',
                'to'   => 'propietario_capturado',
            ],
            'enviar_informe_captura' => [
                'from' => 'propietario_capturado',
                'to'   => 'informe_captura_enviado',
            ],
            'remitir_asesoria_legal' => [
                'from' => 'antecedentes_verificados',
                'to'   => 'propietario_remitido_asesoria_legal',
            ],
            'realizar_informe_decomiso' => [
                'from' => 'antecedentes_verificados',
                'to'   => 'enviar_informe_decomiso',
            ],
            'registrar_arma' => [
                'from' => 'antecedentes_verificados',
                'to'   => 'arma_registrada',
            ]
        ]
    ],
    'realizar_resenia_fotografica'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\ReseniaFotografica'],
        'places'        => [
                          	'nueva',
                            'solicitud_recibida',
                            'resenia_fotografica_enviada'
                          ],
        'transitions'   => [
            'recibir_solicitud' => [
                'from' => 'nueva',
                'to'   => 'solicitud_recibida',
            ],
            'enviar_resenia_fotografica' => [
                'from' => 'solicitud_recibida',
                'to'   => 'resenia_fotografica_enviada',
            ]
        ]
    ],
    'recepcionar_declaracion_ss'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\RecepcionarDeclaracion'],
        'places'        => [
                          	'nueva',
                            'solicitud_recepcionada',
                            'tipo_solicitud_verificada',
                            'fiscal_niniez_solicitado',
                            'declaracion_tomada',
                            'registro_filmico_verificado',
                            'escena_crimen_procesada',
                            'informe_indicios_encontrados_enviado',
                            'resultado_declaracion_verificado',
                            'resultados_declaracion_cotejados',
                            'informe_enviado'
                          ],
        'transitions'   => [
            'recepcionar_solicitud' => [
                'from' => 'nueva',
                'to'   => 'solicitud_recepcionada',
            ],
            'verificar_solicitud' => [
                'from' => 'solicitud_recepcionada',
                'to'   => 'tipo_solicitud_verificada',
            ],
            'solicitar_fiscal_niniez' => [
                'from' => 'tipo_solicitud_verificada',
                'to'   => 'fiscal_niniez_solicitado',
            ],
            'realizar_toma_declaracion' => [
                'from' => 'tipo_solicitud_verificada',
                'to'   => 'declaracion_tomada',
            ],
            'realizar_toma_declaracion_menor' => [
                'from' => 'fiscal_niniez_solicitado',
                'to'   => 'declaracion_tomada',
            ],
            'verificar_registro_filmico' => [
                'from' => 'declaracion_tomada',
                'to'   => 'registro_filmico_verificado',
            ],
            'procesar_escena_crimen' => [
                'from' => 'registro_filmico_verificado',
                'to'   => 'escena_crimen_procesada',
            ],
            'enviar_informe_indicios_encontrados' => [
                'from' => 'escena_crimen_procesada',
                'to'   => 'informe_indicios_encontrados_enviado',
            ],
            'verificar_resultado_declaracion' => [
                'from' => 'informe_indicios_encontrados_enviado',
                'to'   => 'resultado_declaracion_verificado',
            ],
            'verificar_resultados_declaracion' => [
                'from' => 'registro_filmico_verificado',
                'to'   => 'resultado_declaracion_verificado',
            ],
            'cotejar_resultados_declaracion' => [
                'from' => 'resultado_declaracion_verificado',
                'to'   => 'resultados_declaracion_cotejados',
            ],
            'enviar_informe' => [
                'from' => 'resultados_declaracion_cotejados',
                'to'   => 'informe_enviado',
            ]
        ]
    ],
    'reconocimiento_rueda_persona_ss'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\ReconocimientoRuedaPersona'],
        'places'        => [
                          	'nuevo',
                            'requerimiento_fiscal_recibido',
                            'partes_citadas',
                            'reconocimiento_realizado',
                            'acta_no_reconocimiento_enviada',
                            'acta_reconocimiento_enviada',
                            'escena_crimen_procesada',
                            'informe_enviado'
                          ],
        'transitions'   => [
            'recibir_requerimiento_fiscal' => [
                'from' => 'nuevo',
                'to'   => 'requerimiento_fiscal_recibido',
            ],
            'citar_partes' => [
                'from' => 'requerimiento_fiscal_recibido',
                'to'   => 'partes_citadas',
            ],
            'realizar_reconocimiento' => [
                'from' => 'partes_citadas',
                'to'   => 'reconocimiento_realizado',
            ],
            'culpable_no_identificado' => [
                'from' => 'reconocimiento_realizado',
                'to'   => 'acta_no_reconocimiento_enviada',
            ],
            'testigo_imposiblilitado_para_identificacion' => [
                'from' => 'requerimiento_fiscal_recibido',
                'to'   => 'acta_no_reconocimiento_enviada',
            ],
            'culpable_identificado' => [
                'from' => 'reconocimiento_realizado',
                'to'   => 'acta_reconocimiento_enviada',
            ],
            'procesar_escena_crimen' => [
                'from' => 'acta_reconocimiento_enviada',
                'to'   => 'escena_crimen_procesada',
            ],
            'ejecutar_procesamiento_escena_crimen' => [
                'from' => 'acta_no_reconocimiento_enviada',
                'to'   => 'escena_crimen_procesada',
            ],
            'enviar_informe' => [
                'from' => 'escena_crimen_procesada',
                'to'   => 'informe_enviado',
            ]
        ]
    ],
    'registrar_orden_judicial_ss'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\RegistrarOrdenJudicial'],
        'places'        => [
                          	'nueva',
                            'orden_recepcionada',
                            'correccion_informacion_faltante_coordinada',
                            'datos_orden_registrados',
                            'orden_existente_verificada',
                            'orden_judicial_archivada',
                            'orden_judicial_registrada',
                            'orden_captura_archivada',
                            'orden_decomiso_digitalizada',
                            'orden_decomiso_remitida',
                            'orden_decomiso_archivada'
                          ],
        'transitions'   => [
            'recibir_orden' => [
                'from' => 'nueva',
                'to'   => 'orden_recepcionada',
            ],
            'completar_informacion_faltante' => [
                'from' => 'orden_recepcionada',
                'to'   => 'correccion_informacion_faltante_coordinada',
            ],
            'registrar_datos_orden' => [
                'from' => 'correccion_informacion_faltante_coordinada',
                'to'   => 'datos_orden_registrados',
            ],
            'registrar_datos_ordenes' => [
                'from' => 'orden_recepcionada',
                'to'   => 'datos_orden_registrados',
            ],
            'verificar_orden_existente' => [
                'from' => 'datos_orden_registrados',
                'to'   => 'orden_existente_verificada',
            ],
            'archivar_orden_judicial' => [
                'from' => 'orden_existente_verificada',
                'to'   => 'orden_judicial_archivada',
            ],
            'registrar_orden_judicial' => [
                'from' => 'orden_existente_verificada',
                'to'   => 'orden_judicial_registrada',
            ],
            'archivar_orden_captura' => [
                'from' => 'orden_judicial_registrada',
                'to'   => 'orden_captura_archivada',
            ],
            'digitalizar_orden_decomiso' => [
                'from' => 'orden_judicial_registrada',
                'to'   => 'orden_decomiso_digitalizada',
            ],
            'remitir_orden_decomiso' => [
                'from' => 'orden_decomiso_digitalizada',
                'to'   => 'orden_decomiso_remitida',
            ],
            'archivar_orden_decomiso' => [
                'from' => 'orden_decomiso_remitida',
                'to'   => 'orden_decomiso_archivada',
            ]
        ]
    ],
    'retencion_nota_roja'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\NotaRoja'],
        'places'        => [
                          	'nueva',
                            'nota_roja_recibida',
                            'captura_ejecutada',
                            'datos_detenido_tomados',
                            'informe_captura_enviado',
                            'informe_extradicion_enviado',
                            'acta_libertad_enviada'
                          ],
        'transitions'   => [
            'recibir_nota_roja' => [
                'from' => 'nueva',
                'to'   => 'nota_roja_recibida',
            ],
            'ejecutar_captura' => [
                'from' => 'nota_roja_recibida',
                'to'   => 'captura_ejecutada',
            ],
            'registrar_detenido' => [
                'from' => 'captura_ejecutada',
                'to'   => 'datos_detenido_tomados',
            ],
            'enviar_informe_captura' => [
                'from' => 'datos_detenido_tomados',
                'to'   => 'informe_captura_enviado',
            ],
            'enviar_informe_extradicion' => [
                'from' => 'informe_captura_enviado',
                'to'   => 'informe_extradicion_enviado',
            ],
            'enviar_acta_libertad' => [
                'from' => 'informe_captura_enviado',
                'to'   => 'acta_libertad_enviada',
            ]
        ]
    ],
    'realizar_allanamiento'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\SolicitudAllanamiento'],
        'places'        => [
                          	'nuevo',
                            'solicitud_recepcionada',
                            'circunstancias_definidas',
                            'orden_allanamiento_solicitada',
                            'acta_registro_concentimiento_llenadas',
                            'orde_allanamiento_expirada',
                            'orden_operaciones_notificada_elaborada',
                            'informe_inspeccion_ocular_enviado',
                            'evidencias_encontradas_registradas',
                            'informe_evidencia_encontrada_enviado',
                            'acta_allanamiento_enviada',
                            'informe_allanamiento_enviado',
                            'informe_remision_evidencias_enviado'
                          ],
        'transitions'   => [
            'recibir_solicitud' => [
                'from' => 'nuevo',
                'to'   => 'solicitud_recepcionada',
            ],
            'solicitar_orden_allanamiento' => [
                'from' => 'nuevo',
                'to'   => 'orden_allanamiento_solicitada',
            ],
            'enviar_acta_concentimiento' => [
                'from' => 'solicitud_recepcionada',
                'to'   => 'acta_registro_concentimiento_llenadas',
            ],
            'orden_allanamiento_expiro' => [
                'from' => 'orden_allanamiento_solicitada',
                'to'   => 'orde_allanamiento_expirada',
            ],
            'orden_operaciones_notificada_elaborada' => [
                'from' => 'orden_allanamiento_solicitada',
                'to'   => 'orden_operaciones_notificada_elaborada',
            ],
            'enviar_informe_inspeccion_ocular' => [
                'from' => 'orden_allanamiento_solicitada',
                'to'   => 'informe_inspeccion_ocular_enviado',
            ],
            'remitir_informe_inspeccion_ocular' => [
                'from' => 'acta_registro_concentimiento_llenadas',
                'to'   => 'informe_inspeccion_ocular_enviado',
            ],
            'registrar_evidencia' => [
                'from' => 'informe_inspeccion_ocular_enviado',
                'to'   => 'evidencias_encontradas_registradas',
            ],
            'enviar_informe_evidencia_encontrada' => [
                'from' => 'evidencias_encontradas_registradas',
                'to'   => 'informe_evidencia_encontrada_enviado',
            ],
            'enviar_acta_allanamiento' => [
                'from' => 'informe_inspeccion_ocular_enviado',
                'to'   => 'acta_allanamiento_enviada',
            ],
            'enviar_informe_allanamiento' => [
                'from' => 'informe_evidencia_encontrada_enviado',
                'to'   => 'informe_allanamiento_enviado',
            ],
            'enviar_informe_traslado_evidencias' => [
                'from' => 'informe_allanamiento_enviado',
                'to'   => 'informe_remision_evidencias_enviado',
            ]
        ]
    ],
    'realizar_captura'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\Captura'],
        'places'        => [
                          	'nueva',
                            'solicitud_recibida',
                            'motivos_captura_verificados',
                            'captura_fines_extradicion_realizada',
                            'procedicimento_aprehencion_menores_realizado',
                            'captura_registrada',
                            'informe_captura_enviado',
                            'informe_remision_enviado',
                            'evidencias_registradas',
                            'informe_evidencia_encontrada_enviado',
                            'informe_capturado_remitido_enviado',
                            'informe_remision_evidencias_enviado'
                          ],
        'transitions'   => [
            'recibir_solicitud' => [
                'from' => 'nueva',
                'to'   => 'solicitud_recibida',
            ],
            'verificar_motivos_captura' => [
                'from' => 'solicitud_recibida',
                'to'   => 'motivos_captura_verificados',
            ],
            'captura_extradicion' => [
                'from' => 'motivos_captura_verificados',
                'to'   => 'captura_fines_extradicion_realizada',
            ],
            'captura_menor' => [
                'from' => 'motivos_captura_verificados',
                'to'   => 'procedicimento_aprehencion_menores_realizado',
            ],
            'registrar_captura' => [
                'from' => 'motivos_captura_verificados',
                'to'   => 'captura_registrada',
            ],
            'enviar_informe_captura' => [
                'from' => 'captura_registrada',
                'to'   => 'informe_captura_enviado',
            ],
            'enviar_informe_traslado_capturado' => [
                'from' => 'informe_captura_enviado',
                'to'   => 'informe_remision_enviado',
            ],
            'registrar_evidencia' => [
                'from' => 'informe_captura_enviado',
                'to'   => 'evidencias_registradas',
            ],
            'enviar_informe_evidencia_encontrada' => [
                'from' => 'evidencias_registradas',
                'to'   => 'informe_evidencia_encontrada_enviado',
            ],
            'enviar_informe_remision_capturado' => [
                'from' => 'evidencias_registradas',
                'to'   => 'informe_remision_enviado',
            ],
            'enviar_informe_remision_evidencias' => [
                'from' => 'evidencias_registradas',
                'to'   => 'informe_remision_evidencias_enviado',
            ]
        ]
    ],
    'realizar_registro_personal'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\RegistroPersona'],
        'places'        => [
                          	'nuevo',
                            'orden_registro_solicitada',
                            'orden_registro_aprobada',
                            'registro_personal_ejecutado',
                            'informe_registro_personal_enviado',
                            'procesamiento_escena_crimen_asignado',
                            'escena_crimen_procesada',
                            'informe_procesamiento_escena_enviado',
                            'registrar_evidencias',
                            'informe_evidencias_encontradas_enviado',
                            'informe_traslado_evidencias_enviado'
                          ],
        'transitions'   => [
            'solicitar_orden_registro_personal' => [
                'from' => 'nuevo',
                'to'   => 'orden_registro_solicitada',
            ],
            'solicitud_aprobada' => [
                'from' => 'orden_registro_solicitada',
                'to'   => 'orden_registro_aprobada',
            ],
            'ejecutar_registro' => [
                'from' => 'orden_registro_aprobada',
                'to'   => 'registro_personal_ejecutado',
            ],
            'enviar_informe_registro_personal' => [
                'from' => 'registro_personal_ejecutado',
                'to'   => 'informe_registro_personal_enviado',
            ],
            'asignar_procesamiento_escena_crimen' => [
                'from' => 'registro_personal_ejecutado',
                'to'   => 'procesamiento_escena_crimen_asignado',
            ],
            'procesar_escena_crimen' => [
                'from' => 'procesamiento_escena_crimen_asignado',
                'to'   => 'escena_crimen_procesada',
            ],
            'enviar_informe_procesamiento_escena_crimen' => [
                'from' => 'escena_crimen_procesada',
                'to'   => 'informe_procesamiento_escena_enviado',
            ],
            'registrar_evidencias' => [
                'from' => 'informe_procesamiento_escena_enviado',
                'to'   => 'registrar_evidencias',
            ],
            'enviar_informe_evidencias_encontradas' => [
                'from' => 'registrar_evidencias',
                'to'   => 'informe_evidencias_encontradas_enviado',
            ],
            'enviar_informe_evidencias_remitidas' => [
                'from' => 'informe_evidencias_encontradas_enviado',
                'to'   => 'informe_traslado_evidencias_enviado',
            ]
        ]
    ],
    'realizar_vigilancia_seguimiento'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\Seguimiento'],
        'places'        => [
                          	'nuevo',
                            'informacion_verificada',
                            'caso_asignado',
                            'vigilancia_seguimiento_ejecutado',
                            'escena_crimen_procesada',
                            'informe_vigilancia_seguimiento_entregado',
                            'pruebas_entregadas',
                            'mensaje_validacion_operacion_enviado',
                            'operacion_validada',
                            'operacion_ejecutada',
                            'delitos_procesados',
                            'diligencias_finales_realizadas',
                            'informe_final_enviado'
                          ],
        'transitions'   => [
            'verificar_informacion' => [
                'from' => 'nuevo',
                'to'   => 'informacion_verificada',
            ],
            'asignar_caso' => [
                'from' => 'informacion_verificada',
                'to'   => 'caso_asignado',
            ],
            'realizar_vigilancia' => [
                'from' => 'caso_asignado',
                'to'   => 'vigilancia_seguimiento_ejecutado',
            ],
            'procesar_escena_crimen' => [
                'from' => 'vigilancia_seguimiento_ejecutado',
                'to'   => 'escena_crimen_procesada',
            ],
            'entregar_informe_vigilancia_seguimiento' => [
                'from' => 'escena_crimen_procesada',
                'to'   => 'informe_vigilancia_seguimiento_entregado',
            ],
            'entregar_informe_seguimiento_vigilancia' => [
                'from' => 'vigilancia_seguimiento_ejecutado',
                'to'   => 'informe_vigilancia_seguimiento_entregado',
            ],
            'entregar_pruebas' => [
                'from' => 'informe_vigilancia_seguimiento_entregado',
                'to'   => 'pruebas_entregadas',
            ],
            'validar_operacion' => [
                'from' => 'pruebas_entregadas',
                'to'   => 'mensaje_validacion_operacion_enviado',
            ],
            'responder_validacion' => [
                'from' => 'mensaje_validacion_operacion_enviado',
                'to'   => 'operacion_validada',
            ],
            'ejecutar_operacion' => [
                'from' => 'operacion_validada',
                'to'   => 'operacion_ejecutada',
            ],
            'realizar_diligencias_complementarias' => [
                'from' => 'operacion_ejecutada',
                'to'   => 'diligencias_finales_realizadas',
            ],
            'procesar_delitos' => [
                'from' => 'operacion_ejecutada',
                'to'   => 'delitos_procesados',
            ],
            'realizar_diligencias_finales' => [
                'from' => 'delitos_procesados',
                'to'   => 'diligencias_finales_realizadas',
            ],
            'enviar_informe_final' => [
                'from' => 'diligencias_finales_realizadas',
                'to'   => 'informe_final_enviado',
            ]
        ]
    ],
    'unidad_retrato_hablado'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\RetratoHablado'],
        'places'        => [
                          	'nuevo',
                            'solicitud_recibida',
                            'tipo_solicitud_verificada',
                            'fotografias_analizadas',
                            'informe_enviado',
                            'informe_aprobado',
                            'informe_original_entregado',
                            'informe_copia_entregado',
                            'formulario_peticion_llenado',
                            'lugar_retrato_definido',
                            'retrato_hablado_realizado',
                            'retrato_original_archivado',
                            'copia_retrato_hablado_entregado'
                          ],
        'transitions'   => [
            'recibir_solicitud' => [
                'from' => 'nuevo',
                'to'   => 'solicitud_recibida',
            ],
            'verificar_tipo_solicitud' => [
                'from' => 'solicitud_recibida',
                'to'   => 'tipo_solicitud_verificada',
            ],
            'analizar_fotografias' => [
                'from' => 'tipo_solicitud_verificada',
                'to'   => 'fotografias_analizadas',
            ],
            'enviar_informe_aprobacion' => [
                'from' => 'fotografias_analizadas',
                'to'   => 'informe_enviado',
            ],
            'aprobar_informe' => [
                'from' => 'informe_enviado',
                'to'   => 'informe_aprobado',
            ],
            'entregar_informe_original' => [
                'from' => 'informe_aprobado',
                'to'   => 'informe_original_entregado',
            ],
            'entregar_informe_copia' => [
                'from' => 'informe_aprobado',
                'to'   => 'informe_copia_entregado',
            ],
            'llenar_formulario_peticion' => [
                'from' => 'tipo_solicitud_verificada',
                'to'   => 'formulario_peticion_llenado',
            ],
            'definir_lugar_retrato_hablado' => [
                'from' => 'formulario_peticion_llenado',
                'to'   => 'lugar_retrato_definido',
            ],
            'realizar_retrato_hablado' => [
                'from' => 'lugar_retrato_definido',
                'to'   => 'retrato_hablado_realizado',
            ],
            'archivar_retrato_hablado_original' => [
                'from' => 'retrato_hablado_realizado',
                'to'   => 'retrato_original_archivado',
            ],
            'entregar_copia_retrato_hablado' => [
                'from' => 'retrato_original_archivado',
                'to'   => 'copia_retrato_hablado_entregado',
            ]
        ]
    ],
    'flagrancia'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\Flagrancia'],
        'places'        => [
                          	'nueva',
                            'denuncia_recibida',
                            'captura_realizada',
                            'captura_informada',
                            'datos_detenido_verificados',
                            'datos_detenido_registrados',
                            'fiscal_informado',
                            'investigador_informado',
                            'detenido_remitido_ministerio_publico',
                            'informe_remision_enviado',
                            'informe_captura_realizado',
                            'informe_captura_enviado',
                            'informe_captura_recibido',
                            'fiscal_notificado',
                            'inspeccion_escena_crimen_asignada',
                            'diligencias_asignadas',
                            'diligencias_realizadas',
                            'escena_crimen_procesada',
                            'evidencias_registradas',
                            'evidencias_remitidas_ministerio_publico',
                            'informe_procesamiento_escena_enviado',
                            'informe_procesamiento_escena_recibido',
                            'informe_final_realizado',
                            'sospechoso_remitido_ministerio_publico',
                            'informe_remision_enviado',
                            'informe_final_enviado'
                          ],
        'transitions'   => [
            'recibir_denuncia' => [
                'from' => 'nueva',
                'to'   => 'denuncia_recibida',
            ],
            'realizar_captura' => [
                'from' => 'nueva',
                'to'   => 'captura_realizada',
            ],
            'ejecutar_captura' => [
                'from' => 'denuncia_recibida',
                'to'   => 'captura_realizada',
            ],
            'informar_captura' => [
                'from' => 'captura_realizada',
                'to'   => 'captura_informada',
            ],
            'verificar_datos_sospechoso' => [
                'from' => 'captura_informada',
                'to'   => 'datos_detenido_verificados',
            ],
            'registrar_detenido' => [
                'from' => 'datos_detenido_verificados',
                'to'   => 'datos_detenido_registrados',
            ],
            'informar_fiscal' => [
                'from' => 'datos_detenido_verificados',
                'to'   => 'fiscal_informado',
            ],
            'informar_investigador' => [
                'from' => 'datos_detenido_registrados',
                'to'   => 'investigador_informado',
            ],
            'remitir_detenido_ministerio_publico' => [
                'from' => 'fiscal_informado',
                'to'   => 'detenido_remitido_ministerio_publico',
            ],
            'enviar_informe_remision' => [
                'from' => 'detenido_remitido_ministerio_publico',
                'to'   => 'informe_remision_enviado',
            ],
            'realizar_informe_captura' => [
                'from' => 'captura_informada',
                'to'   => 'informe_captura_realizado',
            ],
            'enviar_informe_captura' => [
                'from' => 'informe_captura_realizado',
                'to'   => 'informe_captura_enviado',
            ],
            'recibir_informe_captura' => [
                'from' => 'informe_captura_enviado',
                'to'   => 'informe_captura_recibido',
            ],
            'notificar_fiscal' => [
                'from' => 'informe_captura_recibido',
                'to'   => 'fiscal_notificado',
            ],
            'asignar_procesamiento_escena_crimen' => [
                'from' => 'informe_captura_recibido',
                'to'   => 'inspeccion_escena_crimen_asignada',
            ],
            'asignar_diligencia' => [
                'from' => 'fiscal_notificado',
                'to'   => 'diligencias_asignadas',
            ],
            'realizar_diligencias' => [
                'from' => 'diligencias_asignadas',
                'to'   => 'diligencias_realizadas',
            ],
            'procesar_escena_crimen' => [
                'from' => 'inspeccion_escena_crimen_asignada',
                'to'   => 'escena_crimen_procesada',
            ],
            'registrar_evidencias' => [
                'from' => 'escena_crimen_procesada',
                'to'   => 'evidencias_registradas',
            ],
            'remitir_evidencias_ministerio_publico' => [
                'from' => 'evidencias_registradas',
                'to'   => 'evidencias_remitidas_ministerio_publico',
            ],
            'enviar_informe_procesamiento_escena_crimen' => [
                'from' => 'evidencias_remitidas_ministerio_publico',
                'to'   => 'informe_procesamiento_escena_enviado',
            ],
            'remitir_informe_procesamiento_escena_crimen' => [
                'from' => 'escena_crimen_procesada',
                'to'   => 'informe_procesamiento_escena_enviado',
            ],
            'recibir_informe_procesamiento_escena_crimen' => [
                'from' => 'informe_procesamiento_escena_enviado',
                'to'   => 'informe_procesamiento_escena_recibido',
            ],
            'realizar_informe_final' => [
                'from' => 'informe_procesamiento_escena_recibido',
                'to'   => 'informe_final_realizado',
            ],
            'remitir_sospechoso_ministerio_publico' => [
                'from' => 'informe_final_realizado',
                'to'   => 'sospechoso_remitido_ministerio_publico',
            ],
            'enviar_informe_remision' => [
                'from' => 'sospechoso_remitido_ministerio_publico',
                'to'   => 'informe_remision_enviado',
            ],
            'enviar_informe_final' => [
                'from' => 'informe_remision_enviado',
                'to'   => 'informe_final_enviado',
            ]
        ]
    ],
    'solicitud_analisis'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\SolicitudAnalisis'],
        'places'        => [
                          	'nueva',
                            'evidencias_recibidas',
                            'evidencias_verificadas',
                            'evidencias_devueltas',
                            'evidencias_registradas',
                            'evidencias_almacenadas',
                            'orden_trabajo_generada',
                            'orden_trabajo_enviada',
                            'orden_trabajo_recibida',
                            'orden_trabajo_revisada',
                            'orden_trabajo_rechazada',
                            'orden_trabajo_aceptada',
                            'evidencias_recepcionadas',
                            'evidencias_revisadas',
                            'evidencias_rechazadas',
                            'fijacion_fotografica_realizada',
                            'analisis_realizado',
                            'informe_pericial_elaborado',
                            'informe_pericial_enviado',
                            'informe_pericial_recibido',
                            'informe_pericial_entregado'
                          ],
        'transitions'   => [
            'recibir_evidencias' => [
                'from' => 'nueva',
                'to'   => 'evidencias_recibidas',
            ],
            'verificar_evidencias' => [
                'from' => 'evidencias_recibidas',
                'to'   => 'evidencias_verificadas',
            ],
            'devolver_evidencias' => [
                'from' => 'evidencias_verificadas',
                'to'   => 'evidencias_devueltas',
            ],
            'registrar_evidencias' => [
                'from' => 'evidencias_verificadas',
                'to'   => 'evidencias_registradas',
            ],
            'almacenar_evidencias' => [
                'from' => 'evidencias_registradas',
                'to'   => 'evidencias_almacenadas',
            ],
            'generar_orden_trabajo' => [
                'from' => 'evidencias_almacenadas',
                'to'   => 'orden_trabajo_generada',
            ],
            'enviar_orden_trabajo' => [
                'from' => 'orden_trabajo_generada',
                'to'   => 'orden_trabajo_enviada',
            ],
            'recibir_orden_trabajo' => [
                'from' => 'orden_trabajo_enviada',
                'to'   => 'orden_trabajo_recibida',
            ],
            'revisar_orden_trabajo' => [
                'from' => 'orden_trabajo_recibida',
                'to'   => 'orden_trabajo_revisada',
            ],
            'rechazar_orden_trabajo' => [
                'from' => 'orden_trabajo_revisada',
                'to'   => 'orden_trabajo_rechazada',
            ],
            'aceptar_orden_trabajo' => [
                'from' => 'orden_trabajo_revisada',
                'to'   => 'orden_trabajo_aceptada',
            ],
            'recepcionar_evidencias' => [
                'from' => 'orden_trabajo_aceptada',
                'to'   => 'evidencias_recepcionadas',
            ],
            'revisar_evidencias' => [
                'from' => 'evidencias_recepcionadas',
                'to'   => 'evidencias_revisadas',
            ],
            'rechazar_evidencias' => [
                'from' => 'evidencias_revisadas',
                'to'   => 'evidencias_rechazadas',
            ],
            'realizar_fijacion_fotografica' => [
                'from' => 'evidencias_revisadas',
                'to'   => 'fijacion_fotografica_realizada',
            ],
            'realizar_analisis' => [
                'from' => 'fijacion_fotografica_realizada',
                'to'   => 'analisis_realizado',
            ],
            'elaborar_informe_pericial' => [
                'from' => 'analisis_realizado',
                'to'   => 'informe_pericial_elaborado',
            ],
            'enviar_informe_pericial' => [
                'from' => 'informe_pericial_elaborado',
                'to'   => 'informe_pericial_enviado',
            ],
            'recibir_informe_pericial' => [
                'from' => 'informe_pericial_enviado',
                'to'   => 'informe_pericial_recibido',
            ],
            'remitir_informe_pericial' => [
                'from' => 'informe_pericial_recibido',
                'to'   => 'informe_pericial_entregado',
            ]
        ]
    ],
    ////////////////////////////////////////
    'acuerdo_interno_ss'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\AcuerdoInternoSS'],
        'places'        => [
                          	'nuevo_solicitud_acuerdo',
                            'elaboro_acto_solicitado',
                            'redacto_acuerdo',
                            'firmo_acuerdo',
                            'entrego_notificacion',
                            'actualizo_bd',
                          ],
        'transitions'   => [
            'elaborar_acto' => [
                'from' => 'nueva_solicitud_acuerdo',
                'to'   => 'elaboro_acto_solicitado',
            ],
            'redactar_acuerdo' => [
                'from' => 'elaboro_acto_solicitado',
                'to'   => 'redacto_acuerdo',
            ],
            'firmar_acuerdo' => [
                'from' => 'redacto_acuerdo',
                'to'   => 'firmo_acuerdo',
            ],
            'entregar_notificacion' => [
                'from' => 'firmo_acuerdo',
                'to'   => 'entrego_notificacion',
            ],
            'actualizar_bd' => [
                'from' => 'entrego_notificacion',
                'to'   => 'actualizo_bd',
            ]
        ]
    ],
    'extraer_dato_sistema_ss'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\ExtraerDatoSistemaSS'],
        'places'        => [
                          	'nuevo_instruccion',
                            'recepciono_verifico_documentos',
                            'realizo_baja_persona',
                            'genero_respuesta',
                            'archivo'
                          ],
        'transitions'   => [
            'recepcionar_acuerdo' => [
                'from' => 'nuevo_instruccion',
                'to'   => 'recepciono_verifico_documentos',
            ],
            'bajar_persona' => [
                'from' => 'recepciono_verifico_documentos',
                'to'   => 'realizo_baja_persona',
            ],
            'generar_respuesta' => [
                'from' => 'realizo_baja_persona',
                'to'   => 'genero_respuesta',
            ],
            'enviar_archivo' => [
                'from' => 'genero_respuesta',
                'to'   => 'archivo',
            ]
        ]
    ],
    'delito_contra_propiedad_ss'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\DelitoContraPropiedadSS'],
        'places'        => [
                          	'nueva_denuncia',
                            'asigno_denuncia',
                            'nueva_solicitud_nota_informacion',
                            'genero_informe_propuesta',
                            'nueva_solicitud_peritaje_vehiculo',
                            'registro_informacion_vehiculo',
                            'genero_acta_inspeccion',
                            'nueva_solicitud_diligencia',
                            'asigno_diligencia',
                            'genero_informes_diligencias',
                            'nueva_solicitud_datos_estadisticos',
                            'registro_actividades_mensuales',
                            'genero_informe_periodico_casos',
                            'remitio_informe_ss_fna',
                            'remitio_informe_ss_medicinaforensemp_fiscalmp',
                            'remitio_informe_ss_fiscalmp',
                            'remitio_informe_ss_estadisticaplaneacion'
                          ],
        'transitions'   => [
            'asignar_denuncia' => [
                'from' => 'nueva_denuncia',
                'to'   => 'asigno_denuncia',
            ],
            'recibir_solicitud_nota_informacion' => [
                'from' => 'asigno_denuncia',
                'to'   => 'nueva_solicitud_nota_informacion',
            ],
            'generar_informe_propuesta' => [
                'from' => 'nueva_solicitud_nota_informacion',
                'to'   => 'genero_informe_propuesta',
            ],
            'remitir_informe_ss_fna' => [
                'from' => 'genero_informe_propuesta',
                'to'   => 'remitio_informe_ss_fna',
            ],
            'recibir_solicitud_peritaje_vehiculo' => [
                'from' => 'asigno_denuncia',
                'to'   => 'nueva_solicitud_peritaje_vehiculo',
            ],
            'registrar_informacion_vehiculo' => [
                'from' => 'nueva_solicitud_peritaje_vehiculo',
                'to'   => 'registro_informacion_vehiculo',
            ],
            'generar_acta_inspeccion' => [
                'from' => 'registro_informacion_vehiculo',
                'to'   => 'genero_acta_inspeccion',
            ],
            'remitir_informe_ss_medicinaforensemp_fiscalmp' => [
                'from' => 'genero_acta_inspeccion',
                'to'   => 'remitio_informe_ss_medicinaforensemp_fiscalmp',
            ],
            'recibir_solicitud_diligencia' => [
                'from' => 'asigno_denuncia',
                'to'   => 'nueva_solicitud_diligencia',
            ],
            'asignar_diligencia' => [
                'from' => 'nueva_solicitud_diligencia',
                'to'   => 'asigno_diligencia',
            ],
            'generar_informes_diligencias' => [
                'from' => 'asigno_diligencia',
                'to'   => 'genero_informes_diligencias',
            ],
            'remitir_informe_ss_fiscalmp' => [
                'from' => 'genero_informes_diligencias',
                'to'   => 'remitio_informe_ss_fiscalmp',
            ],
            'recibir_solicitud_datos_estadisticos' => [
                'from' => 'asigno_denuncia',
                'to'   => 'nueva_solicitud_datos_estadisticos',
            ],
            'registrar_actividades_mensuales' => [
                'from' => 'nueva_solicitud_datos_estadisticos',
                'to'   => 'registro_actividades_mensuales',
            ],
            'generar_informe_periodico_casos' => [
                'from' => 'registro_actividades_mensuales',
                'to'   => 'genero_informe_periodico_casos',
            ],
            'remitir_informe_ss_estadisticaplaneacion' => [
                'from' => 'genero_informe_periodico_casos',
                'to'   => 'remitio_informe_ss_estadisticaplaneacion',
            ]
        ]
    ],
    'informe_logistico_ss'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\InformeLogisticoSS'],
        'places'        => [
                          	'nueva_solicitud',
                            'verifico_solicitado',
                            'genero_informe_respuesta',
                            'genero_informe_solicitud',
                            'envio_solicitud',
                            'envio_respuesta',
                            'genero_informe_respectivos'
                          ],
        'transitions'   => [
            'verificar_existencias' => [
                'from' => 'nueva_solicitud',
                'to'   => 'verifico_solicitado',
            ],
            'generar_informe_respuesta' => [
                'from' => 'verifico_solicitado',
                'to'   => 'genero_informe_respuesta',
            ],
            'enviar_respuesta' => [
                'from' => 'genero_informe_respuesta',
                'to'   => 'envio_respuesta',
            ],
            'generar_informe_respectivo' => [
                'from' => 'envio_respuesta',
                'to'   => 'genero_informe_respectivos',
            ],
            'generar_informe_solicitud' => [
                'from' => 'verifico_solicitado',
                'to'   => 'genero_informe_solicitud',
            ],
            'enviar_solicitud' => [
                'from' => 'genero_informe_solicitud',
                'to'   => 'envio_solicitud',
            ],
            'generar_informe_avisos' => [
                'from' => 'envio_solicitud',
                'to'   => 'genero_informe_respectivos',
            ]
        ]
    ],
    'nueva_promocion_ss'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\NuevaPromocionSS'],
        'places'        => [
                            'recibe_solicitud_oficial',
                            'obtuvo_listados_copias_id',
                            'solicito_informacion_secretario_general',
                            'recibio_informacion_solicitada',
                            'extiendio_estructura_presupuestaria'
                          ],
        'transitions'   => [
            'obtener_listados' => [
                'from' => 'recibe_solicitud_oficial',
                'to'   => 'obtuvo_listados_copias_id',
            ],
            'solicitar_informacion' => [
                'from' => 'obtuvo_listados_copias_id',
                'to'   => 'solicito_informacion_secretario_general',
            ],
            'recibir_informacion' => [
                'from' => 'solicito_informacion_secretario_general',
                'to'   => 'recibio_informacion_solicitada',
            ],
            'extender_estructura_presupuestaria' => [
                'from' => 'recibio_informacion_solicitada',
                'to'   => 'extiendio_estructura_presupuestaria',
            ]
        ]
    ],
    'contestacion_oficio_ss'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\ContestacionOficioSS'],
        'places'        => [
                            'nueva_solicitud',
                            'ingreso_solicitud_libro',
                            'proceso_informacion',
                            'autorizo_jefe_inmediato',
                            'envio_contestacion',
                          ],
        'transitions'   => [
            'ingresar_solicitud' => [
                'from' => 'nueva_solicitud',
                'to'   => 'ingreso_solicitud_libro',
            ],
            'procesar_informacion' => [
                'from' => 'ingreso_solicitud_libro',
                'to'   => 'proceso_informacion',
            ],
            'autorizar_contestacion' => [
                'from' => 'proceso_informacion',
                'to'   => 'autorizo_jefe_inmediato',
            ],
            'enviar_autorizacion_jefe' => [
                'from' => 'autorizo_jefe_inmediato',
                'to'   => 'envio_contestacion',
            ]
        ]
    ],
    'informe_perfilacion_criminal_ss'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\InformePerfilacionCriminalSS'],
        'places'        => [
                          	'nueva_denuncia',
                            'reviso_expediente_carencias',
                            'analizo_expediente_sugerencias',
                            'individualizo_victima_sospechoso',
                            'genero_perfil_victima',
                            'genero_perfil_sospechoso',
                            'nueva_solicitud_matriz_vinculacion',
                            'genero_matriz_vinculacion',
                            'vinculo',
                            'realizo_estudios',
                            'genero_antecedetes_victima',
                            'genero_antecedetes_sospechoso',
                            'genero_informe_final',
                            'entrego_informe_final'
                          ],
        'transitions'   => [
            'revisar_expediente' => [
                'from' => 'nueva_denuncia',
                'to'   => 'reviso_expediente_carencias',
            ],
            'analizar_expediente' => [
                'from' => 'reviso_expediente_carencias',
                'to'   => 'analizo_expediente_sugerencias',
            ],
            'individualizar' => [
                'from' => 'analizo_expediente_sugerencias',
                'to'   => 'individualizo_victima_sospechoso',
            ],
            'generar_perfil_victima' => [
                'from' => 'individualizo_victima_sospechoso',
                'to'   => 'genero_perfil_victima',
            ],
            'generar_perfil_sospechoso' => [
                'from' => 'individualizo_victima_sospechoso',
                'to'   => 'genero_perfil_sospechoso',
            ],
            'generar_matriz_vinculacion_victima' => [
                'from' => 'genero_perfil_victima',
                'to'   => 'genero_matriz_vinculacion',
            ],
            'generar_matriz_vinculacion_sospechoso' => [
                'from' => 'genero_perfil_sospechoso',
                'to'   => 'genero_matriz_vinculacion',
            ],
            'nueva_solicitud_matriz_vinculacion' => [
                'from' => 'nueva_solicitud_matriz_vinculacion',
                'to'   => 'genero_matriz_vinculacion',
            ],
            'vincular' => [
                'from' => 'genero_matriz_vinculacion',
                'to'   => 'vinculo',
            ],
            'realizar_estudios' => [
                'from' => 'vinculo',
                'to'   => 'realizo_estudios',
            ],
            'generar_antecedentes_victima' => [
                'from' => 'realizo_estudios',
                'to'   => 'genero_antecedetes_victima',
            ],
            'generar_antecedentes_sospechoso' => [
                'from' => 'realizo_estudios',
                'to'   => 'genero_antecedetes_sospechoso',
            ],
            'generar_informe_final_victima' => [
                'from' => 'genero_antecedetes_victima',
                'to'   => 'genero_informe_final',
            ],
            'generar_informe_final_sospechoso' => [
                'from' => 'genero_antecedetes_sospechoso',
                'to'   => 'genero_informe_final',
            ],
            'informe_final_entregado' => [
                'from' => 'genero_informe_final',
                'to'   => 'informe_final_entregado',
            ]
        ]
    ],
    'informe_disciplinario_ss'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\InformeDisciplinarioSS'],
        'places'        => [
                            'recibio_informe_inicial',
                            'proceso_informacion',
                            'realizo_audiencia_descargo',
                            'genero_dictamen',
                            'genero_informe_resolucion',
                            'notifico_resolucion',
                            'archivo_resolucion',
                            'ejecuto_sancion',
                            'remitio_resolucion_direccion_general',
                            'archivo_informe_final'
                          ],
        'transitions'   => [
            'procesar_informacion' => [
                'from' => 'recibio_informe_inicial',
                'to'   => 'proceso_informacion',
            ],
            'realizar_audiencia_descargo' => [
                'from' => 'proceso_informacion',
                'to'   => 'realizo_audiencia_descargo',
            ],
            'generar_dictamen' => [
                'from' => 'realizo_audiencia_descargo',
                'to'   => 'genero_dictamen',
            ],
            'generar_informe_resolucion' => [
                'from' => 'genero_dictamen',
                'to'   => 'genero_informe_resolucion',
            ],
            'notificar_resolucion' => [
                'from' => 'genero_informe_resolucion',
                'to'   => 'notifico_resolucion',
            ],
            'archivar_resolucion' => [
                'from' => 'notifico_resolucion',
                'to'   => 'archivo_resolucion',
            ],
            'remitir_resolucion_direccion_general' => [
                'from' => 'notifico_resolucion',
                'to'   => 'remitio_resolucion_direccion_general',
            ],
            'ejecutar_sancion' => [
                'from' => 'notifico_resolucion',
                'to'   => 'ejecuto_sancion',
            ],
            'archivar_informe_final' => [
                'from' => 'ejecuto_sancion',
                'to'   => 'archivo_informe_final',
            ]
        ]
    ],
    'informe_delito_contra_vida_ss'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\InformeDelitoContraVidaSS'],
        'places'        => [
                            'nueva_denuncia',
                            'realizo_levantamiento_cadaverico',
                            'busco_testigos',
                            'tomo_declaracion_testigos',
                            'recolecto_informacion_hecho',
                            'realizo_primeras_diligencias',
                            'genero_informe_preliminar',
                            'remitio_informe_preliminar_mp',
                            'recibio_auto_ampliacion',
                            'realizo_diligencias_complementarias',
                            'incorporo_resultados_periciales',
                            'genero_informe_avances',
                            'remitio_informe_avances_mp',
                            'genero_informe_final',
                            'remitio_informe_final_mp',
                            'genero_informe_remision_detenido',
                            'remitio_informe_remision_mp',
                            'nueva_orden_captura_pj',
                            'ejecuto_orden_captura',
                            'sospechoso_remitido_pj',
                            'informe_enviado'
                          ],
        'transitions'   => [
            'realizar_lavantamiento_cadaverico' => [
                'from' => 'nueva_denuncia',
                'to'   => 'realizo_levantamiento_cadaverico',
            ],
            'buscar_testigos' => [
                'from' => 'realizo_levantamiento_cadaverico',
                'to'   => 'busco_testigos',
            ],
            'tomar_declaracion_testigos' => [
                'from' => 'busco_testigos',
                'to'   => 'tomo_declaracion_testigos',
            ],
            'recolectar_informacion_hecho_testigos' => [
                'from' => 'tomo_declaracion_testigos',
                'to'   => 'recolecto_informacion_hecho',
            ],
            'recolectar_informacion_hecho' => [
                'from' => 'busco_testigos',
                'to'   => 'recolecto_informacion_hecho',
            ],
            'realizar_primeras_diligencias' => [
                'from' => 'recolecto_informacion_hecho',
                'to'   => 'realizo_primeras_diligencias',
            ],
            'generar_informe_preliminar' => [
                'from' => 'realizo_primeras_diligencias',
                'to'   => 'genero_informe_preliminar',
            ],
            'remitir_informe_preliminar' => [
                'from' => 'genero_informe_preliminar',
                'to'   => 'remitio_informe_preliminar_mp',
            ],
            'finalizar_informe_preliminar' => [
                'from' => 'remitio_informe_preliminar_mp',
                'to'   => 'informe_enviado',
            ],
            'recibir_auto_ampliacion_avances' => [
                'from' => 'remitio_informe_preliminar_mp',
                'to'   => 'recibio_auto_ampliacion',
            ],
            'realizar_diligencias_complementarias_avances' => [
                'from' => 'recibio_auto_ampliacion',
                'to'   => 'realizo_diligencias_complementarias',
            ],
            'incorporar_resultados_periciales_avances' => [
                'from' => 'realizo_diligencias_complementarias',
                'to'   => 'incorporo_resultados_periciales',
            ],
            'generar_informe_avances' => [
                'from' => 'incorporo_resultados_periciales',
                'to'   => 'genero_informe_avances',
            ],
            'remitir_informe_avances' => [
                'from' => 'genero_informe_avances',
                'to'   => 'remitio_informe_avances_mp',
            ],
            'finalizar_informe_avances' => [
                'from' => 'remitio_informe_avances_mp',
                'to'   => 'informe_enviado',
            ],
            'recibir_auto_ampliacion_final' => [
                'from' => 'remitio_informe_avances_mp',
                'to'   => 'recibio_auto_ampliacion',
            ],
            'realizar_diligencias_complementarias_final' => [
                'from' => 'recibio_auto_ampliacion',
                'to'   => 'realizo_diligencias_complementarias',
            ],
            'incorporar_resultados_periciales_final' => [
                'from' => 'realizo_diligencias_complementarias',
                'to'   => 'incorporo_resultados_periciales',
            ],
            'generar_informe_final' => [
                'from' => 'incorporo_resultados_periciales',
                'to'   => 'genero_informe_final',
            ],
            'remitir_informe_final' => [
                'from' => 'genero_informe_final',
                'to'   => 'remitio_informe_final_mp',
            ],
            'finalizar_informe_final' => [
                'from' => 'remitio_informe_final_mp',
                'to'   => 'informe_enviado',
            ],
            'recibir_orden_captura' => [
                'from' => 'remitio_informe_final_mp',
                'to'   => 'nueva_orden_captura_pj',
            ],
            'orden_ejecutada' => [
                'from' => 'nueva_orden_captura_pj',
                'to'   => 'ejecuto_orden_captura',
            ],
            'remitir_sospechoso' => [
                'from' => 'ejecuto_orden_captura',
                'to'   => 'sospechoso_remitido_pj',
            ],
            'realizar_primeras_diligencias_testigos_flagrancia' => [
                'from' => 'tomo_declaracion_testigos',
                'to'   => 'realizo_primeras_diligencias',
            ],
            'realizar_primeras_diligencias_flagrancia' => [
                'from' => 'busco_testigos',
                'to'   => 'realizo_primeras_diligencias',
            ],
            'realizar_diligencias_complentarias_flagrancia' => [
                'from' => 'realizo_primeras_diligencias',
                'to'   => 'realizo_diligencias_complementarias',
            ],
            'generar_informe_remision' => [
                'from' => 'realizo_diligencias_complementarias',
                'to'   => 'genero_informe_remision_detenido',
            ],
            'remitir_informe_remision' => [
                'from' => 'genero_informe_remision_detenido',
                'to'   => 'remitio_informe_remision_mp',
            ],
            'generar_informe_final_flagrancia' => [
                'from' => 'remitio_informe_remision_mp',
                'to'   => 'genero_informe_final',
            ],
            'remitir_informe_final_flagrancia' => [
                'from' => 'genero_informe_final',
                'to'   => 'remitio_informe_final_mp',
            ],
            'finalizar_informe_final_flagrancia' => [
                'from' => 'remitio_informe_final_mp',
                'to'   => 'informe_enviado',
            ]
        ]
    ],
    'estandarizacion_ss'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\EstandarizacionSS'],
        'places'        => [
                            'nueva_solicitud',
                            'nuevo_manual',
                            'nueva_actualizacion_instructivo',
                            'nuevo_boletin_doctrinal_juridico',
                            'presento_manual',
                            'necesidades_cambio',
                            'selecciono_tema',
                            'manual_aprobado',
                            'realizo_cronograma',
                            'elaboro_boletin',
                            'difundio_manual',
                            'actualizo_documento',
                            'reviso_boletin',
                            'presento_instructivo',
                            'presento_boletin',
                            'manual_difundido',
                            'instructivo_aprobado',
                            'aprobo_boletin',
                            'socializado',
                            'difundio_boletin',
                            'manual_socializado',
                            'manual_difundido'
                          ],
        'transitions'   => [
            'generar_manual_nuevo' => [
                'from' => 'nueva_solicitud',
                'to'   => 'nuevo_manual',
            ],
            'generar_actualizacion_instructivo' => [
                'from' => 'nueva_solicitud',
                'to'   => 'nueva_actualizacion_instructivo',
            ],
            'generar_nuevo_boletin' => [
                'from' => 'nueva_solicitud',
                'to'   => 'nuevo_boletin_doctrinal_juridico',
            ],
            'presentar_manual' => [
                'from' => 'nuevo_manual',
                'to'   => 'presento_manual',
            ],
            'presentar_necesidades' => [
                'from' => 'nueva_actualizacion_instructivo',
                'to'   => 'necesidades_cambio',
            ],
            'seleccionar_tema' => [
                'from' => 'nuevo_boletin_doctrinal_juridico',
                'to'   => 'selecciono_tema',
            ],
            'aprobar_manual' => [
                'from' => 'presento_manual',
                'to'   => 'manual_aprobado',
            ],
            'realizar_cronograma' => [
                'from' => 'necesidades_cambio',
                'to'   => 'realizo_cronograma',
            ],
            'elaborar_boletin' => [
                'from' => 'selecciono_tema',
                'to'   => 'elaboro_boletin',
            ],
            'difundir_manual' => [
                'from' => 'manual_aprobado',
                'to'   => 'difundio_manual',
            ],
            'actualizar_documento' => [
                'from' => 'realizo_cronograma',
                'to'   => 'actualizo_documento',
            ],
            'revisar_boletin' => [
                'from' => 'elaboro_boletin',
                'to'   => 'reviso_boletin',
            ],
            'presentar_instructivo' => [
                'from' => 'actualizo_documento',
                'to'   => 'presento_instructivo',
            ],
            'presentar_boletin' => [
                'from' => 'reviso_boletin',
                'to'   => 'presento_boletin',
            ],
            'difundir_manual' => [
                'from' => 'difundio_manual',
                'to'   => 'manual_difundido',
            ],
            'aprobar_instructivo' => [
                'from' => 'presento_instructivo',
                'to'   => 'instructivo_aprobado',
            ],
            'aprobar_boletin' => [
                'from' => 'presento_boletin',
                'to'   => 'aprobo_boletin',
            ],
            'socializar_instructivo' => [
                'from' => 'instructivo_aprobado',
                'to'   => 'socializado',
            ],
            'difundir_boletin' => [
                'from' => 'aprobo_boletin',
                'to'   => 'difundio_boletin',
            ],
            'socializar_manual' => [
                'from' => 'socializado',
                'to'   => 'manual_socializado',
            ],
            'difundir_manual' => [
                'from' => 'difundio_boletin',
                'to'   => 'manual_difundido',
            ]
        ]
    ],
    'informe_escena_delito_ss'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\InformeEscenaDelitoSS'],
        'places'        => [
                            'nueva_denuncia',
                            'proceso_escena_delito',
                            'proceso_indicios',
                            'proceso_pertenencias',
                            'proceso_allanamiento',
                            'proceso_exhumacion',
                            'reconstruyo_hechos',
                            'realizo_pruebas_luminol',
                            'envio_indicios_laboratorio',
                            'envio_pertenencias_mp',
                            'recibio_resultados_laboratorio',
                            'genero_informe_pericial',
                            'genero_movil',
                            'genero_informe_final',
                            'nueva_orden_captura_pj',
                            'remitio_informe_final_mp',
                            'ejecuto_orden_captura',
                            'sospechoso_remitido_pj'
                          ],
        'transitions'   => [
            'procesar_escena_delito' => [
                'from' => 'nueva_denuncia',
                'to'   => 'proceso_escena_delito',
            ],
            'procesar_indicios' => [
                'from' => 'proceso_escena_delito',
                'to'   => 'proceso_indicios',
            ],
            'procesar_pertenencias' => [
                'from' => 'proceso_escena_delito',
                'to'   => 'proceso_pertenencias',
            ],
            'procesar_allanamiento' => [
                'from' => 'proceso_escena_delito',
                'to'   => 'proceso_allanamiento',
            ],
            'procesar_exhumacion' => [
                'from' => 'proceso_escena_delito',
                'to'   => 'proceso_exhumacion',
            ],
            'reconstruir_hechos' => [
                'from' => 'proceso_escena_delito',
                'to'   => 'reconstruyo_hechos',
            ],
            'realizar_pruebas_luminol' => [
                'from' => 'proceso_escena_delito',
                'to'   => 'realizo_pruebas_luminol',
            ],
            'enviar_indicios_laboratorio' => [
                'from' => 'proceso_indicios',
                'to'   => 'envio_indicios_laboratorio',
            ],
            'enviar_pertenencias_mp' => [
                'from' => 'proceso_pertenencias',
                'to'   => 'envio_pertenencias_mp',
            ],
            'recibir_resulatados_laboratorio' => [
                'from' => 'envio_indicios_laboratorio',
                'to'   => 'recibio_resultados_laboratorio',
            ],
            'generar_informe_pericial_laboratorios' => [
                'from' => 'recibio_resultados_laboratorio',
                'to'   => 'genero_informe_pericial',
            ],
            'generar_informe_pericial_pertenencias' => [
                'from' => 'envio_pertenencias_mp',
                'to'   => 'genero_informe_pericial',
            ],
            'generar_informe_pericial_allanamiento' => [
                'from' => 'proceso_allanamiento',
                'to'   => 'genero_informe_pericial',
            ],
            'generar_informe_pericial_exhumacion' => [
                'from' => 'proceso_exhumacion',
                'to'   => 'genero_informe_pericial',
            ],
            'generar_informe_pericial_hechos' => [
                'from' => 'reconstruyo_hechos',
                'to'   => 'genero_informe_pericial',
            ],
            'generar_informe_pericial_luminol' => [
                'from' => 'realizo_pruebas_luminol',
                'to'   => 'genero_informe_pericial',
            ],
            'generar_movil' => [
                'from' => 'genero_informe_pericial',
                'to'   => 'genero_movil',
            ],
            'generar_informe_final' => [
                'from' => 'genero_movil',
                'to'   => 'genero_informe_final',
            ],
            'remitir_informe_final_mp' => [
                'from' => 'genero_informe_final',
                'to'   => 'remitio_informe_final_mp',
            ],
            'recibir_nueva_orden_captura' => [
                'from' => 'remitio_informe_final_mp',
                'to'   => 'nueva_orden_captura_pj',
            ],
            'ejecutar_orden_captura' => [
                'from' => 'nueva_orden_captura_pj',
                'to'   => 'ejecuto_orden_captura',
            ],
            'remitir_sospechoso_pj' => [
                'from' => 'ejecuto_orden_captura',
                'to'   => 'sospechoso_remitido_pj',
            ]
        ]
    ],
    'informe_topografia_forense_ss'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\InformeTopografiaForenseSS'],
        'places'        => [
                            'nueva_denuncia',
                            'verifico_equipos',
                            'determino_levantamiento_acorde_hechos',
                            'realizo_bosquejo_topografico',
                            'verifico_viabilidad',
                            'realizo_levantamiento_topografico',
                            'realizo_exhumacion',
                            'reconstruyo_hechos',
                            'genero_informe_final',
                            'remitio_informe_final_mp'
                          ],
        'transitions'   => [
            'verificar_equipos' => [
                'from' => 'nueva_denuncia',
                'to'   => 'verifico_equipos',
            ],
            'determinar_levantamiento' => [
                'from' => 'nueva_denuncia',
                'to'   => 'determino_levantamiento_acorde_hechos',
            ],
            'realizar_levantamiento_topografico' => [
                'from' => 'nueva_denuncia',
                'to'   => 'realizo_bosquejo_topografico',
            ],
            'verificar_viabilidad_equipos' => [
                'from' => 'verifico_equipos',
                'to'   => 'verifico_viabilidad',
            ],
            'verificar_viabilidad_hechos' => [
                'from' => 'determino_levantamiento_acorde_hechos',
                'to'   => 'verifico_viabilidad',
            ],
            'verificar_viabilidad_bosquejo' => [
                'from' => 'realizo_bosquejo_topografico',
                'to'   => 'verifico_viabilidad',
            ],
            'realizar_levantamiento_topografico' => [
                'from' => 'verifico_viabilidad',
                'to'   => 'realizo_levantamiento_topografico',
            ],
            'realizar_exhumacion' => [
                'from' => 'verifico_viabilidad',
                'to'   => 'realizo_exhumacion',
            ],
            'reconstruir_hechos' => [
                'from' => 'verifico_viabilidad',
                'to'   => 'reconstruyo_hechos',
            ],
            'generar_informe_final_hechos' => [
                'from' => 'reconstruyo_hechos',
                'to'   => 'genero_informe_final',
            ],
            'generar_informe_final_exhumacion' => [
                'from' => 'realizo_exhumacion',
                'to'   => 'genero_informe_final',
            ],
            'generar_informe_final_levantamiento' => [
                'from' => 'realizo_levantamiento_topografico',
                'to'   => 'genero_informe_final',
            ],
            'remitir_informe_final_mp' => [
                'from' => 'genero_informe_final',
                'to'   => 'remitio_informe_final_mp',
            ]
        ]
    ],
    'denuncia_proceso_general_ss'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\DenunciaProcesoGeneralSS'],
        'places'        => [
                            'nueva_denuncia',
                            'registro_denuncia_infraganti',
                            'verifico_identidad_detenido',
                            'verifico_identidad_denunciante',
                            'remite_solicitud_defensor_defensa_publica_pj',
                            'tipifico_delito',
                            'remitido_defensa_publica',
                            'autorizo_delito',
                            'transcribio_denuncia',
                            'notifico_denunciante_denuncia_no_aceptada',
                            'genero_reporte_denuncia_firmado',
                            'entrego_notificacion_denunciante',
                            'remitio_donde_corresponde',
                            'verifico_denuncias_similares',
                            'agrupo_denuncias_similares',
                            'imprimio_denuncia_individual',
                            'remitio_denuncia_mrd_mp',
                            'recibio_requerimiento_investigativo',
                            'asigno_investigador_especializado',
                            'genero_informe_avances',
                            'realizo_informe_flagrancia_resultados',
                            'remite_informe_investigador_fiscal_instruccion_mp',
                            'remitio_informe_avances_fiscal_instruccion_mp',
                            'informe_investigador_remitido',
                            'genero_informe_preliminar',
                            'remitio_informe_preliminar_fiscal_instruccion_mp',
                            'genero_informe_especializado_final',
                            'remitio_informe_especializado_final_mp',
                            'recibio_nueva_orden_captura_juez_pj',
                            'ejecuto_orden',
                            'remitio_detenido_juez_pj',
                            'orden_ejecutada'
                          ],
        'transitions'   => [
            'registrar_denuncia_infraganti' => [
                'from' => 'nueva_denuncia',
                'to'   => 'registro_denuncia_infraganti',
            ],
            'verificar_identidad_denunciante' => [
                'from' => 'nueva_denuncia',
                'to'   => 'verifico_identidad_denunciante',
            ],
            'verificar_identidad_detenido' => [
                'from' => 'registro_denuncia_infraganti',
                'to'   => 'verifico_identidad_detenido',
            ],
            'verificar_identidad_detenido_infraganti' => [
                'from' => 'verifico_identidad_detenido',
                'to'   => 'verifico_identidad_denunciante',
            ],
            'remitir_solicitud_defensa_publica' => [
                'from' => 'verifico_identidad_detenido',
                'to'   => 'remite_solicitud_defensor_defensa_publica_pj',
            ],
            'tipificar_delito' => [
                'from' => 'verifico_identidad_denunciante',
                'to'   => 'tipifico_delito',
            ],
            'defensa_publica_remitido' => [
                'from' => 'remite_solicitud_defensor_defensa_publica_pj',
                'to'   => 'remitido_defensa_publica',
            ],
            'autorizar_delito' => [
                'from' => 'tipifico_delito',
                'to'   => 'autorizo_delito',
            ],
            'transcribir_denuncia' => [
                'from' => 'autorizo_delito',
                'to'   => 'transcribio_denuncia',
            ],
            'notificar_denuncia_no_aceptada' => [
                'from' => 'autorizo_delito',
                'to'   => 'notifico_denunciante_denuncia_no_aceptada',
            ],
            'entregar_notificacion_no_aceptada' => [
                'from' => 'notifico_denunciante_denuncia_no_aceptada',
                'to'   => 'entrego_notificacion_denunciante',
            ],
            'generar_denuncia_firmada' => [
                'from' => 'transcribio_denuncia',
                'to'   => 'genero_reporte_denuncia_firmado',
            ],
            'remitir_quien_corresponde' => [
                'from' => 'genero_reporte_denuncia_firmado',
                'to'   => 'remitio_donde_corresponde',
            ],
            'verificar_denuncias_similares' => [
                'from' => 'genero_reporte_denuncia_firmado',
                'to'   => 'verifico_denuncias_similares',
            ],
            'agrupar_denuncias_similares' => [
                'from' => 'remitio_donde_corresponde',
                'to'   => 'agrupo_denuncias_similares',
            ],
            'agrupar_denuncias_similares' => [
                'from' => 'verifico_denuncias_similares',
                'to'   => 'agrupo_denuncias_similares',
            ],
            'imprimir_denuncia' => [
                'from' => 'agrupo_denuncias_similares',
                'to'   => 'imprimio_denuncia_individual',
            ],
            'remitir_denuncia_mrd_mp' => [
                'from' => 'imprimio_denuncia_individual',
                'to'   => 'remitio_denuncia_mrd_mp',
            ],
            'realizar_informe_flagrancia' => [
                'from' => 'imprimio_denuncia_individual',
                'to'   => 'realizo_informe_flagrancia_resultados',
            ],
            'recibir_requerimiento_investigativo' => [
                'from' => 'remitio_denuncia_mrd_mp',
                'to'   => 'recibio_requerimiento_investigativo',
            ],
            'asignar_investigador' => [
                'from' => 'recibio_requerimiento_investigativo',
                'to'   => 'asigno_investigador_especializado',
            ],
            'generar_informe_avances' => [
                'from' => 'asigno_investigador_especializado',
                'to'   => 'genero_informe_avances',
            ],
            'remitir_informe_investigador_mp' => [
                'from' => 'realizo_informe_flagrancia_resultados',
                'to'   => 'remite_informe_investigador_fiscal_instruccion_mp',
            ],
            'informe_avances_remitido_mp' => [
                'from' => 'genero_informe_avances',
                'to'   => 'remitio_informe_avances_fiscal_instruccion_mp',
            ],
            'informe_investigador_remitido_mp' => [
                'from' => 'remite_informe_investigador_fiscal_instruccion_mp',
                'to'   => 'informe_investigador_remitido',
            ],
            'generar_informe_preliminar' => [
                'from' => 'remitio_informe_avances_fiscal_instruccion_mp',
                'to'   => 'genero_informe_preliminar',
            ],
            'informe_preliminar_remitido_mp' => [
                'from' => 'genero_informe_preliminar',
                'to'   => 'remitio_informe_preliminar_fiscal_instruccion_mp',
            ],
            'generar_informe_final' => [
                'from' => 'remitio_informe_preliminar_fiscal_instruccion_mp',
                'to'   => 'genero_informe_especializado_final',
            ],
            'informe_final_remitido_mp' => [
                'from' => 'genero_informe_especializado_final',
                'to'   => 'remitio_informe_especializado_final_mp',
            ],
            'recibir_orden_captura' => [
                'from' => 'remitio_informe_especializado_final_mp',
                'to'   => 'recibio_nueva_orden_captura_juez_pj',
            ],
            'ejecutar_orden' => [
                'from' => 'recibio_nueva_orden_captura_juez_pj',
                'to'   => 'ejecuto_orden',
            ],
            'detenido_remitido_pj' => [
                'from' => 'ejecuto_orden',
                'to'   => 'remitio_detenido_juez_pj',
            ],
            'orden_captura_ejecutada' => [
                'from' => 'remitio_detenido_juez_pj',
                'to'   => 'orden_ejecutada',
            ]
        ]
    ],
    'informe_cuadro_estadistico_ss'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\InformeCuadroEstadisticoSS'],
        'places'        => [
                            'nueva_autorizacion_informe',
                            'recepciono_informacion',
                            'ingreso_informacion_recibida',
                            'consolido_informacion',
                            'consulto_bd',
                            'obtuvo_resultados',
                            'elaboro_cuadro_informe',
                            'informe_enviado_operacion_direccion_subdireccion'
                          ],
        'transitions'   => [
            'recepcionar_informacion' => [
                'from' => 'nueva_autorizacion_informe',
                'to'   => 'recepciono_informacion',
            ],
            'ingresar_informacion_recibida' => [
                'from' => 'recepciono_informacion',
                'to'   => 'ingreso_informacion_recibida',
            ],
            'consolidar_informacion' => [
                'from' => 'ingreso_informacion_recibida',
                'to'   => 'consolido_informacion',
            ],
            'consultar_bd' => [
                'from' => 'consolido_informacion',
                'to'   => 'consulto_bd',
            ],
            'obtener_resultados' => [
                'from' => 'consulto_bd',
                'to'   => 'obtuvo_resultados',
            ],
            'elaborar_cuadros_informe' => [
                'from' => 'obtuvo_resultados',
                'to'   => 'elaboro_cuadro_informe',
            ],
            'enviar_informe' => [
                'from' => 'elaboro_cuadro_informe',
                'to'   => 'informe_enviado_operacion_direccion_subdireccion',
            ]
        ]
    ],
    'solicitud_revelado_fotografia_ss'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\SolicitudReveladoFotografiaSS'],
        'places'        => [
                          	'nueva_denuncia',
                            'realizo_fotografias',
                            'almaceno_fotografias_digital',
                            'abastecio_material',
                            'clasifico_depuro_fotografias',
                            'revelo_fotografias',
                            'registro_fotografias_fisicas',
                            'elaboro_album',
                            'album_entregado_policia_tecnico'
                          ],
        'transitions'   => [
            'realizar_fotografias' => [
                'from' => 'nueva_denuncia',
                'to'   => 'realizo_fotografias',
            ],
            'almacenar_fotografias' => [
                'from' => 'realizo_fotografias',
                'to'   => 'almaceno_fotografias_digital',
            ],
            'abastecer_fotografias' => [
                'from' => 'almaceno_fotografias_digital',
                'to'   => 'abastecio_material',
            ],
            'clasificar_depurar_fotografias' => [
                'from' => 'abastecio_material',
                'to'   => 'clasifico_depuro_fotografias',
            ],
            'revelar_fotografias' => [
                'from' => 'clasifico_depuro_fotografias',
                'to'   => 'revelo_fotografias',
            ],
            'registrar_fotografias_fisicas' => [
                'from' => 'revelo_fotografias',
                'to'   => 'registro_fotografias_fisicas',
            ],
            'elaborar_album' => [
                'from' => 'registro_fotografias_fisicas',
                'to'   => 'elaboro_album',
            ],
            'entregar_album' => [
                'from' => 'elaboro_album',
                'to'   => 'album_entregado_policia_tecnico',
            ]
        ]
    ],
    'solicitud_revisar_informacion_digital_ss'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\SolicitudRevisarInformacionDigitalSS'],
        'places'        => [
                            'nueva_solicitud',
                            'verifico_datos_bd',
                            'confirmo_datos_correctos',
                            'corrigio_datos',
                            'reporto_personal_duplicado',
                            'filtro_lista_depurada',
                            'elaboro_reporte_correspondeinte',
                            'entrego_reporte_director_general'
                          ],
        'transitions'   => [
            'verificar_datos' => [
                'from' => 'nueva_solicitud',
                'to'   => 'verifico_datos_bd',
            ],
            'confirmar_datos' => [
                'from' => 'verifico_datos_bd',
                'to'   => 'confirmo_datos_correctos',
            ],
            'corregir_datos' => [
                'from' => 'verifico_datos_bd',
                'to'   => 'corrigio_datos',
            ],
            'reportar_personal_duplicado_correctos' => [
                'from' => 'confirmo_datos_correctos',
                'to'   => 'reporto_personal_duplicado',
            ],
            'reportar_personal_duplicado_corregidos' => [
                'from' => 'corrigio_datos',
                'to'   => 'reporto_personal_duplicado',
            ],
            'depurar_lista' => [
                'from' => 'reporto_personal_duplicado',
                'to'   => 'filtro_lista_depurada',
            ],
            'elaborar_reporte' => [
                'from' => 'filtro_lista_depurada',
                'to'   => 'elaboro_reporte_correspondeinte',
            ],
            'entregar_reporte' => [
                'from' => 'elaboro_reporte_correspondeinte',
                'to'   => 'entrego_reporte_director_general',
            ]
        ]
    ],
    'solicitud_estructura_criminal_ss'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\SolicitudEstructuraCriminalSS'],
        'places'        => [
                            'nueva_solicitud',
                            'verifico_registro_ordeno_solicitud',
                            'recepciono_informacion_investigada',
                            'clasifico_informacion_bd',
                            'busco_informacion_sistema',
                            'ingreso_informacion_verificada_bd',
                            'genero_expediente_documento_validos',
                            'entrego_solicitud'
                          ],
        'transitions'   => [
            'verificar_registro_ordeno_solicitud' => [
                'from' => 'nueva_solicitud',
                'to'   => 'verifico_registro_ordeno_solicitud',
            ],
            'recepcionar_informacion' => [
                'from' => 'verifico_registro_ordeno_solicitud',
                'to'   => 'recepciono_informacion_investigada',
            ],
            'clasificar_informacion' => [
                'from' => 'recepciono_informacion_investigada',
                'to'   => 'clasifico_informacion_bd',
            ],
            'buscar_informacion' => [
                'from' => 'clasifico_informacion_bd',
                'to'   => 'busco_informacion_sistema',
            ],
            'informacion_verificada' => [
                'from' => 'busco_informacion_sistema',
                'to'   => 'ingreso_informacion_verificada_bd',
            ],
            'generar_expediente' => [
                'from' => 'ingreso_informacion_verificada_bd',
                'to'   => 'genero_expediente_documento_validos',
            ],
            'entregar_solicitud' => [
                'from' => 'genero_expediente_documento_validos',
                'to'   => 'entrego_solicitud',
            ]
        ]
    ],

    'solicitud_record_historial'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\SolicitudRecordHistorial'],
        'places'        => [
                          	'nueva_solicitud',
                            'verifico_requisitos_datos_ciudadano',
                            'recepcion_esquela_identidad',
                            'aviso_requisitos_necesarios',
                            'elaboro_respuesta',
                            'respuesta_elaborada',
                            'redaccion_solicitud_datos_ciudadano',
                            'recibio_documentacion_necesaria_requisitos',
                            'envio_solicitud',
                            'solicitud_enviada',
                            'elaboro_constancia',
                            'constancia_elaborada'
                          ],
        'transitions'   => [
            'verificar_requisitos' => [
                'from' => 'nueva_solicitud',
                'to'   => 'verifico_requisitos_datos_ciudadano',
            ],
            'recepcionar_esquelas_identidades' => [
                'from' => 'nueva_solicitud',
                'to'   => 'recepcion_esquela_identidad',
            ],
            'avisar_requisitos' => [
                'from' => 'verifico_requisitos_datos_ciudadano',
                'to'   => 'aviso_requisitos_necesarios',
            ],
            'elaborar_respuesta' => [
                'from' => 'verifico_requisitos_datos_ciudadano',
                'to'   => 'elaboro_respuesta',
            ],
            'respuesta_generada' => [
                'from' => 'elaboro_respuesta',
                'to'   => 'respuesta_elaborada',
            ],
            'recibir_documentacion' => [
                'from' => 'aviso_requisitos_necesarios',
                'to'   => 'recibio_documentacion_necesaria_requisitos',
            ],
            'elaborar_constancia' => [
                'from' => 'recibio_documentacion_necesaria_requisitos',
                'to'   => 'elaboro_constancia',
            ],
            'elaborada_constancia' => [
                'from' => 'elaboro_constancia',
                'to'   => 'constancia_elaborada',
            ],
            'redactar_solicitud_ciudadano' => [
                'from' => 'recepcion_esquela_identidad',
                'to'   => 'redaccion_solicitud_datos_ciudadano',
            ],
            'enviar_solicitud' => [
                'from' => 'redaccion_solicitud_datos_ciudadano',
                'to'   => 'envio_solicitud',
            ],
            'enviado_solicitud' => [
                'from' => 'envio_solicitud',
                'to'   => 'solicitud_enviada',
            ]
        ]
    ],
    'solicitud_transporte_almacen_general_ss'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\SolicitudTransporteAlmacenGeneralSS'],
        'places'        => [
                          	'nueva_solicitud',
                            'recepciona_indicios',
                            'verifico_requisitos',
                            'asigno_numero_oficio',
                            'transporto_indicios'
                          ],
        'transitions'   => [
            'recepcionar_indicios' => [
                'from' => 'nueva_solicitud',
                'to'   => 'recepciona_indicios',
            ],
            'verificar_requisitos' => [
                'from' => 'recepciona_indicios',
                'to'   => 'verifico_requisitos',
            ],
            'asignar_numero_oficio' => [
                'from' => 'verifico_requisitos',
                'to'   => 'asigno_numero_oficio',
            ],
            'transportar_indicios' => [
                'from' => 'asigno_numero_oficio',
                'to'   => 'transporto_indicios',
            ]
        ]
    ],
    'solicitud_antecedente_ss'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\SolicitudAntecedenteSS'],
        'places'        => [
                            'nueva_solicitud_antecedentes',
                            'recibio_solicitud_ciudadano',
                            'recibio_solicitud_juez_fiscal',
                            'recibio_solicitud_dpto_detenidos',
                            'registro_solicitud',
                            'verifico_solicitud',
                            'identifico_persona',
                            'verifica_antecedentes',
                            'registro_solicitud',
                            'elaboro_ficha',
                            'envio_solicitud_orden_captura',
                            'registro_record',
                            'archivo_documento',
                            'emitio_record',
                            'entrego_record',
                            'documento_archivado',
                            'antecedentes_entregados'
                          ],
        'transitions'   => [
            'recibir_solicitud_ciudadano' => [
                'from' => 'nueva_solicitud_antecedentes',
                'to'   => 'recibio_solicitud_ciudadano',
            ],
            'recibir_solicitud_juez_fiscal' => [
                'from' => 'nueva_solicitud_antecedentes',
                'to'   => 'recibio_solicitud_juez_fiscal',
            ],
            'recibir_solicitud_depto_detenidos' => [
                'from' => 'nueva_solicitud_antecedentes',
                'to'   => 'recibio_solicitud_dpto_detenidos',
            ],
            'registrar_solicitud' => [
                'from' => 'recibio_solicitud_ciudadano',
                'to'   => 'registro_solicitud',
            ],
            'verificar_solicitud' => [
                'from' => 'recibio_solicitud_juez_fiscal',
                'to'   => 'verifico_solicitud',
            ],
            'identificar_persona' => [
                'from' => 'recibio_solicitud_dpto_detenidos',
                'to'   => 'identifico_persona',
            ],
            'verificar_antecedentes' => [
                'from' => 'registro_solicitud',
                'to'   => 'verifica_antecedentes',
            ],
            'registrar_solicitud' => [
                'from' => 'verifico_solicitud',
                'to'   => 'registro_solicitud',
            ],
            'elaborar_ficha' => [
                'from' => 'identifico_persona',
                'to'   => 'elaboro_ficha',
            ],
            'archivar_documento_identifico' => [
                'from' => 'identifico_persona',
                'to'   => 'archivo_documento',
            ],
            'archivar_documento_ficha' => [
                'from' => 'elaboro_ficha',
                'to'   => 'archivo_documento',
            ],
            'registrar_record_solicitud' => [
                'from' => 'registro_solicitud',
                'to'   => 'registro_record',
            ],
            'registrar_record_antecedentes' => [
                'from' => 'verifica_antecedentes',
                'to'   => 'registro_record',
            ],
            'enviar_orden_captura' => [
                'from' => 'verifica_antecedentes',
                'to'   => 'envio_solicitud_orden_captura',
            ],
            'emitir_record' => [
                'from' => 'registro_record',
                'to'   => 'emitio_record',
            ],
            'entregar_record' => [
                'from' => 'emitio_record',
                'to'   => 'entrego_record',
            ],
            'entregado_antecedente' => [
                'from' => 'entrego_record',
                'to'   => 'antecedentes_entregados',
            ],
            'archviado_documento' => [
                'from' => 'archivo_documento',
                'to'   => 'documento_archivado',
            ]
        ]
    ],
    'informe_urid_ss'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\InformeURIDSS'],
        'places'        => [
                            'nuevo_requerimiento_investigativo_fiscal',
                            'toma_declaraciones',
                            'nuevo_informe_pericial',
                            'envio_indicios_laboratorio',
                            'recepcion_resultados_laboratorio',
                            'actualizo_informe_pericial',
                            'registro_perfil_sospechoso',
                            'genero_informe_investigativo',
                            'ejecuto_orden_judicial',
                            'genero_informe_final',
                            'envia_informe_final_fiscal_instruccion_mp',
                            'informe_final_remitido_mp'
                          ],
        'transitions'   => [
            'tomar_declaraciones' => [
                'from' => 'nuevo_requerimiento_investigativo_fiscal',
                'to'   => 'toma_declaraciones',
            ],
            'generar_informe_pericial' => [
                'from' => 'toma_declaraciones',
                'to'   => 'nuevo_informe_pericial',
            ],
            'enviar_indicios' => [
                'from' => 'nuevo_informe_pericial',
                'to'   => 'envio_indicios_laboratorio',
            ],
            'recibir_resultados' => [
                'from' => 'envio_indicios_laboratorio',
                'to'   => 'recepcion_resultados_laboratorio',
            ],
            'actualizar_informe_pericial' => [
                'from' => 'recepcion_resultados_laboratorio',
                'to'   => 'actualizo_informe_pericial',
            ],
            'registrar_perfil_sospechoso' => [
                'from' => 'actualizo_informe_pericial',
                'to'   => 'registro_perfil_sospechoso',
            ],
            'generar_informe_investigativo' => [
                'from' => 'registro_perfil_sospechoso',
                'to'   => 'genero_informe_investigativo',
            ],
            'ejecutar_orden_judicial' => [
                'from' => 'genero_informe_investigativo',
                'to'   => 'ejecuto_orden_judicial',
            ],
            'generar_informe_final' => [
                'from' => 'ejecuto_orden_judicial',
                'to'   => 'genero_informe_final',
            ],
            'enviar_informe_mp' => [
                'from' => 'genero_informe_final',
                'to'   => 'envia_informe_final_fiscal_instruccion_mp',
            ],
            'informe_final_remitido' => [
                'from' => 'envia_informe_final_fiscal_instruccion_mp',
                'to'   => 'informe_final_remitido_mp',
            ]
        ]
    ]
];
