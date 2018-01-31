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
                            'remitido_fiscalia_niñez',
                            'diligencia_completada',
                            'remitido_juzgado_niñez',
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
                'to'   => 'remitido_fiscalia_niñez',
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
                'to'   => 'remitido_juzgado_niñez',
            ],
            'remitir_medicina_forense' => [
                'from' => 'remitido_juzgado_niñez',
                'to'   => 'remitir_medicina_forense',
            ],
            'elaborar_informe' => [
                'from' => 'remitir_medicina_forense',
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
        'recibir_solicitud'   => [
            'recibir_documento' => [
                'from' => 'nueva',
                'to'   => 'solicitud_recibida',
            ],
            'entregar_informe' => [
                'from' => 'recibido',
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
                            'informe_final_enviado',
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
                            'informe_final_enviado',
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
                            'informe_audiencia_presentado',
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
                'from' => 'informe_investigacion_enviado',
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
                'from' => 'informe_captura_enviado',
                'to'   => 'diligencias_investigativas_realizadas',
            ],
            'procesar_escena_crimen' => [
                'from' => 'diligencias_investigativas_realizadas',
                'to'   => 'escena_crimen_procesada',
            ],
            'procesamiento_escena_crimen' => [
                'from' => 'informe_captura_enviado',
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
            'enviar_informe_investigativo' => [
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
                            'arma_registrada',
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
    'realizar_reseña_fotografica'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\ReseniaFotografica'],
        'places'        => [
                          	'nueva',
                            'solicitud_recibida',
                            'reseña_fotografica_enviada'
                          ],
        'transitions'   => [
            'recibir_solicitud' => [
                'from' => 'nueva',
                'to'   => 'solicitud_recibida',
            ],
            'enviar_reseña_fotografica' => [
                'from' => 'solicitud_recibida',
                'to'   => 'reseña_fotografica_enviada',
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
                            'fiscal_niñez_solicitado',
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
            'solicitar_fiscal_niñez' => [
                'from' => 'tipo_solicitud_verificada',
                'to'   => 'fiscal_niñez_solicitado',
            ],
            'realizar_toma_declaracion' => [
                'from' => 'tipo_solicitud_verificada',
                'to'   => 'declaracion_tomada',
            ],
            'realizar_toma_declaracion_menor' => [
                'from' => 'fiscal_niñez_solicitado',
                'to'   => 'declaracion_tomada',
            ],
            'verificar_registro_filmico' => [
                'from' => 'declaracion_tomada',
                'to'   => 'registro_filmico_verificado',
            ],
            'procesar_escena_crimen' => [
                'from' => 'registro_filmico_verificado',
                'to'   => 'procesar_escena_crimen',
            ],
            'enviar_informe_indicios_encontrados' => [
                'from' => 'procesar_escena_crimen',
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
                            'acta_libertad_enviada',
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
                            'informe_remision_evidencias_enviado',
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
                            'registrar_captura',
                            'informe_captura_enviado',
                            'registrar_evidencias',
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
                'to'   => 'registrar_captura',
            ],
            'enviar_informe_captura' => [
                'from' => 'registrar_captura',
                'to'   => 'informe_captura_enviado',
            ],
            'enviar_informe_traslado_capturado' => [
                'from' => 'informe_captura_enviado',
                'to'   => 'informe_remision_enviado',
            ],
            'registrar_evidencia' => [
                'from' => 'informe_captura_enviado',
                'to'   => 'registrar_evidencia',
            ],
            'enviar_informe_evidencia_encontrada' => [
                'from' => 'registrar_evidencia',
                'to'   => 'informe_evidencia_encontrada_enviado',
            ],
            'enviar_informe_remision_capturado' => [
                'from' => 'registrar_evidencia',
                'to'   => 'informe_remision_enviado',
            ],
            'enviar_informe_remision_evidencias' => [
                'from' => 'registrar_evidencia',
                'to'   => 'informe_remision_evidencias_enviado',
            ],
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
                            'informe_final_enviado',
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
            'realizar_vigilancia_seguimiento' => [
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
                'to'   => 'diligencias_finales_realizdas',
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


    'notificaciones_internas_ss'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\NotificacionInternaSS'],
        'places'        => [
                          	'nuevo_solicitud_acuerdo',
                            'elaboro_acto_solicitado',
                            'redacto_acuerdo',
                            'firmo_acuerdo',
                            'entrego_notificacion',
                            'actualizo_bd',
                            'bd_actualizada'
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
            'firma_acuerdo' => [
                'from' => 'redacto_acuerdo',
                'to'   => 'firmo_acuerdo',
            ],
            'entrega_notificacion' => [
                'from' => 'firmo_acuerdo',
                'to'   => 'entrego_notificacion',
            ],
            'actualizacion_bd' => [
                'from' => 'entrego_notificacion',
                'to'   => 'actualizo_bd',
            ],
            'actualizada_bd' => [
                'from' => 'actualizo_bd',
                'to'   => 'bd_actualizada',
            ]
        ]
    ],

    'extraer_datos_sistema_ss'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\ExtraerDatoSistemaSS'],
        'places'        => [
                          	'nueva_instruccion',
                            'recepcion_acuerdo_cancelacion',
                            'realizo_baja_persona',
                            'genero_respuesta',
                            'archivo',
                            'control_estadistico_digital_impreso'
                          ],
        'transitions'   => [
            'recepciona_acuerdo' => [
                'from' => 'nueva_instruccion',
                'to'   => 'recepcion_acuerdo_cancelacion',
            ],
            'baja_persona' => [
                'from' => 'recepcion_acuerdo_cancelacion',
                'to'   => 'realizo_baja_persona',
            ],
            'genera_respuesta' => [
                'from' => 'realizo_baja_persona',
                'to'   => 'genero_respuesta',
            ],
            'envia_archivo' => [
                'from' => 'genero_respuesta',
                'to'   => 'archivo',
            ],
            'control_estadistico' => [
                'from' => 'archivo',
                'to'   => 'control_estadistico_digital_impreso',
            ]
        ]
    ],

    'delitos_contra_propiedad_ss'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\DelitoContraPropiedadSS'],
        'places'        => [
                          	'nueva_denuncia',
                            'recibio_solicitud_nota_informacion',
                            'recibio_solicitud_peritaje_vehiculo',
                            'recibio_solicitud_requerimiento',
                            'recibio_solicitud_datos_estadisticos',
                            'obtuvo_informacion_bd',
                            'verifica_registra_vehiculo_bd',
                            'asigno_diligencias',
                            'registro_mensual_actividades_unidad',
                            'obtuvo_informacion_bd',
                            'genero_informe_propuesta',
                            'genero_acta_inspeccion',
                            'genero_informe_diligencias',
                            'genero_informe_periodico_casos',
                            'remitio_informe_fna',
                            'remitio_informe_medicina_forense_mp',
                            'remitio_informe_fiscal_mp',
                            'remitio_informe_estadistica_planeacion',
                            'informe_enviado'
                          ],
        'transitions'   => [
            'solicitud_nota_informacion' => [
                'from' => 'nueva_denuncia',
                'to'   => 'recibio_solicitud_nota_informacion',
            ],
            'solicitud_peritaje_vehiculo' => [
                'from' => 'nueva_denuncia',
                'to'   => 'recibio_solicitud_peritaje_vehiculo',
            ],
            'solicitud_requerimiento' => [
                'from' => 'nueva_denuncia',
                'to'   => 'recibio_solicitud_requerimiento',
            ],
            'solicitud_datos_estadisticos' => [
                'from' => 'nueva_denuncia',
                'to'   => 'recibio_solicitud_datos_estadisticos',
            ],
            'obtener_informacion' => [
                'from' => 'recibio_solicitud_nota_informacion',
                'to'   => 'obtuvo_informacion_bd',
            ],
            'registra_vehiculo' => [
                'from' => 'recibio_solicitud_peritaje_vehiculo',
                'to'   => 'verifica_registra_vehiculo_bd',
            ],
            'asignar_diligencias' => [
                'from' => 'recibio_solicitud_requerimiento',
                'to'   => 'asigno_diligencias',
            ],
            'registro_actividades' => [
                'from' => 'recibio_solicitud_datos_estadisticos',
                'to'   => 'registro_mensual_actividades_unidad',
            ],
            'nuevo_informe_propuesta' => [
                'from' => 'obtuvo_informacion_bd',
                'to'   => 'genero_informe_propuesta',
            ],
            'nueva_acta_inspeccion' => [
                'from' => 'verifica_registra_vehiculo_bd',
                'to'   => 'genero_acta_inspeccion',
            ],
            'nuevo_informe_diligencias' => [
                'from' => 'asigno_diligencias',
                'to'   => 'genero_informe_diligencias',
            ],
            'nuevo_informe_periodico' => [
                'from' => 'registro_mensual_actividades_unidad',
                'to'   => 'genero_informe_periodico_casos',
            ],
            'informe_fna' => [
                'from' => 'genero_informe_propuesta',
                'to'   => 'remitio_informe_fna',
            ],
            'informe_medicina_forense' => [
                'from' => 'genero_acta_inspeccion',
                'to'   => 'remitio_informe_medicina_forense_mp',
            ],
            'informe_mp' => [
                'from' => 'genero_informe_diligencias',
                'to'   => 'remitio_informe_fiscal_mp',
            ],
            'informe_estadistico' => [
                'from' => 'genero_informe_periodico_casos',
                'to'   => 'remitio_informe_estadistica_planeacion',
            ],
            'informe_fna_enviado' => [
                'from' => 'remitio_informe_fna',
                'to'   => 'informe_enviado',
            ],
            'informe_medicina_forense_enviado' => [
                'from' => 'remitio_informe_medicina_forense_mp',
                'to'   => 'informe_enviado',
            ],
            'informe_fiscal_enviado' => [
                'from' => 'remitio_informe_fiscal_mp',
                'to'   => 'informe_enviado',
            ]
        ]
    ],

    'informes_logisticos'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\InformeLogisticoSS'],
        'places'        => [
                          	'nueva_solicitud_materiales',
                            'verifico_existencia_material',
                            'genero_solicitud_unidad_administrativa',
                            'genero_informe_avisos',
                            'envio_solicitud',
                            'envio_respuesta',
                            'genero_informe_respectivos',
                            'informes_respectivos_entregados'
                          ],
        'transitions'   => [
            'verificar_existencias' => [
                'from' => 'nueva_solicitud_materiales',
                'to'   => 'verifico_existencia_material',
            ],
            'solicitud_unidad_administrativa' => [
                'from' => 'verifico_existencia_material',
                'to'   => 'genero_solicitud_unidad_administrativa',
            ],
            'nuevo_informe_avisos' => [
                'from' => 'verifico_existencia_material',
                'to'   => 'genero_informe_avisos',
            ],
            'solicitud_enviada' => [
                'from' => 'genero_solicitud_unidad_administrativa',
                'to'   => 'envio_solicitud',
            ],
            'respuesta_enviada' => [
                'from' => 'genero_informe_avisos',
                'to'   => 'envio_respuesta',
            ],
            'informe_respectivos' => [
                'from' => 'envio_solicitud',
                'to'   => 'genero_informe_respectivos',
            ],
            'nuevo_informe_avisos' => [
                'from' => 'envio_respuesta',
                'to'   => 'genero_informe_respectivos',
            ],
            'informes_entregados' => [
                'from' => 'genero_informe_respectivos',
                'to'   => 'informes_respectivos_entregados',
            ]
        ]
    ],

    'nuevas_promociones_ss'   => [
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
                            'recibe_informacion_solicitada',
                            'extiende_estructura_presupuestaria',
                            'estructura_presupuestaria_extendida'
                          ],
        'transitions'   => [
            'obtener_listados' => [
                'from' => 'recibe_solicitud_oficial',
                'to'   => 'obtuvo_listados_copias_id',
            ],
            'solicitud_informacion' => [
                'from' => 'obtuvo_listados_copias_id',
                'to'   => 'solicito_informacion_secretario_general',
            ],
            'recibir_informacion' => [
                'from' => 'solicito_informacion_secretario_general',
                'to'   => 'recibe_informacion_solicitada',
            ],
            'estructura_presupuestaria' => [
                'from' => 'recibe_informacion_solicitada',
                'to'   => 'extiende_estructura_presupuestaria',
            ],
            'extendida_estructura' => [
                'from' => 'extiende_estructura_presupuestaria',
                'to'   => 'estructura_presupuestaria_extendida',
            ]
        ]
    ],

    'contestacion_oficios_ss'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\ContestacionOficioSS'],
        'places'        => [
                          	'nueva_solicitud_requerimiento_fiscal',
                            'ingreso_solicitud',
                            'proceso_informacion',
                            'realizo_contestacion',
                            'recibio_autorizacion_jefe',
                            'envio_contestacion',
                            'contestacion_enviada'
                          ],
        'transitions'   => [
            'nueva_solicitud' => [
                'from' => 'nueva_solicitud_requerimiento_fiscal',
                'to'   => 'ingreso_solicitud',
            ],
            'procesamiento_informacion' => [
                'from' => 'ingreso_solicitud',
                'to'   => 'proceso_informacion',
            ],
            'contestacion_realizada' => [
                'from' => 'proceso_informacion',
                'to'   => 'realizo_contestacion',
            ],
            'autorizacion_jefe' => [
                'from' => 'realizo_contestacion',
                'to'   => 'recibio_autorizacion_jefe',
            ],
            'envia_contestacion' => [
                'from' => 'recibio_autorizacion_jefe',
                'to'   => 'envio_contestacion',
            ],
            'enviado' => [
                'from' => 'envio_contestacion',
                'to'   => 'contestacion_enviada',
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
                          	'nueva_solicitud',
                            'reviso_expediente_carencias',
                            'analizo_expediente_sugerencias',
                            'individualizacion_victima_sospechoso',
                            'registro_identificacion_victima_sospechoso',
                            'genero_matriz_vinculacion',
                            'realizo_estudios',
                            'genero_antecedetes_victima_sospechoso',
                            'genero_informe_final',
                            'entrego_informe_final',
                            'informe_final_entregado'
                          ],
        'transitions'   => [
            'recibir_documento' => [
                'from' => 'nueva_solicitud',
                'to'   => 'reviso_expediente_carencias',
            ],
            'analisis_expediente' => [
                'from' => 'reviso_expediente_carencias',
                'to'   => 'analizo_expediente_sugerencias',
            ],
            'individualizacion' => [
                'from' => 'analizo_expediente_sugerencias',
                'to'   => 'individualizacion_victima_sospechoso',
            ],
            'registro' => [
                'from' => 'individualizacion_victima_sospechoso',
                'to'   => 'registro_identificacion_victima_sospechoso',
            ],
            'matriz_vinculacion_proceso' => [
                'from' => 'registro_identificacion_victima_sospechoso',
                'to'   => 'genero_matriz_vinculacion',
            ],
            'matriz_vinculacion_nuevo' => [
                'from' => 'nueva_solicitud',
                'to'   => 'genero_matriz_vinculacion',
            ],
            'estudios' => [
                'from' => 'genero_matriz_vinculacion',
                'to'   => 'realizo_estudios',
            ],
            'antecedentes' => [
                'from' => 'realizo_estudios',
                'to'   => 'genero_antecedetes_victima_sospechoso',
            ],
            'informe_final' => [
                'from' => 'genero_antecedetes_victima_sospechoso',
                'to'   => 'genero_informe_final',
            ],
            'informe_entregado' => [
                'from' => 'genero_informe_final',
                'to'   => 'informe_final_entregado',
            ]
        ]
    ],

    'informe_disciplinarios_ss'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\InformeDisciplinarioSS'],
        'places'        => [
                          	'recibio_informe_inicial',
                            'proceso_informacion',
                            'redacto_informe_investigativo',
                            'notifico_personal',
                            'genero_informe_final',
                            'envio_informe_secretario_ejecutivo',
                            'nueva_resolucion',
                            'archivo',
                            'ejecuto_sancion',
                            'genero_informe',
                            'resolucion_archivada',
                            'informe_generado'
                          ],
        'transitions'   => [
            'procesamiento' => [
                'from' => 'recibio_informe_inicial',
                'to'   => 'proceso_informacion',
            ],
            'informe_investigativo' => [
                'from' => 'proceso_informacion',
                'to'   => 'redacto_informe_investigativo',
            ],
            'notificacion_personal' => [
                'from' => 'redacto_informe_investigativo',
                'to'   => 'notifico_personal',
            ],
            'informe_final' => [
                'from' => 'notifico_personal',
                'to'   => 'genero_informe_final',
            ],
            'envia_informe' => [
                'from' => 'genero_informe_final',
                'to'   => 'envio_informe_secretario_ejecutivo',
            ],
            'resolucion_nueva' => [
                'from' => 'genero_informe_final',
                'to'   => 'nueva_resolucion',
            ],
            'envia_secretario' => [
                'from' => 'envio_informe_secretario_ejecutivo',
                'to'   => 'informe_enviado_secretario',
            ],
            'archiva_resolucion' => [
                'from' => 'nueva_resolucion',
                'to'   => 'archivo',
            ],
            'archivada_resolucion' => [
                'from' => 'archivo',
                'to'   => 'resolucion_archivada',
            ],
            'sancion' => [
                'from' => 'nueva_resolucion',
                'to'   => 'ejecuto_sancion',
            ],
            'genera_informe' => [
                'from' => 'ejecuto_sancion',
                'to'   => 'genero_informe',
            ],
            'generado_informe' => [
                'from' => 'genero_informe',
                'to'   => 'informe_generado',
            ]
        ]
    ],

    'informe_homicidios_ss'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\InformeHomicidioSS'],
        'places'        => [
                          	'nuevo_homicidio',
                            'redacto_informe_pericial',
                            'recibio_dictamen_forense',
                            'elaboro_actas',
                            'remitio_caso_fiscal_instruccion_mp',
                            'recibio_requerimiento_investigativo',
                            'redacto_informe_interrogatorio',
                            'genero_perfil_sospechoso',
                            'redacto_reporte_muestra',
                            'solicito_dictamen',
                            'adjunto_reporte_medicina_forense',
                            'redacto_informe_avances',
                            'remitio_informe_avances_fiscal_instruccion_mp',
                            'redacto_informe_preliminar',
                            'remitio_informe_preliminar_fiscal_instruccion_mp',
                            'redacto_informe_final',
                            'remitio_informe_final_fiscal_instruccion_mp',
                            'nueva_orden_captura_juez_pj',
                            'ejecuto_orden',
                            'remitio_detenido_juez_pj',
                            'orden_captura_ejecutada'
                          ],
        'transitions'   => [
            'informe_pericial' => [
                'from' => 'nuevo_homicidio',
                'to'   => 'redacto_informe_pericial',
            ],
            'dictamen_forense' => [
                'from' => 'redacto_informe_pericial',
                'to'   => 'recibio_dictamen_forense',
            ],
            'actas' => [
                'from' => 'recibio_dictamen_forense',
                'to'   => 'elaboro_actas',
            ],
            'remite_caso_mp' => [
                'from' => 'elaboro_actas',
                'to'   => 'remitio_caso_fiscal_instruccion_mp',
            ],
            'auto_requerimiento_investigativo' => [
                'from' => 'remitio_caso_fiscal_instruccion_mp',
                'to'   => 'recibio_requerimiento_investigativo',
            ],
            'informe_interrogatorio' => [
                'from' => 'recibio_requerimiento_investigativo',
                'to'   => 'redacto_informe_interrogatorio',
            ],
            'perfilacion_criminal' => [
                'from' => 'redacto_informe_interrogatorio',
                'to'   => 'genero_perfil_sospechoso',
            ],
            'reporte_muestra' => [
                'from' => 'genero_perfil_sospechoso',
                'to'   => 'redacto_reporte_muestra',
            ],
            'dictamen_forense' => [
                'from' => 'redacto_reporte_muestra',
                'to'   => 'solicito_dictamen',
            ],
            'reporte_medicina_forense' => [
                'from' => 'solicito_dictamen',
                'to'   => 'adjunto_reporte_medicina_forense',
            ],
            'informe_avances' => [
                'from' => 'adjunto_reporte_medicina_forense',
                'to'   => 'redacto_informe_avances',
            ],
            'remitir_informe_avances_mp' => [
                'from' => 'redacto_informe_avances',
                'to'   => 'remitio_informe_avances_fiscal_instruccion_mp',
            ],
            'informe_preliminar' => [
                'from' => 'remitio_informe_avances_fiscal_instruccion_mp',
                'to'   => 'redacto_informe_preliminar',
            ],
            'remitir_informe_preliminar_mp' => [
                'from' => 'redacto_informe_preliminar',
                'to'   => 'remitio_informe_preliminar_fiscal_instruccion_mp',
            ],
            'informe_final' => [
                'from' => 'remitio_informe_preliminar_fiscal_instruccion_mp',
                'to'   => 'redacto_informe_final',
            ],
            'remitir_informe_final_mp' => [
                'from' => 'redacto_informe_final',
                'to'   => 'remitio_informe_final_fiscal_instruccion_mp',
            ],
            'orden_captura' => [
                'from' => 'remitio_informe_final_fiscal_instruccion_mp',
                'to'   => 'nueva_orden_captura_juez_pj',
            ],
            'orden_ejecutada' => [
                'from' => 'nueva_orden_captura_juez_pj',
                'to'   => 'ejecuto_orden',
            ],
            'detenido_remitido' => [
                'from' => 'ejecuto_orden',
                'to'   => 'remitio_detenido_juez_pj',
            ],
            'orden ejecutada' => [
                'from' => 'remitio_detenido_juez_pj',
                'to'   => 'orden_captura_ejecutada',
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
            'manual_nuevo' => [
                'from' => 'nueva_solicitud',
                'to'   => 'nuevo_manual',
            ],
            'actualizacion_instructivo' => [
                'from' => 'nueva_solicitud',
                'to'   => 'nueva_actualizacion_instructivo',
            ],
            'nuevo_boletin' => [
                'from' => 'nueva_solicitud',
                'to'   => 'nuevo_boletin_doctrinal_juridico',
            ],
            'presenta_manual' => [
                'from' => 'nuevo_manual',
                'to'   => 'presento_manual',
            ],
            'necesidades' => [
                'from' => 'nueva_actualizacion_instructivo',
                'to'   => 'necesidades_cambio',
            ],
            'tema_seleccionado' => [
                'from' => 'nuevo_boletin_doctrinal_juridico',
                'to'   => 'selecciono_tema',
            ],
            'aprobacion_manual' => [
                'from' => 'presento_manual',
                'to'   => 'manual_aprobado',
            ],
            'cronograma' => [
                'from' => 'necesidades_cambio',
                'to'   => 'realizo_cronograma',
            ],
            'boletin' => [
                'from' => 'selecciono_tema',
                'to'   => 'elaboro_boletin',
            ],
            'difundir_manual' => [
                'from' => 'manual_aprobado',
                'to'   => 'difundio_manual',
            ],
            'actualizacion_documento' => [
                'from' => 'realizo_cronograma',
                'to'   => 'actualizo_documento',
            ],
            'revision_boletin' => [
                'from' => 'elaboro_boletin',
                'to'   => 'reviso_boletin',
            ],
            'presentacion_instructivo' => [
                'from' => 'actualizo_documento',
                'to'   => 'presento_instructivo',
            ],
            'presentacion_boletin' => [
                'from' => 'reviso_boletin',
                'to'   => 'presento_boletin',
            ],
            'difundido_manual' => [
                'from' => 'difundio_manual',
                'to'   => 'manual_difundido',
            ],
            'aprobacion_instructivo' => [
                'from' => 'presento_instructivo',
                'to'   => 'instructivo_aprobado',
            ],
            'aprobacion_boletin' => [
                'from' => 'presento_boletin',
                'to'   => 'aprobo_boletin',
            ],
            'instructivo_socializado' => [
                'from' => 'instructivo_aprobado',
                'to'   => 'socializado',
            ],
            'boletin_difundido' => [
                'from' => 'aprobo_boletin',
                'to'   => 'difundio_boletin',
            ],
            'socializacion_manual' => [
                'from' => 'socializado',
                'to'   => 'manual_socializado',
            ],
            'difundacion_manual' => [
                'from' => 'difundio_boletin',
                'to'   => 'manual_difundido',
            ]
        ]
    ],

    'informe_escena_crimen_ss'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\InformeEscenaCrimenSS'],
        'places'        => [
                          	'nueva_denuncia',
                            'proceso_escena_crimen',
                            'envio_indicios_laboratorio',
                            'entrego_fografias',
                            'recibio_resultados_laboratorio',
                            'redaccion_informe_pericial',
                            'consulto_bd',
                            'genero_perfil_sospechoso',
                            'genero_perfil_victima',
                            'genero_informe_final',
                            'remitio_informe_investigador_fiscal_instruccion_mp',
                            'recibio_nueva_orden_captura_juez_pj',
                            'ejecuto_orden',
                            'remitio_detenido_juez_pj',
                            'orden_ejecutada'
                          ],
        'transitions'   => [
            'escena_crimen' => [
                'from' => 'nueva_denuncia',
                'to'   => 'proceso_escena_crimen',
            ],
            'envio_indicios' => [
                'from' => 'proceso_escena_crimen',
                'to'   => 'envio_indicios_laboratorio',
            ],
            'entrega_fotografias' => [
                'from' => 'proceso_escena_crimen',
                'to'   => 'entrego_fografias',
            ],
            'recepcion_resultados' => [
                'from' => 'envio_indicios_laboratorio',
                'to'   => 'recibio_resultados_laboratorio',
            ],
            'informe_pericial_fotografia' => [
                'from' => 'entrego_fografias',
                'to'   => 'redaccion_informe_pericial',
            ],
            'informe_pericial_laboratorio' => [
                'from' => 'recibio_resultados_laboratorio',
                'to'   => 'redaccion_informe_pericial',
            ],
            'generacion_informe_final' => [
                'from' => 'redaccion_informe_pericial',
                'to'   => 'genero_informe_final',
            ],
            'cansulta_bd' => [
                'from' => 'proceso_escena_crimen',
                'to'   => 'consulto_bd',
            ],
            'perfilacion_sospechoso' => [
                'from' => 'consulto_bd',
                'to'   => 'genero_perfil_sospechoso',
            ],
            'perfilacion_victima' => [
                'from' => 'consulto_bd',
                'to'   => 'genero_perfil_victima',
            ],
            'informe_final_sospechoso' => [
                'from' => 'genero_perfil_sospechoso',
                'to'   => 'genero_informe_final',
            ],
            'informe_final_victima' => [
                'from' => 'genero_perfil_victima',
                'to'   => 'genero_informe_final',
            ],
            'remitir_informe_final_mp' => [
                'from' => 'genero_informe_final',
                'to'   => 'remitio_informe_investigador_fiscal_instruccion_mp',
            ],
            'orden_captura' => [
                'from' => 'remitio_informe_investigador_fiscal_instruccion_mp',
                'to'   => 'recibio_nueva_orden_captura_juez_pj',
            ],
            'orden_captura_ejecutada' => [
                'from' => 'recibio_nueva_orden_captura_juez_pj',
                'to'   => 'ejecuto_orden',
            ],
            'remitir_detenido' => [
                'from' => 'ejecuto_orden',
                'to'   => 'remitio_detenido_juez_pj',
            ],
            'ejecucion_orden' => [
                'from' => 'remitio_detenido_juez_pj',
                'to'   => 'orden_ejecutada',
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
            'denuncia_infraganti' => [
                'from' => 'nueva_denuncia',
                'to'   => 'registro_denuncia_infraganti',
            ],
            'denuncia_ordinaria' => [
                'from' => 'nueva_denuncia',
                'to'   => 'verifico_identidad_denunciante',
            ],
            'identidad_detenido_ordinario' => [
                'from' => 'registro_denuncia_infraganti',
                'to'   => 'verifico_identidad_detenido',
            ],
            'identidad_detenido_infraganti' => [
                'from' => 'verifico_identidad_detenido',
                'to'   => 'verifico_identidad_denunciante',
            ],
            'solicitud_defensa_publica' => [
                'from' => 'verifico_identidad_detenido',
                'to'   => 'remite_solicitud_defensor_defensa_publica_pj',
            ],
            'tipificacion_delito' => [
                'from' => 'verifico_identidad_denunciante',
                'to'   => 'tipifico_delito',
            ],
            'defensa_publica' => [
                'from' => 'remite_solicitud_defensor_defensa_publica_pj',
                'to'   => 'remitido_defensa_publica',
            ],
            'autorizacion_delito' => [
                'from' => 'tipifico_delito',
                'to'   => 'autorizo_delito',
            ],
            'transcripcion_denuncia' => [
                'from' => 'autorizo_delito',
                'to'   => 'transcribio_denuncia',
            ],
            'denuncia_no_aceptada' => [
                'from' => 'autorizo_delito',
                'to'   => 'notifico_denunciante_denuncia_no_aceptada',
            ],
            'notificacion_entregada_no_aceptada' => [
                'from' => 'notifico_denunciante_denuncia_no_aceptada',
                'to'   => 'entrego_notificacion_denunciante',
            ],
            'denuncia_firmada' => [
                'from' => 'transcribio_denuncia',
                'to'   => 'genero_reporte_denuncia_firmado',
            ],
            'remite_quien_corresponde' => [
                'from' => 'genero_reporte_denuncia_firmado',
                'to'   => 'remitio_donde_corresponde',
            ],
            'verificacion_denuncias_similares' => [
                'from' => 'genero_reporte_denuncia_firmado',
                'to'   => 'verifico_denuncias_similares',
            ],
            'agrupacion_denuncias_similares_remitidas' => [
                'from' => 'remitio_donde_corresponde',
                'to'   => 'agrupo_denuncias_similares',
            ],
            'agrupacion_denuncias_similares_verificadas' => [
                'from' => 'verifico_denuncias_similares',
                'to'   => 'agrupo_denuncias_similares',
            ],
            'impresion_denuncia' => [
                'from' => 'agrupo_denuncias_similares',
                'to'   => 'imprimio_denuncia_individual',
            ],
            'denuncia_remitida_mrd_mp' => [
                'from' => 'imprimio_denuncia_individual',
                'to'   => 'remitio_denuncia_mrd_mp',
            ],
            'resultados_informe_flagrancia' => [
                'from' => 'imprimio_denuncia_individual',
                'to'   => 'realizo_informe_flagrancia_resultados',
            ],
            'auto_requerimietno_investigativo' => [
                'from' => 'remitio_denuncia_mrd_mp',
                'to'   => 'recibio_requerimiento_investigativo',
            ],
            'asignacion_investigador' => [
                'from' => 'recibio_requerimiento_investigativo',
                'to'   => 'asigno_investigador_especializado',
            ],
            'informe_flagrancia_resultados' => [
                'from' => 'imprimio_denuncia_individual',
                'to'   => 'realizo_informe_flagrancia_resultados',
            ],
            'informe_avances' => [
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
            'informe_preliminar' => [
                'from' => 'remitio_informe_avances_fiscal_instruccion_mp',
                'to'   => 'genero_informe_preliminar',
            ],
            'informe_preliminar_remitido_mp' => [
                'from' => 'genero_informe_preliminar',
                'to'   => 'remitio_informe_preliminar_fiscal_instruccion_mp',
            ],
            'Informe_final' => [
                'from' => 'remitio_informe_preliminar_fiscal_instruccion_mp',
                'to'   => 'genero_informe_especializado_final',
            ],
            'informe_final_remitido_mp' => [
                'from' => 'genero_informe_especializado_final',
                'to'   => 'remitio_informe_especializado_final_mp',
            ],
            'orden_captura' => [
                'from' => 'remitio_informe_especializado_final_mp',
                'to'   => 'recibio_nueva_orden_captura_juez_pj',
            ],
            'ejecucion_orden' => [
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

    'informe_cuadros_estadisticos_ss'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\InformeCuadroEstadisticoSS'],
        'places'        => [
                          	'nueva_autorizacion_informe',
                            'ingreso_informacion_recibida',
                            'consolido_informacion',
                            'consulto_bd',
                            'obtuvo_resultado',
                            'elaboro_informe_estadistico',
                            'informe_estadistico_elaborado'
                          ],
        'transitions'   => [
            'ingreso_informacion' => [
                'from' => 'nueva_autorizacion_informe',
                'to'   => 'ingreso_informacion_recibida',
            ],
            'consolidacion_informacion' => [
                'from' => 'ingreso_informacion_recibida',
                'to'   => 'consolido_informacion',
            ],
            'consulta_bd' => [
                'from' => 'consolido_informacion',
                'to'   => 'consulto_bd',
            ],
            'obtencion_resultado' => [
                'from' => 'consulto_bd',
                'to'   => 'obtuvo_resultado',
            ],
            'elaboracion_informe_estadistico' => [
                'from' => 'obtuvo_resultado',
                'to'   => 'elaboro_informe_estadistico',
            ],
            'informe_estadistico_entregado' => [
                'from' => 'elaboro_informe_estadistico',
                'to'   => 'informe_estadistico_elaborado',
            ]
        ]
    ],

    'solicitud_revelado_fotografias_ss'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\SolicitudReveladoFotografiaSS'],
        'places'        => [
                          	'nueva_solicitud_revelado',
                            'recepciono_fotografias',
                            'clasifico_depuro_abastecimiento_material',
                            'revelado_fisico',
                            'registro_fisico',
                            'entrego_material_policia_tecnico',
                            'material_entregado_policia_tecnico'
                          ],
        'transitions'   => [
            'recepcion_fotografias' => [
                'from' => 'nueva_solicitud_revelado',
                'to'   => 'recepciono_fotografias',
            ],
            'clasificacion_depuracion_material' => [
                'from' => 'recepciono_fotografias',
                'to'   => 'clasifico_depuro_abastecimiento_material',
            ],
            'revelado_fisico_fotografia' => [
                'from' => 'clasifico_depuro_abastecimiento_material',
                'to'   => 'revelado_fisico',
            ],
            'registro_fisico_fotografia' => [
                'from' => 'revelado_fisico',
                'to'   => 'registro_fisico',
            ],
            'entrega_material' => [
                'from' => 'registro_fisico',
                'to'   => 'entrego_material_policia_tecnico',
            ],
            'material_entregado_tecnico' => [
                'from' => 'entrego_material_policia_tecnico',
                'to'   => 'material_entregado_policia_tecnico',
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
                            'entrego_reporte_director_general',
                            'reporte_entregado_director_general'
                          ],
        'transitions'   => [
            'verificacion_datos' => [
                'from' => 'nueva_solicitud',
                'to'   => 'verifico_datos_bd',
            ],
            'confirmacion_datos' => [
                'from' => 'verifico_datos_bd',
                'to'   => 'confirmo_datos_correctos',
            ],
            'correccion_datos' => [
                'from' => 'verifico_datos_bd',
                'to'   => 'corrigio_datos',
            ],
            'personal_duplicado_correctos' => [
                'from' => 'confirmo_datos_correctos',
                'to'   => 'reporto_personal_duplicado',
            ],
            'personal_duplicado_corregidos' => [
                'from' => 'corrigio_datos',
                'to'   => 'reporto_personal_duplicado',
            ],
            'depurar_lista' => [
                'from' => 'reporto_personal_duplicado',
                'to'   => 'filtro_lista_depurada',
            ],
            'elaboracion_reporte' => [
                'from' => 'filtro_lista_depurada',
                'to'   => 'elaboro_reporte_correspondeinte',
            ],
            'entrega_reporte' => [
                'from' => 'elaboro_reporte_correspondeinte',
                'to'   => 'entrego_reporte_director_general',
            ],
            'reporte_entregado' => [
                'from' => 'entrego_reporte_director_general',
                'to'   => 'reporte_entregado_director_general',
            ]
        ]
    ],

    'solicitud_estructuras_criminales_ss'   => [
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
                            'clasificacion_informacion_bd',
                            'busqueda_informacion_sistema',
                            'ingreso_informacion_verificada_bd',
                            'genero_expediente_documento_validos',
                            'envio_notificacion_boletines',
                            'entrego_solicitud',
                            'solicitud_entregada'
                          ],
        'transitions'   => [
            'registro_ordeno_solicitud' => [
                'from' => 'nueva_solicitud',
                'to'   => 'verifico_registro_ordeno_solicitud',
            ],
            'recepcion_informacion' => [
                'from' => 'verifico_registro_ordeno_solicitud',
                'to'   => 'recepciono_informacion_investigada',
            ],
            'clasificar_informacion' => [
                'from' => 'recepciono_informacion_investigada',
                'to'   => 'clasificacion_informacion_bd',
            ],
            'busqueda_informacion' => [
                'from' => 'clasificacion_informacion_bd',
                'to'   => 'busqueda_informacion_sistema',
            ],
            'informacion_verificada' => [
                'from' => 'busqueda_informacion_sistema',
                'to'   => 'ingreso_informacion_verificada_bd',
            ],
            'generar_expediente' => [
                'from' => 'ingreso_informacion_verificada_bd',
                'to'   => 'genero_expediente_documento_validos',
            ],
            'enviar_boletines' => [
                'from' => 'genero_expediente_documento_validos',
                'to'   => 'envio_notificacion_boletines',
            ],
            'entregar_solicitud' => [
                'from' => 'envio_notificacion_boletines',
                'to'   => 'entrego_solicitud',
            ],
            'entregado_solicitud' => [
                'from' => 'entrego_solicitud',
                'to'   => 'solicitud_entregada',
            ]
        ]
    ],

    'solicitud_record_historiales'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
            'arguments' => ['workflow_state']
        ],
        'supports'      => ['App\SolicitudRecordHistoriales'],
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
            'elaboracion_respuesta' => [
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

    'solicitud_antecedentes_ss'   => [
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
            'registra_solicitud' => [
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
            'orden_captura' => [
                'from' => 'verifica_antecedentes',
                'to'   => 'envio_solicitud_orden_captura',
            ],
            'emitir_record' => [
                'from' => 'registro_record',
                'to'   => 'emitio_record',
            ],
            'entregar_recordo' => [
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
            'informe_pericial' => [
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
