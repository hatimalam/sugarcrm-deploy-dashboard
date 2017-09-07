<?php

/** custom relate field for Dashboard template **/
$dictionary["User"]["fields"]["hats_dashboardtemplate_users"] = array (
    'name' => 'hats_dashboardtemplate_users',
    'type' => 'link',
    'relationship' => 'hats_dashboardtemplate_users',
    'source' => 'non-db',
    'module' => 'hats_DashboardTemplate',
    'bean_name' => 'hats_DashboardTemplate',
    'side' => 'right',
    'vname' => 'LBL_HATS_DASHBOARDTEMPLATE_USERS_FROM_USERS_TITLE',
    'id_name' => 'template_id',
    'link-type' => 'one',
);
$dictionary["User"]["fields"]["hats_dashboardtemplate_users_name"] = array (
    'name' => 'hats_dashboardtemplate_users_name',
    'type' => 'relate',
    'source' => 'non-db',
    'vname' => 'LBL_HATS_DASHBOARDTEMPLATE_USERS_FROM_HATS_DASHBOARDTEMPLATE_TITLE',
    'save' => true,
    'id_name' => 'template_id',
    'link' => 'hats_dashboardtemplate_users',
    'table' => 'hats_dashboardtemplate',
    'module' => 'hats_DashboardTemplate',
    'rname' => 'name',
);
$dictionary["User"]["fields"]["template_id"] = array (
    'name' => 'template_id',
    'type' => 'id',
    'source' => 'non-db',
    'vname' => 'LBL_HATS_DASHBOARDTEMPLATE_USERS_FROM_USERS_TITLE_ID',
    'id_name' => 'template_id',
    'link' => 'hats_dashboardtemplate_users',
    'table' => 'hats_dashboardtemplate',
    'module' => 'hats_DashboardTemplate',
    'rname' => 'id',
    'reportable' => false,
    'side' => 'right',
    'massupdate' => false,
    'duplicate_merge' => 'disabled',
    'hideacl' => true,
);
