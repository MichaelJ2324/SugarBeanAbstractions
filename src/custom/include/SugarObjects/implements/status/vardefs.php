<?php

$vardefs = array(
    'fields' => array(
        'status' => array(
            'name' => 'status',
            'vname' => 'LBL_STATUS',
            'type' => 'enum',
            'options' => $table_name.'_status_dom',
            'len' => 100,
            'audited' => true,
            'comment' => 'The status of the record',
            'merge_filter' => 'disabled',
            'sortable' => true,
            'duplicate_on_record_copy' => 'always',
            'full_text_search' => array (
                'enabled' => true,
                'searchable' => false,
            ),
            'required' => false,
            'massupdate' => true,
            'no_default' => true,
            'comments' => 'The status of the record',
            'help' => '',
            'importable' => 'true',
            'duplicate_merge' => 'enabled',
            'duplicate_merge_dom_value' => '1',
            'reportable' => true,
            'unified_search' => false,
            'calculated' => false,
            'size' => '20',
            'dependency' => false,
        )
    )
);
