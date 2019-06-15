<?php

class CopyUserDashboardApi extends SugarApi
{
    public function registerApiRest()
    {
        return array(
            'copyUserDashboard' => array(
                'reqType' => 'POST',
                'path' => array('hats_DashboardTemplate', 'copyUserDashboard'),
                'pathVars' => array('', ''),
                'method' => 'copyUserDashboard',
                'shortHelp' => 'This endpoint copies primary user dashboard to secondary users.',
                'longHelp' => '',
            ),
        );
    }

    protected $template;
    protected $where;

    //copy dashboard from primary user to secondary users
    public function copyUserDashboard($api, $args)
    {
        global $timedate, $db;
        $this->requireArgs($args, array('deploy_type', 'selected_records', 'template_id'));
        $GLOBALS['log']->fatal("Args are: ".print_r($args,true));

        $this->template = BeanFactory::getBean("hats_DashboardTemplate", '');//$args['template_id']);
        if(!empty($this->template->id)) {
            $primary_user_id = $this->template->assigned_user_id;
            //get users for the deployment
            $secondary_user_ids = $this->getSecondaryUsers($args['deploy_type'], $args['selected_records']);
            //create where clause
	        $this->where = " AND dashboard_module='{$this->template->module_list}'";
	        //if views are selected
	        if($this->template->view_name != '') {
	            $view_name = str_replace("^", "'", $this->template->view_name);
	            $this->where .= " AND view_name IN (".$view_name.")";
	        }

	        //remove primary user from the secondary user array if exists
	        if(($key = array_search($primary_user_id, $secondary_user_ids)) !== FALSE) {
	            unset($secondary_user_ids[$key]);
	        }
	        //fetch primary user dashboards
	        $dashboard_data = $this->getPrimaryUserDashboards($primary_user_id);
	        if(!empty($dashboard_data)) {
	            //delete existing data and populate new dashboards
	            foreach($secondary_user_ids as $user_id) {
	                $this->deleteExistingDashboards($user_id);
	                $this->insertNewDashboards($user_id, $dashboard_data);
	                //relate this user to dashboard template
	                $this->template->load_relationship('hats_dashboardtemplate_users');
	                $this->template->hats_dashboardtemplate_users->add($user_id);
	            }
	            return array('success' => true, 'message' => translate('LBL_DASHBOARD_DEPLOYMENT_SUCCESS', 'hats_DashboardTemplate'));
	        } else {
	            return array('success' => true, 'message' => translate('LBL_NO_DASHBOARDS_FOUND', 'hats_DashboardTemplate'));
	        }
        } else {
            return false;
        }
    }

    /** utility function to get associated users for selected teams, roles */
    protected function getSecondaryUsers($deploy_type, $selected_records)
    {
        $secondary_users = array();
        //get users based on the selected deploy type
        switch($deploy_type) {
            case 'Users':
                $secondary_users = $selected_records;
            break;
            case 'Teams':
                //get all users for selected teams
                foreach($selected_records as $team_id) {
                    $team_bean = BeanFactory::getBean("Teams", $team_id, array('disable_row_level_security' => true));
                    //retrieve only active users and active employees
                    $user_list = $team_bean->get_team_members(true, null, true);
                    //retrieve id from userbean and merge with the secondary_users array for singular array formation
                    $secondary_users = array_merge($secondary_users, array_column($user_list, 'id'));
                }
            break;
            case 'ACLRoles':
                //get all users for selected roles
                foreach($selected_records as $role_id) {
                    //don't retrieve portal user
                    $query = "SELECT users.id ".
                        "FROM users ".
                        "INNER JOIN acl_roles_users ON acl_roles_users.role_id = ? ".
                            "AND acl_roles_users.user_id = users.id AND acl_roles_users.deleted = 0 ".
                        "WHERE users.deleted=0 AND portal_only=0";

                    $stmt = DBManagerFactory::getConnection()->executeQuery($query, array($role_id));
                    while ($row = $stmt->fetch()) {
                    	//push user id to array
                        $secondary_users[] = $row['id'];
                    }
                }
            break;
        }
        //return unique values with proper array index ordering
        return array_values(array_unique($secondary_users));
    }


    protected function insertNewDashboards($user_id, $dashboards)
    {
        global $db;
        $bean = BeanFactory::newBean("Dashboards");
        foreach($dashboards as $dashboard_id) {
            $select_data = "SELECT * FROM dashboards WHERE id='{$dashboard_id}'";
            $result = $db->query($select_data);
            while($row = $db->fetchByAssoc($result)) {
                foreach ($row as $key => $value) {
                    $row[$key] = $db->massageValue($value, $bean->getFieldDefinition($key));
                }
                $row['id'] = $db->quoted(create_guid());
                $row['date_entered'] = $db->quoted(TimeDate::getInstance()->nowDb());
                $row['date_modified'] = $db->quoted(TimeDate::getInstance()->nowDb());
                $row['assigned_user_id'] = $db->quoted($user_id);
                $insert_sql = "INSERT INTO dashboards VALUES (".join(',', $row).")";
                $result = $db->query($insert_sql);
            }
        }
        return true;
    }

    protected function getPrimaryUserDashboards($user_id)
    {
        global $db;
        $dashboard_data = array();
        //fetch dashboards assigned to $user_id
        $query = "SELECT dashboards.id FROM dashboards WHERE assigned_user_id='{$user_id}' AND deleted=0 {$this->where}";
        $result = $db->query($query);
        //if result found, iterate over the rows
        if(isset($result->num_rows) && $result->num_rows > 0) {
            while($row = $db->fetchByAssoc($result)) {
                $dashboard_data[] = $row['id'];
            }
        }
        return $dashboard_data;
    }

    protected function deleteExistingDashboards($user_id)
    {
        global $db;
        $query = "UPDATE dashboards SET deleted=1 WHERE assigned_user_id = '{$user_id}' {$this->where}";
        $db->query($query);
        return true;
    }
}
