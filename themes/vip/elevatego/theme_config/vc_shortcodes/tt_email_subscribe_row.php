<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = !empty($css) ? vc_shortcode_custom_css_class( $css ) : '';
//$url = vc_build_link( $link );

$content = wpb_js_remove_wpautop( apply_filters( 'the_content', $content ), true );

$output = '<div class="container-fluid l-padding-t-2 l-padding-b-2 subscription-email-form">
	<div class="container">
		<div class="row">
			<div class="col-xs-2 col-sm-2 col-md-1 pull-right">
				<div class="form-group">
					<button type="button" class="close subscription-email-form-close" aria-label="Close">
						<span aria-hidden="true" class="picon picon-large-cross"></span>
					</button>
				</div>
			</div>
			<div class="col-xs-10 col-sm-10 col-md-5 pull-left">
				<p class="subscription-email-form-text">'.$main_text.'</p>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 pull-left">
				<div id="subscriptionEmailFormSection" class="show">
					<form id="subscriptionEmailForm" name="subscriptionEmailForm" method="post" class="subscriptionEmailForm form-inline">
						<!--SALESFORCE: OID-->
						<input type="hidden" id="oid" name="oid" value="'.$oid.'" />
						<!--SALESFORCE: Return URL-->
						<input type="hidden" id="retURL" name="retURL" value="'.$retURL.'" />
						<!--SALESFORCE: Web to Lead form name-->
						<input type="hidden" id="00N28000001ZCdL" name="00N28000001ZCdL" value="'.$sales_00N28000001ZCdL.'" />
						<!--SALESFORCE: Lead record type-->
						<input type="hidden" id="recordType" name="recordType" value="'.$recordType.'" />
						<!--SALESFORCE: Product/s-->
						<input type="hidden" id="00N28000002BqFl" name="00N28000002BqFl" value="" />
						<!--SALESFORCE: Camapign Id-->
						<input type="hidden" id="Campaign_ID" name="Campaign_ID" value="'.$Campaign_ID.'" />
						<!--SALESFORCE: Lead source-->
						<input type="hidden" id="lead_source" name="lead_source" value="'.$lead_source.'" />
						<!--SALESFORCE: Referral source-->
						<input type="hidden" id="Referral_Source__c" name="Referral_Source__c" value="'.$Referral_Source__c.'" />
						<!--SALESFORCE: Debug code-->
						<input type="hidden" id="debug" name="debug" value="0" />
						<!-- form text -->
						<div class="form-group col-xs-6 col-sm-7">
							<label class="sr-only" for="email">Email address<abbr title="Required">*</abbr></label>
							<input class="form-control subscription-email-form-input" type="email" name="email" id="email" placeholder="Email address" />
						</div>
						<!--form button and meter progress -->
						<div class="form-group col-xs-6 col-sm-5">
							<button class="btn btn-default subscription-email-form-button btn-block" type="submit">'.$button_text.'</button>
							<div class="meter nostripes hide" style="width: 213px; ">
								<span style="100%"></span>
							</div>
						</div>
					</form>
				</div>
				<div id="subscriptionEmailFormThankyouSection" class="text-center hide">
					'.$content.'
				</div>
			</div>
		</div>
	</div>
</div>';

print balanceTags($output);
