
require(['jquery-1.8.3.min', 'underscore', 'backbone'],
        function($, _, Backbone) {
            var JobView = {};

      




            JobView.AddNewJob = Backbone.View.extend({
                el: '#jobs-list',
                initialize: function() {

                    _.bindAll(this, 'render');

                    freePrevView(this);
                }, events: {
                },
                render: function(evt) {
                    evt.preventDefault();
                    this.model = new JobView.Job();
                    this.model.set({
                        tasks: $("#tasks").val(),
                        start: "",
                        end: "",
                        starttime: "",
                        endtime: "",
                        require: "",
                        wages: "",
                        location: "",
                        details: ""
                    }); /*selected id in the url*/
                    this.model.fetch({
                        reset: true,
                        success: function(response, model) {


                        },
                        error: function(err) {
                            //console.log(err);
                        }
                    });



                }, change_avatar: function() {

                }

            });
            return JobView;
        });
