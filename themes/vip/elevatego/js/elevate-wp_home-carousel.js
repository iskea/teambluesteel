/**
 * Elevate WP  v1.0.0
 */

//HOME PAGE - VERTICAL TABS CAROUSEL
$(window).load(function () {
    // starting index
    var currTab = 1;
    // count of all tabs
    var totalTabs = $("div.vertical-tab-menu div.list-group > a").length;

    if (totalTabs > 1) {
        //Start transition loop
        var i = setInterval(cycleTabs, 5000);

        //Bind transition click
        $('div.vertical-tab-menu div.list-group > a').click(function (e) {
            e.preventDefault();
            currTab = $(this).index();
            cycleTabs();
            clearTimeout(i);
            i = setInterval(cycleTabs, 5000);
        });
    }

    function cycleTabs() {
        // increment counter
        currTab++;

        // reset if we're at the last one
        if (currTab == totalTabs + 1) {
            currTab = 1;
        }

        if (totalTabs) {
            $("div.vertical-tab-menu div.list-group > a").removeClass("active");
            $("div.vertical-tab-menu div.list-group > a:nth-of-type(" + (currTab) + ")").addClass("active");
            $("div.nav-thumbs>ul>li").removeClass("active");
            $("div.nav-thumbs>ul>li:nth-of-type(" + (currTab) + ")").addClass("active");
            $("div.vertical-tab>div.vertical-tab-content").removeClass("active");
            $("div.vertical-tab>div.vertical-tab-content:nth-of-type(" + (currTab) + ")").addClass("active");
            $("div.vertical-tab-bg>div.vertical-tab-bgimg").removeClass("active");
            $("div.vertical-tab-bg>div.vertical-tab-bgimg:nth-of-type(" + (currTab) + ")").addClass("active");
        }
    }
});
