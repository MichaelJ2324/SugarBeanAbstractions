<?php

$vardefs = array(
    'fields' => array(
        'date_modified' => array(
            'name' => 'date_modified',
            'vname' => 'LBL_DATE_MODIFIED',
            'type' => 'datetime',
            'group' => 'modified_by_name',
            'comment' => 'Date record last modified',
            'enable_range_search' => true,
            'full_text_search' => array(
                'enabled' => true,
                'searchable' => false,
                'sortable' => true,
                // Disabled until UX component is available
                //'aggregations' => array(
                //    'date_modified' => array(
                //        'type' => 'DateRange',
                //    ),
                //),
            ),
            'studio' => array(
                'portaleditview' => false, // Bug58408 - hide from Portal edit layout
            ),
            'options' => 'date_range_search_dom',
            'duplicate_on_record_copy' => 'no',
            'readonly' => true,
            'massupdate' => false,
        )
    ),
    'indices' => array(
        'date_modified' => array(
            'name' => 'idx_' . strtolower($table_name) . '_date_modified',
            'type' => 'index',
            'fields' => array('date_modified')
        )
    )
);