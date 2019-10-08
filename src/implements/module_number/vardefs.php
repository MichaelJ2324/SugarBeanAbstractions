<?php


$vardefs = array(
    'fields' => array(
        $_object_name . '_number' => array (
            'name' => $_object_name . '_number',
            'vname' => 'LBL_NUMBER',
            'type' => 'int',
            'readonly' => true,
            'len' => 11,
            'required' => true,
            'auto_increment' => true,
            'unified_search' => true,
            'full_text_search' => array('enabled' => true, 'searchable' => true,  'boost' => 1.25),
            'comment' => 'Visual unique identifier',
            'duplicate_merge' => 'disabled',
            'disable_num_format' => true,
            'studio' => array('quickcreate' => false),
            'duplicate_on_record_copy' => 'no',
        ),
    ),
    'indices'=>array(
        strtolower($module).'numk' => array(
            'name' => strtolower($module).'numk',
            'type' => 'unique',
            'fields'=> array($_object_name . '_number')
        )
    )
);