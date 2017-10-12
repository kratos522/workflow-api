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
                          	'pendiente_remitir_expediente_a_maadeh',
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
    ]
];
