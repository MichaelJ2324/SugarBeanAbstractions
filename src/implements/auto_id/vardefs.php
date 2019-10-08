<?php


$vardefs = array(
    'fields' => array(
        'id' => array (
            'name' => 'id',
            'vname' => 'LBL_ID',
            'type' => 'int',
            'readonly' => true,
            'len' => 11,
            'required' => true,
            'auto_increment' => true,
            'unified_search' => true,
            'full_text_search' => array('enabled' => false, 'searchable' => true,  'boost' => 1.25),
            'comment' => 'Visual unique identifier',
            'duplicate_merge' => 'disabled',
            'disable_num_format' => true,
            'studio' => array('quickcreate' => false),
            'duplicate_on_record_copy' => 'no',
        ),
    ),
);