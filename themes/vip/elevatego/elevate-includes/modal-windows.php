<?php

/** This file contains all the Modal Window functions */

/**
 *
 * Function to generate booking html
 *
 */

function create_booking_modal_html(
	$post_id,
	$s_class,
	$s_cat,
	$pBooking,
	$pBookingHeading,
	$pSubBookingHeading,
	$pBookingTimeLocations,
	$pBookingDate,
	$eventBookingFile,
	$pBookingHeading,
	$pBookingTimeLocations,
	$pBookingDate
)
{

	$content_html = '<div class="modal fade" id="' . $s_class . $post_id . '" tabindex="-1" role="dialog" aria-labelledby="' . $s_cat . '">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span><br /><span class="close-text">Close</span>
				</button>
			</div>
			<div class="modal-body col-lg-12 modal-fixed-height greywhite-grand-bg" style="background-url:(' . $pBooking . ')">
				<div class="modal-title-container">
					<span class="right-angled-border"></span>
					<span class="modal-title-box">Fintalk</span> Exclusive to Macquarie Staff only.
				</div>

				<div class="col-lg-9 modal-content-block l-padding-t-4">
					<div id="EventSubscribeForm" class="l-padding-t-2 show">
						<h2><strong>' . $pBookingHeading . '</strong> @ Fintalk</h2>
						<h2 class="text-primary">' . $pSubBookingHeading . '</h2>
						<span>' . $pBookingTimeLocations . '</span>
						<form method="post" id="eventform" class="l-padding-t-4">
							<div class="col-lg-12 padding-0">
								<div class="col-lg-7 padding-0">
									<div class="input-group">
										<div class="input-group-addon">
											<strong>' . $pBookingDate . '</strong>
										</div>
										<input class="form-control input-sm" type="email" name="event_subscribe_email" placeholder="Email address">
										<i class="error-icon picon picon-0550-attention-error-alert-caution hide"></i>
									</div>
								</div>
								<div class="col-lg-4">
									<button class="btn btn-primary btn-block" type="submit">Secure your place</button>
									<div class="meter nostripes blue-progress hide" style="width: 214px;">
										<span style="100%"></span>
									</div>
								</div>
							</div>
						</form>
						<div class="col-lg-12 l-padding-t-2 text-primary">
							<form action="' . $eventBookingFile . '" method="post">
							<span class="picon picon picon-0023-calendar-month-day-planner-events font-40"></span>
								<input type="hidden" name="event_calendar_name" id="event_calendar_name" value="' . $pBookingHeading . '"/>
								<input type="hidden" name="event_calendar_location" id="event_calendar_location" value="' . $pBookingTimeLocations . '"/>
								<input type="hidden" name="event_calendar_date" id="event_calendar_date" value="' . $pBookingDate . '"/>
								<input type="submit" class="btn btn-link" value="Add to your calendar"></form>
						</div>
						<div class="col-lg-12 l-padding-t-2"></div>
					</div>
					<div id="eventThanks" class="text-center l-padding-b-2 hide">
						<h2 class="l-padding-b-1">Great! You\'ve successfully subscribed.</h2>
						<p class="l-padding-b-1"><strong>As a subscriber you can take advantage
							<br> of special Your.Macquarie content.</strong></p>
						<p>To activate your account please check your
							<br> email and click the activation link.</p>
					</div>
				</div>
				<div class="col-lg-3 padding-left-0 padding-right-0 l-padding-t-4">
					<img src="img/markbouris_large.png" class="img-responsive" width="78%">
					<div class="col-lg-1"></div>
				</div>
				<div class="col-lg-3 bg-white-70 modal-chat-box">
					<div class="col-lg-1 pull-right"></div>
					<div class="col-lg-3">
						<img src="' . get_theme_mod('live_chat_image') . '" class="img-circle chat-thumbnail" width="100px" height="100px">
					</div>
					<div class="col-lg-8">
						<h5><strong>Need some help?</strong></h5>
						<a href="#">
							<div class="row l-padding-b-1 text-center">
								<button class="btn btn-default" type="button">
									<span class="picon picon-0309-support-help-talk-call font-30 inline-icon"><!-- fill --></span> Live chat
								</button>
							</div>
						</a>
					</div>
				</div>


			</div>
		</div>
	</div>
</div>' . PHP_EOL;;

	return $content_html;
}

/**
 *
 * Function to generate alert html
 *
 */

function create_alert_modal_html(
	$post_id,
	$s_class,
	$s_cat,
	$alertImage,
	$alertHeading,
	$alertButton1,
	$alertButton1text,
	$alertButton2,
	$alertButton2text
)
{

	$content_html = '<div class="modal fade" id="' . $s_class . $post_id . '" tabindex="-1" role="dialog" aria-labelledby="' . $s_cat . '">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span><br /><span class="close-text">Close</span>
				</button>
			</div>
			<div class="modal-body col-lg-12 modal-fixed-height bg-blue">
				<div class="modal-title-container">
					<span class="right-angled-border right-angled-border-primary"></span>
					<span class="modal-title-box">Alert</span>
				</div>
				<div class="col-lg-12 l-padding-t-2">
					<div class="col-lg-6 l-padding-t-4  l-padding-b-2 padding-lr-70">
						<img src="' . $alertImage . '" class="img-responsive">
					</div>
					<div class="col-lg-6 l-padding-t-4  padding-lr-70">
						<h2 class=" text-primary">RBA announced today <br>that interest rates remains
							<br><strong>' . $alertHeading . '</strong></h2>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="col-lg-8 modal-content-block">
						<a class="btn btn-primary" href="' . $alertButton1 . '">' . $alertButton1text . '</a> &nbsp;&nbsp;
						<a class="btn btn-default" href="' . $alertButton2 . '">' . $alertButton2text . '</a>
					</div>
					<div class="col-lg-4 padding-0">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-11 bg-white-70">
                            <div class="col-lg-4">
                                <img src="' . get_theme_mod('live_chat_image') . '" class="img-circle chat-thumbnail" width="100px" height="100px">
                            </div>
                            <div class="col-lg-8">
                                <h5><strong>Want to fix your home loan?</strong></h5>
                                <a href="#">
                                    <div class="row l-padding-b-1 text-center">
                                        <button class="btn btn-default" type="button">
                                            <span class="picon picon-0309-support-help-talk-call inline-icon"><!-- fill --></span> Live chat
                                        </button>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="l-padding-b-4"></div>
            	</div>
			</div>
		</div>
	</div>
</div>' . PHP_EOL;;

	return $content_html;
}

/**
 *
 * Function to generate subscribe html
 *
 */

function create_subscribe_modal_html(
	$post_id,
	$s_class,
	$s_cat,
	$pSubscribeHeading
)
{

	$content_html = '<div class="modal fade" id="' . $s_class . $post_id . '" tabindex="-1" role="dialog" aria-labelledby="' . $s_cat . '">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span><br /><span class="close-text">Close</span>
				</button>
			</div>
			<div class="modal-body col-lg-12 modal-fixed-height bg-green">
				<div class="modal-title-container">
					<span class="right-angled-border"></span>
					<span class="modal-title-box">Subscribe to Your.Macquarie</span>
				</div>
				<div id="subscribeForm" class="l-padding-t-2 show">
					<h2 class="text-center l-padding-t-1">' . $pSubscribeHeading . '</h2>
					<div class="text-center">
						<div class="feature-item center-block img-circle">
							<span class="picon picon-0046-home-house"><!-- fill --></span>
						</div>
						<div class="feature-item center-block img-circle">
							<span class="picon picon picon-0511-suitcase-tag-travel-baggage-luggage"><!-- fill --></span>
						</div>
						<div class="feature-item center-block img-circle">
							<span class="picon picon picon-0495-car-garage"><!-- fill --></span>
						</div>
					</div>
					<form id="submitEmailForm" class="l-padding-t-2" name="submitEmailForm" method="post">
						<!--SALESFORCE: OID-->
						<input type="hidden" id="oid" name="oid" value="00D28000000HpoS" />
						<!--SALESFORCE: Return URL-->
						<input type="hidden" id="retURL" name="retURL" value="http://www.macquarie.com/au/personal/home-loans" />
						<!--SALESFORCE: Web to Lead form name-->
						<input type="hidden" id="00N28000001ZCdL" name="00N28000001ZCdL" value="Subscribe - Macquarie Elevate - Online - Staff always on" />
						<!--SALESFORCE: Lead record type-->
						<input type="hidden" id="recordType" name="recordType" value="01228000000Czge" />
						<!--SALESFORCE: Product/s-->
						<input type="hidden" id="00N28000002BqFl" name="00N28000002BqFl" value="" />
						<!--SALESFORCE: Camapign Id-->
						<input type="hidden" id="Campaign_ID" name="Campaign_ID" value="70128000000DZrY" />
						<!--SALESFORCE: Lead source-->
						<input type="hidden" id="lead_source" name="lead_source" value="Macquarie Elevate" />
						<!--SALESFORCE: Referral source-->
						<input type="hidden" id="Referral_Source__c" name="Referral_Source__c" value="Macquarie Staff" />
						<!--SALESFORCE: Debug code-->
						<input type="hidden" id="debug" name="debug" value="0" />
						<div class="input-group col-lg-6 margin-auto">
							<div class="col-lg-9">
								<label class="sr-only" for="email">Email address
									<abbr title="Required">*</abbr></label>
								<input class="form-control  input-sm modal-input" type="email" name="email" id="email" placeholder="Email address" />
								<i class="error-icon picon picon-0550-attention-error-alert-caution hide"></i>
							</div>
							<div class="col-lg-3">
								<button class="btn btn-success  btn-block" type="submit">Submit</button>
								<div class="meter nostripes hide" style="width: 138px;">
									<span></span>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div id="subscribeThanks" class="text-center l-padding-b-2 hide">
					<h2 class="l-padding-b-1">Great! You\'ve successfully subscribed.</h2>
					<p class="l-padding-b-1"><strong>As a subscriber you can take advantage
						<br> of special Your.Macquarie content.</strong></p>
					<p>To activate your account please check your
						<br> email and click the activation link.</p>
				</div>
				<div class=" l-padding-b-4"></div>
			</div>
		</div>
	</div>
</div>' . PHP_EOL;;

	return $content_html;
}

function generate_modal_windows()
{

	$s_tiles = '';
	$a_args = array(
		'post_type' => 'elv_tiles',
		'posts_per_page' => -1,
	);

	$o_query = new WP_Query($a_args);
	if ($o_query->have_posts()) {
		while ($o_query->have_posts()) {
			$o_query->the_post();

			// get the categories without the link
			$o_cat = null;
			$o_cat = get_the_category();

			$a_cat = array();
			if (!empty($o_cat)) {
				foreach ($o_cat as $o) {
					$a_cat[] = esc_html($o->name);
				}
			}

			$s_cat = '';
			$s_cat = implode(', ', $a_cat);

			$s_class_color = '';
			$s_class_color = get_post_meta(get_the_ID(), 'elv_tiles_class', true);

			$s_link = '';
			$s_link = get_post_meta(get_the_ID(), 'elv_tiles_link', true);

			$s_inline_style = '';
			$s_featured_img_url = '';
			$s_featured_img_url = get_the_post_thumbnail_url();

			if ($s_featured_img_url != '') {
				$s_inline_style = ' src="' . $s_featured_img_url . '"';
			}

			$s_class = '';
			$s_class = get_post_meta(get_the_ID(), 'elv_tiles_ptype', true);

			switch ($s_class) {
				case 'book':
					$pBookingHeading = get_post_meta(get_the_ID(), 'elv_tiles_pBookingHeading', true);
					$pSubBookingHeading = get_post_meta(get_the_ID(), 'elv_tiles_pSubBookingHeading', true);
					$pBookingTimeLocations = get_post_meta(get_the_ID(), 'elv_tiles_pBookingTimeLocations', true);
					$pBookingDate = get_post_meta(get_the_ID(), 'elv_tiles_pBookingDate', true);
					$pBooking = get_post_meta(get_the_ID(), 'elv_tiles_pBooking', true);
					break;

				case 'alert':
					$alertImage = get_post_meta(get_the_ID(), 'elv_tiles_alertImage', true);
					$alertHeading = get_post_meta(get_the_ID(), 'elv_tiles_alertHeading', true);
					$alertButton1 = get_post_meta(get_the_ID(), 'elv_tiles_alertButton1', true);
					$alertButton1text = get_post_meta(get_the_ID(), 'elv_tiles_alertButton1text', true);
					$alertButton2 = get_post_meta(get_the_ID(), 'elv_tiles_alertButton2', true);
					$alertButton2text = get_post_meta(get_the_ID(), 'elv_tiles_alertButton2text', true);
					break;

				case 'subscribe':
					$pSubscribeHeading = get_post_meta(get_the_ID(), 'elv_tiles_pSubscribeHeading', true);
					break;

				case 'tipsandtools':
					break;

				default:
			}

			if ($s_class == 'tipsandtools') {
				$s_tiles .= '
		<div class="grid-item animate col-md-4 l-padding-b-1 cat-bank">
				<div class="modal-triangle-small modal hide-triangle-small-green">
					<span class="picon picon-0651-star-favorite-rating text-white"></span></div>
				<div class="' . $s_class_color . '  feature-tile  tile-modal" ">
					<div class="tile-head"><span class="h4">' . $s_cat . '</span></div>
					<div class="tile-body">
						<img ' . $s_inline_style . ' class="img-responsive" />
						' . get_the_content() . '
						<p></p>
						<div class="tile-link">
						</div>
					</div>
				</div>
			</div>' . PHP_EOL;
			} else {
				$s_tiles .= '
		<div class="grid-item animate col-md-4 l-padding-b-1 cat-bank">
				<div class="modal-triangle-small modal hide-triangle-small-green">
					<span class="picon picon-0651-star-favorite-rating text-white"></span></div>
				<div class="' . $s_class_color . '  feature-tile  tile-modal" data-toggle="modal" data-target="#' . $s_class . get_the_ID() . '">
					<div class="tile-head"><span class="h4">' . $s_cat . '</span></div>
					<div class="tile-body">
						<img ' . $s_inline_style . ' class="img-responsive" />
						' . get_the_content() . '
						<p></p>
						<div class="tile-link">
						</div>
					</div>
				</div>
			</div>' . PHP_EOL;
			}

			$s_tiles .= get_modal_swtich($s_class, $s_cat, get_the_ID());

		}
	}

	wp_reset_postdata();

	return $s_tiles . PHP_EOL;;
}

function get_modal_swtich($modal_type, $s_cat, $post_id)
{
	$eventBookingFile = get_template_directory_uri() . '/eventGenerator.php';
	$s_tiles = '';
	switch ($modal_type) {
		case 'book':
			$pBookingHeading = get_post_meta($post_id, 'elv_tiles_pBookingHeading', true);
			$pSubBookingHeading = get_post_meta($post_id, 'elv_tiles_pSubBookingHeading', true);
			$pBookingTimeLocations = get_post_meta($post_id, 'elv_tiles_pBookingTimeLocations', true);
			$pBookingDate = get_post_meta($post_id, 'elv_tiles_pBookingDate', true);
			$pBooking = get_post_meta($post_id, 'elv_tiles_pBooking', true);

			$s_tiles .= create_booking_modal_html(
				$post_id,
				$modal_type,
				$s_cat,
				$pBooking,
				$pBookingHeading,
				$pSubBookingHeading,
				$pBookingTimeLocations,
				$pBookingDate,
				$eventBookingFile,
				$pBookingHeading,
				$pBookingTimeLocations,
				$pBookingDate
			);
			break;

		case 'alert':
			$alertImage = get_post_meta($post_id, 'elv_tiles_alertImage', true);
			$alertHeading = get_post_meta($post_id, 'elv_tiles_alertHeading', true);
			$alertButton1 = get_post_meta($post_id, 'elv_tiles_alertButton1', true);
			$alertButton1text = get_post_meta($post_id, 'elv_tiles_alertButton1text', true);
			$alertButton2 = get_post_meta($post_id, 'elv_tiles_alertButton2', true);
			$alertButton2text = get_post_meta($post_id, 'elv_tiles_alertButton2text', true);
			$s_tiles .= create_alert_modal_html(
				$post_id,
				$modal_type,
				$s_cat,
				$alertImage,
				$alertHeading,
				$alertButton1,
				$alertButton1text,
				$alertButton2,
				$alertButton2text
			);
			break;

		case 'subscribe':
			$pSubscribeHeading = get_post_meta($post_id, 'elv_tiles_pSubscribeHeading', true);
			$s_tiles .= create_subscribe_modal_html(
				$post_id,
				$modal_type,
				$s_cat,
				$pSubscribeHeading
			);
			break;

		default:
	}

	return $s_tiles;
}

