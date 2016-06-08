<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$css_class = !empty($css) ? vc_shortcode_custom_css_class($css) : '';

// do the author loop
$a = array();

$r = implode('<br />', $a);

$query = new WP_Query(array('post_type' => 'elv_authors'));

$html = '';

$html_opener = '<!-- Code Added --><div class="container tile-columns"><div class="row l-padding-t-2 l-padding-b-2 column-content">';
$html_closer = '</div></div><!-- Code Closed -->';

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

$count = 0;
if ($query->have_posts()) {
	while ($query->have_posts()) {
		$query->the_post();

		if ($count % 3 == 0) {
			$html .= $html_opener;
		}

		$html .= '<div class="col-md-4 l-padding-b-1">
				<div class="bg-white feature-tile author-tile author-tile">
					<div class="tile-body text-center">
						<img src="' . wp_get_attachment_url(get_post_thumbnail_id()) . '" class="img-circle" width="200" height="200">
						<h3><strong>' . get_the_title() . '</strong></h3>
						<h4 class="author-stats">
							<small><strong>' . count(explode('|', get_post_meta(get_the_ID(), 'elv_authors_follower_id', true))) . '</strong>&nbsp;Followers</small>
						</h4>
						<h4 class="author-description">
							<small>' . get_post_meta(get_the_ID(), 'elv_authors_tag_line', true) . '</small>
						</h4>
						<h4><a href="' . get_home_url() . '/expertise-author?author_post_id=' . get_post_meta(get_the_ID(), "elv_posts_authors", true) . '">View profile</a> </h4>';
			if (in_array($author_id_value, $user_followed_authors)) {
				$html .= '<button class="btn btn-social active" id="user-authors">Following</button>';
			} else {
				$html .= '<button class="btn btn-social" id="user-authors">Follow</button>';
			}
		$html .= '</div>
				</div>
			</div>';

		if (($count + 1) % 3 == 0) {
			$html .= $html_closer;

		}

		$count++;
	}
}

if (($count + 1) % 3 != 0) {
	$html .= $html_closer;
}

$html .= '<!-- Code Closed -->';

print balanceTags($html);

?>





