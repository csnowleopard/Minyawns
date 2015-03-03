define(['underscore', 'jquery-1.8.3.min', 'backbone', 'backbone.modaldialog'],
        function(_, $, Backbone, ModalView) {

            var Manage = {};
            Manage.templates = {
            };
            /*
             *
             *   BACKBONE MODELS
             *
             *
             */
            Manage.User = Backbone.Model.extend({
                defaults: {
                    role_names: "",
                    total: ""
                },
                url: function() {

                    return  '../wp-content/themes/minyawns/templates/profile/api/index.php/users';
                }
            });
            Manage.UserCollection = Backbone.Collection.extend({
                model: Manage.User,
                url: function() {
                    return '../wp-content/themes/minyawns/templates/profile/api/index.php/users';
                },
                parse: function(response) {

                    this.total = response.total;
                    return response.data;
                }

            });
            Manage.UserDetailsCollection = Backbone.Collection.extend({
                model: Manage.User,
                url: function() {
                    return '../wp-content/themes/minyawns/templates/profile/api/index.php/users';
                },
                parse: function(response) {

                    this.total = response.total;
                    return response.data;
                }

            });
            /*====================================================================================================================================
             END OF MODELS
             
             BEGIN VIEWS
             ====================================================================================================================================*/





            /*
             *
             *
             *    BACKBONE VIEWS
             *
             *
             *
             */
            Manage.ProfileContianerView = Backbone.View.extend({
                el: '#profile-view',
                initialize: function() {

                    _.bindAll(this, 'render', 'change_avatar');
                    this.userdetails = new Manage.UserDetailsCollection();
                    freePrevView(this);
                }, events: {
                    'change #roles-drop-down': function(e) {
                        this.select_role(e);
                    },
                    'click .change-avtar': 'change_avatar'
                },
                render: function() {
                    var self = this;
                    $("#loader1").show();

                    this.userdetails.fetch({
                        data: {
                            'action': 'fetch',
                            'user_id': $("#current_user").val()
                        },
                        reset: true,
                        success: function(model, response) {
                            $("#loader1").show();
                            var template = _.template($("#user-avatar").html());
                            var html = template(response.data); //response.toJSON()
                            $(self.el).append(html);
                            $("#bread-crumbs-id").empty();
                            $("#bread-crumbs-id").append("<a href='" + siteurl + "/jobs'>View All jobs</a><a href='#profile' class='breadcrumb-end'>" + self.options.breadcrumb + "</a>");

                            if (response.data.user_role == "minyawn") {
                                var template = _.template($("#user-profile").html());
                                var html = template(response.data); //response.toJSON()
                                $(self.el).append(html);
                            } else
                            {
                                var template = _.template($("#user-profile-two").html());
                                var html = template(response.data); //response.toJSON()
                                $(self.el).append(html);
                            }
                            /*
                             *  user votes
                             * 
                             */
                            var template = _.template($("#user-votes").html());
                            var html = template(); //response.toJSON()
                            $(self.el).append(html);

                            /*
                             *  user history
                             * 
                             */
                            //$("#my-history").show();
                            var template = _.template($("#history-row").html());
                            $("#no-more-tables").find('table tbody').html(template);
                            $("#loader1").hide();
                        }
                    });
                }, change_avatar: function() {
                    var view = new Manage.AddNewAvatar();
                    view.render().showModal();
                }

            });

            /*
             * Profile edit view 
             * 
             * 
             */


            Manage.ProfileEditContianerView = Backbone.View.extend({
                el: '#main-content',
                initialize: function() {

                    _.bindAll(this, 'render', 'save_user_details');
                    this.usercollection = new Manage.UserCollection();
                    this.userdetails = new Manage.UserDetailsCollection();
                    freePrevView(this);
                }, events: {
                    'click #update-profile-button': 'save_user_details'
                },
                render: function() {
                    $('#tags').tagsInput();
                    var self = this;
                    $("#bread-crumbs-id").append("<a href='#edit' class='breadcrumb-end'>" + self.options.breadcrumb + "</a>");
                    $(self.el).find("#profile-view").hide();
                    $(self.el).find("#my-history").hide();
                    $('#tags').tagsInput();
                    this.userdetails.fetch({
                        data: {
                            'action': 'fetch',
                            'user_id': $("#current_user").val()
                        },
                        reset: true,
                        success: function(model, response) {
                            if (response.data.user_role == "minyawn") {
                                $(".tm-input").tagsManager();
                                var template = _.template($("#edit-profile").html());
                                var html = template(response.data); //response.toJSON()
                                $(self.el).append(html);
                                $(".tm-input").tagsManager({
                                    prefilled: response.data.user_skills,
                                    hiddenTagListId: 'user_skills',
                                });
                            } else
                            {
                                var template = _.template($("#edit-profile-two").html());
                                var html = template(response.data); //response.toJSON()
                                $(self.el).append(html);
                            }

                        }
                    })

                }, save_user_details: function() {
                    var validator = $("#edit-user-profile").validate({
                        rules: {
                            linkedIn: {
                                url: true
                            }
                        }
                    });
                    if (validator.form() === false)
                    {
                        return false;
                    } else {
                       
                        if ($("#user_role").val() === "minyawn") {
                            var self = this;
                            this.usercollection.fetch({
                                data: {
                                    'first_name': $("#inputFirst").val(),
                                    'last_name': $("#inputlast").val(),
                                    'college': $("#inputcollege").val(),
                                    'major': $("#inputmajor").val(),
                                    'skill': $("#tagsinput").val(),
                                    'body': $("#inputbody").val(),
                                    'url': $("#LinkedIn").val(),
                                    'current_user': $("#current_user").val(),
                                    'user_skills': $("#user_skills").val()
                                },
                                reset: true,
                                success: function(model, response) {

                                    if (response.status == "success")
                                    {
                                        $("#edit-user-profile").remove();
                                        $("#profile-view").show();
                                        $("#my-history").show();
                                        $("#profile-view").empty();
                                        $("#edit-user-profile").remove();
                                        var profile_view = new Manage.ProfileContianerView({'breadcrumb': 'My Profile'});
                                        profile_view.render();
                                    }

                                }
                            });
                        } else {
                            var self = this;
                            this.usercollection.fetch({
                                data: {
                                    'industry': $("#inputFirst").val(),
                                    'location': $("#inputlast").val(),
                                    'body': $("#inputbody").val(),
                                    'company_website': $("#LinkedIn").val(),
                                    'current_user': $("#current_user").val(),
                                    'user_role': $("#user_role").val()
                                },
                                reset: true,
                                success: function(model, response) {

                                    if (response.status == "success")
                                    {
                                        $("#edit-user-profile").remove();
                                        $("#profile-view").show();
                                        $("#my-history").show();
                                        $("#profile-view").empty();
                                        $("#edit-user-profile").remove();
                                        var profile_view = new Manage.ProfileContianerView({'breadcrumb': 'My Profile'});
                                        profile_view.render();
                                    }

                                }
                            });


                        }
                    }
                }
            });


            /*
             *  Loads the lightbox a .showModal() call above
             * 
             * 
             */
            Manage.AddNewAvatar = ModalView.extend({
                el: '',
                initialize: function() {

                    _.bindAll(this, 'render', 'upload_avatar', 'close_popup');
                    this._ensureElement();
                    this.template = _.template($("#avatar-dialog").html());
                    freePrevView(this);
                }, events: {
                    'click #update-profile-button': 'save_user_details',
                    'click #save_poup': 'upload_avatar',
                    'click #close': 'close_popup'
                }, render: function() {
                    $(this.el).html(this.template());
                    return this;
                }, upload_avatar: function() {
                    $("#loader2").show();
                    var formData = new FormData($('form')[0]);
                    $.ajax({
                        url: '../wp-content/themes/minyawns/templates/profile/api/index.php/change_avatar', //server script to process data
                        type: 'POST',
                        xhr: function() {  // custom xhr
                            var myXhr = $.ajaxSettings.xhr();
                            if (myXhr.upload) { // check if upload property exists
                                //myXhr.upload.addEventListener('progress', false); // for handling the progress of the upload
                            }
                            return myXhr;
                        },
                        //Ajax events
                        success: function(data, status) {

                            $("#modal-blanket").hide();
                            $(".modal").hide();
                            $("#modalContainer").remove();
                            window.location.hash = '#profile';
                            window.location.reload();
                        },
                        error: function(data, status, e) {

                        },
                        // Form data
                        data: formData,
                        //Options to tell JQuery not to process data or worry about content-type
                        cache: false,
                        contentType: false,
                        processData: false
                    });


                }, close_popup: function()
                {
                    $("#modal-blanket").hide();
                    $(".modal").hide();
                    $("#modalContainer").remove();
                    //window.location.hash = '#profile';
                }


            });


            return Manage;
        });


