<?php

/** custom field to capture views for selected module **/
$dictionary['hats_DashboardTemplate']['fields']['view_name']['name']='view_name';
$dictionary['hats_DashboardTemplate']['fields']['view_name']['type']='multienum';
$dictionary['hats_DashboardTemplate']['fields']['view_name']['vname']='LBL_VIEW_NAME';
$dictionary['hats_DashboardTemplate']['fields']['view_name']['dbType']='varchar';
$dictionary['hats_DashboardTemplate']['fields']['view_name']['options']='view_name_dom';
$dictionary['hats_DashboardTemplate']['fields']['view_name']['comment']='View types';
$dictionary['hats_DashboardTemplate']['fields']['view_name']['isMultiSelect']=true;
$dictionary['hats_DashboardTemplate']['fields']['view_name']['massupdate']=false;
$dictionary['hats_DashboardTemplate']['fields']['view_name']['default']='^^';
$dictionary['hats_DashboardTemplate']['fields']['view_name']['audited']=false;
$dictionary['hats_DashboardTemplate']['fields']['view_name']['comments']='View types';
$dictionary['hats_DashboardTemplate']['fields']['view_name']['duplicate_merge']='enabled';
$dictionary['hats_DashboardTemplate']['fields']['view_name']['duplicate_merge_dom_value']='1';
$dictionary['hats_DashboardTemplate']['fields']['view_name']['merge_filter']='disabled';
$dictionary['hats_DashboardTemplate']['fields']['view_name']['unified_search']=false;
$dictionary['hats_DashboardTemplate']['fields']['view_name']['calculated']=false;
$dictionary['hats_DashboardTemplate']['fields']['view_name']['visibility_grid']=array (
  'trigger' => 'module_list',
  'values' =>
  array (
    '' =>
    array (
      0 => '',
    ),
    'Home' =>
    array (
      0 => '',
    ),
    'Accounts' =>
    array (
      0 => '',
      1 => 'records',
      2 => 'record',
    ),
    'Contacts' =>
    array (
      0 => '',
      1 => 'records',
      2 => 'record',
    ),
    'Leads' =>
    array (
      0 => '',
      1 => 'records',
      2 => 'record',
    ),
    'Opportunities' =>
    array (
      0 => '',
      1 => 'records',
      2 => 'record',
    ),
    'Cases' =>
    array (
      0 => '',
      1 => 'records',
      2 => 'record',
    ),
  ),
);

 ?>
