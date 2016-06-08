/**
 * Elevate WP  v1.0.0
 */

//PRODUCT PAGE - VERTICAL TABS CAROUSEL
$(window).load(function () {
    // starting index
    var currTab = 1;
    // count of all tabs
    var totalTabs = $("div.additional-features div.vertical-tab-menu div.list-group > a").length;
    var backgroundImageURL=$("div.additional-features div.vertical-tab-menu div.list-group > a:nth-of-type(1)").attr("data-bg");
    $("div.additional-features").css("background", "url("+backgroundImageURL +")");

    if (totalTabs > 1) {

        //Bind transition click
        $('div.additional-features div.vertical-tab-menu div.list-group > a').click(function (e) {
            e.preventDefault();
            currTab = $(this).index();
            cycleTabs();
        });
    }

    function cycleTabs() {
        // increment counter
        currTab++;

        // reset if we're at the last one
        if (currTab == totalTabs + 1) {
            currTab = 1;
        }

        backgroundImageURL=$("div.additional-features div.vertical-tab-menu div.list-group > a:nth-of-type(" + (currTab) + ")").attr("data-bg");
        //alert(backgroundImageURL);

        if (totalTabs) {
            $("div.additional-features div.vertical-tab-menu div.list-group > a").removeClass("active");
            $("div.additional-features div.vertical-tab-menu div.list-group > a:nth-of-type(" + (currTab) + ")").addClass("active");
            $("div.additional-features div.vertical-tab>div.vertical-tab-content").removeClass("active");
            $("div.additional-features div.vertical-tab>div.vertical-tab-content:nth-of-type(" + (currTab) + ")").addClass("active");
            $("div.additional-features").css("background", "url("+backgroundImageURL +")");
        }
    }
});
