<?php

/*
 *
 * Template Name: Full BG Page
 *
 * @package Wordpress
 *
*/

get_header();

$id = get_post();
$post = get_post($id);
$content = apply_filters('the_content', $post->post_content);

?>

<div id="primary" style="background-image: url("<?php echo wp_get_attachment_url( get_post_thumbnail_id($id) ); ?>")">
    <main id="main" class="site-main" role="main">

        <?php

        echo $content;

        ?>


    </main><!-- .site-main -->


</div><!-- .content-area -->

<?php get_footer(); ?>

