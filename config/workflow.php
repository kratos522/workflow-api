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
    ]
];
