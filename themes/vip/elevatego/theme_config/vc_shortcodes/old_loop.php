<?php get_header();

/*
$my_query = new WP_Query( 'category_name=featured&posts_per_page=1' );
while ( $my_query->have_posts() ) : $my_query->the_post();
    $do_not_duplicate = $post->ID; ?>
    <!-- Do stuff... -->
endwhile;
*/


$a_args = array(
    'post_type' => 'elv_tiles',
    'posts_per_page' => 9,
);

$s_tiles  = '';
$s_tiles  .= '
<div class="container tile-columns">
	<div class="row l-padding-t-2">
		<div class="col-md-8 col-md-push-2 l-padding-t-1 center-block">
			<ul class="nav nav-pills nav-justified">
				<li role="presentation" class="active"><a href="#">All</a></li>
				<li role="presentation"><a href="#">Save</a></li>
				<li role="presentation"><a href="#">Borrow</a></li>
				<li role="presentation"><a href="#">Rewards</a></li>
				<li role="presentation"><a href="#">Expertise</a></li>
			</ul>
		</div>
	</div>
	<div class="row l-padding-t-2 l-padding-b-2 column-content">' . PHP_EOL;

if ( is_front_page() ) {
    $o_query = new WP_Query( $a_args );
    if ( $o_query->have_posts() ):
        while ( $o_query->have_posts() ) : $o_query->the_post();

            // get the categories without the link
            $o_cat = null;
            $o_cat = get_the_category();

            $a_cat = array();
            if ( ! empty( $o_cat ) ) {
                foreach( $o_cat as $o ) {
                    $a_cat[] =  esc_html( $o->name );
                }
            }

            $s_cat = '';
            $s_cat = implode(', ', $a_cat);

            $s_class = '';
            $s_class = get_post_meta(get_the_ID(), 'elv_tiles_class', true);

            $s_link = '';
            $s_link = get_post_meta(get_the_ID(), 'elv_tiles_link', true);

            $s_inline_style = '';
            $s_featured_img_url = '';
            $s_featured_img_url = get_the_post_thumbnail_url();

            if( $s_featured_img_url != '' ){
                $s_inline_style = ' style="background-image: url(' . $s_featured_img_url . ');"';
            }

            $s_tiles .= '
        <div class="col-md-4 l-padding-t-1 l-padding-b-1">
			<div class="' . $s_class . ' feature-tile"' . $s_inline_style . '>
				<div class="tile-head"><span class="h1">' . $s_cat . '</span></div>
				<div class="tile-body">
					'. nl2br( get_the_content() ) .'
					<div class="tile-link">
						<a href="' . $s_link . '">Learn more</a>
					</div>
				</div>
			</div>
		</div>' . PHP_EOL;

        endwhile;
    else:
        wp_die('no posts');
    endif;

    wp_reset_postdata();

    $s_tiles .= '	</div>' . PHP_EOL . '</div>';
    echo $s_tiles;
}


// zones example
// https://wordpress.org/support/topic/plugin-zone-manager-zoninator-add-specific-custom-post-types
/*
$zone_query = z_get_zone_query( 'test' );
if ( $zone_query->have_posts() ) :
    while ( $zone_query->have_posts() ) : $zone_query->the_post();
        echo '<li>' . get_the_title() . '</li>';
    endwhile;
endif;
wp_reset_query();
*/

wp_footer();