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

    selectedUsersCallback: function() {
        console.log('callback from drawer');
    }
})
