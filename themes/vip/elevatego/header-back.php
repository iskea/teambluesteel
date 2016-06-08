`<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

//
function get_client_ip_env() {
	$ipaddress = '';
	if (getenv('HTTP_CLIENT_IP'))
		$ipaddress = getenv('HTTP_CLIENT_IP');
	else if(getenv('HTTP_X_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	else if(getenv('HTTP_X_FORWARDED'))
		$ipaddress = getenv('HTTP_X_FORWARDED');
	else if(getenv('HTTP_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_FORWARDED_FOR');
	else if(getenv('HTTP_FORWARDED'))
		$ipaddress = getenv('HTTP_FORWARDED');
	else if(getenv('REMOTE_ADDR'))
		$ipaddress = getenv('REMOTE_ADDR');
	else
		$ipaddress = 'UNKNOWN';

	return $ipaddress;
}

	var_dump(get_client_ip_env());

function get_ip() {

	//Just get the headers if we can or else use the SERVER global
	if ( function_exists( 'apache_request_headers' ) ) {

		$headers = apache_request_headers();

	} else {

		$headers = $_SERVER;

	}

	//Get the forwarded IP if it exists
	if ( array_key_exists( 'X-Forwarded-For', $headers ) && filter_var( $headers['X-Forwarded-For'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 ) ) {

		$the_ip = $headers['X-Forwarded-For'];

	} elseif ( array_key_exists( 'HTTP_X_FORWARDED_FOR', $headers ) && filter_var( $headers['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 )
	) {

		$the_ip = $headers['HTTP_X_FORWARDED_FOR'];

	} else {

		$the_ip = filter_var( $_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 );

	}

	return $the_ip;

}
var_dump(get_ip());

function get_ip_new() {

	$ipaddress = '';
	if ($_SERVER['HTTP_CLIENT_IP'] != '127.0.0.1')
		$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	else if ($_SERVER['HTTP_X_FORWARDED_FOR'] != '127.0.0.1')
		$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	else if ($_SERVER['HTTP_X_FORWARDED'] != '127.0.0.1')
		$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	else if ($_SERVER['HTTP_FORWARDED_FOR'] != '127.0.0.1')
		$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	else if ($_SERVER['HTTP_FORWARDED'] != '127.0.0.1')
		$ipaddress = $_SERVER['HTTP_FORWARDED'];
	else if ($_SERVER['REMOTE_ADDR'] != '127.0.0.1')
		$ipaddress = $_SERVER['REMOTE_ADDR'];
	else
		$ipaddress = 'UNKNOWN';

}
var_dump(get_ip_new());

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if (is_singular() && pings_open(get_queried_object())) : ?>
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="site">
	<div class="site-inner">
		<a class="skip-link screen-reader-text hidden" href="#content"><?php _e('Skip to content', 'twentysixteen'); ?></a>
		<!--		<header id="masthead" class="site-header" role="banner">-->
		<div class="container-fluid">
			<div class="container nav-wider">
				<div class="col-sm-4 col-md-3">
					<img src="img/logo_lock.png" class="img-responsive" />
				</div>
				<div class="col-sm-12 col-md-9">
					<div class="row">
						<ul class="nav-details">
							<li>
								<span class="picon picon-0294-phone-call-ringing inline-icon"><!-- fill --></span><a href="tel:1300444555"> 1300 444 555</a>
							</li>
							<li>
								<span class="picon picon-0033-search-find-zoom inline-icon"><!-- fill --></span><a href="tel:1300444555"> Search</a>
							</li>
						</ul>
					</div>
					<nav class="navbar fixed-top">
						<div class="row">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle collapsed navbar-inverse" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
									<span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span>
									<span class="icon-bar"></span> <span class="icon-bar"></span>
								</button>
							</div>
							<div id="navbar" class="navbar-collapse collapse navbar-inverse bg-black">
						<span class="toggleLogoSmall">
							<img src="img/logo-landscape.png" />
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

									if (has_nav_menu('social')) :

										$navs = wp_get_nav_menus();

										$menu_counter = 1;

										foreach ($navs as $v) {
											if ($v->name == 'primary') {
												$menuitems = wp_get_nav_menu_items($v);
												$complete_menu_array = buildTree($menuitems, 0);
												foreach ($complete_menu_array as $k => $v) {

													if ($v->post_title != 'Your.Macquarie') {

														?>
														<li class="dropdown menu-large bg-black">
															<a href="<?php echo($v->url); ?>" class="dropdown-toggle"
																data-toggle="dropdown"><?php echo($v->post_title); ?></a>
															<div class="dropdown-menu dropdown-menuTwo megamenu row ">
																<div class="container nav-wider l-padding-t-3 l-padding-b-3">
																	<?php

																	if ($menu_counter == 1) {

																		?>
																		<div class="col-xs-3 col-sm-3 col-md-3 blue-feature-box">
																			<h1><?php echo $col_1_heading ?></h1>
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
																		<div class="col-xs-3 col-sm-3 col-md-3 blue-feature-box">
																			<h1><?php echo $col_2_heading ?></h1>
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
																		<div class="col-xs-3 col-sm-3 col-md-3 blue-feature-box">
																			<h1><?php echo $col_3_heading ?></h1>
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
																		<div class="col-xs-3 col-sm-3 col-md-3 blue-feature-box">
																			<h1><?php echo $col_4_heading ?></h1>
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
																		foreach ($v->wpse_children as $wpse_child) {

																			?>
																			<div
																				class="col-xs-3 col-sm-3 col-md-2 col-md-offset-1">
																			<h1><?php echo($wpse_child->post_title); ?>
																			</h1>
																			<?php

																			if (!empty($wpse_child->wpse_children)) {

																				$count = 0;

																				foreach ($wpse_child->wpse_children as $wpse_child_child) {

																					if (!empty($wpse_child_child->wpse_children)) {
																						?>
																						<div class="select-blue-iconarrow input-group">
																							<?php
																							if ($count > 0){

																							?>
																							<label class="select-dropdown calculator-select-dropdown"> <?php

																								} else{
																								?>
																								<label class="select-dropdown ratewizard-select-dropdown"> <?php
																									}

																									?>
																									<select class="form-control input-lg">
																										<option>
																											<a href="<?php echo $wpse_child_child->url; ?>" class="footer-level-three-item-link"><?php echo($wpse_child_child->post_title); ?></a>
																										</option>
																										<?php

																										foreach ($wpse_child_child->wpse_children as $wpse_child_child_child) {

																											?>
																											<option>
																												<a href="<?php echo $wpse_child_child_child->url; ?>" class="footer-level-three-item-link"><?php echo($wpse_child_child_child->post_title); ?></a>
																											</option>
																											<?php
																										}
																										?>
																									</select> </label>
																						</div>
																						<?php
																					} else {

																						?>
																						<p><h3 class="text-primary"><a
																								href="<?php echo $wpse_child_child->url; ?>"
																								class="footer-level-three-item-link"><?php echo($wpse_child_child->post_title); ?></a>
																						</h3></p>
																						<?php
																					}

																					$count++;
																				}
																			}

																			?></div><?php
																		}
																	}

																	?></div>
															</div>
														</li>
														<?php
													} else {
														?>
														<li class="primary-color dropdown menu-large your-macquarie">
															<a href="<?php echo($v->url); ?>" class="dropdown-toggle"
																data-toggle="dropdown"><?php echo($v->post_title); ?></a>
															<div class="dropdown-menu megamenu row ">
																<div class="container nav-wider l-padding-t-3 l-padding-b-3">
																	<div class="col-xs-6 col-sm-6 col-md-6 green-feature-box">
																		<h1>Your.Macquarie</h1>
																		<div class="text-center">
														<span>
															<img src="http://placehold.it/35x35">
															<span>1</span>
														</span>
														<span>
															<img src="http://placehold.it/35x35">
															<span>2</span>
														</span>
														<span>
															<img src="http://placehold.it/35x35">
															<span>3</span>
														</span>
																		</div>
																		<div class="l-padding-t-2 text-center">
																			<button class="btn btn-success" type="button">Visit Your.Macquarie
																			</button>
																		</div>
																	</div>
																	<?php if (!empty($v->wpse_children)) {
																		foreach ($v->wpse_children as $wpse_child) {

																			?>
																			<div
																				class="col-xs-3 col-sm-3 col-md-2 col-md-offset-1">
																			<h1><?php echo($wpse_child->post_title); ?>
																			</h1>
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
																											<a href="<?php echo $wpse_child_child->url; ?>" class="footer-level-three-item-link"><?php echo($wpse_child_child->post_title); ?></a>
																										</option>
																										<?php

																										foreach ($wpse_child_child->wpse_children as $wpse_child_child_child) {

																											?>
																											<option>
																												<a href="<?php echo $wpse_child_child_child->url; ?>" class="footer-level-three-item-link"><?php echo($wpse_child_child_child->post_title); ?></a>
																											</option>
																											<?php
																										}
																										?>
																									</select> </label>
																						</div>
																						<?php
																					} else {

																						?>
																						<p><h3 class="text-primary"><a
																								href="<?php echo $wpse_child_child->url; ?>"
																								class="footer-level-three-item-link"><?php echo($wpse_child_child->post_title); ?></a>
																						</h3></p>
																						<?php
																					}

																					$i++;
																				}
																			}

																			?></div><?php
																		}
																	}

																	?></div>
															</div>
														</li>
														<?php

													}
													$menu_counter++;
												}

											}

										}

									endif; ?>
							</div>
						</div>
					</nav>
				</div>
			</div>
			<!--</header><!-- .site-header -->
			<div id="content" class="site-content">

