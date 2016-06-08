<?php
/*
 *
 * Template Name: web-notifications
 *
 * @package Wordpress
 *
*/


if(isset($_REQUEST['post_id_for_ajax'])){
	$ost_id_for_ajax = $_REQUEST['post_id_for_ajax'];
	$user_id_for_post = $_REQUEST['user_id_for_post'];
	$current_user_ids = get_post_meta($ost_id_for_ajax,'elv_notifications_user_id',true);
	$user_id_for_post = $user_id_for_post.'|'.$current_user_ids;
	update_post_meta($ost_id_for_ajax,'elv_notifications_user_id',$user_id_for_post);
}




