<?php

/*
 *
 * Template Name: Blank Page
 *
 * @package Wordpress
 *
*/

get_header(); ?>



<div id="primary">
    <main id="main" class="site-main" role="main">

        <?php



        $query = new WP_Query(array('post_type' => 'elv_authors'));

        if ($query->have_posts()) :

            while ($query->have_posts()) : $query->the_post();

            

            endwhile;
            wp_reset_postdata();
        else :

        endif;



        $id = get_post();
        $post = get_post($id);
        $content = apply_filters('the_content', $post->post_content);
        echo $content;

        ?>


    </main><!-- .site-main -->


</div><!-- .content-area -->

<?php get_footer(); ?>

