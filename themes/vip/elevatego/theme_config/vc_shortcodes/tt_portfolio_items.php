<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = !empty($css) ? vc_shortcode_custom_css_class( $css ) : '';
$items_array = (array) vc_param_group_parse_atts( $portfolio_items );
?>

<div class="gallery-wrapper <?php echo esc_attr($css_class.' '.$el_class);?>">
	<?php if(!empty($items_array)):?>
	<div class="row row-fit-10">
		<?php foreach ($items_array as $key => $tab): ?>
			<div class="col-md-<?php echo esc_attr($columns);?> col-xs-<?php echo esc_attr($columns);?>">
				<div class="portfolio-item">
					<a class="image-popup-no-margins photozoom" href="<?php echo wp_get_attachment_url($tab['item_cover']);?>" data-title="<?php echo esc_attr($tab['item_title']);?>" data-cats="<?php echo esc_attr($tab['item_cat']);?>">
				        <img src="<?php echo wp_get_attachment_url($tab['item_thumb']);?>">
				    </a>

				    <div class="hover">
						<h5><?php print $tab['item_title'];?></h5>
						<p><?php print $tab['item_cat'];?></p>
					</div>
				</div>
			</div>

		<?php endforeach;?>
	</div>
	<?php endif;?>
</div>