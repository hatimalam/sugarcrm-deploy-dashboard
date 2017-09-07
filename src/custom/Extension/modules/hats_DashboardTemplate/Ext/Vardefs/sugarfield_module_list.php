<?php

/** custom field to show list of modules **/
$dictionary['hats_DashboardTemplate']['fields']['module_list'] = array(
    'name' => 'module_list',
    'type' => 'enum',
    'vname' => 'LBL_MODULE_LIST',
    'dbType' => 'varchar',
    'len' => 50,
    'options' => 'module_list_dom',
    'comment' => 'List of modules',
    'help' => '(Dashboard template to be copied from)',
    'required' => true,
    'massupdate' => false,
);
