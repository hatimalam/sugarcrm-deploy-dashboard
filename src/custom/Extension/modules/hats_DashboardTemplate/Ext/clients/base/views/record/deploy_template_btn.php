<?php

/** custom button to deploy template to users **/
$deploy_template_btns = array(
    array(
        'name' => 'deploy_template_user_btn',
        'type' => 'copy-dashboard-btn',
        'label' => 'LBL_DEPLOY_TEMPLATE_USER_BUTTON',
        'event' => 'button:deploy_template_user_btn:click',
        'acl_action' => 'view',
        'deploy_type' => 'Users',
    ),
    array(
        'name' => 'deploy_template_team_btn',
        'type' => 'copy-dashboard-btn',
        'label' => 'LBL_DEPLOY_TEMPLATE_TEAM_BUTTON',
        'event' => 'button:deploy_template_team_btn:click',
        'acl_action' => 'view',
        'deploy_type' => 'Teams',
    ),
    array(
        'name' => 'deploy_template_role_btn',
        'type' => 'copy-dashboard-btn',
        'label' => 'LBL_DEPLOY_TEMPLATE_ROLE_BUTTON',
        'event' => 'button:deploy_template_role_btn:click',
        'acl_action' => 'view',
        'deploy_type' => 'ACLRoles',
    ),
);

foreach($viewdefs['hats_DashboardTemplate']['base']['view']['record']['buttons'] as $key => $val)
{
    if($val['type'] == 'actiondropdown')
    {
        array_splice($viewdefs['hats_DashboardTemplate']['base']['view']['record']['buttons'][$key]['buttons'], -1, 0, $deploy_template_btns);
    }
}
