({
    extendsFrom: 'RecordView',
    initialize: function(options)
    {
        this._super('initialize', [options]);
        this.context.on("button:deploy_template_btn:click", this.saveDashboard, this);
    },

    saveDashboard: function()
    {
        console.log("Deploy dashboard button clicked");
        //open mutliple-selection list drawer
        app.drawer.open({
                layout: 'multi-selection-list',
                context:
                {
                    module: 'Users',
                    isMultiSelect: true,
                },
            //on closing drawer, callback returns selection records array
            }, _.bind(this.selectedUsersCallback, this)
        );
    },

    selectedUsersCallback: function(models)
    {
        console.log("Selected users callback called");
        // console.log(model);
        //iterate over each model
        if(!_.isEmpty(models))
        {
            app.alert.show('select_user_confirmation', {
                title: app.lang.get('LBL_USER_OVERWRITE_WARNING', this.module),
                level: 'confirmation',
                messages: app.lang.get('LBL_OVERWRITE_CONFIRMATION_MESSAGE', this.module),
                onConfirm: _.bind(function() {
                    app.alert.show('copy_dashboard_inprogress', {
                        level: 'process',
                        title: app.lang.get('LBL_COPYING_DASHBOARDS', this.module),
                    });
                    var user_ids = [];
                    _.each(models, function(model) {
                        user_ids.push(model.id);
                    });
                    var self = this,
                        primary_user = this.model.get('assigned_user_id'),
                        template_id = this.model.get('id'),
                        //pass these ids to copyUserDashboard API
                        url = app.api.buildURL('hats_DashboardTemplate', 'copyUserDashboard', {}, {}),
                        value = {template_id: template_id, primary_user:primary_user, secondary_users:user_ids};
                    //call custom API to copy dashboard data
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
                }, this),
            });

        } else {
            app.alert.show('user_cancelled_operation', {
                level: 'error',
                title: app.lang.get('LBL_COPY_OPERATION_CANCELLED', this.module),
                messages: app.lang.get('LBL_COPY_OPERATION_CANCELLED_MSG', this.module),
                autoClose: true,
            });
        }
    },
})
