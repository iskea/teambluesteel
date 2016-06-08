<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = !empty($css) ? vc_shortcode_custom_css_class( $css ) : '';
$url = vc_build_link( $link );

if($type == 'right'){
    $type = 'pull-right';
}else{
    $type = 'pull-left';
}

$persona = 1;

$content = wpb_js_remove_wpautop( apply_filters( 'the_content', $content ), true );
if(isset($_SESSION['persona_updated'])){
    $persona = $_SESSION['persona_updated'];
} else if(isset($_SESSION['persona'])){
    $persona = $_SESSION['persona'];
} else{
}


$a_background_data = (array) vc_param_group_parse_atts( $background_data );
$background_images = array();
foreach ($a_background_data as $background_data_s) {

    $background_images[$background_data_s['persona_number']] = $background_data_s['background_image'];

}

$main_background_image = '';


if(isset($background_images[$persona])){

    if (!$background_images[$persona]) {
        $main_background_image = '';
    } else {
        $main_background_image = $background_images[$persona];
    }

} else{
    $main_background_image = '';
}



$output = '<div class="container-fluid product-feature">
 <img class="img-responsive feature-background" src="'.wp_get_attachment_url($main_background_image).'">
	<div class="container">
		<div class="row l-padding-t-5 l-padding-b-5">
			<div class="col-md-6 bg-white l-padding-b-1 '.$type.'">
				'.$content.'
                 <div>
				<a href="'.esc_url($url['url']).'" class="btn btn-default" title="'.esc_attr($url['title']).'" target="'.( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self').'">'.esc_attr($url['title']).'</a>
                   </div>
			</div>
			<div class="col-md-6">
				<!-- fill -->
			</div>

		</div>
	</div>
</div>';
print balanceTags($output);
