<?php

/** custom link field for users subpanel under DashBoard Template **/
$dictionary["hats_DashboardTemplate"]["fields"]["hats_dashboardtemplate_users"] = array (
    'name' => 'hats_dashboardtemplate_users',
    'type' => 'link',
    'relationship' => 'hats_dashboardtemplate_users',
    'source' => 'non-db',
    'module' => 'Users',
    'bean_name' => 'User',
    'vname' => 'LBL_HATS_DASHBOARDTEMPLATE_USERS_FROM_HATS_DASHBOARDTEMPLATE_TITLE',
    'id_name' => 'template_id',
    'link-type' => 'many',
    'side' => 'left',
);
