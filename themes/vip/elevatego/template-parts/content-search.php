<?php
/**
 * The template part for displaying results in search pages
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

$background_image = get_image_url($post->ID);

?>
	<div class="container">
		<div class="row">
			<div class=" col-md-3" style="padding:0;">
				<img class="img-responsive" src="<?php echo $background_image ?>" alt="<?php echo get_the_title(); ?>">
			</div>
			<div class=" col-md-9">
				<a class="text-black bg-grey-dark dummy-media-object" style="overflow: auto;" href="<?php echo get_permalink(); ?>">
					<p><strong><?php echo get_the_title(); ?></strong></p>
					<p><?php twentysixteen_excerpt(); ?></p>
					<?php
					$all_tags = get_the_tags($post->ID);

					if (!empty($all_tags)) {
						$tagcount = 0;
						foreach ($all_tags as $tag) {
							?>
							<span class="badge"><a href="<?php echo get_home_url() ?>/expertise-tags?title_tag=<?php echo $tag->term_id ?>" class="text-black"><?php echo $tag->name; ?></a></span>
						<?php }
					} ?>
			</div>
		</div>
	</div>
<?php

?>