<?php

/** enable Dashboard Template module only from Admin page **/
$admin_option_defs = array();

$admin_option_defs['Administration']['dashboard_deployment'] = array(
    'SugarPortal',
    'LBL_DASHBOARD_DEPLOYMENT_TITLE',
    'LBL_DASHBOARD_DEPLOYMENT_DESC',
    'javascript:parent.SUGAR.App.router.navigate("hats_DashboardTemplate", {trigger:true})',
);

$admin_group_header[] = array('LBL_DASHBOARD_DEPLOYMENT_HEADER_TITLE', '', false, $admin_option_defs, 'LBL_DASHBOARD_DEPLOYMENT_HEADER_DESC');
