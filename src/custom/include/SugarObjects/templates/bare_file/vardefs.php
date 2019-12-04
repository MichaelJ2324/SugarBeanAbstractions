<?php

$vardefs = array(
    'fields' => array(
        'hash' => array(
            'name' => 'hash',
            'vname' => 'LBL_HASH',
            'type' => 'char',
            'len' => 255,
            'required' => true,
            'unified_search' => true,
            'full_text_search' => array('enabled' => false, 'boost' => 0),
            'importable' => 'required',
            'duplicate_merge' => 'disabled',
            //'duplicate_merge_dom_value' => '3',
            'merge_filter' => 'selected',
            'duplicate_on_record_copy' => 'no',
            'studio' => false,
            'mandatory_fetch' => true,
            'readonly' => true
        )
    ),
    'uses' => array(
        'bare',
        'file_upload'
    )
);