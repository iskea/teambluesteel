<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$css_class = !empty($css) ? vc_shortcode_custom_css_class($css) : '';

/* Comparison table details */
$menu_data_s = (array)vc_param_group_parse_atts($menu_data);
$pro = '';

$product_complete_information_array = array();
$product_detail_information_array = array();
$get_all_product_features = array();
$i = 0;

/* Get information about products */
foreach ($menu_data_s as $menu_data_p) {

	$url = vc_build_link($menu_data_p['btn_link'])['url'];
	$product_id = url_to_postid(esc_url($url));
	$product_complete_information_array[$i]['product_data'] = get_product_data_from_url_with_image($product_id);
	$product_detail_information_array[$i] = $product_complete_information_array[$i]['product_data'];
	$product_complete_information_array[$i]['icon'] = $menu_data_p['icon_typicons'];
	$product_complete_information_array[$i]['modal_yes_no'] = $menu_data_p['modal_yes_no'];
	$product_complete_information_array[$i]['modal_type'] = $menu_data_p['modal_type'];
	$product_complete_information_array[$i]['modal_link'] = isset($menu_data_p['modal_link']) ? $menu_data_p['modal_link'] : '';

	foreach ($product_complete_information_array[$i]['product_data']['tags'] as $feature_tags) {
		$get_all_product_features[$feature_tags] = $feature_tags;
	}
	$i++;
}

$output_tt_11 = get_tab_1_left_most_column($product_detail_information_array);
$output_tt_22 = get_tab_1_right_column($product_complete_information_array);
$output_tt_55 = get_feature_section($get_all_product_features, $product_detail_information_array);

/* Get repayments calc javascript file*/
$custom_js_path = get_template_directory_uri() . '/js/elevate-wp_hl-repayments.js';

/* Get rate information */
$rate_structure = get_theme_mod("rate_field_id");
$rate_structure = $rate_structure == "public" ? "" : $rate_structure;

$rate_output = get_rates(array('rt_stct' => $rate_structure), "", "");

function find_loan_type($title)
{
	if (stristr(strtolower($title), 'basic')) {
		return "basic";
	} else if (stristr(strtolower($title), 'offset')) {
		return "offset";
	} else if (stristr(strtolower($title), 'line')) {
		return "loc";
	} else {
		return urlencode($title);
	}
}

$output = '<!--

 Primary information (' . $rate_structure . ')

-->
<div class="container-fluid product-feature">
	<img class="img-responsive feature-background" src="' . wp_get_attachment_url($background_image) . '">
	<div class="container">
		<div class="row l-padding-t-2 l-padding-b-2">
			<div class="col-md-9">
				<h4>' . $subtitle . '</h4>
				<h2>' . $heading . '</h2>
			</div>
		</div>
	</div>
</div>';
$output .= '<!--

 Repayments calculator

-->
<div class="container-fluid">
	<div class="container">
		<div class="row">
			<div class="col-md-9 calc-wrapper">
				<div class="calculator-body bg-blue fixed-height-536">
					<form method="post" id="repayForm">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="property_value">What is the value of the property?</label>
									<input type="text" class="form-control" name="property_value" id="property_value" placeholder="$1,300,000" value="500000" />
									<i class="error-icon picon picon-0550-attention-error-alert-caution hide"></i>
								</div>
								<div class="form-group">
									<label for="your_savings">How much would you like to borrow?</label>
									<input type="text" class="form-control" name="your_savings" id="your_savings" placeholder="$750" value="300000" />
									<i class="error-icon picon picon-0550-attention-error-alert-caution hide"></i>
								</div>
								<div class="form-group">
									<label>How would you like to structure your loan?</label>
									<div class="row" data-toggle="buttons">
										<div class="col-md-6">
											<label class="btn btn-primary-inverse btn-block in_type active" for="variable_rate">
												<input type="radio" class="radio-button" name="in_type" id="variable_rate" value="var" checked /> Variable
											</label>
										</div>
										<div class="col-md-6">
											<label class="btn btn-primary-inverse in_type btn-block" for="fixed_rate">
												<input type="radio" class="radio-button" name="in_type" id="fixed_rate" value="fix" /> Fixed
											</label>
										</div>
									</div>
								</div>
								<div class="form-group hide" id="fixed">
									<label>For how long would you like to fix your interest?</label>
									<label class="select-arrow" for="fx_term">
										<select class="form-control" name="fx_term" id="fx_term">
											<option value="">Please select one</option>
											<option value="1year">1 year</option>
											<option value="2year">2 years</option>
											<option value="3year">3 years</option>
											<option value="4year">4 years</option>
											<option value="5year">5 years</option>
										</select> </label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Would you like to earn Qantas Points?</label>
									<div class="row" data-toggle="buttons">
										<div class="col-md-6">
											<label class="btn btn-primary-inverse btn-block" for="pd_feat_yes">
												<input type="radio" class="radio-button" name="pd_feat" id="pd_feat_yes" autocomplete="off" value="flyer"/> Yes
											</label>
										</div>
										<div class="col-md-6">
											<label class="btn btn-primary-inverse btn-block active" for="pd_feat_no">
												<input type="radio" class="radio-button" name="pd_feat" id="pd_feat_no" autocomplete="off" value="" checked /> No
											</label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label>What is the purpose of your loan?</label>
									<div class="row" data-toggle="buttons">
										<div class="col-md-6">
											<label class="btn btn-primary-inverse btn-block active" for="owner_occupied">
												<input type="radio" class="radio-button" name="rt_t1" id="owner_occupied" autocomplete="off" value="" checked /> Owner occupied
											</label>
										</div>
										<div class="col-md-6">
											<label class="btn btn-primary-inverse btn-block" for="interest_only">
												<input type="radio" class="radio-button" name="rt_t1" id="interest_only" autocomplete="off" value="inv" /> Investment only
											</label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label>What kind of repayments would you prefer?</label>
									<div class="row" data-toggle="buttons">
										<div class="col-md-6">
											<label class="btn btn-primary-inverse btn-block active" for="principal_interest">
												<input type="radio" class="radio-button" name="rt_t4" id="principal_interest" value="" autocomplete="off" checked> Principal & Interest
											</label>
										</div>
										<div class="col-md-6">
											<label class="btn btn-primary-inverse btn-block" for="interest">
												<input type="radio" class="radio-button" name="rt_t4" id="interest" value="io" autocomplete="off"> Interest only
											</label>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<button class="btn btn-success btn-block">Calculate</button>
								</div>
							</div>
							<!--<div class="col-md-6">
								<div class="form-group">
									<button class="btn btn-default btn-block">Reset</button>
								</div>
							</div>-->
						</div>
					</form>
				</div>
			</div>
			<div class="col-md-3">';
$output .= live_chat_area();
$output .= '</div>
		</div>
	</div>
	<div class="col-md-3">
		<!-- fill -->
	</div>
</div>
<!--

 Tabbed area

-->
<div class="container-fluid clearfix l-padding-t-2" id="tabCategory">
	<div class="row">
		<ul class="nav nav-tabs center-block">
			<li class="active"><a href="#tab-1" data-toggle="tab">Compare rates</a></li>
			<li><a href="#tab-2" data-toggle="tab">Compare features</a></li>
		</ul>
	</div>
</div>
<div class="container-fluid bg-grey">
	<div class="container">
		<div class="row tab-content">
			<div class="tab-pane active" id="tab-1">
				<div class="table-responsive">
					<table class="table comparison-row" id="repayments-table">
						<tr>
							<td width="40%" class="table-col-title">
								<table width="100%">
									<tr>
										<td class="column-heading">&nbsp;</td>
									</tr>';
foreach ($product_detail_information_array as $product_details) {

	$output .= '<tr>
										<td class="feature-tile bg-white">
											<div>
												<div class="tile-head">
													<span class="h4">' . $product_details["title"] . '</span>
												</div>
													<div class="tile-body first-col">
													<h3>'.(isset($product_details['tagline'][0]) ? $product_details['tagline'][0] : '').'</h3>
													<div class="tile-link">
														<div class="col-xs-6 col-sm-6 col-md-5"><div class="row"><a class="btn btn-primary btn-block" href="' . (isset($product_details['applynow'][0]) ? $product_details['applynow'][0] : '#') . '">Apply now</a></div></div>
														<div class="col-xs-6 col-sm-6 col-md-5 col-md-offset-1"><div class="row"><a class="btn btn-primary-inverse btn-block" href="' . (isset($product_details['learnmore'][0]) ? $product_details['learnmore'][0] : '#') . '">Learn more</a>&nbsp;</div></div>
													</div>
												</div>
											</div>
										</td>
									</tr>';
}

$output .= '</table>
							</td>
							<td width="15%" class="table-col-rates">
								<table width="100%">
									<tr>
										<td class="column-heading text-center">
											<small>Interest rate</small>
										</td>
									</tr>';
foreach ($product_detail_information_array as $product_details) {
	$loan_type = find_loan_type($product_details["title"]);
	$output .= '<tr>
										<td class="feature-tile bg-white">
											<div>
												<div class="tile-body text-center">
													<div class="rate-display rate-med" id="result-' . $loan_type . '-rate">
														' . get_rate(array('rt_stct' => $rate_structure, 'rt_type' => 'rate', 'pd_name' => $loan_type, 'pd_feat' => '', 'in_type' => 'var', 'fx_term' => '', 'rt_t1' => '', 'rt_t2' => 'lte80', 'rt_t3' => 'tier2', 'rt_t4' => '', 'rt_t5' => '', 'rt_t6' => ''), "", "") . '
													</div>
													<p><small><strong>Interest rate</strong></small></p>
												</div>
											</div>
										</td>
									</tr>
									<script>$(document).ready(function() {$("#result-' . $loan_type . '-rate").html(rateWrapper($("#result-' . $loan_type . '-rate").html()));});</script>';
}
$output .= '</table>
							</td>
							<td width="15%" class="table-col-rates">
								<table width="100%">
									<tr>
										<td class="column-heading text-center">
											<small>Comparison rate</small>
										</td>
									</tr>';
foreach ($product_detail_information_array as $product_details) {
	$loan_type = find_loan_type($product_details["title"]);
	$output .= '<tr>
										<td class="feature-tile bg-white">
											<div>
												<div class="tile-body text-center text-grey">
													<div class="rate-display rate-med" id="result-' . $loan_type . '-cmp">
														' . get_rate(array('rt_stct' => $rate_structure, 'rt_type' => 'cmp', 'pd_name' => $loan_type, 'pd_feat' => '', 'in_type' => 'var', 'fx_term' => '', 'rt_t1' => '', 'rt_t2' => 'lte80', 'rt_t3' => 'tier2', 'rt_t4' => '', 'rt_t5' => '', 'rt_t6' => ''), "", "") . '
													</div>
													<p>
														<small>Comparison rate</small>
													</p>
												</div>
											</div>
										</td>
									</tr>
									<script>$(document).ready(function() {$("#result-' . $loan_type . '-cmp").html(rateWrapper($("#result-' . $loan_type . '-cmp").html()));});</script>';
}
$output .= '</table>
							</td>
							<td width="15%" class="table-col-lvr">
								<table width="100%">
									<tr>
										<td class="column-heading text-center">
											<small>Max LVR</small>
										</td>
									</tr>';
foreach ($product_detail_information_array as $product_details) {
	$loan_type = find_loan_type($product_details["title"]);
	$output .= '
									<tr>
										<td class="feature-tile bg-white">
											<div>
												<div class="tile-body text-center">
													<div class="rate-display rate-med" id="result-' . $loan_type . '-lvr">
											<span class="rate-whole">
												<span class="rate-decimal">80<span class="rate-percent">%</span></span>
											</span>
													</div>
													<p>
														<small><strong>LVR</strong></small>
													</p>
												</div>
											</div>
										</td>
									</tr>';
}
$output .= '

								</table>
							</td>
							<td width="15%" class="table-col-repayments">
								<table width="100%">
									<tr>
										<td class="column-heading text-center">
											<small class="text-primary">Repayments</small>
										</td>
									</tr>';
foreach ($product_detail_information_array as $product_details) {
	$loan_type = find_loan_type($product_details["title"]);
	$output .= '<tr>
										<td class="feature-tile bg-white">
											<div>
												<div class="tile-body text-center">
													<div class="rate-display rate-med ">
											<span class="rate-whole"><span class="rate-decimal text-primary" id="result-' . $loan_type . '-repay">n/a</span>
											</span>
													</div>
													<p>
														<label class="select-arrow select-arrow-primary" for="rt_t4_' . $loan_type . '">
															<select name="rt_t4" class="rt_t4" id="rt_t4_' . $loan_type . '">
																<option value="12">Monthly</option>
																<option value="26">Fortnightly</option>
															</select> </label>
													</p>
												</div>
											</div>
										</td>
									</tr>';
}
$output .= '</table>
							</td>
							<td width="15%" class="table-col-gift">
								<table width="100%">
									<tr>
										<td class="column-heading text-center">
											<small>Rewards</small>
										</td>
									</tr>';

foreach ($product_detail_information_array as $product_details) {
	
	$loan_type = find_loan_type($product_details["title"]);
	$output .= '
									<tr>
										<td class="feature-tile bg-white">
											<div>
												<div class="tile-body text-center">'.(isset($product_details['rewards'][0]) ? $product_details['rewards'][0] : '').'
												</div>
											</div>
										</td>
									</tr>';
}
$output .= '</table>
							</td>
							<!--<td width="15%" class="table-col-apply">
								<table width="100%">
									<tr>
										<td class="column-heading text-center">
											<small class="text-primary">Actions</small>
										</td>
									</tr>';

foreach ($product_detail_information_array as $product_details) {

	$output .= '<tr>
										<td class="feature-tile bg-white">
											<div>
												<div class="tile-body text-center">
													<div class="rate-display rate-med">
														<a class="btn btn-primary btn-block" href="' . (isset($product_details['applynow'][0]) ? $product_details['applynow'][0] : '#') . '">Apply now</a>
														<a class="btn btn-primary-inverse btn-block" href="' . (isset($product_details['learnmore'][0]) ? $product_details['learnmore'][0] : '#') . '">Learn more</a>
													</div>
												</div>
											</div>
										</td>
									</tr>';
}
$output .= '</table>
							</td>-->
						</tr>
					</table>
				</div>
			</div>
			<div class="tab-pane" id="tab-2">
                <div class="table-responsive">
                    <table class="table comparison-row compare-features" id="comparison-table">
                        <tr>
                            <td width="33.33%" class="table-col-title">
                                <table width="100%">
                                    <tr>
                                        <td class="column-heading">&nbsp;</td>
                                    </tr>
                                    ' . $output_tt_11 . '
                                </table>
                            </td>
                            ' . $output_tt_55 . '
                        </tr>
                    </table>
                </div>
            </div>
		</div>
	</div>
</div>';

/* Get repayments calculator javscript file */
$output .= '<script src="' . $custom_js_path . '"></script>';

/* Get full rates array for page */
$output .= '<script>var rateArray = ' . $rate_output . ';</script>';

print balanceTags($output);