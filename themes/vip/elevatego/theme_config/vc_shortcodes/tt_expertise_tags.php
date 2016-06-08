<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = !empty($css) ? vc_shortcode_custom_css_class( $css ) : '';

$filter_main_tag = '';

if(isset($_REQUEST['tile_tag'])) {

	$filter_main_tag = get_tag($_REQUEST['tile_tag'])->name;

}


$html = '<div class="container-fluid bg-white l-padding-b-2">
	<div class="container">
		<div class="col-md-12 l-padding-b-2 pull-up-1-5em">
			<div class="col-md-2 feature-expertise-label">Browsing tag:</div>
		</div>
		<div class="col-md-12 center-block text-center"><h3>"'.$filter_main_tag.'"</h3></div>
	</div>
</div>
';

print balanceTags($html);


