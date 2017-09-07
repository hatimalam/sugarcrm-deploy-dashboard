<?php

$dictionary['hats_dashboardtemplate_users'] = array(
    'true_relationship_type' => 'one-to-many',
    'from_studio' => true,
    'relationships' =>
    array(
        'hats_dashboardtemplate_users' =>
        array(
            'lhs_module' => 'hats_DashboardTemplate',
            'lhs_table' => 'hats_dashboardtemplate',
            'lhs_key' => 'id',
            'rhs_module' => 'Users',
            'rhs_table' => 'users',
            'rhs_key' => 'id',
            'relationship_type' => 'many-to-many',
            'join_table' => 'hats_dashboardtemplate_users',
            'join_key_lhs' => 'template_id',
            'join_key_rhs' => 'user_id',
        ),
    ),
    'table' => 'hats_dashboardtemplate_users',
    'fields' =>
    array(
        'id' =>
        array(
            'name' => 'id',
            'type' => 'id',
        ),
        'template_id' =>
        array(
            'name' => 'template_id',
            'type' => 'id',
        ),
        'user_id' =>
        array(
            'name' => 'user_id',
            'type' => 'id',
        ),
        'date_modified' =>
        array(
            'name' => 'date_modified',
            'type' => 'datetime',
        ),
        'deleted' =>
        array(
            'name' => 'deleted',
            'type' => 'bool',
            'len' => '1',
            'default' => '0',
            'required' => false,
        ),
    ),
    'indices' =>
    array(
        0 =>
        array(
            'name' => 'idx_dashboardtemplate_userspk',
            'type' => 'primary',
            'fields' => array(
                'id',
            ),
        ),
        1 =>
        array(
            'name' => 'idx_template_user',
            'type' => 'index',
            'fields' => array(
                'template_id',
            ),
        ),
        2 =>
        array(
            'name' => 'idx_user_template',
            'type' => 'index',
            'fields' => array(
                'user_id',
            ),
        ),
    ),
);
