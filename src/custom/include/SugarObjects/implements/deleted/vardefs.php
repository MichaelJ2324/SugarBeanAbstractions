<?php

$vardefs = array(
    'fields' => array(
        'deleted' => array(
            'name' => 'deleted',
            'vname' => 'LBL_DELETED',
            'type' => 'bool',
            'default' => '0',
            'reportable' => false,
            'duplicate_on_record_copy' => 'no',
            'comment' => 'Record deletion indicator'
        )
    ),
    'indices' => array(
        'deleted' => array(
            'name' => 'idx_' . strtolower($table_name) . '_id_del',
            'type' => 'index',
            'fields' => array('id', 'deleted')
        )
    ),
);