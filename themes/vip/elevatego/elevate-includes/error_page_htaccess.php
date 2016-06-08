<?php

/** This file contains all the global functions */


/**
 *
 * Error pages
 *
 */

// Create Custom Error Pages in WordPress using HTACCESS
function royal_custom_error_pages() {
    $error_pages = '';
    // Get HTACCESS path & dynamic website url
    $htaccess_file = '.htaccess';
    $website_url = get_bloginfo('url').'/';

    // Check & prevent writing error pages more than once
    $check_file = file_get_contents($htaccess_file);
    $this_string = '# BEGIN WordPress Error Pages';

    if( strpos( $check_file, $this_string ) === false) {

        // Setup Error page locations dynamically
        $error_pages .= PHP_EOL. PHP_EOL . '# BEGIN WordPress Error Pages'. PHP_EOL. PHP_EOL;
        $error_pages .= 'ErrorDocument 401 '.$website_url.'error-401'.PHP_EOL;
        $error_pages .= 'ErrorDocument 403 '.$website_url.'error-403'.PHP_EOL;
        $error_pages .= 'ErrorDocument 404 '.$website_url.'error-404'.PHP_EOL;
        $error_pages .= 'ErrorDocument 500 '.$website_url.'error-500'.PHP_EOL;
        $error_pages .= PHP_EOL. '# END WordPress Error Pages'. PHP_EOL;

        // Write the error page locations to HTACCESS
        $htaccess = fopen( $htaccess_file, 'a+');
        fwrite( $htaccess, $error_pages );
        fclose($htaccess);

    }
}

add_action('init','royal_custom_error_pages'); // This will run the function everytime, not ideal!

// register_activation_hook( __FILE__, 'royal_custom_error_pages' ); // Using a plugin, runs only once!
