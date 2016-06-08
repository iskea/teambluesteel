<?php
/**
 * The template part for displaying results in search pages
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

global $hash;
global $article_id;



function user_like($user_id, $article_id){
//
//	var_dump($user_id);
//	var_dump($article_id);
	$user_likes = get_post_meta(303, 'elv_personalisations_likes');
	var_dump($user_likes);


//	$user_likes[0] = $user_likes[0].'|'.$article_id;
//	update_post_meta($user_id, 'elv_personalisations_likes', $user_likes[0]);
//
//
//	$article_likes[0] = get_post_meta($article_id, 'elv_posts_likes');
//	$article_likes[0] = $article_likes[0] + 1;
//	update_post_meta($article_id, 'elv_personalisations_likes', $article_likes[0]);
//
//	$content = '$article_likes[0]';
//	return $content;

}

if(isset($_REQUEST["user_id_posted"]) && isset($_REQUEST["post_id_posted"])){
//	echo $_REQUEST["user_id_posted"];
//	echo $_REQUEST["post_id_posted"];
	echo user_like(303, 195);
}

?>
