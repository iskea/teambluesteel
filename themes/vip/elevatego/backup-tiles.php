<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = !empty($css) ? vc_shortcode_custom_css_class( $css ) : '';
//$url = vc_build_link( $link );






$a_args = array(
    'post_type' => 'elv_tiles',
    'posts_per_page' => 9,
);

$s_tiles  = '';
$s_tiles  .= '
<div class="container tile-columns">
	<div class="row l-padding-t-2">
		<div class="col-md-8 col-md-push-2 l-padding-t-1 center-block">
			<ul class="nav nav-pills nav-justified">
				<li role="presentation" class="active"><a href="#">All</a></li>
				<li role="presentation"><a href="#">Save</a></li>
				<li role="presentation"><a href="#">Borrow</a></li>
				<li role="presentation"><a href="#">Rewards</a></li>
				<li role="presentation"><a href="#">Expertise</a></li>
			</ul>
		</div>
	</div>
	<div class="row l-padding-t-2 l-padding-b-2 column-content">' . PHP_EOL;

$o_query = new WP_Query( $a_args );
if ( $o_query->have_posts() ):
    while ( $o_query->have_posts() ) : $o_query->the_post();

        // get the categories without the link
        $o_cat = null;
        $o_cat = get_the_category();



        $a_cat = array();
        if ( ! empty( $o_cat ) ) {
            foreach( $o_cat as $o ) {
                $a_cat[] =  esc_html( $o->name );
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

        if( $s_featured_img_url != '' ){
            $s_inline_style = ' style="background-image: url(' . $s_featured_img_url . ');"';
        }


        $s_class = '';
        $s_class = get_post_meta(get_the_ID(), 'elv_tiles_ptype', true);







        switch ( $s_class ) {
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
                $alertButton2text = get_post_meta(get_the_ID(), 'elv_tiles_alertButton2text', true);				break;
            case 'subscribe':
                $pSubscribeHeading = get_post_meta(get_the_ID(), 'elv_tiles_pSubscribeHeading', true);
                break;
            default:
        }







        $s_tiles .= '
        <div class="col-md-4 l-padding-t-1 l-padding-b-1">
			<div class="' . $s_class_color . ' feature-tile"' . $s_inline_style . ' data-toggle="modal" data-target="#'.$s_class.get_the_ID().'">
				<div class="tile-head"><span class="h1">' . $s_cat . '</span></div>
				<div class="tile-body">
					'. nl2br( get_the_content() ) .'
					<div class="tile-link">
						<a href="' . $s_link . '">Learn more</a>
					</div>
				</div>
			</div>
		</div>' . PHP_EOL;


        //var_dump(get_the_ID());
        //var_dump( get_post_meta($expertise->ID, 'elv_tiles_ptype', true) );






        switch ( $s_class ) {
            case 'book':
                $pBookingHeading = get_post_meta(get_the_ID(), 'elv_tiles_pBookingHeading', true);
                $pSubBookingHeading = get_post_meta(get_the_ID(), 'elv_tiles_pSubBookingHeading', true);
                $pBookingTimeLocations = get_post_meta(get_the_ID(), 'elv_tiles_pBookingTimeLocations', true);
                $pBookingDate = get_post_meta(get_the_ID(), 'elv_tiles_pBookingDate', true);
                $pBooking = get_post_meta(get_the_ID(), 'elv_tiles_pBooking', true);

                $s_tiles .= '
				<div class="modal fade" id="'.$s_class.get_the_ID().'" tabindex="-1" role="dialog" aria-labelledby="' . $s_cat . '">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span><br /><span class="close-text">Close</span>
								</button>
							</div>
							<div class="modal-body col-lg-12 greywhite-grand-bg" style="background-url:('.$pBooking.')">
								<div class="modal-triangle modal-triangle-green">
									<span class="glyphicon glyphicon-star text-white"></span></div>
								<div class="col-lg-12">
									<div class="col-lg-8 modal-content-block">
										<div class="modal-title-box">
											<span class="btn btn-white btn-sm"><strong>Fintalk</strong></span> Exclusive to Macquarie Staff only.
										</div>
										<p><br /></p>
										<h2><strong>'.$pBookingHeading.'</strong> @ Fintalk</h2>
										<h2 class="text-primary">'.$pSubBookingHeading.'</h2>
										<span>'.$pBookingTimeLocations.'</span>
										<p><br /></p>
										<div class="input-group col-lg-11">
											<div class="input-group-addon"><strong>'.$pBookingDate.'</strong></div>
											<input class="form-control input-sm" type="email" name="subscribe_email" placeholder="Email address">
										<span class="input-group-btn">
											<button class="btn btn-primary btn-round-border" type="button">Secure your place</button>
										</span>
										</div>
										<p><br /></p>
										<div class="text-primary">
											<span class="glyphicon glyphicon-calendar"></span> Add to your calendar
		</div>
										<p><br /></p>
										<p><br /></p>
									</div>
									<div class="col-lg-4 padding-0">
										<div class="col-lg-1"></div>
										<div class="col-lg-11 bg-white-70 modal-chat-box">
											<div class="col-lg-4">
												<img src="img/chat-brigit.jpg" class="img-circle chat-thumbnail" width="100px" height="100px">
											</div>
											<div class="col-lg-8">
												<h5><strong>Need some help?</strong></h5>
												<a href="#">
													<div class="row l-padding-b-1 text-center">
														<button class="btn btn-default" type="button">
															<span class="glyphicon glyphicon-comment inline-icon"><!-- fill --></span> Live chat
		</button>
													</div>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>' ;


                break;
            case 'alert':
                $alertImage = get_post_meta(get_the_ID(), 'elv_tiles_alertImage', true);
                $alertHeading = get_post_meta(get_the_ID(), 'elv_tiles_alertHeading', true);
                $alertButton1 = get_post_meta(get_the_ID(), 'elv_tiles_alertButton1', true);
                $alertButton1text = get_post_meta(get_the_ID(), 'elv_tiles_alertButton1text', true);
                $alertButton2 = get_post_meta(get_the_ID(), 'elv_tiles_alertButton2', true);
                $alertButton2text = get_post_meta(get_the_ID(), 'elv_tiles_alertButton2text', true);

                $s_tiles .= '
				<div class="modal fade" id="'.$s_class.get_the_ID().'" tabindex="-1" role="dialog" aria-labelledby="' . $s_cat . '">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span><br /><span class="close-text">Close</span>
								</button>
							</div>
							<div class="modal-body col-lg-12 bg-blue">
								<div class="modal-triangle">
									<span class="picon picon-0032-flag text-white"></span>
								</div>
								<div class="col-lg-12">
									<div class="modal-title-box">
										<span class="btn btn-white btn-sm"><strong>Alert</strong></span>
									</div>
									<p><br /></p>
									<div class="col-lg-5 modal-content-block">
										<img src="'.$alertImage.'" width="300">
										<p><br /></p>
									</div>
									<div class="col-lg-6">
										<h2 class="text-primary">RBA announced today <br>that interest rates remains
											<br><strong>'.$alertHeading.'</strong></h2>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="col-lg-8 modal-content-block">
										<a class="btn btn-primary" href="'.$alertButton1.'">'.$alertButton1text.'</a> &nbsp;&nbsp;
										<a class="btn btn-default" href="'.$alertButton2.'">'.$alertButton2text.'</a>
									</div>
									<div class="col-lg-4 padding-0">
										<div class="col-lg-1"></div>
										<div class="col-lg-11 bg-white-70">
											<div class="col-lg-4">
												<img src="img/chat-brigit.jpg" class="img-circle chat-thumbnail" width="100px" height="100px">
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
									<p><br /></p>
									<p><br /></p>
									<p><br /></p>
								</div>
							</div>
						</div>
					</div>
				</div>' ;

                break;
            case 'subscribe':
                $pSubscribeHeading = get_post_meta(get_the_ID(), 'elv_tiles_pSubscribeHeading', true);

                $s_tiles .= '<div class="modal fade" id="'.$s_class.get_the_ID().'" tabindex="-1" role="dialog" aria-labelledby="' . $s_cat . '">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span><br /><span class="close-text">Close</span>
								</button>
							</div>
							<div class="modal-body col-lg-12 bg-green">
								<div class="modal-triangle modal-triangle-green">
									<span class="picon picon-0651-star-favorite-rating text-white"></span></div>
								<div class="modal-title-box">
									<span class="btn btn-white btn-sm">Subscribe to Your.Macquarie</span>
								</div>
								<div id="subscribeForm" class="show">
								<h2 class="text-center">'.$pSubscribeHeading.'</h2>
								<div class="text-center">
									<div class="feature-item center-block img-circle">
										<span class="picon picon-0046-home-house"><!-- fill --></span>
									</div>
									<div class="feature-item center-block img-circle">
										<span class="picon picon-0379-business-suitcase"><!-- fill --></span>
									</div>
									<div class="feature-item center-block img-circle">
										<span class="picon picon-0478-plane-air"><!-- fill --></span>
									</div>
								</div>
								<p><br /></p>
								<form id="submitEmailForm" name="submitEmailForm" method="post">
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
											<label class="sr-only" for="email">Email address <abbr title="Required">*</abbr></label>
											<input class="form-control  input-sm btn-round-border" type="email" name="email" id="email" placeholder="Email address" required />
										</div>
										<div class="col-lg-3">
											<button class="btn btn-green btn-round-border" type="submit"><strong>Submit</strong></button>
											<div class="meter nostripes hide">
												<span style="100%"></span>
											</div>
										</div>
									</div>
								</form>
								</div>
								<div id="subscribeThanks" class="text-center show">
									<h2>Great! You\'ve successfully subscribed.<br><br></h2>
									<p><strong>As a subscriber you can take advantage <br> of special Your.Macquarie content.</strong><br><br></p>
									<p>To activate your account please check your <br> email and click the activation link.</p>
								</div>
								<p><br /></p>
								<p><br /></p>
							</div>
						</div>
					</div>
				</div>' ;


                break;
            default:
        }












    endwhile;

endif;

wp_reset_postdata();



$args_expertise = array( 'numberposts' => -1);

$o_query_expertise = get_posts( $args_expertise );

//var_dump($o_query_expertise);
if ($o_query_expertise) {
    foreach ($o_query_expertise as $expertise) {

        $s_featured_img_url = wp_get_attachment_url( get_post_thumbnail_id($expertise->ID) );;

        if ($s_featured_img_url != '') {
            $s_inline_style = ' style="background-image: url(' . $s_featured_img_url . ');"';
        }
        //var_dump($expertise);
        $s_tiles .= '

<div class="col-md-4 l-padding-b-1">
				<div class="bg-blue feature-tile" ' . $s_inline_style . '">
					<div class="tile-head"><span class="h1">Elevate your wealth</span></div>
					<div class="tile-body">
						<img src="">
						<h3 class="text-white">
							' . nl2br($expertise->post_title) . '
						</h3>
						<div class="tile-link">
							<a class="" href="'.$expertise->guid.'">Learn more</a>
						</div>
					</div>
				</div>
			</div>
			
			';




    }
}

wp_reset_postdata();

$s_tiles .= '	</div>' . PHP_EOL . '</div>';


print balanceTags($s_tiles);
