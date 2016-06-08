<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>
</div><!-- .site-content -->
<?php




function tdrows($elements) {
	$a_disclaimer = array();
	foreach ($elements as $element) {
		if(trim($element->nodeValue)){
			$a_disclaimer[] = $element->nodeValue;
		}
	}
	return $a_disclaimer;
}

function getdata($contents) {
	$a_all_disclaimers = array();
	$DOM = new DOMDocument;
	$DOM->loadHTML($contents);
	$items = $DOM->getElementsByTagName('tr');
	foreach ($items as $node) {
		$a_all_disclaimers[] = tdrows($node->childNodes);
	}
	return $a_all_disclaimers;
}

$disclaimer_accordion = get_post_meta(get_the_ID(), 'elv_posts_disclaimer1');
$disclaimer_accordion_accordion_data  = '';
$disclaimer_accordion_accordion = get_post_meta(get_the_ID(), 'elv_posts_accordion');
if( isset($disclaimer_accordion_accordion[0]) && $disclaimer_accordion_accordion[0] != '' ){
	//var_dump($disclaimer_accordion[0]);
	$disclaimer_accordion_accordion_data =  $disclaimer_accordion_accordion[0];
}


$disclaimer_accordion2 = get_post_meta(get_the_ID(), 'elv_posts_disclaimer2');
$disclaimer_accordion_accordion2_data  = '';
$disclaimer_accordion_accordion2 = get_post_meta(get_the_ID(), 'elv_posts_accordion2');
if( isset($disclaimer_accordion_accordion2[0]) && $disclaimer_accordion_accordion2[0] != '' ){
	//var_dump($disclaimer_accordion[0]);
	$disclaimer_accordion_accordion2_data =  $disclaimer_accordion_accordion2[0];
}

$disclaimer_open = get_post_meta(get_the_ID(), 'elv_posts_disclaimer2');
$disclaimer_accordion_data = array();
if( isset($disclaimer_accordion[0]) && $disclaimer_accordion[0] != '' ){
	//var_dump($disclaimer_accordion[0]);
	$disclaimer_accordion_data =  getdata($disclaimer_accordion[0]);
}

$disclaimer_open_data = array();
if( isset($disclaimer_open[0]) && $disclaimer_open[0] != '' ){
	$disclaimer_open_data = getdata($disclaimer_open[0]);
	//var_dump($disclaimer_open_data,111111); exit();
}

$disclaimer_partner_object = null;
$disclaimer_partner_object = get_page_by_title('Partner Disclaimer',OBJECT, 'elv_disclaimers');

$disclaimer_partner_value = '';
if(isset($disclaimer_partner_object->post_content)){
	$disclaimer_partner_value = $disclaimer_partner_object->post_content;
}
//var_dump($disclaimer_partner_value);
?>
<!--

 Footer

-->
<footer id="colophon" class="site-footer row" role="contentinfo">
	<div class="container-fluid" id="disclaimer-links">
		<div class="container l-padding-b-2">
			<div class="row">
				<?php if (has_nav_menu('social')) : ?>
					<?php

					//var_dump(wp_get_nav_menus());

					$navs = wp_get_nav_menus();
					foreach ($navs as $v) {
						if ($v->name == 'Footer') {
							$menuitems = wp_get_nav_menu_items($v);
							//var_dump(buildTree($menuitems, 0));
							$complete_menu_array = buildTree($menuitems, 0);

							foreach ($complete_menu_array as $k => $v) {

								?>
								<div class="col-md-3">
									<h5 class="l-padding-t-2">
										<?php
										if ($v->url == "" || $v->url == "#") {
											echo get_headings($v);
										} else {

											?>
											<a href="<?php echo($v->url); ?>" class="footer-level-one-item-link"><?php echo get_headings($v); ?></a>
											<?php
										} ?>
									</h5>
									<ul>
										<?php

										if (!empty($v->wpse_children)) {

											foreach ($v->wpse_children as $wpse_child) {

												?>
												<li>
													<a href="<?php echo $wpse_child->url; ?>" class="footer-level-two-item-link"><?php echo get_headings($wpse_child); ?></a>
													<ul>
														<?php

														if (!empty($wpse_child->wpse_children)) {

															foreach ($wpse_child->wpse_children as $wpse_child_child) {

																?>
																<li>
																	<a href="<?php echo $wpse_child_child->url; ?>" class="footer-level-three-item-link"><?php echo get_headings($wpse_child_child); ?></a>
																</li>
																<?php

															}
														}

														?>
													</ul>
												</li>
												<?php
											}
										}
										?>
									</ul>
								</div>
								<?php
							}
						}
					}
					?>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php
	if( !empty($disclaimer_accordion_data) ) {
	//var_dump( $disclaimer_accordion_accordion_data );
	?>
	<div class="container-fluid bg-white" id="disclaimer-accordion">
		<div class="container l-padding-t-3 l-padding-b-2">
			<div class="row">
				<div class="col-md-12">
					<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="headingOne">
								<h4>
									<?php
									if( $disclaimer_accordion_accordion_data  == 2 ){
									?>
									<a role="button" class="accordion-toggle " data-toggle="collapse"
									   data-parent="#accordion" href="#collapseOne" aria-expanded="true"
									   aria-controls="collapseOne"> Disclaimers</span></a>
								</h4>
							</div>
							<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
								 aria-labelledby="headingOne">
								<div class="panel-body">
									<?php
									foreach ($disclaimer_accordion_data as $disclaimer_accordion_value) {
										$anchor_id = $disclaimer_accordion_value[0];
										$disclaimer_url = $disclaimer_accordion_value[1];
										$disclaimer_value = get_post(url_to_postid($disclaimer_url))->post_content;
										echo '<p><a id="footnote-' . $anchor_id . '" name="footnote-' . $anchor_id . '"></a><sup>' . $anchor_id . '</sup>&nbsp;' . $disclaimer_value . '</p>';
									}
									} else {
									?>
									<a role="button" class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne"> Disclaimers</a>
									</h4>
								</div>
								<div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">
									<div class="panel-body">
										<?php
										foreach ($disclaimer_accordion_data as $disclaimer_accordion_value) {
											$anchor_id = $disclaimer_accordion_value[0];
											$disclaimer_url = $disclaimer_accordion_value[1];
											$disclaimer_value = get_post(url_to_postid($disclaimer_url))->post_content;
											echo '<p><a id="footnote-' . $anchor_id . '" name="footnote-' . $anchor_id . '"></a><sup>' . $anchor_id . '</sup>&nbsp;' . $disclaimer_value . '</p>';
										}
										}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		}
		?>
		<div class="container-fluid bg-black l-padding-t-1" id="disclaimer-footer">
			<div class="container l-padding-t-1">
				<?php
				// TODO: cut in accordion code
				if( !empty($disclaimer_open_data) ){
					if( $disclaimer_accordion_accordion2_data  == 2 ){
						foreach ($disclaimer_open_data as $disclaimer_open_value) {
							$anchor_id = $disclaimer_open_value[0];
							$disclaimer_url = $disclaimer_open_value[1];
							$disclaimer_value = get_post(url_to_postid($disclaimer_url))->post_content;
							echo '
						<div class="row">
							<div class="col-md-12">
								<p>
									<a id="footnote-' . $anchor_id . '" name="footnote-' . $anchor_id . '"></a><sup>' . $anchor_id . '</sup>&nbsp;
									' . $disclaimer_value . '
								</p>
							</div>
						</div>' . PHP_EOL;
						}
					}
				}
				?>
				<div class="row">
					<div class="col-md-12">
						<p><?php echo $disclaimer_partner_value ?></p>
						<p>Apple, the Apple logo & iPhone are trademarks of Apple Inc, registered in the U.S. and other countries. App Store is a service mark of Apple Inc. Google Play and Android are trademarks of Google Inc.</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<hr />
						<p>Any advice on this website does not take into account your objectives, financial situation or needs and you should consider whether it is appropriate for you. Deposit products and credit cards are issued by Macquarie Bank Limited ABN 46 008 583 542 AFSL and Australian Credit Licence (ACL) 237502 (MBL). Macquarie home loans are serviced by Macquarie Securitisation Limited ABN 16 003 297 336 ACL 237863 on behalf of the lender Perpetual Limited ABN 86 000 431 827. All applications for credit products are subject to standard credit approval criteria. Terms, conditions, fees and charges apply and may be varied or introduced in the future.</p>
						<p>Except for MBL, any entity referred to is not an authorised deposit-taking institution for the purposes of the Banking Act 1959 (Cth). That entity's obligations do not represent deposits or other liabilities of MBL. MBL does not guarantee or otherwise provide assurance in respect of the obligations of that entity, unless noted otherwise.</p>
						<p>Powered by WordPress VIP.</p>
						<hr />
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<p class="pull-left">© Macquarie Group Limited</p>
					</div>
					<div class="col-md-6">
						<p class="pull-right"><a>Important information</a> | <a>Privacy policy</a></p>
					</div>
				</div>
			</div>
		</div>

</footer><!-- .site-footer -->
<!--

Footer

-->
<!-- Bootstrap core JavaScript
================================================== -->
</div><!-- .site-inner -->
</div><!-- .site -->
<?php 
wp_footer(); 
//vip_powered_wpcom();
?>

</body>
</html>
