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
        $this->requireArgs($args, array('deploy_type', 'secondary_records', 'template_id'));
        $GLOBALS['log']->fatal("Args are: ".print_r($args,true));

        $this->template = BeanFactory::getBean("hats_DashboardTemplate", $args['template_id']);
        if(!empty($this->template->id)) {
            $primary_user_id = $this->template->assigned_user_id;
            //get users for the deployment
            $secondary_user_ids = $this->getSecondaryUsers($args['deploy_type'], $args['secondary_records']);
        } else {
            return false;
        }
        
        // if($this->template->id == '')
        // {
        //     return false;
        // }
        // //create where clause
        // $this->where = " AND dashboard_module='{$this->template->module_list}'";
        // if($this->template->view_name != '')
        // {
        //     $view_name = str_replace("^", "'", $this->template->view_name);
        //     $this->where .= " AND view_name IN (".$view_name.")";
        // }

        // if(($key = array_search($primary_user_id, $secondary_user_ids)) !== FALSE)
        // {
        //     unset($secondary_user_ids[$key]);
        // }
        // $dashboard_data = $this->getPrimaryUserDashboards($primary_user_id);
        // if(!empty($dashboard_data))
        // {
        //     //delete existing data and populate new dashboards
        //     foreach($secondary_user_ids as $user_id)
        //     {
        //         $this->deleteExistingDashboards($user_id);
        //         $this->insertNewDashboards($user_id, $dashboard_data);
        //         //relate this user to dashboard template
        //         $this->template->load_relationship('hats_dashboardtemplate_users');
        //         $this->template->hats_dashboardtemplate_users->add($user_id);
        //     }
        //     return array('success' => true, 'message' => 'Dashboards successfully updated.');
        // } else
        // {
        //     return array('success' => true, 'message' => 'No records found.');
        // }
    }


    protected function getSecondaryUsers($deploy_type, $secondary_records)
    {
        $secondary_users = array();
        return $secondary_users;
    }


    protected function insertNewDashboards($user_id, $dashboards)
    {
        global $db;
        $bean = BeanFactory::newBean("Dashboards");
        foreach($dashboards as $dashboard_id)
        {
            $select_data = "SELECT * FROM dashboards WHERE id='{$dashboard_id}'";
            $result = $db->query($select_data);
            while($row = $db->fetchByAssoc($result))
            {
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
        if(isset($result->num_rows) && $result->num_rows > 0)
        {
            while($row = $db->fetchByAssoc($result))
            {
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
