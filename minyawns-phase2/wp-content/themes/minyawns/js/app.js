require.config({
    urlArgs: "v=" + (new Date()).getTime(),
    shim: {
        'jquery-1.8.3.min': {
            exports: "$"
        },
        'underscore': {
            exports: "_"
        },
        'backbone': {
            deps: ['underscore', 'jquery-1.8.3.min'],
            exports: 'Backbone'
        },
        'bootstrap.min': {
            deps: ['jquery-1.8.3.min']
        },
        'custom': {
            deps: ['jquery-1.8.3.min']
        },
        'bootstrap-select': {
            deps: ['jquery-1.8.3.min', 'bootstrap.min']
        },
        'flatui-checkbox': {
            deps: ['jquery-1.8.3.min']
        },
        'flatui-radio': {
            deps: ['jquery-1.8.3.min']
        },
        'jquery.tagsinput': {
            deps: ['jquery-1.8.3.min']
        },
        'jquery.placeholder': {
            deps: ['jquery-1.8.3.min']
        }, 'bootstrap-switch': {
            deps: ['jquery-1.8.3.min']
        }, 'jquery.validate.min': {
            deps: ['jquery-1.8.3.min']
        },
        'awm-custom': {
            deps: ['jquery-1.8.3.min', 'jquery.validate.min']
        },
        'bootstrap-tagmanager': {
            deps: ['jquery-1.8.3.min', 'bootstrap.min']
        }, 'application': {
            deps: ['jquery-1.8.3.min', 'bootstrap.min', 'bootstrap-switch', 'bootstrap-select', 'jquery.placeholder']
        }, 'jquery-ui-1.10.3.custom.min':
                {
                    deps: ['jquery-1.8.3.min']
                }, 'jquery.stacktable': {
            deps: ['jquery-1.8.3.min']
        }
    }
});
var ProfileView = {};
require([
    'jquery-1.8.3.min',
    'underscore',
    'backbone',
    '../templates/profile/js/profile',
    '../templates/jobs/js/job',
    'jquery.validate.min',
    'jquery.tagsinput',
    'awm-custom',
    'bootstrap.min',
    'bootstrap-tagmanager',
    'application',
    'bootstrap-switch',
    'jquery-ui-1.10.3.custom.min',
    'jquery.stacktable'
],
        function($, _, Backbone, Profile) {


            ProfileView = Backbone.Router.extend({
                routes: {
                    "#": "profile",
                    "profile": "profile",
                    "logout": "logout",
                    "edit": "edit",
                    "update": "profile",
                    "sendform": "sendform"

                }, profile: function(routes)
                {
                    $("#innermainimage").remove();
                    $("#init-land").remove();
                    $("#profile-view").show();
                    $("#my-history").show();
                    $("#profile-view").empty();
                    //$("#my-history").empty();
                    $("#edit-user-profile").remove();

                    var profile_view = new Profile.ProfileContianerView({'breadcrumb': 'My Profile'});
                    profile_view.render();


                }, edit: function()
                {

                    var profile_edit_view = new Profile.ProfileEditContianerView({'breadcrumb': 'Edit Profile'});
                    profile_edit_view.render();




                }, logout: function()
                {

                    $.ajax({
                        url: "../wp-content/themes/minyawns/templates/profile/api/index.php/logout",
                        success: function() {

                        }});
                }, sendform: function() {
                    
                    var Job = Backbone.Model.extend({
                defaults: {
                    tasks: "",
                    start: "",
                    end: "",
                    starttime: "",
                    endtime: "",
                    require: "",
                    wages: "",
                    location: "",
                    details: ""
                },
                url: function() {

                    return  '../wp-content/themes/minyawns/templates/jobs/api/index.php/addjob';
                }, validate: function(attr) {



                }
            });
            var data = {};
//            data.title = $("#tasks").val();
//            data.sdate=$("#start-date").val();
//            data.edate=$("#end-date").val();
//            data.stime=$("#start-time").val();
//            data.etime=$("#end-time").val();
//            data.required=$("#required").val();
//            data.wages=$("#wages").val();
//            data.location=$("#location").val();
//            data.detail=$("#details").val();
                    var jobs = new Job();
                    jobs.set({ 
                        tasks: $("#tasks").val(),
                        start: $("#start-date").val(),
                        end: $("#end-date").val(),
                        starttime:$("#start-time").val(),
                        endtime:$("#end-time").val(),
                        require: $("#required").val(),
                        wages: $("#wages").val(),
                        location:$("#location").val(),
                        details: $("#details").val()
                    }); /*selected id in the url*/
                    jobs.save(data);
                }
            });
            $(function() {
                new ProfileView();
                Backbone.history.start();


            });
        });
function onAddTag(tag) {/*adds tags from the hidden field*/
    var $keywords = $("#tags").siblings(".tagsinput").children(".tag");
    var tags = [];
    for (var i = $keywords.length; i--; ) {
        tags.push($($keywords[i]).text().substring(0, $($keywords[i]).text().length - 1).trim());
    }

    /*Then if you only want the unique tags entered:*/
    var uniqueTags = $.unique(tags);

    $("#user_skills").val(uniqueTags);
}
function onRemoveTag(tag) { /*removes tags from the hidden field*/
    var $keywords = $("#tags").siblings(".tagsinput").children(".tag");
    var tags = [];
    for (var i = $keywords.length; i--; ) {
        tags.push($($keywords[i]).text().substring(0, $($keywords[i]).text().length - 1).trim());
    }

    /*Then if you only want the unique tags entered:*/
    var uniqueTags = $.unique(tags);

    $("#user_skills").val(uniqueTags);
}

var currentView = null;
function freePrevView(th) {
    if (!_.isNull(currentView))
    {
        currentView.unbind();
        currentView.undelegateEvents();
    }
    currentView = th;
}






