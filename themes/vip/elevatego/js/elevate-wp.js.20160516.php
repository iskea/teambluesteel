/*!
 *
 * Elevate WP  v1.0.0
 *
 */


function megamenu(){
        // navbar mega dropdown animation on scroll
        $('.toggleLogoSmall').addClass('hide');
        $('.toggleLogoBig').addClass('show');

        var position = $(window).scrollTop();

        $(window).scroll(function () {

            $('.dropdown-toggle').each(function () {
                if ($(this).parent().hasClass("open")) {
                    $(this).dropdown("toggle");
                }
            });
            //$('.dropdown-menu').stop().fadeOut("fast");

            var scroll = $(window).scrollTop();

            if (scroll > position) {
                //do nothing
            } else {
                //wide navbar
                $('.navbar').removeClass('fixed-top');
                $('.navbar').addClass('navbar-fixed-top');
                $('.navbar-fixed-top').addClass('animateWidebar');
                $('#navbar').css('margin-top', '0px');

                $('.toggleLogoSmall').addClass('show');
                $('.toggleLogoSmall').removeClass('hide');

                $('.toggleLogoBig').addClass('hide');
                $('.toggleLogoBig').removeClass('show');

            }

            if ($(this).scrollTop() < 560) {
                //short navbar
                $('.navbar').addClass('fixed-top');
                $('.navbar').removeClass('navbar-fixed-top');
                $('#navbar').css('margin-top', '20px');

                $('.toggleLogoSmall').addClass('hide');
                $('.toggleLogoSmall').removeClass('show');

                $('.toggleLogoBig').addClass('show');
                $('.toggleLogoBig').removeClass('hide');
            }

            position = scroll;
        });
}

function megamenuDropdown() {
    $('.dropdown-menu').click(function (e) {
        e.stopPropagation();
    });
}

//HOME PAGE - VERTICAL TABS CAROUSEL
function  verticalTabs() {
    $("div.vertical-tab-menu div.list-group > a").click(function (e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.vertical-tab>div.vertical-tab-content").removeClass("active");
        $("div.vertical-tab>div.vertical-tab-content").eq(index).addClass("active");
        $("div.vertical-tab-bg>div.vertical-tab-bgimg").removeClass("active");
        $("div.vertical-tab-bg>div.vertical-tab-bgimg").eq(index).addClass("active");
    });
}

function personalisation(){
    new Fingerprint2().get(function( hash ){
        // get the has
        console.log(hash); //a hash, representing your device fingerprint
        // check if the has is within the database



        // if has exists then return the hash options

        

        // else save the has with any options

        // var data = {
        //     'action': 'my_action',
        //     'whatever': 1234
        // };
        //
        // // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        // jQuery.post(ajaxurl, data, function(response) {
        //     alert('Got this from the server: ' + response);
        // });




        // jQuery.ajax({
        //     type: "POST",
        //     url: ajaxurl, // or '<?php echo admin_url('admin-ajax.php'); ?>'
        //     data: {
        //         'action': 'ajax_form',
        //         'field-one': jQuery('[field-one]').val()// or combine serialized form with action ....
        //     },
        //     beforeSend: function() {
        //         alert('before')
        //     },
        //     success: function(){
        //         alert('success')
        //     },
        //     error: function(){
        //         alert('error')
        //     },
        // });

    });
}

jQuery(document).ready(function () {
    megamenu();
    megamenuDropdown();
    verticalTabs();
    personalisation();

    //$('form').validate();
});
