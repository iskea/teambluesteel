<?php
/*
 *
 * Template Name: user-likes
 *
 * @package Wordpress
 *
*/


if(isset($_REQUEST['code_spliter'])){
$code_spliter = $_REQUEST['code_spliter'];

	switch ($code_spliter){
		case 'like':
			if(isset($_REQUEST['user_id_posted_like']) && isset($_REQUEST['post_id_posted'])){


				$user_id = $_REQUEST['user_id_posted_like'];
				$article_id = $_REQUEST['post_id_posted'];
				$author_id = $_REQUEST['author_id_posted'];

				/**
				 * 
				 * Update article ID to User Hash - likes
				 * 
				 */

				$user_likes = get_post_meta($user_id, 'elv_personalisations_likes');
				if(!empty($user_likes) && $user_likes[0] != ''){
					$user_likes[0] = $user_likes[0].'|'.$article_id;
				}else{
					$user_likes[0] = $article_id;
				}
				update_post_meta($user_id, 'elv_personalisations_likes', $user_likes[0]);

				/**
				 *
				 * Update article ID to Post - likes
				 *
				 */
				$article_likes = get_post_meta($article_id, 'elv_posts_likes');

				if(!empty($article_likes) && $article_likes[0] != ''){

					$new_article_likes= (int)$article_likes + 1;
				} else{
					$new_article_likes = 21;
				}
				update_post_meta($article_id, 'elv_posts_likes', $new_article_likes);


				/**
				 *
				 * Update article ID to Authors - likes
				 *
				 */

				$author_likes = get_post_meta($author_id, 'elv_authors_posts_liked');
				if(!empty($author_likes) && $author_likes[0] != ''){
					$author_likes[0] = $author_likes[0].'|'.$article_id;
				}else{
					$author_likes[0] = $article_id;
				}
				update_post_meta($author_id, 'elv_authors_posts_liked', $author_likes[0]);



				echo $new_article_likes;
			}
		break;

		case 'dislike':
			if(isset($_REQUEST['user_id_posted_dislike']) && isset($_REQUEST['post_id_posted'])){

				$user_id = $_REQUEST['user_id_posted_dislike'];
				$article_id = $_REQUEST['post_id_posted'];
				$author_id = $_REQUEST['author_id_posted'];
				/**
				 *
				 * Update article ID to User Hash - dislikes
				 *
				 */
				$user_dislikes = get_post_meta($user_id, 'elv_personalisations_dislikes');
				if(!empty($user_dislikes) && $user_dislikes[0] != ''){
					$user_dislikes[0] = $user_dislikes[0].'|'.$article_id;
				}else{
					$user_dislikes[0] = $article_id;
				}
				update_post_meta($user_id, 'elv_personalisations_dislikes', $user_dislikes[0]);

				/**
				 *
				 * Update article ID to Post - dislikes
				 *
				 */

				$article_dislikes = get_post_meta($article_id, 'elv_posts_dislikes');

				if(!empty($article_dislikes) && $article_dislikes[0] != ''){

					$new_article_dislikes= (int)$article_dislikes + 1;
				} else{
					$new_article_dislikes = 6;
				}
				update_post_meta($article_id, 'elv_posts_dislikes', $new_article_dislikes);

				/**
				 *
				 * Update article ID to Authors - dislikes
				 *
				 */

				$author_dislikes = get_post_meta($author_id, 'elv_authors_posts_disliked');
				if(!empty($author_dislikes) && $author_dislikes[0] != ''){
					$author_dislikes[0] = $author_dislikes[0].'|'.$article_id;
				}else{
					$author_dislikes[0] = $article_id;
				}
				update_post_meta($author_id, 'elv_authors_posts_disliked', $author_dislikes[0]);


				echo $new_article_dislikes;
			}
			break;

		case 'articleBookmark':
			if(isset($_REQUEST['user_id_posted_bookmark']) && isset($_REQUEST['post_id_posted'])){

				$user_id = $_REQUEST['user_id_posted_bookmark'];
				$article_id = $_REQUEST['post_id_posted'];
				$author_id = $_REQUEST['author_id_posted'];

				/**
				 *
				 * Update article ID to User Hash - likes
				 *
				 */
				$user_bookmarks = get_post_meta($user_id, 'elv_personalisations_bookmarks');
				if(!empty($user_bookmarks) && $user_bookmarks[0] != ''){
					$user_bookmarks[0] = $user_bookmarks[0].','.$article_id;
				}else{
					$user_bookmarks[0] = $article_id;
				}
				update_post_meta($user_id, 'elv_personalisations_bookmarks', $user_bookmarks[0]);
				/**
				 *
				 * Update article ID to Authors - likes
				 *
				 */
				$author_bookmarks = get_post_meta($author_id, 'elv_authors_posts_bookmark');
				if(!empty($author_bookmarks) && $author_bookmarks[0] != ''){
					$author_bookmarks[0] = $author_bookmarks[0].'|'.$article_id;
				}else{
					$author_bookmarks[0] = $article_id;
				}
				update_post_meta($author_id, 'elv_authors_posts_bookmark', $author_bookmarks[0]);



//				$article_dislikes[0] = get_post_meta($article_id, 'elv_posts_dislikes');
//				$new_article_dislikes= (int)$article_likes[0][0]++;
//				update_post_meta($article_id, 'elv_posts_dislikes', $new_article_likes);
//
//				echo $new_article_dislikes;
				echo '';
			}
			break;

		case 'authorFollow':
			if(isset($_REQUEST['user_id_posted_author'])){

				$user_id = $_REQUEST['user_id_posted_author'];
				$article_id = $_REQUEST['post_id_posted'];
				$author_id = $_REQUEST['author_id_posted'];
				/**
				 *
				 * Update article ID to User Hash - likes
				 *
				 */

				$user_followed_author = get_post_meta($user_id, 'elv_personalisations_authors');
				$user_followed_author[0] = $user_followed_author[0].'|'.$author_id;
				update_post_meta($user_id, 'elv_personalisations_authors', $user_followed_author[0]);
				/**
				 *
				 *follower_id
				 * Update article ID to Authors - likes
				 *
				 */
				$author_followed_ids = get_post_meta($author_id, 'elv_authors_follow_id');
				if(!empty($author_followed_ids) && $author_followed_ids[0] != ''){
					$author_followed_ids[0] = $author_followed_ids[0].'|'.$article_id;
				}else{
					$author_followed_ids[0] = $article_id;
				}
				update_post_meta($author_id, 'elv_authors_follow_id', $author_followed_ids[0]);

				/**
				 *
				 *
				 * Update article ID to Authors - likes
				 *
				 */
				$user_followed_author_id = get_post_meta($author_id, 'elv_authors_follower_id');
				if(!empty($user_followed_author_id) && $user_followed_author_id[0] != ''){
					$user_followed_author_id[0] = $user_followed_author_id[0].'|'.$user_id;
				}else{
					$user_followed_author_id[0] = $user_followed_author_id;
				}
				update_post_meta($author_id, 'elv_authors_follower_id', $user_followed_author_id[0]);

				echo '';
			}
			break;

	}




}


?>

