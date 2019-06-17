<?php

/*
 * Your installation or use of this SugarCRM file is subject to the applicable
 * terms available at
 * http://support.sugarcrm.com/Resources/Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this SugarCRM file.
 *
 * Copyright (C) SugarCRM Inc. All rights reserved.
 */

$dictionary['hats_DashboardTemplate'] = array(
    'table' => 'hats_dashboardtemplate',
    'audited' => false,
    'activity_enabled' => false,
    'duplicate_merge' => true,
    'fields' => array (
      'name' =>  
      array (
        'name' => 'name',
        'vname' => 'LBL_NAME',
        'type' => 'name',
        'dbType' => 'varchar',
        'len' => '255',
        'unified_search' => true,
        'full_text_search' => 
        array (
          'enabled' => true,
          'boost' => '1.55',
          'searchable' => true,
        ),
        'required' => true,
        'importable' => 'required',
        'duplicate_merge' => 'enabled',
        'merge_filter' => 'selected',
        'duplicate_on_record_copy' => 'always',
        'massupdate' => false,
        'no_default' => false,
        'comments' => '',
        'help' => '',
        'duplicate_merge_dom_value' => '3',
        'audited' => false,
        'reportable' => true,
        'default' => '',
        'calculated' => false,
        'size' => '20',
      ),
      'module_list' =>
      array(
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
      ),
      'view_name' =>
      array(
        'name' => 'view_name',
        'type' => 'multienum',
        'vname' => 'LBL_VIEW_NAME',
        'dbType' => 'varchar',
        'options' => 'view_name_dom',
        'comment' => 'View types',
        'isMultiSelect' => true,
        'massupdate' => false,
        'default' => '^^',
        'audited' => false,
        'visibility_grid' => array(
          'trigger' => 'module_list',
          'values' => array(
            '' => array(
              0 => '',
            ),
            'Home' => array(
              0 => '',
            ),
            'Accounts' => array(
              0 => '',
              1 => 'records',
              2 => 'record',
            ),
            'Contacts' => array(
              0 => '',
              1 => 'records',
              2 => 'record',
            ),
            'Leads' => array(
              0 => '',
              1 => 'records',
              2 => 'record',
            ),
            'Opportunities' => array(
              0 => '',
              1 => 'records',
              2 => 'record',
            ),
            'Cases' => array(
              0 => '',
              1 => 'records',
              2 => 'record',
            ),
          ),
        ),
      ),
    ),
    'relationships' => array (),
    'optimistic_locking' => true,
    'unified_search' => true,
    'full_text_search' => true,
    'acls' => array(
        'SugarACLAdminOnly' => true,
    ),
);

if (!class_exists('VardefManager')){
}
VardefManager::createVardef('hats_DashboardTemplate','hats_DashboardTemplate', array('basic','assignable','taggable'));