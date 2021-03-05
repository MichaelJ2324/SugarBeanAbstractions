<?php

$vardefs = array(
    'audited' => false,
    'favorites' => false,
    'activity_enabled' => false,
    'fields' => array(
        'id' => array(
            'name' => 'id',
            'vname' => 'LBL_ID',
            'type' => 'id',
            'required' => true,
            'reportable' => true,
            'duplicate_on_record_copy' => 'no',
            'comment' => 'Unique identifier',
            'mandatory_fetch' => true,
        ),
    ),
    'uses' => array(
        'deleted'
    ),
    'indices' => array(
        'id' => array(
            'name' => 'idx_' . preg_replace('/[^a-z0-9_\-]/i', '', strtolower($module)) . '_pk',
            'type' => 'primary',
            'fields' => array('id')
        ),
    ),
    'duplicate_check' => array(
        'enabled' => false
    )
);