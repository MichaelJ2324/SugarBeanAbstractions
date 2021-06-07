<?php

$vardefs = [
    'fields' => [
        'follow_up_datetime' => array(
            'name' => 'follow_up_datetime',
            'vname' => 'LBL_FOLLOW_UP_DATETIME',
            'type' => 'datetimecombo',
            'dbType' => 'datetime',
            'comment' => 'Deadline for following up on an issue',
            'audited' => true,
        ),
        'widget_follow_up_datetime' => [
            'name' => 'widget_follow_up_datetime',
            'vname' => 'LBL_WIDGET_FOLLOW_UP_DATETIME',
            'type' => 'widget',
            'multiline' => false,
            'studio' => false,
            'workflow' => false,
            'reportable' => false,
            'importable' => false,
            'source' => 'non-db',
            'console' => [
                'name' => 'follow_up_datetime',
                'label' => 'LBL_WIDGET_FOLLOW_UP_DATETIME',
                'type' => 'follow-up-datetime-colorcoded',
                'color_code_classes' => [
                    'overdue' => 'expired',
                    'in_a_day' => 'soon-expired',
                    'more_than_a_day' => 'white black-text',
                ],
            ],
        ],
    ]
];