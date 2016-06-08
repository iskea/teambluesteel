function pushPs( options ){
    var fp = {
        excludeLanguage: true,
        excludeUserAgent: true,
        excludeScreenResolution: true,
        excludeAvailableScreenResolution: true,
        excludePlugins: true,
        excludeIEPlugins: true,
        //excludeColorDepth: true,
        //excludeTimezoneOffset: true,
        //excludeSessionStorage: true,
        //excludeIndexedDB: true,
        //excludeAddBehavior: true,
        //excludeOpenDatabase: true,
        //excludeCpuClass: true,
        //excludePlatform: true,
        excludeDoNotTrack: true,
        excludeCanvas: true,
        excludeWebGL: true,
        excludeAdBlock: true,
        excludeHasLiedLanguages: true,
        //excludeHasLiedResolution: true,
        //excludeHasLiedOs: true,
        //excludeHasLiedBrowser: true,
    };
    // new Fingerprint2(fp).get(function( hash, o ){
    //     var data = {
    //         'action': 'push_ps',
    //         'h': hash,
    //         'o': options
    //     };
    //     //alert( hash );
    //     console.log(o);
    //     jQuery.post(ajaxurl, data, function(response) {
    //         //console.log('Got this from the server: ' + hash);
    //     });
    // });
}

function getPs(){
    var fp = {
        excludeLanguage: true,
        excludeUserAgent: true,
        excludeScreenResolution: true,
        excludeAvailableScreenResolution: true,
        excludePlugins: true,
        excludeIEPlugins: true,
        //excludeColorDepth: true,
        //excludeTimezoneOffset: true,
        //excludeSessionStorage: true,
        //excludeIndexedDB: true,
        //excludeAddBehavior: true,
        //excludeOpenDatabase: true,
        //excludeCpuClass: true,
        //excludePlatform: true,
        excludeDoNotTrack: true,
        excludeCanvas: true,
        excludeWebGL: true,
        excludeAdBlock: true,
        excludeHasLiedLanguages: true,
        //excludeHasLiedResolution: true,
        //excludeHasLiedOs: true,
        //excludeHasLiedBrowser: true,

    };
    // new Fingerprint2(fp).get(function( hash, o ){
    //     var data = {
    //         'action': 'get_ps',
    //         'h': hash
    //     };
    //     jQuery.post(ajaxurl, data, function(url) {
    //         if(url){
    //             //window.location.replace(url);
    //         }
    //     });
    // });
}

// personalisation data
var i_ps = 1;
jQuery(document).ready(function () {
    pushPs( i_ps );
    getPs();
});

//aafd567aecfccfc19ea99e9c9cc4fd92
//aafd567aecfccfc19ea99e9c9cc4fd92

//628546a220207054f037a0c8eca92fdb
