# sugarcrm-deploy-dashboard
This plug-in allows sugar admin user to deploy same dashboard for multiple users in Single-Go.

NOTE: This project has been developed on Sugar 7.9.0.0 using a WAMP stack.

# Installation Instructions:
- Get the latest package from release section : https://github.com/hatimalam/sugarcrm-deploy-dashboard/releases/tag/1.0
- Install it using Module Loader
- Verify the successful installation

# Usage Instructions:
- Navigate to Admin screen and verify if you can see the "Dashboard Deployment" section at the end (requires admin privilege)
- Click on Dashboard Template link and it will open a SugarCRM module list view
- Create new template using "Create" button and select module and view for which you want to share the dashboard
- Select Primary User from whom you need to capture the dashboard template
- Save the record
- Navigate to record detail view
- Click on action dropdown and select "Deploy template to User(s)", it will open up multiple user selection screen
- Select users for whom you want to apply this template to
- Confirm if you are OK to overwrite the users existing dashboards
- Once confirmed, the template will be applied to selected users
