<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$css_class = !empty($css) ? vc_shortcode_custom_css_class($css) : '';

if (isset($_REQUEST['author_post_id'])) {
	$author_id = $_REQUEST['author_post_id'];
} else {
	$author_id = url_to_postid(esc_url(get_home_url() . '/blog/elv_authors/ian-skea/'));
}
$user_id = '1';

if (isset($_SESSION['user_id'])) {
	$user_id = $_SESSION['user_id'];
}
$user_followed_author = get_post_meta($user_id, 'elv_personalisations_authors');
$user_followed_authors = array();
if (isset($user_followed_author[0]) && $user_followed_author[0] != '') {
	$user_followed_authors = explode('|', $user_followed_author[0]);
}

$author_featured_image = get_elevate_author_featured_image($author_id);

$content_post = get_post($author_id);

$author_description = $content_post->post_content;
$get_followers = get_post_meta($author_id, 'elv_authors_follow_id', true);

$a_get_followers = explode('|', $get_followers);

$html = '<div class="container-fluid bg-white l-padding-t-1 elevate-article-top-content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-2 pull-up-3em">
					<img src="' . $author_featured_image . '" class="img-circle chat-thumbnail author-pic img-responsive" alt=""/>
				</div>
				<div class="col-md-2">
					<h4 class="author-description filter-by-author text-center">
						<small><em>' . get_post_meta($author_id, 'elv_authors_tag_line')[0] . '</em></small>
					</h4>
					<h4 class="author-stats">
						<small><strong>4</strong>&nbsp;Articles</small>
						<small><strong>' . count($a_get_followers) . '</strong>&nbsp;Followers</small>
					</h4>';
if (in_array($author_id, $user_followed_authors)) {
	$html .= '<button class="btn btn-social active" id="user-authors">Following</button>';
} else {
	$html .= '<button class="btn btn-social" id="user-authors">Follow</button>';
}
$html .= '</div>
				<div class="col-md-5 l-padding-t-2">
					<p>' . $author_description . '</p>
				</div>
			</div>
		</div>
	</div>
</div>
';

print balanceTags($html);