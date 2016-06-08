<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = !empty($css) ? vc_shortcode_custom_css_class( $css ) : '';
$args = array(
	'post_type' => 'post',
	'category_name' =>  $tesla_category,
	'showposts' => $nr_posts ? (int)$nr_posts : get_option('posts_per_page'),
);

$tt_query = new WP_Query($args);
?>

<div class="tt-blog-feed <?php echo esc_attr($css_class.' '.$el_class);?>">            
    <?php while($tt_query->have_posts()): $tt_query->the_post(); 
        get_template_part('templates/blog-post');
    endwhile; ?>
</div>