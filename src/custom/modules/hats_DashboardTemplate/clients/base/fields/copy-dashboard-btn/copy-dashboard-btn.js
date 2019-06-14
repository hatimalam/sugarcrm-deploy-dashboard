({
    extendsFrom: 'RowactionField',
    deployType: undefined,
    initialize: function(options) {
        this._super('initialize', [options]);
        this.type = 'rowaction';
    },

    /** button click action */
    rowActionSelect: function(evt) {
        //check the deploy type from button metadata and open drawer accordingly
        if(!_.isUndefined(this.def.deploy_type) && !_.isEmpty(this.def.deploy_type)) {
            this.deployType = this.def.deploy_type;
            console.log(this.deployType);
            app.drawer.open({
                    layout: 'multi-selection-list',
                    context:
                    {
                        module: this.deployType,
                        isMultiSelect: true,
                    },
                //on closing drawer, callback returns selection records array
                }, _.bind(this.selectedUsersCallback, this)
            );
        } else {
            app.alert.show('error_deploy_type', {
                level: 'error',
                messages: 'LBL_ERROR_INVALID_DEPLOY_TYPE',
                autoClose: false
            });
        }
        console.log('btn clicked..');
    },

    selectedUsersCallback: function(records) {
    	console.log('callback from drawer');
    	console.log(records);
    	var selected_records = [];
    	if(!_.isUndefined(records) && !_.isEmpty(records)) {
    		_.each(records, function(record) {
    			selected_records.push(record.id);
    		});
    		//call dashboard copy API to copy current template to all the selected IDs
    		var self = this,
                primary_user = this.model.get('assigned_user_id'),
                template_id = this.model.get('id'),
    			url = app.api.buildURL('hats_DashboardTemplate', 'copyUserDashboard', {}, {}),
                value = {template_id: template_id, deploy_type:this.deployType, selected_records:selected_records};
            app.api.call('create', url, value, {
                success: function(data)
                {
                    if(data.success)
                    {
                        app.alert.dismiss('copy_dashboard_inprogress');
                        console.log(data);
                        app.alert.show('dashboard_copy_success', {
                            level: 'success',
                            messages: app.lang.get('LBL_SUCCESSFULLY_COPIED_MESSAGE', self.module),
                            autoClose: true,
                        });
                        //refresh the user subpanel
                        self.model.getRelatedCollection('hats_dashboardtemplate_users').fetch({relate:true});
                    }
                },
                error: function(err)
                {
                    if(err.status != 412) {
                        app.alert.show('server-error',{level:'error',messages:'ERR_GENERIC_SERVER_ERROR'});
                    }
                    app.error.handleHttpError(err);
                },
            });
    	} else {
    		console.log('no action..');
    	}
    }
})
