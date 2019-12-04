<?php

$vardefs = array(
    'fields' => array(
        'created_by' => array(
            'name' => 'created_by',
            'rname' => 'user_name',
            'id_name' => 'created_by',
            'vname' => 'LBL_CREATED',
            'type' => 'assigned_user_name',
            'table' => 'users',
            'isnull' => false,
            'dbType' => 'id',
            'group' => 'created_by_name',
            'comment' => 'User who created record',
            'massupdate' => false,
            'duplicate_on_record_copy' => 'no',
            'readonly' => true,
            'full_text_search' => array(
                'enabled' => true,
                'searchable' => false,
                'type' => 'id',
                'aggregations' => array(
                    'created_by' => array(
                        'type' => 'MyItems',
                        'label' => 'LBL_AGG_CREATED_BY_ME',
                    ),
                ),
            ),
            'processes' => array(
                'types' => array(
                    'RR' => false,
                    'ALL' => true,
                ),
            ),
        ),
        'created_by_name' => array(
            'name' => 'created_by_name',
            'vname' => 'LBL_CREATED',
            'type' => 'relate',
            'reportable' => false,
            'link' => 'created_by_link',
            'rname' => 'full_name',
            'source' => 'non-db',
            'table' => 'users',
            'id_name' => 'created_by',
            'module' => 'Users',
            'duplicate_merge' => 'disabled',
            'importable' => false,
            'massupdate' => false,
            'duplicate_on_record_copy' => 'no',
            'readonly' => true,
            'sort_on' => array('last_name'),
            'exportable' => true,
        ),
        'created_by_link' => array(
            'name' => 'created_by_link',
            'type' => 'link',
            'relationship' => strtolower($module) . '_created_by',
            'vname' => 'LBL_CREATED_USER',
            'link_type' => 'one',
            'module' => 'Users',
            'bean_name' => 'User',
            'source' => 'non-db',
            'side' => 'right',
        ),
    ),
    'relationships' => array(
        strtolower($module) . '_created_by' => array(
            'lhs_module' => 'Users',
            'lhs_table' => 'users',
            'lhs_key' => 'id',
            'rhs_module' => $module,
            'rhs_table' => strtolower($table_name),
            'rhs_key' => 'created_by',
            'relationship_type' => 'one-to-many'
        ),
    )
);