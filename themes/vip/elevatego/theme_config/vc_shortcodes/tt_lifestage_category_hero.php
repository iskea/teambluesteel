<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = !empty($css) ? vc_shortcode_custom_css_class( $css ) : '';
$url = vc_build_link( $link );

$background_image = find_right_background_image($background_data);

$user_id = '1';

if (isset($_SESSION['user_id'])) {

	$user_id = $_SESSION['user_id'];
}

$user_followed_author = get_post_meta($user_id, 'elv_personalisations_authors');
$user_followed_authors = array();
if (isset($user_followed_author[0]) && $user_followed_author[0] != '') {
	$user_followed_authors = explode('|', $user_followed_author[0]);
}

$author_id = get_post_meta(get_the_ID(), 'elv_posts_authors');
$author_id_value = 295;
if (isset($author_id[0]) && $author_id[0] != '') {
	$author_id_value = $author_id[0];
}


if($light_dark == "dark") {
	$light_dark = "text-white";
}

$content = wpb_js_remove_wpautop( apply_filters( 'the_content', $content ), true );

$output = '
    <div class="container l-padding-t-3 l-padding-b-3">
		<div class="row">
			<div class="col-md-5 l-padding-b-2 l-padding-t-1 '.$light_dark.'">
				<div class="hero-area">
					<h1>'.$heading.'</h1>
					'.$content.'
                    <form method="post" action="';
                        $output .= get_home_url() . '/dont-not-delete';
                        $output .= '" id="user-follow-form">
                        <input type="hidden" id="user_id" value="'.$user_id.'" name="user_id"/>
                        <input type="hidden" id="user_id_posted_author" value="" name="user_id_posted_author"/>
                        <input type="hidden" id="author_id_posted" value="<?php echo $author_id_value ?>" name="author_id_posted"/>
                        <input type="hidden" id="post_id_posted" value="<?php echo get_the_ID() ?>" name="post_id_posted"/>
                        <input type="hidden" id="code_spliter" value="authorFollow" name="code_spliter"/>
                        <p class="author-followme text-left">';
                         if (in_array($author_id_value, $user_followed_authors)) {
							 $output .= '<button class="btn btn-social active" id="user-authors">Following</button>';
						 } else {
							 $output .= '<button class="btn btn-social" id="user-authors">Follow</button>';
						 }
                        $output .= '</p>
                    </form>
				</div>
			</div>
		</div>
	</div>
	<div class="vertical-tab-bg">
		<div class="vertical-tab-bgimg active">';
if(!$background_video){
	$output .= '<div class="vertical-tab-bgimg active">';
	$output .= '<img class="hero-image-sim img-responsive" src="'. wp_get_attachment_url($background_image).'" />';
	$output .= '</div>';
}else{
	$output .= '<div id="bg-video-container">';
	$output .= '<iframe id="bg" src="https://www.youtube.com/embed/'. $background_video.'?autoplay=1&amp;playlist='.$background_video.'&amp;controls=0&amp;loop=1" frameborder="0"></iframe>';
	$output .= '</div>';
}

$output .= '</div>
	</div>';

$output .= "<script>
$('#user-follow-form').submit(function () {
    var user_id = $('#user_id').val();
    $('#user_id_posted_author').val(user_id);
    // catch the form's submit event
    $.ajax({ // create an AJAX call...
			data: $(this).serialize(), // get the form data
			type: $(this).attr('method'), // GET or POST
			url: $(this).attr('action'), // the file to call
			success: function (response) { // on success..
        $('#number-of-authors').hide();
        $('#number-of-authors_updated').show();
        $('#number-of-authors_updated').html(response); // update the DIV
        $('#user-authors').addClass('active');
    }
		});
		return false; // cancel original event to prevent form submitting
	});
</script>";

print balanceTags($output);
