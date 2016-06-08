<?php
/*
 *
 * Template Name: Product CTA
 *
 * @package Wordpress
 *
*/

get_header(); ?>
	<div id="primary">
		<main id="main" class="site-main" role="main">
			<?php
			$query = new WP_Query(array('post_type' => 'elv_authors'));

			if ($query->have_posts()) :

				while ($query->have_posts()) : $query->the_post();

				endwhile;
				wp_reset_postdata();
			else :

			endif;

			$id = get_post();
			$post = get_post($id);
			$content = apply_filters('the_content', $post->post_content);
			echo $content;

			?>
		</main><!-- .site-main -->
	</div><!-- .content-area -->
	<!--

	 Sticky CTA

	-->
<?php

$args = array('post_type' => 'elv_product_features', 'posts_per_page' => -1);
$loop = new WP_Query($args);
$i = 0;
$products = array();
while ($loop->have_posts()) : $loop->the_post();

	$post_id = get_the_ID();
	$product_complete_information_array[$i]['product_data'] = get_product_data_from_url_with_image($post_id);
	$product_detail_information_array[$i] = $product_complete_information_array[$i]['product_data'];

	$i++;

endwhile;

?>
	<div class="container-fluid sticky-cta" id="sticky-cta">
		<div class="container bg-white">
			<div class="row">
				<div class="col-xs-6 col-sm-6 col-md-4">
					<form class="form-horizontal">
						<select class="form-control" id="cta-product-select">
							<?php
							foreach ($product_detail_information_array as $product_details) {
								?>
								<option value="<?php echo $product_details['applynow'][0] ?>"><?php echo $product_details['title'] ?></option>
								<?php

							} ?>
						</select>
					</form>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-4">
					<ul class="list-unstyled list-inline pull-right">
						<li>
							<a href="#" class="h5 text-primary" id="cta-apply-url">Apply now</a>
						</li>
						<li><a href="<?php echo get_home_url() ?>/contact-us" class="h5 text-primary">Contact us</a>
						</li>
					</ul>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-4 live-chat">
					<ul class="list-unstyled list-inline pull-right">
						<li>
							<span class="picon picon-0294-phone-call-ringing inline-icon"><!-- fill --></span>
							<strong>Talk to us</strong></a>
						</li>
						<li>
							<a id="liveagent_button_online_57328000000Kz6n_cta" href="javascript://Chat" style="display: none;" onclick="liveagent.startChat('57328000000Kz6n')" class="h5"> Live chat
								<img src="<?php echo get_theme_mod('live_chat_image') ?>" class="img-circle chat-thumbnail" width="50" height="50"></a>
							<div id="liveagent_button_offline_57328000000Kz6n_cta" style="">
									<a href="" data-toggle="modal" data-target="#requestCallCta">Request a call</a>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div><!-- /.container -->
		<script type="text/javascript">
			if (!window._laq) {
				window._laq = [];
			}
			window._laq.push(function () {
				liveagent.showWhenOnline('57328000000Kz6n', document.getElementById('liveagent_button_online_57328000000Kz6n_cta'));
				liveagent.showWhenOffline('57328000000Kz6n', document.getElementById('liveagent_button_offline_57328000000Kz6n_cta'));
			});
		</script>
		<script type="text/javascript">
			$(document).ready(function () {
				$('#cta-product-select').change(function () {
					$('a#cta-apply-url').attr("href", $(this).val());
				});
			});
		</script>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="requestCallCta" tabindex="-1" role="dialog" aria-labelledby="Request a Call">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span><br /><span class="close-text">Close</span>
					</button>
				</div>
				<div class="modal-body col-lg-12 bg-grey ">
					<div id="requestCallBlock" class="text-left padding-lr-60 show">
						<h2 class="l-padding-t-1">Request a call</h2>
						<form id="requestCallForm" name="web-form" method="post" action="https://www.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8">
							<?php echo htmlspecialchars_decode(get_theme_mod("salesforce_field_id")); ?>
							<div class="form-group col-lg-12 l-padding-b-1 padding-left-0 padding-right-0">
								<div class="col-lg-6 padding-left-0">
									<label class="sr-only" for="first_name">First name<abbr title="Required">*</abbr></label>
									<input name="first_name" id="first_name" type="text" class="form-control" placeholder="First name" />
								</div>
								<div class="col-lg-6 padding-right-0">
									<label class="sr-only" for="last_name">Last name<abbr title="Required">*</abbr></label>
									<input name="last_name" id="last_name" type="text" class="form-control" placeholder="Last name" />
								</div>
							</div>
							<div class="form-group col-lg-12 l-padding-b-1 padding-left-0 padding-right-0">
								<div class="col-lg-6 padding-left-0">
									<label class="sr-only" for="phone">Phone number<abbr title="Required">*</abbr></label>
									<input name="phone" id="phone" type="text" class="form-control" placeholder="Phone number" />
								</div>
								<div class="col-lg-6 padding-right-0">
									<label class="sr-only" for="email">Email address<abbr title="Required">*</abbr></label>
									<input name="email" id="email" type="email" class="form-control" placeholder="Email address" />
								</div>
							</div>
							<div class="form-group">
								<label class="select-arrow" for="00N28000003U6Hr">
									<select class="form-control" name="00N28000003U6Hr" id="00N28000003U6Hr">
										<option value="">Please select time </option>
										<option value="">ASAP</option>
										<option value="Morning - 8am to 12pm">Morning - 9am to 12pm</option>
										<option value="Afternoon - 12pm to 4pm">Afternoon - 12pm to 4pm</option>
										<option value="Evening - 4pm to 6pm">Evening - 4pm to 6pm</option>
									</select>
								</label>
							</div>
							<div class="form-group col-lg-12 l-padding-b-1 padding-left-0 padding-right-0">
								<div class="col-lg-6 padding-left-0">
									<button class="btn btn-primary btn-block" type="submit">Submit</button>
								</div>
								<div class="col-lg-6 padding-right-0">
									<button class="btn btn-default btn-block" type="reset">Clear</button>
								</div>
							</div>
							<div class="form-group disclaimer-copy">The information you provide on this form will be retained and handled by Macquarie in accordance with our
								<a href="//www.macquarie.com/about/disclosures/privacy-and-cookies">Privacy Policy</a> and we may contact you about products or services we feel may be of interest to you. If you do not wish to provide all details or receive information of this nature, please phone us on
								<a href="tel:<?php echo  get_theme_mod("phone_field_id"); ?>"><?php echo  get_theme_mod("phone_field_id"); ?></a>.
							</div>
						</form>
					</div>
					<div id="requestCallThanks" class="text-center l-padding-b-2 hide">
						<h2 class="l-padding-b-1">Great! You've successfully subscribed.</h2>
						<p class="l-padding-b-1"><strong>As a subscriber you can take advantage
								<br> of special Your.Macquarie content.</strong></p>
						<p>To activate your account please check your
							<br> email and click the activation link.</p>
					</div>
					<div class=" l-padding-b-2"></div>
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>