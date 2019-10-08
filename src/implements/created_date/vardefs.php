<?php

$vardefs = array(
    'fields' => array(
        'date_entered' => array(
            'name' => 'date_entered',
            'vname' => 'LBL_DATE_ENTERED',
            'type' => 'datetime',
            'group' => 'created_by_name',
            'comment' => 'Date record created',
            'enable_range_search' => true,
            'options' => 'date_range_search_dom',
            'studio' => array(
                'portaleditview' => false, // Bug58408 - hide from Portal edit layout
            ),
            'duplicate_on_record_copy' => 'no',
            'readonly' => true,
            'massupdate' => false,
            'full_text_search' => array(
                'enabled' => true,
                'searchable' => false,
                // Disabled until UX component is available
                //'aggregations' => array(
                //    'date_entered' => array(
                //        'type' => 'DateRange',
                //    ),
                //),
            ),
        )
    ),
    'indices' => array(
        'date_entered' => array(
            'name' => 'idx_' . strtolower($table_name) . '_date_entered',
            'type' => 'index',
            'fields' => array('date_entered')
        )
    )
);
