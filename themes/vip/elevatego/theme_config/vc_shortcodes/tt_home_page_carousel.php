<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = !empty($css) ? vc_shortcode_custom_css_class( $css ) : '';
$url1 = vc_build_link( $plink1 );
$url2 = vc_build_link( $plink2 );
$url3 = vc_build_link( $plink3 );

$pdescription1 = str_replace(array('{br}','{br/}','{br /}'), '<br />', $pdescription1);
$pdescription2 = str_replace(array('{br}','{br/}','{br /}'), '<br />', $pdescription2);
$pdescription3 = str_replace(array('{br}','{br/}','{br /}'), '<br />', $pdescription3);


$custom_js_path = get_template_directory_uri().'/js/elevate-wp_home-carousel.js';

$new_output = '<script src="'.$custom_js_path.'"></script>
<div class="container l-padding-t-1 l-padding-b-5">
		<div class="row">
			<div class="col-md-12 l-padding-t-1 l-padding-b-1">
				<div class="row">
					<div class="h3 offers-text">Exclusive offers</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 vertical-tab-container">
				<div class="hidden-xs col-sm-1 col-md-1 vertical-tab-menu">
					<div class="list-group">
						<a href="#" class="list-group-item active text-center">
							<span class="'.$iconclass1.' hidden-sm"></span><br />'.$pheading1.'</a>
						<a href="#" class="list-group-item text-center">
							<span class="'.$iconclass2.' hidden-sm"></span><br />'.$pheading2.'</a>
						<a href="#" class="list-group-item text-center">
							<span class="'.$iconclass3.' hidden-sm"></span><br />'.$pheading3.'</a>
					</div>
				</div>
				<div class="col-xs-12 col-sm-11 col-md-11 vertical-tab">
					<!-- home loan section -->
					<div class="vertical-tab-content text-center lr-padding-3 active">
						<h1>'. $pdescription1.'</h1>
							<p class="l-padding-t-2"><a href="'.esc_url($url1['url']).'" class="btn btn-primary" title="'.esc_attr($url1['title']).'" target="'.( strlen( $url1['target'] ) > 0 ? esc_attr( $url1['target'] ) : '_self').'">'.esc_attr($url1['title']).'</a></p>
					</div>
					<!-- credit cards section -->
					<div class="vertical-tab-content text-center lr-padding-3">
						<h1>'. $pdescription2.'</h1>
							<p class="l-padding-t-2"><a href="'.esc_url($url2['url']).'" class="btn btn-primary" title="'.esc_attr($url2['title']).'" target="'.( strlen( $url2['target'] ) > 0 ? esc_attr( $url2['target'] ) : '_self').'">'.esc_attr($url2['title']).'</a></p>

					</div>
					<!-- savings account section -->
					<div class="vertical-tab-content text-center lr-padding-3">
						<h1>'. $pdescription3.'</h1>
							<p class="l-padding-t-2"><a href="'.esc_url($url3['url']).'" class="btn btn-primary" title="'.esc_attr($url3['title']).'" target="'.( strlen( $url3['target'] ) > 0 ? esc_attr( $url3['target'] ) : '_self').'">'.esc_attr($url3['title']).'</a></p>

					</div>
				</div>
				<div class="nav-thumbs">
					<ul>
						<li class="active"><a href="#" class="1" data-slide="1">1</a></li>
						<li><a href="#" class="2" data-slide="2">2</a></li>
						<li><a href="#" class="3" data-slide="3">3</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="vertical-tab-bg">
		<div class="vertical-tab-bgimg active">
			<img class="hero-image-sim img-responsive hero-image-static-height" src="'. wp_get_attachment_url($background_image_1).'"  />
		</div>
		<div class="vertical-tab-bgimg">
			<img class="hero-image-sim img-responsive hero-image-static-height" src="'. wp_get_attachment_url($background_image_2).'" />
		</div>
		<div class="vertical-tab-bgimg">
			<img class="hero-image-sim img-responsive hero-image-static-height" src="'. wp_get_attachment_url($background_image_3).'" />
		</div>
	</div>';

//
//$output = '<div class="container l-padding-b-10">';
//$output .= '<div class="row">';
//$output .= '<div class="col-md-12 l-padding-t-1 l-padding-b-1">';
//$output .= '<div class="row">';
//$output .= '<div class="offers-text">Exclusive offers</div>';
//$output .= '</div>';
//$output .= '</div>';
//$output .= '</div>';
//$output .= '<div class="row">';
//$output .= '<div class="col-md-12 col-sm-8 col-xs-9 vertical-tab-container">';
//$output .= '<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 vertical-tab-menu">';
//$output .= '<div class="list-group">';
//$output .= '<a href="#" class="list-group-item active text-center">';
//$output .= '<span class="'.$iconclass1.'"><!-- fill --></span><br />'. $pheading1.'</a>';
//$output .= '<a href="#" class="list-group-item text-center">';
//$output .= '<span class="'.$iconclass2.'"></span><br />'. $pheading2.'</a>';
//$output .= '<a href="#" class="list-group-item text-center">';
//$output .= '<span class="'.$iconclass3.'"></span><br />'. $pheading3.'</a>';
//$output .= '</div>';
//$output .= '</div>';
//$output .= '<div class="col-lg-11 col-md-11 col-sm-11 col-xs-11 vertical-tab">';
//$output .= '<div class="vertical-tab-content text-center active">';
//$output .= '<h2>'. $pdescription1.'</h2>';
//$output .= '<br /> <a href="'.esc_url($url1['url']).'" class="btn btn-primary" title="'.esc_attr($url1['title']).'" target="'.( strlen( $url1['target'] ) > 0 ? esc_attr( $url1['target'] ) : '_self').'">'.esc_attr($url1['title']).'</a>';
//$output .= '</div>';
//$output .= '<div class="vertical-tab-content text-center">';
//$output .= '<h2>'. $pdescription2.'</h2>';
//$output .= '<br /> <a href="'.esc_url($url2['url']).'" class="btn btn-primary" title="'.esc_attr($url2['title']).'" target="'.( strlen( $url2['target'] ) > 0 ? esc_attr( $url2['target'] ) : '_self').'">'.esc_attr($url2['title']).'</a>';
//$output .= '</div>';
//$output .= '<div class="vertical-tab-content text-center">';
//$output .= '<h2>'. $pdescription3.'</h2>';
//$output .= '<br /> <a href="'.esc_url($url3['url']).'" class="btn btn-primary" title="'.esc_attr($url3['title']).'" target="'.( strlen( $url3['target'] ) > 0 ? esc_attr( $url3['target'] ) : '_self').'">'.esc_attr($url3['title']).'</a>';
//$output .= '</div>';
//$output .= '</div>';
//$output .= '</div>';
//$output .= '</div>';
//$output .= '</div>';
//$output .= '<div class="vertical-tab-bg">';
//
//
//
//
//
//if(!$background_video_1){
//    $output .= '<div class="vertical-tab-bgimg active">';
//    $output .= '<img class="hero-image-sim img-responsive" src="'. wp_get_attachment_url($background_image_1).'" />';
//    $output .= '</div>';
//}else{
//    $output .= '<div id="bg-video-container">';
//    $output .= '<iframe id="bg" src="https://www.youtube.com/embed/'. $background_video_1.'?autoplay=1&amp;playlist='.$background_video_1.'&amp;controls=0&amp;loop=1" frameborder="0"></iframe>';
//    $output .= '</div>';
//}
//
//if(!$background_video_2){
//    $output .= '<div class="vertical-tab-bgimg active">';
//    $output .= '<img class="hero-image-sim img-responsive" src="'. wp_get_attachment_url($background_image_2).'" />';
//    $output .= '</div>';
//}else{
//    $output .= '<div id="bg-video-container">';
//    $output .= '<iframe id="bg" src="https://www.youtube.com/embed/'. $background_video_2.'?autoplay=1&amp;playlist='.$background_video_1.'&amp;controls=0&amp;loop=1&amp;showinfo=0&amp;modestbranding=1&amp;disablekb=1&amp;enablejsapi=1" frameborder="0"></iframe>';
//    $output .= '</div>';
//}
//
//
//if(!$background_video_3){
//    $output .= '<div class="vertical-tab-bgimg active">';
//    $output .= '<img class="hero-image-sim img-responsive" src="'. wp_get_attachment_url($background_image_3).'" />';
//    $output .= '</div>';
//}else{
//    $output .= '<div id="bg-video-container">';
//    $output .= '<iframe id="bg" src="https://www.youtube.com/embed/'. $background_video_3.'?autoplay=1&amp;playlist='.$background_video_1.'&amp;controls=0&amp;loop=1&amp;showinfo=0&amp;modestbranding=1&amp;disablekb=1&amp;enablejsapi=1" frameborder="0"></iframe>';
//    $output .= '</div>';
//}




//$output .= '<div class="vertical-tab-bgimg">';
//$output .= '<img class="hero-image-sim img-responsive" src="'. wp_get_attachment_url($background_image_2).'" />';
//$output .= '</div>';
//$output .= '<div class="vertical-tab-bgimg">';
////$output .= '<img class="hero-image-sim img-responsive" src="'. wp_get_attachment_url($background_image_3).'" />';
//$output .= '</div>';
//$output .= '</div>';
//$output .= '</div>';

print balanceTags($new_output);
