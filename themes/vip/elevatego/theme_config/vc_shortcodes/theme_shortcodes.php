<?php
/* TT Custom Heading */
class WPBakeryShortCode_TT_section_header extends WPBakeryShortCode {
	public function getStyles( $font_container_data ) {
		$styles = array();

		if (!empty($font_container_data)) {
			$pieces = explode("|", $font_container_data);

			foreach($pieces as $piece) 
				$styles[] = str_replace(array('_', '%23'), array('-', '#'), $piece).';';			
		}
		return implode('',$styles);
	}
}

/* TT Gallery Carousel */
class WPBakeryShortCode_TT_carousel extends WPBakeryShortCode {}

/* TT Team Member */
class WPBakeryShortCode_TT_member extends WPBakeryShortCode {}

/* TT Team Member */
class WPBakeryShortCode_TT_blog_list extends WPBakeryShortCode {}

/* Google Map */
class WPBakeryShortCode_TT_GMap extends WPBakeryShortCode {}

/* Contact Item */
class WPBakeryShortCode_TT_contact_item extends WPBakeryShortCode {
}

/* Pricing Table */
class WPBakeryShortCode_TT_pricing_table extends WPBakeryShortCode {
}

/* Portfolio Items */
class WPBakeryShortCode_TT_portfolio_items extends WPBakeryShortCode {
}

/* Services Items */
class WPBakeryShortCode_TT_services_items extends WPBakeryShortCode {
}

/* Two Column with Chat Items */
class WPBakeryShortCode_TT_two_column_with_chat extends WPBakeryShortCode {
}

/* Home Page Carousel */
class WPBakeryShortCode_TT_home_page_carousel extends WPBakeryShortCode {
}

/* Tiles */
class WPBakeryShortCode_TT_tiles extends WPBakeryShortCode {
}

/* Elevate Lifestage Category Hero */
class WPBakeryShortCode_TT_lifestage_category_hero extends WPBakeryShortCode {
}

/* Elevate Email Subscribe Row */
class WPBakeryShortCode_TT_email_subscribe_row extends WPBakeryShortCode {
}

/* Elevate Repayments Calc */
class WPBakeryShortCode_TT_repayments_calc extends WPBakeryShortCode {
}

/* Elevate Feature Testimonial */
class WPBakeryShortCode_TT_feature_testimonial extends WPBakeryShortCode {
}

/* Elevate Hero Product */
class WPBakeryShortCode_TT_hero_product extends WPBakeryShortCode {
}

/* Elevate Product Main Features */
class WPBakeryShortCode_TT_product_main_features extends WPBakeryShortCode {
}

/* Elevate Bundle Feature */
class WPBakeryShortCode_TT_bundle_feature extends WPBakeryShortCode {
}

/* Elevate Anchor Navigation */
class WPBakeryShortCode_TT_anchor_navigation extends WPBakeryShortCode {
}

/* Elevate Secondary Navigation */
class WPBakeryShortCode_TT_secondary_navigation extends WPBakeryShortCode {
}

/* Elevate Two Column Event */
class WPBakeryShortCode_TT_two_column_event extends WPBakeryShortCode {
}

/* Homepage Hero */
class WPBakeryShortCode_TT_hero_feature extends WPBakeryShortCode {
}

/* Feature Expertise Lifestage */
class WPBakeryShortCode_TT_feature_expertise_lifestage extends WPBakeryShortCode {
}

/* Ad Feature Tile */
class WPBakeryShortCode_TT_ad_feature_tile extends WPBakeryShortCode {
}

/* Elevate Reward Features */
class WPBakeryShortCode_TT_reward_features extends WPBakeryShortCode {
}

/* Elevate Rewards Promo */
class WPBakeryShortCode_TT_reward_promo extends WPBakeryShortCode {
}

/* Find your F Adviser */
class WPBakeryShortCode_TT_find_your_adviser extends WPBakeryShortCode {
}

/* personalisation */
class WPBakeryShortCode_TT_personalisation extends WPBakeryShortCode {
}

/* Repayment Calculations */
class WPBakeryShortCode_TT_repayment_calculation extends WPBakeryShortCode {
}

/* Product Selector Widget */
class WPBakeryShortCode_TT_product_selector_widget extends WPBakeryShortCode {
}

/* Authors Widget */
class WPBakeryShortCode_TT_authors extends WPBakeryShortCode {
}

/* Feature_product */
class WPBakeryShortCode_TT_feature_product extends WPBakeryShortCode {
}

/* Rate Widget */
class WPBakeryShortCode_TT_rate_widget extends WPBakeryShortCode {
}

/* Personalised Home Page Header */
class WPBakeryShortCode_TT_personalised_home_page_header extends WPBakeryShortCode {
}

/* Personalised Home Page Banner */
class WPBakeryShortCode_TT_personalised_home_page_banner extends WPBakeryShortCode {
}

/* Personalised Home Page Banner */
class WPBakeryShortCode_TT_personalisation_generator extends WPBakeryShortCode {
}

/* Personalised Personalised Tiles */
class WPBakeryShortCode_TT_personalised_tiles extends WPBakeryShortCode {
}

/* Featured Promotion Tiles */
class WPBakeryShortCode_tt_featured_promotion_tiles extends WPBakeryShortCode {
}

/* Featured Tiles Product Page */
class WPBakeryShortCode_tt_featured_tiles_product_page extends WPBakeryShortCode {
}

/* Expertise Article Carousel */
class WPBakeryShortCode_tt_expertise_article_carousel extends WPBakeryShortCode {
}

/* Product Main Features Three */
class WPBakeryShortCode_tt_product_main_features_three extends WPBakeryShortCode {
}

/* Lifestages 2 by 2  */
class WPBakeryShortCode_tt_lifestages_2_by_2 extends WPBakeryShortCode {
}

/* Bank Accounts Tool */
class WPBakeryShortCode_tt_bank_accounts_tool extends WPBakeryShortCode {
}

/* Credit Card Category Page */
class WPBakeryShortCode_tt_credit_card_category_page extends WPBakeryShortCode {
}

/* Credit Card Product Hero */
class WPBakeryShortCode_tt_credit_card_product_hero extends WPBakeryShortCode {
}

/* Credit Card Additional Features */
class WPBakeryShortCode_tt_credit_card_additional_features extends WPBakeryShortCode {
}

/* Author Listing */
class WPBakeryShortCode_tt_author_listing_new extends WPBakeryShortCode {
}

/* Article Listing */
class WPBakeryShortCode_tt_article_listing extends WPBakeryShortCode {
}

/* Two Column Tiles */
class WPBakeryShortCode_tt_two_column_tiles extends WPBakeryShortCode {
}

/* Rewards Tool */
class WPBakeryShortCode_tt_rewards_tool extends WPBakeryShortCode {
}

/* Repayment Calculator */
class WPBakeryShortCode_tt_repayment_calculator extends WPBakeryShortCode {
}

/* Contact Us Tile */
class WPBakeryShortCode_tt_contact_us_tile extends WPBakeryShortCode {
}

/* Personalised Promotion Tile */
class WPBakeryShortCode_tt_personalised_promotion_tile extends WPBakeryShortCode {
}

/* Elevate Param Tiles */
class WPBakeryShortCode_tt_param_tiles extends WPBakeryShortCode {
}

/* Elevate Side Chat Widget */
class WPBakeryShortCode_tt_side_chat_widget extends WPBakeryShortCode {
}

/* Expertise Tags */
class WPBakeryShortCode_tt_expertise_tags extends WPBakeryShortCode {
}

