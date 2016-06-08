<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
global $persona;

global $hash;
global $user_id;


if (isset($_SESSION["hash"]) && isset($_SESSION["persona"]) && isset($_SESSION["user_id"])) {
	/*
	* If Hash and Persona are present in Session
	*/
//echo 'hi sesh hash and persona';

	$persona = $_SESSION['persona'];
	$hash = $_SESSION['hash'];
	$user_id = $_SESSION['user_id'];

	if (!$persona) {
		$persona_and_id = explode('|', is_new_user($_SESSION['hash']));

		$_SESSION['persona'] = $persona_and_id[0];
		$_SESSION['user_id'] = $persona_and_id[1];
	}

	$hash = $_SESSION['hash'];
	$user_id = $_SESSION['user_id'];


} else if (isset($_SESSION["hash"])) {
	/*
	* If only hash present in the session
	*
	*/
//echo 'hi sesh hash ';
	$hash = $_SESSION['hash'];

	$persona_and_id = explode('|', is_new_user($_SESSION['hash']));

	$_SESSION['persona'] = $persona_and_id[0];
	$_SESSION['user_id'] = $persona_and_id[1];


	$persona = $_SESSION['persona'];
	$hash = $_SESSION['hash'];
	$user_id = $_SESSION['user_id'];


} else if (isset($_REQUEST["hash"])) {
	/*
	* This is redirect page
	*
	*/
	$_SESSION['hash'] = $_REQUEST["hash"];
	$persona_and_id = explode('|', is_new_user($_REQUEST["hash"]));
	$_SESSION['persona'] = $persona_and_id[0];
	$_SESSION['user_id'] = $persona_and_id[1];

	$persona = $_SESSION['persona'];
	$hash = $_SESSION['hash'];
	$user_id = $_SESSION['user_id'];


} else if (isset($_REQUEST["hash"]) && $_REQUEST['personas']) {
	/*
	* This is redirect page
	*
	*/
	$_SESSION['hash'] = $_REQUEST["hash"];
	$_SESSION['persona'] = $_REQUEST['personas'];

	$hash = $_REQUEST['hash'];
	$persona = $_REQUEST['personas'];

	$id = create_new_user($hash, $persona);

	$_SESSION['user_id'] = $id;

	$persona = $_SESSION['persona'];
	$hash = $_SESSION['hash'];
	$user_id = $_SESSION['user_id'];


} else {

	/*
	* Neither Hash nor Persona are present in the session
	*
	*/

	$current_url = get_permalink();
	echo '
<script src="' . get_template_directory_uri() . '/js/fingerprint2.min.js"></script>
<script src="' . get_template_directory_uri() . '/js/jquery.min.js"></script>
<script type="text/javascript">
var fp = {
excludeLanguage: true,
excludeUserAgent: true,
excludeScreenResolution: true,
excludeAvailableScreenResolution: true,
excludePlugins: true,
excludeIEPlugins: true,
excludeDoNotTrack: true,
excludeCanvas: true,
excludeWebGL: true,
excludeAdBlock: true,
excludeHasLiedLanguages: true,
};
new Fingerprint2(fp).get(function( hash ){

window.location.href = "' . $current_url . '/?hash=" + hash;
});
</script>';
	die;

}


function create_new_user($hash, $persona)
{

	$args = array('post_type' => 'elv_personalisations', 'posts_per_page' => 10);
	$loop = new WP_Query($args);

	$user_found = 0;
	while ($loop->have_posts()) : $loop->the_post();
//var_dump(the_title());
//var_dump($hash);
		if (get_the_title() == $hash) {
			$user_found = 1;
			$id = get_the_ID();
		}
	endwhile;

	if ($user_found == 0) {
		$id = wp_insert_post(array('post_title' => $hash, 'post_type' => 'elv_personalisations', 'post_content' => $persona, 'post_status' => 'publish',));
		update_post_meta($id, 'elv_personalisations_ID', $id);
		update_post_meta($id, 'elv_personalisations_hash', $hash);
		update_post_meta($id, 'elv_personalisations_persona', $persona);
		update_post_meta($id, 'elv_personalisations_likes', 222);
		update_post_meta($id, 'elv_personalisations_dislikes', 221);
		update_post_meta($id, 'elv_personalisations_authors', 292);
	}
	return $id;

}

function is_new_user($hash)
{
	$args = array('post_type' => 'elv_personalisations', 'posts_per_page' => -1);
	$loop = new WP_Query($args);
	$persona = '';
	$post_id = '';
	$user_found = 0;
	while ($loop->have_posts()) : $loop->the_post();

		if (get_the_title() == $hash) {
			$post_id = get_the_ID();
			$personas = get_post_meta($post_id, 'elv_personalisations_persona');
			$persona = $personas[0];
			$user_found = 1;

		}
	endwhile;

	if ($user_found > 0) {

	} else {

		$persona = 1;
		$post_id = create_new_user($hash, $persona);
	}


	return $persona . '|' . $post_id;
}


?><!DOCTYPE html>

<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if (is_singular() && pings_open(get_queried_object())) : ?>
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<?php endif; ?>
	<?php
	wp_head();
	$id = get_post();
	?>
</head>

<?php

/**
 *
 * We are updating background image based on user persona
 *
 *
 */
$body_background_image_url = '';

switch ($persona) {

	case 1:
		if (class_exists('MultiPostThumbnails')) {
			$body_background_image_url = MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'secondary-image-1');
		} else {
			$body_background_image_url = '';
		}
		break;
	case 2:
		if (class_exists('MultiPostThumbnails')) {
			$body_background_image_url = MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'secondary-image-2');
		} else {
			$body_background_image_url = '';
		}
		break;
	case 3:
		if (class_exists('MultiPostThumbnails')) {
			$body_background_image_url = MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'secondary-image-3');
		} else {
			$body_background_image_url = '';
		}
		break;
	case 4:
		if (class_exists('MultiPostThumbnails')) {
			$body_background_image_url = MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'secondary-image-4');
		} else {
			$body_background_image_url = '';
		}
		break;
	case 5:
		if (class_exists('MultiPostThumbnails')) {
			$body_background_image_url = MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'secondary-image-5');
		} else {
			$body_background_image_url = '';
		}
		break;
	case 6:
		if (class_exists('MultiPostThumbnails')) {
			$body_background_image_url = MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'secondary-image-6');
		} else {
			$body_background_image_url = '';
		}
		break;
	case 7:
		if (class_exists('MultiPostThumbnails')) {
			$body_background_image_url = MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'secondary-image-7');
		} else {
			$body_background_image_url = '';
		}
		break;
	case 8:
		if (class_exists('MultiPostThumbnails')) {
			$body_background_image_url = MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'secondary-image-8');
		} else {
			$body_background_image_url = '';
		}
		break;
	default:
		$body_background_image_url = wp_get_attachment_url(get_post_thumbnail_id($id));

}

?>

<body <?php body_class(); ?>  style="background: url('<?php echo $body_background_image_url?>') no-repeat center center fixed;
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;">
<!---

  /$$$$$$                                          /$$             /$$       /$$$$$$                           /$$       /$$   /$$           /$$ /$$
 /$$__  $$                                        | $$            | $$      |_  $$_/                          | $$      | $$  /$$/          | $$| $$
| $$  \ $$ /$$$$$$$   /$$$$$$   /$$$$$$   /$$$$$$$| $$$$$$$       | $$        | $$    /$$$$$$  /$$$$$$$       | $$      | $$ /$$/   /$$$$$$ | $$| $$ /$$   /$$
| $$$$$$$$| $$__  $$ /$$__  $$ /$$__  $$ /$$_____/| $$__  $$      |__/        | $$   |____  $$| $$__  $$      |__/      | $$$$$/   /$$__  $$| $$| $$| $$  | $$
| $$__  $$| $$  \ $$| $$$$$$$$| $$$$$$$$|  $$$$$$ | $$  \ $$       /$$        | $$    /$$$$$$$| $$  \ $$       /$$      | $$  $$  | $$$$$$$$| $$| $$| $$  | $$
| $$  | $$| $$  | $$| $$_____/| $$_____/ \____  $$| $$  | $$      | $$        | $$   /$$__  $$| $$  | $$      | $$      | $$\  $$ | $$_____/| $$| $$| $$  | $$
| $$  | $$| $$  | $$|  $$$$$$$|  $$$$$$$ /$$$$$$$/| $$  | $$      | $$       /$$$$$$|  $$$$$$$| $$  | $$      | $$      | $$ \  $$|  $$$$$$$| $$| $$|  $$$$$$$
|__/  |__/|__/  |__/ \_______/ \_______/|_______/ |__/  |__/      |__/      |______/ \_______/|__/  |__/      |__/      |__/  \__/ \_______/|__/|__/ \____  $$
                                                                                                                                                     /$$  | $$
                                                                                                                                                    |  $$$$$$/
                                                                                                                                                     \______/

-->
<script type='text/javascript' src='https://c.la10cs.salesforceliveagent.com/content/g/js/36.0/deployment.js'></script>
<script type='text/javascript'>
	liveagent.init('https://d.la10cs.salesforceliveagent.com/chat', '57228000000Gmvs', '00DN0000000QdEP');
</script>
<?php

$args = array('post_type' => 'elv_notifications', 'posts_per_page' => -1);
$loop = new WP_Query($args);

$content = '';
$post_id_for_ajax = '';
$user_id_for_post = '';
while ($loop->have_posts()) : $loop->the_post();
		$post_id = get_the_ID();

		$user_id_array = array();
		$active = get_post_meta($post_id, 'elv_notifications_1_url',true);
		$user_id = get_post_meta($post_id, 'elv_notifications_user_id',true);
		$user_id_array = explode('|',$user_id);
		 if ($active == 'yes' && !in_array($_SESSION['user_id'],$user_id_array)){
			$content = get_post($post_id)->post_content;
			$post_id_for_ajax = $post_id;
			$user_id_for_post = $_SESSION['user_id'];

		}
endwhile;

if($content != ''){
?>

<style>

	.main-box-animation {

		-webkit-animation-name: fadeOutUp; /* Chrome, Safari, Opera */
		-webkit-animation-iteration-count: 1; /* Chrome, Safari, Opera */
		animation-iteration-count: 1;

		-webkit-animation-duration: 1s; /* Chrome, Safari, Opera */
		animation-name: fadeOutUp;
		animation-duration: 1s;
	}

	.hide-div{
		display: none;
	}

	@-webkit-keyframes fadeOutUp {
		from {
			opacity: 1;
		}
		to {
			opacity: 0;
			-webkit-transform: translate3d(0, -100%, 0);
			transform: translate3d(0, -100%, 0);
		}
	}
	@keyframes fadeOutUp {
		from {
			opacity: 1;
		}
		to {
			opacity: 0;
			-webkit-transform: translate3d(0, -100%, 0);
			transform: translate3d(0, -100%, 0);
		}
	}
	.fadeOutUp {
		-webkit-animation-name: fadeOutUp;
		animation-name: fadeOutUp;
	}

</style>
<div class="container-fluid" style="background-color:#e3e3e3;height:6em; line-height: 6em;" id="main-box" name="main-box">
	<div class="container">
		<div class="row"  id="web-notificaiton-box" name="web-notificaiton-box">

		<div class="col-md-10"><?php echo $content ?></div>
		<div class="col-md-2">
				<form action="<?php echo get_home_url() ?>/web-notifications/" method="post" id="update_web_notification_for_user">
					<input type="hidden" value="<?php echo $post_id_for_ajax ?>" name="post_id_for_ajax" id="post_id_for_ajax">
					<input type="hidden" value="<?php echo $user_id_for_post ?>" name="user_id_for_post" id="user_id_for_post">
					<button type="submit" style="border: none;background-color: transparent;font-size: 3em;">
						<i class="picon picon-large-cross"></i>
					</button>
				</form>
		</div>
		</div>
	</div>
	</div>
	<script>
		$('#update_web_notification_for_user').submit(function () {

			$.ajax({ // create an AJAX call...
				data: $(this).serialize(), // get the form data
				type: $(this).attr('method'), // GET or POST
				url: $(this).attr('action'), // the file to call
				success: function (response) { // on success..
					$('#main-box').slideUp();

				}
			});
			return false; // cancel original event to prevent form submitting
		});

	</script>
	<?php
}
?>
<div id="page" class="site">
	<div class="site-inner">
		<a class="skip-link screen-reader-text hidden" href="#content"><?php _e('Skip to content', 'twentysixteen'); ?></a>
		<!--		<header id="masthead" class="site-header" role="banner">-->
		<div class="container-fluid mobile-menu-padding-0">
			<div class="container nav-wider mobile-menu-padding-0">
				<div class="col-sm-3 col-md-3 sm-scrn-padding-remove hidden-xs">
					<?php echo( get_custom_logo() ); ?>
				</div>
				<div class="col-sm-9 col-md-9 sm-scrn-padding-remove">
					<div class="row hidden-xs">
						<ul class="nav-details">
							<li>
								<strong><span class="picon picon-0294-phone-call-ringing inline-icon"><!-- fill --></span>&nbsp;<a href="tel:1300444555">&nbsp;<?php echo get_theme_mod( 'phone_field_id'); ?></a></strong>
							</li>
							<li>
								<a href=""> Contact us</a>
							</li>
							<li id="searchbutton" style="cursor: pointer;">
								<span class="picon picon-0033-search-find-zoom inline-icon"><!-- fill --></span> Search
							</li>
							<li>
								<a href="https://online.macquarie.com.au/personal/" class="btn btn-primary-inverse"><span class="picon picon-0632-security-lock inline-icon"><!-- fill --></span> Online Banking</a>
							</li>
						</ul>
					</div>
					<nav class="navbar fixed-top">
						<div class="row">
							<div class="navbar-header bg-black">
								<button type="button" class="navbar-toggle collapsed navbar-inverse" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
									<span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span>
									<span class="icon-bar"></span> <span class="icon-bar"></span>
								</button>
						<span class="mobile-toggleLogoSmall navbar-brand hidden-sm hidden-md hidden-lg">
							<img src="<?php echo get_header_image(); ?>" />
						</span>
								<span class="picon picon-0033-search-find-zoom inline-icon mobile-search hidden-lg hidden-md hidden-sm hidden-xs"><!-- fill --></span>
								<a href="https://online.macquarie.com.au/personal/" class="mobile-login hidden-lg hidden-md hidden-sm"><span class="picon picon-0632-security-lock inline-icon text-white"><!-- fill --></span></a>
							</div>
							<div id="navbar" class="navbar-collapse collapse navbar-inverse bg-black mobile-menu-back">
<span class="toggleLogoSmall navbar-brand">
<img src="<?php echo get_header_image(); ?>"/>
</span>
								<ul class="nav navbar-nav pull-right">
									<?php

									$col_1_heading = '';
									$col_1_description = '';
									$col_1_link = '';
									$col_1_button = '';

									$col_2_heading = '';
									$col_2_description = '';
									$col_2_link = '';
									$col_2_button = '';

									$col_3_heading = '';
									$col_3_description = '';
									$col_3_link = '';
									$col_3_button = '';

									$col_4_heading = '';
									$col_4_description = '';
									$col_4_link = '';
									$col_4_button = '';

									if (get_query_var('paged')) $paged = get_query_var('paged');
									if (get_query_var('page')) $paged = get_query_var('page');

									$query = new WP_Query(array('post_type' => 'elv_feature', 'paged' => $paged));

									if ($query->have_posts()) :

										while ($query->have_posts()) : $query->the_post();

											if (get_post_meta(get_the_ID(), 'elv_feature_tag', true) == '1') {

												$col_1_heading = get_the_title(get_the_ID());
												$col_1_description = get_the_content(null, false);
												$col_1_link = get_post_meta(get_the_ID(), 'elv_tiles_link', true);
												$col_1_button = get_post_meta(get_the_ID(), 'elv_feature_cta', true);

											} else if (get_post_meta(get_the_ID(), 'elv_feature_tag', true) == '2') {

												$col_2_heading = get_the_title(get_the_ID());
												$col_2_description = get_the_content(null, false);
												$col_2_link = get_post_meta(get_the_ID(), 'elv_tiles_link', true);
												$col_2_button = get_post_meta(get_the_ID(), 'elv_feature_cta', true);

											} else if (get_post_meta(get_the_ID(), 'elv_feature_tag', true) == '3') {

												$col_3_heading = get_the_title(get_the_ID());
												$col_3_description = get_the_content(null, false);
												$col_3_link = get_post_meta(get_the_ID(), 'elv_tiles_link', true);
												$col_3_button = get_post_meta(get_the_ID(), 'elv_feature_cta', true);

											} else {

												$col_4_heading = get_the_title(get_the_ID());
												$col_4_description = get_the_content(null, false);
												$col_4_link = get_post_meta(get_the_ID(), 'elv_tiles_link', true);
												$col_4_button = get_post_meta(get_the_ID(), 'elv_feature_cta', true);

											}

										endwhile;
										wp_reset_postdata(); ?>
										<!-- show pagination here -->
									<?php else : ?>
										<!-- show 404 error here -->
									<?php endif; ?>





									<?php

									function get_headings($v)
									{
										$heading_title = '';

										if ($v->post_title) {
											$heading_title = $v->post_title;

										} else if ($v->title) {
											$heading_title = $v->title;
										} else {
											$heading_title = 'Error';
										}

										return $heading_title;
									}


									if (has_nav_menu('social')) :

									$navs = wp_get_nav_menus();


									$menu_counter = 1;

									foreach ($navs as $v) {


									if ($v->name == 'primary') {


									$menuitems = wp_get_nav_menu_items($v);
									$complete_menu_array = buildTree($menuitems, 0);
									foreach ($complete_menu_array as $k => $v) {


									if ($v->post_title != 'Your.Macquarie' && $v->title != 'Your.Macquarie') {
									$b_ul = true;
									?>
									<li class="dropdown menu-large bg-black">
										<a href="<?php echo($v->url); ?>" class="dropdown-toggle" data-toggle="dropdown"><?php echo get_headings($v); ?></a>
										<div class="dropdown-menu megamenu row ">
											<div class="container nav-wider l-padding-t-3 l-padding-b-3">
												<?php

												if ($menu_counter == 1) {

													?>
													<div class="col-md-4 blue-feature-box hidden-sm hidden-xs"><!-- one -->
														<h4><?php echo $col_1_heading ?></h4>
														<div class="h3"><?php echo $col_1_description ?></div>
														<div class="l-padding-t-2">
															<a href="<?php echo $col_1_link ?>" class="btn btn-success" type="button">
																<?php echo $col_1_button ?>
															</a>
														</div>
													</div>
													<?php

												} else if ($menu_counter == 2) {

													?>
													<div class="col-md-4 blue-feature-box hidden-sm hidden-xs"><!-- two -->
														<h4><?php echo $col_2_heading ?></h4>
														<div class="h3"><?php echo $col_2_description ?></div>
														<div class="l-padding-t-2">
															<a href="<?php echo $col_2_link ?>" class="btn btn-success" type="button">
																<?php echo $col_2_button ?>
															</a>
														</div>
													</div>
													<?php

												} else if ($menu_counter == 3) {

													?>
													<div class="col-md-4 blue-feature-box hidden-sm hidden-xs"><!-- three -->
														<h4><?php echo $col_3_heading ?></h4>
														<div class="h3"><?php echo $col_3_description ?></div>
														<div class="l-padding-t-2">
															<a href="<?php echo $col_3_link ?>" class="btn btn-success" type="button">
																<?php echo $col_3_button ?>
															</a>
														</div>
													</div>
													<?php

												} else {

													?>
													<div class="col-md-4 blue-feature-box hidden-sm hidden-xs"><!-- else -->
														<h4><?php echo $col_4_heading ?></h4>
														<div class="h3"><?php echo $col_4_description ?></div>
														<div class="l-padding-t-2">
															<a href="<?php echo $col_4_link ?>" class="btn btn-success" type="button">
																<?php echo $col_4_button ?>
															</a>
														</div>
													</div>
													<?php

												}

												?>




												<?php if (!empty($v->wpse_children)) {
												$b_ul = false;
												$i=0;
												foreach ($v->wpse_children as $wpse_child) {

													if($i==0) {
												?>
												<div class="col-xs-12 col-sm-4 col-md-2">
								
													<?php } else { ?>
													<div class="col-xs-12 col-sm-4 col-md-3">
														<?php }
													$i++;
													?>
													<h4><?php echo get_headings($wpse_child); ?></h4>
													<?php

													if (!empty($wpse_child->wpse_children)) {

													$count = 0;

													foreach ($wpse_child->wpse_children as $wpse_child_child) {

													if (!empty($wpse_child_child->wpse_children)) {
													?>
													<div class="select-blue-iconarrow input-group">
														<?php
														if ($count > 0) {
														?>
														<label class="select-dropdown calculator-select-dropdown"> <?php
															} else {
															?>
															<label class="select-dropdown ratewizard-select-dropdown"> <?php
																}
																?>
																<select class="form-control input-lg">
																	<option>
																		<a href="<?php echo $wpse_child_child->url; ?>" class="footer-level-three-item-link"><?php echo get_headings($wpse_child_child); ?></a>
																	</option>
																	<?php

																	foreach ($wpse_child_child->wpse_children as $wpse_child_child_child) {

																		?>
																		<option>
																			<a href="<?php echo $wpse_child_child_child->url; ?>" class="footer-level-three-item-link"><?php echo get_headings($wpse_child_child_child); ?></a>
																		</option>
																		<?php
																	}
																	?>
																</select>
															</label>
														</div>
													</div>
												<?php
												} else {

												?>
													<ul class="list-unstyled" >
														<li>
															<a href="<?php echo $wpse_child_child->url; ?>" class="footer-level-three-item-link"><?php echo get_headings($wpse_child_child); ?></a>
														</li>
													</ul>
								<?php
								}

								}

								}

								?></div><?php
							}
							}

							?></div>
				</li>
				<?php
				} else {
				$b_ul = true;
				?>
				<li class="primary-color dropdown menu-large your-macquarie">
					<a href="<?php echo($v->url); ?>" class="dropdown-toggle" data-toggle="dropdown"><?php echo get_headings($v); ?></a>
					<div class="dropdown-menu megamenu row mobile-your-macquarie">
						<div class="container nav-wider l-padding-t-3 l-padding-b-3">
							<div class="col-xs-12 col-sm-5 col-md-6 green-feature-box">
								<h4 class="hidden-xs">Your.Macquarie</h4>
								<div class="text-center three-icon-feature">
									<?php if (get_post_meta($user_id, 'elv_personalisations_p1')[0]) { ?>
									<!-- circle 1 -->
									<div class="img-circle selected-choice" title="<?php echo get_the_title(get_post_meta($user_id, 'elv_personalisations_p1')[0]) ?>">
										<?php echo get_post_field("post_content", get_post_meta($user_id, 'elv_personalisations_p1')[0]) ?>
										<span class="img-circle-number">1</span>
									</div>
									<?php }
									if (get_post_meta($user_id, 'elv_personalisations_p2')[0]) { ?>
									<!-- circle 2 -->
									<div class="img-circle" title="<?php echo get_the_title(get_post_meta($user_id, 'elv_personalisations_p2')[0]) ?>">
										<?php echo get_post_field("post_content", get_post_meta($user_id, 'elv_personalisations_p2')[0]) ?>
										<span class="img-circle-number">2</span>
									</div>
									<?php }
									if (get_post_meta($user_id, 'elv_personalisations_p3')[0]) { ?>
									<!-- circle 3 -->
									<div class="img-circle" title="<?php echo get_the_title(get_post_meta($user_id, 'elv_personalisations_p3')[0]) ?>">
										<?php echo get_post_field("post_content", get_post_meta($user_id, 'elv_personalisations_p3')[0]) ?>
										<span class="img-circle-number">3</span>
									</div>
									<?php } if((!get_post_meta($user_id, 'elv_personalisations_p3')[0]) && (!get_post_meta($user_id, 'elv_personalisations_p2')[0]) && (!get_post_meta($user_id, 'elv_personalisations_p1')[0]) ) { ?>
										<p class="lead text-center"><a href="<?php echo get_site_url(); ?>/personalisation-tool">Please select your financial priorities</a></p>
									<?php } ?>
									<!-- button -->
									<div class="l-padding-t-1 l-padding-b-2 text-center visit-macquarie">
										<a href="<?php echo get_site_url(); ?>" class="btn btn-success">Visit Your.Macquarie</a>
									</div>
								</div>
							</div>












							<?php if (!empty($v->wpse_children)) {
							foreach ($v->wpse_children as $wpse_child) {

							?>
							<div class="col-xs-12 col-sm-3 col-md-3">
								<h4><?php echo get_headings($wpse_child); ?>
								</h4>
								<?php

								if (!empty($wpse_child->wpse_children)) {

								$i = 0;

								foreach ($wpse_child->wpse_children as $wpse_child_child) {

								if (!empty($wpse_child_child->wpse_children)) {
									?>
									<div class="select-blue-iconarrow input-group">
									<?php
								if ($i > 0){

									?>
									<label class="select-dropdown homeloan-select-dropdown"> <?php

									} else{
									?>
									<label class="select-dropdown articles-select-dropdown"> <?php
									}

										?>
										<select class="form-control input-lg">
											<option>
												<a href="<?php echo $wpse_child_child->url; ?>" class="footer-level-three-item-link"><?php echo get_headings($wpse_child_child); ?></a>
											</option>
											<?php

											foreach ($wpse_child_child->wpse_children as $wpse_child_child_child) {

												?>
												<option>
													<a href="<?php echo $wpse_child_child_child->url; ?>" class="footer-level-three-item-link"><?php echo get_headings($wpse_child_child_child); ?></a>
												</option>
												<?php
											}
											?>
										</select>
									</label>
								</div>
							</div>
							<?php
								} else {

								?>
								<ul class="list-unstyled" >
									<li>
										<a href="<?php echo $wpse_child_child->url; ?>" class="footer-level-three-item-link"><?php echo get_headings($wpse_child_child); ?></a>
									</li>
								</ul>
			<?php
			}

			}

			}

			?></div><?php
			}
			}

			?></div>
	</div>
	</li>
	</ul>
	<?php

	}
	$menu_counter++;
	}

	}

	}

	endif; ?>
</div>
</div>                    </nav>                </div>            </div>

<!--

Search area

-->

<div class="container-fluid">
	<div class="container">

		<div id="morphsearch" class="morphsearch">

			<?php get_search_form(); ?>

		</div><!-- /morphsearch -->
		<div class="overlay"></div>
	</div><!-- /container -->
</div><!-- /container -->

<script>
	(function () {
		var morphSearch = document.getElementById('morphsearch'),
//						input = morphSearch.querySelector('input.search-field'),
			ctrlClose = morphSearch.querySelector('span.morphsearch-close'),
			isOpen = isAnimating = false,
// show/hide search area

			toggleSearch = function (evt) {
// return if open and the input gets focused
				if (evt.type.toLowerCase() === 'focus' && isOpen) return false;
				var offsets = morphsearch.getBoundingClientRect();
				if (isOpen) {
					classie.remove(morphSearch, 'open');

// trick to hide input text once the search overlay closes
// todo: hardcoded times, should be done after transition ends


					if ((document.getElementById('searchbutton').value != null) && (document.getElementById('searchbutton').value !== '')) {
						setTimeout(function () {
							classie.add(morphSearch, 'hideInput');
							setTimeout(function () {
								classie.remove(morphSearch, 'hideInput');
								document.getElementById('searchbutton').value = '';
							}, 300);
						}, 500);
					}

					document.getElementById('searchbutton').blur();
				}
				else {
					classie.add(morphSearch, 'open');
				}
				isOpen = !isOpen;
			};

// events
		document.getElementById('searchbutton').addEventListener('click', toggleSearch);
		ctrlClose.addEventListener('click', toggleSearch);
// esc key closes search overlay
// keyboard navigation events
		document.addEventListener('keydown', function (ev) {
			var keyCode = ev.keyCode || ev.which;
			if (keyCode === 27 && isOpen) {
				toggleSearch(ev);
			}
		});


		/***** for demo purposes only: don't allow to submit the form *****/

	})();


</script>
<!--</header><!-- .site-header -->

<!-- Bread Crumb -->
<div id="content" class="row site-content">
<?php 
if( !is_home() && !is_front_page() ): ?>
	<div class="container l-padding-t-1 l-padding-b-1">
		<ol class="breadcrumb" typeof="BreadcrumbList" vocab="http://schema.org/">
			<?php if (function_exists('bcn_display')) {
				bcn_display();
			} ?>
		</ol>
	</div>
<?php endif; ?>

