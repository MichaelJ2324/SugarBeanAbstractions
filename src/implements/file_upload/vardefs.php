<?php

$vardefs = array(
    'fields' => array(
        'filename' => array (
            'name' => 'filename',
            'vname' => 'LBL_FILENAME',
            'type' => 'varchar',
            'required'=>true,
            'importable' => 'required',
            'len' => '255',
            'studio' => 'false',
            'duplicate_on_record_copy' => 'always',
            // Associating file_ext and file_mime_type to force these fields to be valued
            // when selecting filename
            'fields' => array('file_ext', 'file_mime_type'),
        ),
        'file_ext' => array (
            'name' => 'file_ext',
            'vname' => 'LBL_FILE_EXTENSION',
            'type' => 'varchar',
            'len' => 100,
            'duplicate_on_record_copy' => 'always',
        ),
        'file_mime_type' => array (
            'name' => 'file_mime_type',
            'vname' => 'LBL_MIME',
            'type' => 'varchar',
            'len' => '100',
            'duplicate_on_record_copy' => 'always',
        ),
        'uploadfile' => array (
            'name'=>'uploadfile',
            'vname' => 'LBL_FILE_UPLOAD',
            'type' => 'file',
            'source' => 'non-db',
            'duplicate_on_record_copy' => 'always',
            'fields' => array('filename'),
        ),
    )
);