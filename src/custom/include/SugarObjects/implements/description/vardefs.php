<?php

$vardefs = array(
    'fields' => array(
        'description' => array(
            'name' => 'description',
            'vname' => 'LBL_DESCRIPTION',
            'type' => 'text',
            'comment' => 'Full text of the note',
            'full_text_search' => array('enabled' => true, 'searchable' => true, 'boost' => 0.5),
            'rows' => 6,
            'cols' => 80,
            'duplicate_on_record_copy' => 'always',
        ),
    )
);