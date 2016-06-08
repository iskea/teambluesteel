<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = !empty($css) ? vc_shortcode_custom_css_class( $css ) : '';
//$url = vc_build_link( $link );

$link_tabs = '';

$menu_data_s = (array)vc_param_group_parse_atts($menu_data);
$description_string = '';
$active = 0;
$active_class = 'active';
foreach ($menu_data_s as $menu_data_p) {
	if($active > 0){
		$active_class = '';
	}
	$link_tabs .= '<a href="#" class="list-group-item '.$active_class.'" data-bg="'.wp_get_attachment_url($menu_data_p['background_image']).'">
							<div class="icon"><span class="'.$menu_data_p['icon_typicons'].'"></span></div>
							<div class="caption"><h4>'.$menu_data_p['name'].'</h4></div>
						</a> ';
	$description_string .= '<div class="vertical-tab-content lr-padding-3 '.$active_class.'">
						<h3>'.$menu_data_p['name'].'</h3>
						<p class="">'.$menu_data_p['description'].'</p>
					</div>';
	$active++;
}

$custom_js_path = get_template_directory_uri().'/js/elevate-wp_product-carousel.js';


$r = '<script src="'.$custom_js_path.'"></script><div class="container-fluid bg-grey">
	<div class="container l-padding-t-2">
		<h4>Additional features</h4>
		<h2>Peace of mind when you travel and shop</h2>
	</div>
	<div class="container l-padding-b-2">
		<div class="row">
			<div class="col-md-12 col-sm-8 col-xs-9 vertical-tab-container additional-features dark-gradient-btm">
				<div class="col-md-3 vertical-tab-menu">
					<div class="list-group">
					'.$link_tabs.'
					</div>
				</div>
				<div class="col-md-9 vertical-tab">
					'.$description_string.'
				</div>
			</div>
		</div>
	</div>
</div>';
print balanceTags($r);


