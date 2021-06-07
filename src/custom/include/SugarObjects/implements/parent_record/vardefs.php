<?php

$vardefs = [
    'fields' => [
        'parent_type' => [
            'name' => 'parent_type',
            'vname' => 'LBL_PARENT_TYPE',
            'type' => 'parent_type',
            'dbType' => 'varchar',
            'group' => 'parent_name',
            'options' => strtolower($module).'_parent_type_list',
            'len' => '255',
            'studio' => [
                'wirelesslistview' => false,
            ],
            'comment' => 'Sugar module the Note is associated with',
        ],
        'parent_id' => [
            'name' => 'parent_id',
            'vname' => 'LBL_PARENT_ID',
            'type' => 'id',
            'required' => false,
            'reportable' => true,
            'comment' => 'The ID of the Sugar item specified in parent_type',
        ],
        'parent_name' => [
            'name' => 'parent_name',
            'parent_type' => 'record_type_display' ,
            'type_name' => 'parent_type',
            'id_name' => 'parent_id',
            'vname'=>'LBL_RELATED_TO',
            'type' => 'parent',
            'source' => 'non-db',
            'options' => strtolower($module).'_parent_type_list',
            'studio' => true,
        ],
    ]
];