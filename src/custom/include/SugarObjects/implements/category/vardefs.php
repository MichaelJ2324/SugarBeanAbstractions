<?php

$vardefs = array(
    'fields' => array(
        'category' => array (
            'name' => 'category',
            'vname' => 'LBL_CATEGORY',
            'type' => 'enum',
            'options' => strtolower($object_name) . '_category_dom',
            'len'=>255,
            'comment' => 'The category grouping associated with the record',
            'merge_filter' => 'enabled',
            'sortable' => true,
            'duplicate_on_record_copy' => 'always',
            'massupdate' => true
        ),
    )
);
