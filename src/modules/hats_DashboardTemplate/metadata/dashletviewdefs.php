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

// $Id: MyAccountsDashlet.data.php 16278 2006-08-22 19:09:18Z awu $

global $current_user;

$dashletData['hats_DashboardTemplateDashlet']['searchFields'] = array('date_entered'     => array('default' => ''),
                                                          'date_modified'    => array('default' => ''),
                                                          'assigned_user_id' => array('type'    => 'assigned_user_name', 
                                                                                      'default' => $current_user->name));
$dashletData['hats_DashboardTemplateDashlet']['columns'] =  array(   'name' => array('width'   => '45', 
                                                                      'label'   => 'LBL_LIST_NAME',
                                                                      'link'    => true,
                                                                      'default' => true), 
                                                      'date_entered' => array('width'   => '20', 
                                                                              'label'   => 'LBL_DATE_ENTERED',
                                                                              'default' => true),
                                                      'date_modified' => array('width'   => '20', 
                                                                              'label'   => 'LBL_DATE_MODIFIED'),    
                                                      'created_by' => array('width'   => '8', 
                                                                            'label'   => 'LBL_CREATED'),
                                                      'assigned_user_name' => array('width'   => '8', 
                                                                                     'label'   => 'LBL_LIST_ASSIGNED_USER'),
                                               );