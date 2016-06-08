<?php
/**
 * The template part for displaying single posts
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

$user_id = '1';

if (isset($_SESSION['user_id'])) {

	$user_id = $_SESSION['user_id'];
}

/**
 *
 * Getting user data
 *
 */
$user_liked_posts = has_user_liked($user_id);
$user_disliked_posts = has_user_disliked($user_id);
$user_bookmark_posts = has_user_bookmarked($user_id);
$user_followed_authors = has_user_followed_author($user_id);
$author_id_value = get_article_author_id($user_id);
$author_id = $author_id_value;

/**
 *
 *
 * Getting author data
 *
 */
$author_name = get_elevate_author_name($author_id_value);
$author_content = get_elevate_author_bio($author_id_value);
$author_tag_line = get_elevate_author_tagline($author_id_value);
$number_author_followers = get_elevate_author_followers($author_id_value);
$author_featured_image = get_elevate_author_featured_image($author_id_value);

/**
 *
 *
 * Getting post data
 *
 *
 */
$number_of_likes_value = get_number_of_post_likes(get_the_ID());
$number_of_dislikes_value = get_number_of_post_dislikes(get_the_ID());
$all_article_tags = get_the_tags();
// bold to first 2 words
$get_the_title = '';
$get_the_title = get_the_title();
$s_title = bold_first_words($get_the_title, 3);

/**
 *
 * Custom Data
 *
 */
$form_post_url = EXPERTISE_AJAX_URL;
$i_article_count = 32;
$post_id = get_the_ID();

?>
<input type="hidden" id="user_id" value="<?php echo $user_id ?>" name="user_id" />
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="container l-padding-t-3 l-padding-b-10">
		<div class="row">
			<div class="col-md-8 col-md-offset-1 hero-container">
				<!-- credit cards section -->
				<div class="hero-content">
					<div class="bookmark-icon pull-right">
						<?php echo create_expertise_buttons(
							get_the_ID(),
							$form_post_url,
							'user-bookmark-form',
							'user_id_posted_bookmark',
							'code_spliter',
							'post_id_posted',
							'author_id_posted',
							$author_id_value,
							$user_bookmark_posts,
							'picon picon-0035-bookmark-tag',
							'user-bookmark',
							'number-of-bookmarks_updated',
							'number-of-bookmarks',
							'',
							'',
							'articleBookmark'
						); ?>
					</div>
					<h2>
						<?php echo $s_title; ?>
					</h2>
					<div class="social-action">
						<h4 class="pull-left">
							<?php echo create_expertise_buttons(
								get_the_ID(),
								$form_post_url,
								'user-like-form',
								'user_id_posted_like',
								'code_spliter',
								'post_id_posted',
								'author_id_posted',
								$author_id_value,
								$user_liked_posts,
								'picon picon-0663-like-thumb-up-vote inline-icon thumbs-up',
								'user-liked',
								'number-of-likes',
								'number-of-likes_updated',
								'thumbs-up-numvote',
								$number_of_likes_value,
								'like'
							); ?>
						</h4>
						<h4 class="pull-left">
							<?php echo create_expertise_buttons(
								get_the_ID(),
								$form_post_url,
								'user-dislike-form',
								'user_id_posted_dislike',
								'code_spliter',
								'post_id_posted',
								'author_id_posted',
								$author_id_value,
								$user_disliked_posts,
								'picon picon-0664-dislike-thumb-down-vote inline-icon thumbs-down',
								'user-disliked',
								'number-of-dislikes',
								'number-of-dislikes_updated',
								'thumbs-down-numvote',
								$number_of_dislikes_value,
								'dislike'
							); ?>
						</h4>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="vertical-tab-bg">
		<div class="vertical-tab-bgimg active">
			<?php echo get_the_post_thumbnail(get_the_ID(), 'full', array('alt' => the_title_attribute('echo=0'), 'class' => 'hero-image-sim img-responsive')); ?>
		</div>
	</div>
	</div>
	<!--

     Feature area

    -->
	<div class="container-fluid bg-white l-padding-t-1 elevate-article-top-content">
		<div class="container">
			<div class="row">
				<!--Author details-->
				<div class="col-xs-12 col-sm-12 col-md-2 author-left-column">
					<div class="row">
						<div class="col-xs-3 col-sm-3 col-md-12">
							<div class="row">
								<img src="<?php echo $author_featured_image ?>" class="img-circle chat-thumbnail author-pic img-responsive" alt="" />
							</div>
						</div>
						<div class="col-xs-9 col-sm-9 col-md-12">
							<h5 class="author-description text-center">
								<small><em><?php echo $author_content; ?></em></small>
							</h5>
							<h5 class="author-stats">
								<small><strong><?php echo $i_article_count; ?></strong>&nbsp;Articles</small>
								<small><strong><?php echo $number_author_followers; ?></strong>&nbsp;Followers</small>
							</h5>
							<?php echo create_author_follow_button(
								$post_id,
								$form_post_url,
								'user-follow-form',
								'user_id_posted_author',
								'code_spliter',
								'post_id_posted',
								'author_id_posted',
								$author_id_value,
								$user_followed_authors,
								'btn btn-social btn-block',
								'user-authors',
								'author-followme text-center',
								'authorFollow'
							); ?>
							<h4 class="hidden-xs hidden-sm author-filter">
								<small>Tags</small>
							</h4>
							<p class="hidden-xs hidden-sm author-filter-tags">
								<?php
								if (wp_get_post_tags(get_the_ID())) {
									$tags = wp_get_post_tags(get_the_ID());

									foreach ($tags as $tag) {
										?>
										<a href="<?php echo get_home_url() ?>/expertise-tags?tile_tag=<?php echo $tag->term_id ?>">
											<span class="badge"><?php echo $tag->name ?></span> </a>
										<?php
									}
								}

								?>
							</p>
						</div>
					</div>
				</div>
				<!--Article content-->
				<div class="col-xs-12 col-sm-12 col-md-10">
					<div class="col-md-12">
						<div class="row">
							<h5>
								<small class="article-date"><strong><?php echo get_the_date('d F Y'); ?></strong>
								</small>
								<small class="article-views"><em>216 views</em></small>
							</h5>
							<p class="author-details">
								<a href="<?php echo get_home_url() ?>/expertise-author/?author_post_id=<?php echo $author_id ?>"><span class="author-name"><?php echo $author_name; ?></span></a>
								<span class="author-title"><?php echo $author_tag_line; ?></span>
							</p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-8 col-md-offset-2 l-padding-b-1">
							<div class="row"><?php nl2br(the_content()); ?></div>
							<div class="row">
								<div class="elevate-article-helpful-feature-box bg-grey">
									<h4 class="article-helpful-feature-heading">Did you find this helpful?</h4>
									<div class="social-action">
										<h4 class="pull-left">
											<?php echo create_expertise_buttons(
												get_the_ID(),
												$form_post_url,
												'user-like-form_footer',
												'user_id_posted_like_footer',
												'code_spliter',
												'post_id_posted',
												'author_id_posted',
												$author_id_value,
												$user_liked_posts,
												'picon picon-0663-like-thumb-up-vote inline-icon thumbs-up',
												'user-liked_footer',
												'number-of-likes',
												'number-of-likes_updated_footer',
												'thumbs-up-numvote',
												$number_of_likes_value,
												'like'
											); ?>
										</h4>
										<h4 class="pull-left">
											<?php echo create_expertise_buttons(
												get_the_ID(),
												$form_post_url,
												'user-dislike-form_footer',
												'user_id_posted_dislike_footer',
												'code_spliter',
												'post_id_posted',
												'author_id_posted',
												$author_id_value,
												$user_disliked_posts,
												'picon picon-0664-dislike-thumb-down-vote inline-icon thumbs-down',
												'user-disliked_footer',
												'number-of-dislikes',
												'number-of-dislikes_updated_footer',
												'thumbs-down-numvote',
												$number_of_dislikes_value,
												'dislike'
											); ?>
										</h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</article>
<script>
	$('#user-like-form').submit(function () {

		var user_id = $('#user_id').val();
		$('#user_id_posted_like').val(user_id);
		// catch the form's submit event
		$.ajax({ // create an AJAX call...
			data: $(this).serialize(), // get the form data
			type: $(this).attr('method'), // GET or POST
			url: $(this).attr('action'), // the file to call
			success: function (response) { // on success..
				$('#number-of-likes').hide();

				$('#number-of-likes_footer').hide();
				$('#number-of-likes_updated_footer').html(response); // update the DIV
				alert(response);
				$('#number-of-likes_updated').html(response); // update the DIV
				$('#number-of-likes_updated').show();
				$('#number-of-likes_updated_footer').show();
				$('#user-liked').css("background-color", "green");
				$('#user-liked_footer').css("background-color", "green");
			}
		});
		return false; // cancel original event to prevent form submitting
	});

	$('#user-like-form_footer').submit(function () {

		var user_id = $('#user_id').val();
		$('#user_id_posted_like1').val(user_id);
		// catch the form's submit event
		$.ajax({ // create an AJAX call...
			data: $(this).serialize(), // get the form data
			type: $(this).attr('method'), // GET or POST
			url: $(this).attr('action'), // the file to call
			success: function (response) { // on success..
				$('#number-of-likes').hide();
				$('#number-of-likes_footer').hide();

				$('#number-of-likes_updated').html(response); // update the DIV
				$('#number-of-likes_updated_footer').html(response); // update the DIV
				$('#number-of-likes_updated').show();
				$('#number-of-likes_updated_footer').show();
				$('#user-liked').css("background-color", "green");
				$('#user-liked_footer').css("background-color", "green");
			}
		});
		return false; // cancel original event to prevent form submitting
	});
	$('#user-dislike-form').submit(function () {

		var user_id = $('#user_id').val();
		$('#user_id_posted_dislike').val(user_id);
		// catch the form's submit event
		$.ajax({ // create an AJAX call...
			data: $(this).serialize(), // get the form data
			type: $(this).attr('method'), // GET or POST
			url: $(this).attr('action'), // the file to call
			success: function (response) { // on success..
				$('#number-of-dislikes').hide();
				$('#number-of-dislikes_footer').hide();
				$('#number-of-dislikes_updated').html(response); // update the DIV
				$('#number-of-dislikes_updated_footer').html(response); // update the DIV
				$('#number-of-dislikes_updated').show();
				$('#number-of-dislikes_updated_footer').show();
				$('#user-disliked').css("background-color", "green");
				$('#user-disliked_footer').css("background-color", "green");
			}
		});
		return false; // cancel original event to prevent form submitting
	});
	$('#user-dislike-form_footer').submit(function () {

		var user_id = $('#user_id').val();
		$('#user_id_posted_dislike_footer').val(user_id);
		// catch the form's submit event
		$.ajax({ // create an AJAX call...
			data: $(this).serialize(), // get the form data
			type: $(this).attr('method'), // GET or POST
			url: $(this).attr('action'), // the file to call
			success: function (response) { // on success..
				$('#number-of-dislikes').hide();
				$('#number-of-dislikes_footer').hide();
				$('#number-of-dislikes_updated').html(response); // update the DIV
				$('#number-of-dislikes_updated_footer').html(response); // update the DIV
				$('#number-of-dislikes_updated').show();
				$('#number-of-dislikes_updated_footer').show();
				$('#user-disliked').css("background-color", "green");
				$('#user-disliked_footer').css("background-color", "green");
			}
		});
		return false; // cancel original event to prevent form submitting
	});


	<?php echo create_ajax_calls(
		'user-bookmark-form',
		'user_id',
		'user_id_posted_bookmark',
		'number-of-bookmarks',
		'number-of-bookmarks_updated',
		'user-bookmark'
	); ?>


	<?php echo create_ajax_calls(
		'user-follow-form',
		'user_id',
		'user_id_posted_author',
		'number-of-authors',
		'number-of-authors_updated',
		'user-authors'
	); ?>
</script>
