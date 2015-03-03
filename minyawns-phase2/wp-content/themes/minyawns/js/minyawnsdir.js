jQuery(document).ready(function($) {

//$('.minyawnslist').jscroll({
//    loadingHtml: '<img src="loading.gif" alt="Loading" /> Loading...',
//    padding: 20,
//    nextSelector: 'a.jscroll-next:last',
//    contentSelector: 'li',
//    debug:true,
//    autoTriggerUntil:true
//    
//    });
    var b = $('#back-top');

    $("#directory").addClass("selected");

    $(".green-btn-top").attr('data-page', 'md');
//$("#searchbox").fcbkcomplete({
//json_url: SITEURL + '/wp-content/themes/minyawns/libs/minyawndir.php/allminyawns',
//cache: true,
//filter_case: true,
//filter_hide: true,
//newel: true
//});




//    b.on('click', function() {
//        $('html,body').animate({
//            scrollTop: 0
//        }, 500);
//        return false;
//    });
    var b = $('#back-top');
    // Hide scroll top button
    b.hide();

    fetch_minyawns_list();

//$("#searchbox").keyup(function(){
//    
//    searchString();
//    
//});
// $(window).scroll(function(){  
//                    if  ($(window).scrollTop() == 0){  
//                       alert("here");  
//                       
//                    }   
//            }); 



    document.addEventListener('scroll', function(event) {

        // Hide scroll top button
//      alert(document.body.scrollHeight);
//      alert(document.body.scrollTop);
//       alert(window.Height);
        //if (document.body.scrollHeight === (document.body.scrollTop + window.innerHeight)) {
        if (document.body.scrollHeight === ($(window).scrollTop() + window.innerHeight)) {
            if (window.error !== 404) {
             
//                var no_result = _.template($("#loader-image").html());
//                jQuery(".minyawns-grid1").append(no_result);
                $(".load_ajax_large").show();
                
               
                
               
                load_more();
            }
        }

        if ($(this).scrollTop() > 400) {

            if ($(this).scrollTop() > 400) {

                b.fadeIn();
                // otherwise fadeout button
            } else {
                b.fadeOut();
            }
        }




    });

//$(window).scroll(function() {
//    if($(window).scrollTop() == $(document).height() + $(window).height()) {
//           // ajax call get data from server and append to the div
//   alert("Scrolled");
//    }
//});

});

var b = $('#back-top');
b.on('click', function() {
    $('html,body').animate({
        scrollTop: 0
    }, 500);
    return false;
});


function fetch_minyawns_list() {





    var first = getUrlVars()["filter"];

    var MinyawnsDir = Backbone.Collection.extend({
        // model: MDirModel,
        url: function() {

            return SITEURL + '/wp-content/themes/minyawns/libs/minyawndir.php/allminyawns'
        }
    });



    var _data = {
        'offset': 0,
    };
    if (typeof(first) !== 'undefined')
        _data.filter = first;

    if (typeof(window.is_verified) !== 'undefined')
        _data.verified = window.is_verified;

    window.verified_users = {};
    window.count = 0;
    window.ncount = 0;
    window.total = 0;
    window.minyawndir = new MinyawnsDir();
    window.minyawndir.fetch({
        data: _data,
        reset: true,
        success: function(collection, response) {

            if (response.error !== '404' && response.blank != '1') {
                var template = _.template(jQuery("#minyawn-directory-card").html());

                $(".load_ajax_large").show();

                _.each(collection.models, function(model) {

                    var html = template({result: model.toJSON()});
                    jQuery(".minyawnslist").append(html);

                    window.total = model.toJSON().total;

                    create_verified_array(model.toJSON());


                });

                if (window.total === window.minyawndir.length) {


                } else {
//                    var load_more_template = _.template(jQuery("#load-more").html());
//                    jQuery(".minyawns-grid1").append(load_more_template);
                }


            } else
            {

                var no_result = _.template($("#no-result-minyawn-dir").html());
                jQuery(".no-job").remove();
                jQuery(".minyawnslist").append(no_result);

            }
            jQuery(".minyawns-grid1").find('.load_ajax_large').hide(); //remove loader after load more completes
        }
    });
    $(".inline li").removeClass("selected");

    $("#directory").addClass('selected');
}


function searchString()
{

    var MinyawnsSearch = Backbone.Collection.extend({
        // model: MDirModel,
        url: function() {

            return SITEURL + '/wp-content/themes/minyawns/libs/minyawndir.php/searchAllminyawns'
        }
    });


    var self = this;
    window.MinyawnsSearch.fetch({
        data: {
            // 'offset': self.offset,
            'term': $("#searchbox").val()
        },
        reset: true,
        success: function(model, response) {
            alert("heyup");
        },
        error: function(err) {
            //console.log(err);
        }

    });




}

function formSubmit()
{

    alert("form submited");

}


/*
 *  CLICK FOR LOAD MORE BUTTON 
 * 
 *  MINYAWN DIRECTORY
 */


function load_more() {

//    var filter_loader_template = _.template(jQuery("#filters-loader-image").html());
//    jQuery(".minyawns-grid1").append(filter_loader_template);
    
    if(window.flag == true)
             return;
         
    window.flag=true;

    var first = getUrlVars()["filter"];

    var _data = {
        'offset': window.minyawndir.models.length,
    };

    if (typeof(first) !== 'undefined')
        _data.filter = first;

    if (typeof(window.is_verified) !== 'undefined')
        _data.verified = window.is_verified;

    var counter = 0;
    window.minyawndir.fetch({
        data: _data,
        remove: false,
        add: true,
        success: function(collection, response) {

            if (response.error !== '404') { //if no results returned

                $(".minyawnslist").empty();
                var template = _.template(jQuery("#minyawn-directory-card").html());


                _.each(collection.models, function(model) {
                    
                    var html = template({result: model.toJSON()});

                    jQuery(".minyawnslist").append(html);
                    create_verified_array(model.toJSON());
                    window.total = model.toJSON().total;
                });

                //if(window.minyawndir.models.length === model.toJSON.)
                if (window.total === window.minyawndir.length) { //check to show load more button if total returned == model length hide the button

                    jQuery("#load_more").hide();
                } else {

                    //shwo the load more
                }
 window.flag=false;

            } else
            {
                window.error = 404;
                var no_more_load = _.template(jQuery("#no-more-results-pagination").html());
                jQuery(".minyawns-grid1").append(no_more_load);

            }
            jQuery(".minyawns-grid1").find('.load_ajax_large').hide(); //remove loader after load more completes
        }

    });
   
   
    setTimeout(function() {
        jQuery(".minyawns-grid1").find('#filters-loader').remove()
    }, 1000); //remove loader after load more completes

}

function remove_filter()
{
    window.location = siteurl + '/minyawns-directory/';

}

function create_verified_array(modelTojson)
{
    var user_id = '';

    $.each(modelTojson, function(index, value) {



        if (index == 'user_id') {
            user_id = value;

        }

        if (index === 'user_verified' && value === 'N') {
            window.ncount = window.ncount + 1;
            window.verified_users[user_id] = value;

        } else if (index === 'user_verified' && value === 'Y') {
            window.count = window.count + 1;
        }


        // do your stuff here
    });




}


$(".checkbox").live('click', function() {




//    var filter_loader_template = _.template(jQuery("#filters-loader-image").html());
//    jQuery(".minyawns-grid1").append(filter_loader_template);

//    setTimeout(function() {
//        jQuery(".minyawns-grid1").find('#filters-loader').remove()
//    }, 1000);

    if ($("#checkbox-verified").attr("checked") === 'checked')
    {
        window.is_verified = 'Y';
        jQuery(".minyawnslist").empty();
        jQuery(".load_ajax_large").show();

        fetch_minyawns_list();


    }
    else
    {

        jQuery(".minyawnslist").empty();
        jQuery(".load_ajax_large").show();
        delete  window.is_verified;
        fetch_minyawns_list();

    }






});

$(".on-pop").live("click", function(event) {

    jQuery("#loader" + $(this).attr('job-id')).show();
    var Fetchuserinvites = Backbone.Collection.extend({
        url: SITEURL + '/wp-content/themes/minyawns/libs/job.php/inviteminions'
    });
    window.postinvites = new Fetchuserinvites;
    window.postinvites.fetch({
        type: 'POST',
        data: {
            user_id: $(this).attr('minyawn-id'),
            job_id: $(this).attr('job-id')
        },
        success: function(collection, response) {
            jQuery("#loader" + $(this).attr('job-id')).hide();
            var invites = _.template(jQuery("#active_invites").html());
            jQuery("#miniondir").modal('show');
            jQuery("#invite_to").find(".alert-box").remove();
            if (collection.length > 0) {
                $("#invite_to").append('<tr><td colspan="3"><div class="alert alert-success alert-box"><b>Invite</b>&nbsp;Sent!<button type="button" class="close fui-cross" data-dismiss="alert"></button></div></td></tr>');
                _.each(collection.models, function(model) {
                    jQuery("#row-" + model.toJSON().job_id).remove();
                    var user_button = button_for_invite(model);

                    var html = invites({result: model.toJSON(), button: user_button});


                    jQuery("#invite_to").prepend(html);
                });


            } else
            {

                jQuery("#invite_to").append("No jobs here! Please add a job");

            }
        }
    });
});