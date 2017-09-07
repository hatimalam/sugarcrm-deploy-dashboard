<?php

$viewdefs['hats_DashboardTemplate']['base']['layout']['subpanels']['components'][] = array(
    'layout' => 'subpanel',
    'label' => 'LBL_HATS_DASHBOARDTEMPLATE_USERS_SUBPANEL_TITLE',
    'override_paneltop_view' => 'panel-top-readonly',
    'context' => array(
        'link' => 'hats_dashboardtemplate_users',
    ),
);
