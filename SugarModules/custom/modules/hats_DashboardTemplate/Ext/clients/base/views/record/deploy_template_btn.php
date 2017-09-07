<?php

/** custom button to deploy template to user(s) **/
$deploy_template_btn = array(
    array(
        'name' => 'deploy_template_btn',
        'type' => 'rowaction',
        'label' => 'LBL_DEPLOY_TEMPLATE_BUTTON',
        'event' => 'button:deploy_template_btn:click',
        'acl_action' => 'view',
    ),
);

foreach($viewdefs['hats_DashboardTemplate']['base']['view']['record']['buttons'] as $key => $val)
{
    if($val['type'] == 'actiondropdown')
    {
        array_splice($viewdefs['hats_DashboardTemplate']['base']['view']['record']['buttons'][$key]['buttons'], -1, 0, $deploy_template_btn);
    }
}
