<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$css_class = !empty($css) ? vc_shortcode_custom_css_class($css) : '';
//$url = vc_build_link( $link );

$post_url = vc_build_link($link);
$post_id = url_to_postid(esc_url($post_url['url']));

$user_id = '1';

if (isset($_SESSION['user_id'])) {
	$user_id = $_SESSION['user_id'];
}
/**
 *
 * Getting user data
 *
 *
 */
$i_article_count = 32;
$author_id = get_article_author_id($post_id);
$all_article_tags = get_the_tags($post_id);
$get_the_title = '';
$get_the_title = get_the_title($post_id);
//var_dump(get_post($post_id));
//$content = get_post($post_id)->post_content;
//$content = wpb_js_remove_wpautop(apply_filters('the_content', $content), true);
$content = get_post_trimmed_content($post_id, 200);

$number_of_likes_value = get_number_of_post_likes(get_the_ID());
$number_of_dislikes_value = get_number_of_post_dislikes(get_the_ID());

$form_post_url = EXPERTISE_AJAX_URL;
$user_followed_authors = has_user_followed_author($user_id);
$user_bookmark_posts = has_user_bookmarked($user_id);

$user_liked_posts = has_user_liked($user_id);
$user_disliked_posts = has_user_disliked($user_id);

$create_follow_button = create_author_follow_button(
	$post_id,
	$form_post_url,
	'user-follow-form',
	'user_id_posted_author',
	'code_spliter',
	'post_id_posted',
	'author_id_posted',
	$author_id,
	$user_followed_authors,
	'btn btn-social btn-block',
	'user-authors',
	'author-followme text-center',
	'authorFollow'
);

$create_bookmark_button = create_expertise_buttons(
	get_the_ID(),
	$form_post_url,
	'user-bookmark-form',
	'user_id_posted_bookmark',
	'code_spliter',
	'post_id_posted',
	'author_id_posted',
	$author_id,
	$user_bookmark_posts,
	'picon picon-0035-bookmark-tag',
	'user-bookmark',
	'number-of-bookmarks_updated',
	'number-of-bookmarks',
	'',
	'',
	'articleBookmark'
);

$create_like_button = create_expertise_buttons(
	get_the_ID(),
	$form_post_url,
	'user-like-form_footer',
	'user_id_posted_like_footer',
	'code_spliter',
	'post_id_posted',
	'author_id_posted',
	$author_id,
	$user_liked_posts,
	'picon picon-0663-like-thumb-up-vote inline-icon thumbs-up',
	'user-liked_footer',
	'number-of-likes',
	'number-of-likes_updated_footer',
	'thumbs-up-numvote',
	$number_of_likes_value,
	'like'
);

$create_dislike_button = create_expertise_buttons(
	get_the_ID(),
	$form_post_url,
	'user-dislike-form_footer',
	'user_id_posted_dislike_footer',
	'code_spliter',
	'post_id_posted',
	'author_id_posted',
	$author_id,
	$user_disliked_posts,
	'picon picon-0664-dislike-thumb-down-vote inline-icon thumbs-down',
	'user-disliked_footer',
	'number-of-dislikes',
	'number-of-dislikes_updated_footer',
	'thumbs-down-numvote',
	$number_of_dislikes_value,
	'dislike'
);

$output = '<div class="container-fluid l-padding-t-2 l-padding-b-2 parallax-bg " style="background-image: url(' . wp_get_attachment_url(get_post_thumbnail_id($post_id)) . '">
	<div class="container lifestage-feature fixed-height">
		<div class="row">
			<div class="col-md-9 lifestage-stick-to-bottom left">
				<div class="row l-padding-t-3">
					<div class="col-md-5 feature-expertise-label">
						<div class="col-md-12 col-md-offset-4">Featured Expertise</div>
					</div>
				</div>
				<div class="row bg-white">
                	<div class="col-xs-12 col-sm-3 col-md-3 l-padding-b-2 author-left-column">  
					<img src="' . get_elevate_author_featured_image($author_id) . '" class="img-circle chat-thumbnail author-pic img-responsive" alt="" />
					<h4 class="author-description text-center">
						<small><em>' . get_elevate_author_bio($author_id) . '</em></small>
					</h4>
					<h4 class="author-stats">
						<small><strong>' . $i_article_count . '</strong>&nbsp;Articles</small>
						<small><strong>' . get_elevate_author_followers($author_id) . '</strong>&nbsp;Followers</small>
					</h4>
					' . $create_follow_button . '
				</div>
				<div class="col-xs-12 col-sm-9 col-md-9 l-padding-b-2">
					<div class="row">
						<div class="col-sm-12 col-md-12">
							<h2 class="article-details">
							<span class="article-title">'.$get_the_title.'</span>
							</h2>
							<h3>
								<small class="article-date"><strong>' . get_post($post_id)->post_date . '</strong></small>
								<!--<small class="article-views"><em>216 views</em></small>-->
							</h3>
							<p class="author-details">
								<a href="' . get_home_url() . '/expertise-author/?author_post_id=' . $author_id . '"><span class="author-name">' . get_elevate_author_name($author_id) . '</span></a>
								<span class="author-title">' . get_elevate_author_tagline($author_id) . '</span>
							</p>
						</div>
					</div>
					<div class="row">
						<div class=" col-sm-12 col-md-12">
								' . nl2br($content) . '
								<!--<a href="' . get_permalink($post_id) . '">Read more</a>-->
						</div>
					</div>
					<div class="social-action">
<h4 class="pull-left">';
$output .= $create_like_button;
$output .= '</h4>';
$output .= '<h4 class="pull-left">';
$output .= $create_dislike_button;

$output .= '</h4></div>
					<div class="bookmark-icon pull-right">
						' . $create_bookmark_button . '
					</div>
				</div>
			</div>
			</div>
			<div class="col-md-3 calculator lifestage-stick-to-bottom right">';
$output .= live_chat_area();
$output .= '</div>
		</div>
	</div>
</div>';

$output .= '<script>' . create_ajax_calls('user-follow-form', 'user_id', 'user_id_posted_author', 'number-of-authors', 'number-of-authors_updated', 'user-authors') . '</script>';

$output .= '<script>' . create_ajax_calls(
		'user-bookmark-form',
		'user_id',
		'user_id_posted_bookmark',
		'number-of-bookmarks',
		'number-of-bookmarks_updated',
		'user-bookmark'
	) . '</script>';

print balanceTags($output);
