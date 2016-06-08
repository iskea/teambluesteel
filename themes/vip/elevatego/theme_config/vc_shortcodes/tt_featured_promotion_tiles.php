<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = !empty($css) ? vc_shortcode_custom_css_class( $css ) : '';


$menu_data_s = (array) vc_param_group_parse_atts( $background_data );
$products_pages = '';
    foreach ($menu_data_s as $menu_data_p) {
        $url = vc_build_link( $menu_data_p['btn_link']);
    $products_pages .= '<div class="grid-item animate col-md-4 l-padding-b-1">
				<div class="feature-tile fixed-height-420 dark-gradient-btm" style="background-image: url('. wp_get_attachment_url($menu_data_p['background_image']).');">
					<div class="tile-body">
						<h3 class="text-white">
							'.$menu_data_p['tile_heading'].'
						</h3>
						<p class="text-white">'.$menu_data_p['tile_description'].'</p>
						<div class="tile-link">
							<a href="'.esc_url($url['url']).'" class="" title="'.esc_attr($url['title']).'" target="'.( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self').'">'.esc_attr($url['title']).'</a>
						</div>
					</div>
				</div>
			</div>';
    }


$output = '<div class="container-fluid bg-white l-padding-t-2 l-padding-b-2">
	<div class="container tile-columns static-columns">
		<h4>'.$main_heading.'</h4>
		<h2>'.$sub_heading.'</h2>
		<div class="column-content">
            '.$products_pages.'
		</div>
	</div>
</div>';
print balanceTags($output);
