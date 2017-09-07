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


$manifest = array (
  'acceptable_sugar_versions' =>
  array (
    0 => '7.9.*',
  ),
  'acceptable_sugar_flavors' =>
  array (
    0 => 'ENT',
    1 => 'ULT',
  ),
  'readme' => "This plugin helps copying one user's dashboards with other users of the SugarCRM. Template can be created and deployed only by admin users, regular users cannot access this module. Feel free to modify the codebase to enhance the features.
Initially written by: Hatim Alam
Email: hatimalam@gmail.com",
  'key' => 'hats',
  'author' => 'Hatim Alam',
  'description' => 'This package contains module to copy one user dashboards to other user(s) easily via selection list.',
  'icon' => '',
  'is_uninstallable' => true,
  'name' => 'Easy Share Dashboard',
  'published_date' => '2017-08-24 18:15:00',
  'type' => 'module',
  'version' => '1.0',
  'remove_tables' => 'prompt',
);


$installdefs = array (
  'id' => 'Easy Share Dashboard',
  'beans' =>
  array (
    0 =>
    array (
      'module' => 'hats_DashboardTemplate',
      'class' => 'hats_DashboardTemplate',
      'path' => 'modules/hats_DashboardTemplate/hats_DashboardTemplate.php',
      'tab' => false,
    ),
  ),
  'relationships' =>
  array (
    0 =>
    array (
      'meta_data' => '<basepath>/custom/metadata/hats_dashboardtemplate_usersMetaData.php',
    ),
  ),
  'copy' =>
  array (
    0 =>
    array (
      'from' => '<basepath>/modules/hats_DashboardTemplate',
      'to' => 'modules/hats_DashboardTemplate',
    ),
    1 =>
    array (
      'from' => '<basepath>/custom',
      'to' => 'custom',
    ),
  ),
);
