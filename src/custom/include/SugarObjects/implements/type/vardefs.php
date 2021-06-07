<?php

$vardefs = array(
    'fields' => array(
        'type' => array (
            'name' => 'type',
            'vname' => 'LBL_TYPE',
            'type' => 'enum',
            'options' => strtolower($object_name) . '_type_dom',
            'len'=>255,
            'comment' => 'The type of issue (ex: issue, feature)',
            'merge_filter' => 'enabled',
            'sortable' => true,
            'duplicate_on_record_copy' => 'always',
            'massupdate' => true
        ),
    )
);
