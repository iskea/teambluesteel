<?php

/*
 *
 * Template Name: Personalised Home
 *
 * @package Wordpress
 *
*/

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main row" role="main">
        <?php
        // Start the loop.
        while ( have_posts() ) : the_post();

            // Include the page content template.
            get_template_part( 'template-parts/content', 'page' );
        
            // End of the loop.
        endwhile;

        ?>

    </main><!-- .site-main -->

    <?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php // get_sidebar(); ?>

<?php get_footer(); ?>

