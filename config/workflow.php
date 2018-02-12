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
