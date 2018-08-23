module.exports = {
    props: ['url'],

    data: function () {
        return {
            data: null,
            staff: null,
            selectedAll: false
        }
    },

    template: require("./leads-import.html"),


    filters: {
        success: function (items) {
            return items.filter(function (item) {
                return item.created;
            });
        },

        rejected: function (items) {
            return items.filter(function (item) {
                return item.errors
            });
        }
    },

    computed: {
		
		actuallyUseableCountryList: function () {
				return this.countries.map(function(country) {
				var code = Object.keys(country)[0];
				return {
					code: code,
				  name: country[code]
				}
			  })
			},
        completed: function () {
            return this.data.filter(function (item) {
                return item.created;
            });
        },

        remaining: function () {
            return this.data.filter(function (item) {
                return !item.created;
            });
        },

        total: function () {
            return this.data.length;
        },

        selected: function () {
            return this.data.filter(function (item) {
                return item.selected;
            });
        }
    },

    methods: {
        init: function (res) {
            //Excel ROWS
            this.$set('data', _.map(res.customers, function (item) {
                item.created = false;
                item.errors = false;
                item.selected = false;
                return item;
            }));

            //Staff to be used for Dropdown
            this.$set('companies', res.companies);
            
            //county data to be used
            this.$set('countries', res.countries);
            
            //Sales team data to be used
            this.$set('salesteams', res.salesteams);

            //Look for select all checkbox
            this.$watch('selectedAll', function (selected) {
                this.updateRowsSelection(selected);
            });

            this.selectedAll = false;
        },

        updateRowsSelection: function (status) {
            _.each(this.data, function (item) {
                item.selected = status;
            });
        },

        uploadFile: function () {

            var formData = new FormData();
            formData.append('file', this.$els.fileinput.files[0]);

            this.$http.post(this.url + 'import', formData)
                .success(function (res) {
                    this.init(res);
                }.bind(this)).error(function (err) {
                   
                })
        },

        createRecord: function (item) {
            if (!item.created) {
                var vm = this;
                this.$http.post(this.url + 'ajax-store', item)
                    .success(function (response) {
                        item.created = true;
                        item.selected = false;
                        item.errors = null;
                         console.log(response);
                    })
                    .error(function (error) {
                        console.log(error);
                        item.errors = error;
                    });
            }
        },

        createAll: function () {
            this.selected.forEach(function (item) {
                this.createRecord(item);
            }.bind(this));
        }
    }
}