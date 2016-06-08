<?php
/**
 * Create "Product Rate" admin panel
 */
add_action('init', 'elv_product_rates');
function elv_product_rates()
{
	register_post_type('elv_product_rates',
		array(
			'labels' => array(
				'name' => __('Product Rates'),
				'singular_name' => __('Product Rate')
			),
			'public' => true,
			'has_archive' => true,
			'show_in_menu' => true,
			'menu_position' => 5,
			'menu_icon' => 'dashicons-screenoptions',
			'description' => 'Modular callout tiles',
			'supports' => array('title', 'editor', 'thumbnail'),
			'taxonomies' => array('category', 'post_tag'),
			'exclude_from_search' => true,
			'publicly_queryable' => false,
		)
	);
}

flush_rewrite_rules();

//Create rates shortcode
function get_rate($atts, $content, $tag)
{
	/* Get rate structure from them modifications */
	$rate_structure = get_theme_mod("rate_field_id");

	$values = shortcode_atts(array(
		'rt_stct' => '',        // optional
		'rt_type' => 'rate',        // optional
		'pd_name' => 'basic',    // required
		'pd_feat' => '',        // optional
		'rt_valu' => '',        // optional
		'in_type' => 'var',    // required
		'fx_term' => '',        // optional
		'rt_t1' => '',        // optional
		'rt_t2' => 'lte80',   // optional
		'rt_t3' => 'tier2',   // optional
		'rt_t4' => '',        // optional
		'rt_t5' => '',        // optional
		'rt_t6' => ''         // optional
	), $atts);

	$query = new WP_Query(array('post_type' => 'elv_product_rates', 'name' => $rate_structure));

	// loop through the posts
	while ($query->have_posts()) : $query->the_post();

		$options = get_the_content(null, false);
		//collect values, combining passed in values and defaults

		$options = !is_null(json_decode($options, true)) ? json_decode($options, true) : $options;

		foreach ($options as $rates_array) {

			if (
				$rates_array['rt_stct'] == $values['rt_stct'] &&
				$rates_array['rt_type'] == $values['rt_type'] &&
				$rates_array['pd_name'] == $values['pd_name'] &&
				$rates_array['pd_feat'] == $values['pd_feat'] &&
				$rates_array['in_type'] == $values['in_type'] &&
				$rates_array['fx_term'] == $values['fx_term'] &&
				$rates_array['rt_t1'] == $values['rt_t1'] &&
				$rates_array['rt_t2'] == $values['rt_t2'] &&
				$rates_array['rt_t3'] == $values['rt_t3'] &&
				$rates_array['rt_t4'] == $values['rt_t4'] &&
				$rates_array['rt_t5'] == $values['rt_t5'] &&
				$rates_array['rt_t6'] == $values['rt_t6']
			) {
				return $rates_array["rt_valu"];
			}
		}
		return "n/a";
	endwhile;

	wp_reset_postdata();
}

add_shortcode('get_rate', 'get_rate');

//Create rates shortcode
function get_rates($atts, $content, $tag)
{
	$options = "";
	$values = shortcode_atts(array(
		'rt_stct' => '',        // optional
		'rt_type' => 'rate',        // optional
		'pd_name' => 'basic',    // required
		'pd_feat' => '',        // optional
		'rt_valu' => '',        // optional
		'in_type' => 'var',    // required
		'fx_term' => '',        // optional
		'rt_t1' => '',        // optional
		'rt_t2' => 'lte80',   // optional
		'rt_t3' => 'tier2',   // optional
		'rt_t4' => '',        // optional
		'rt_t5' => '',        // optional
		'rt_t6' => ''         // optional
	), $atts);

	/* Get rate structure from them modifications */
	$rate_structure = get_theme_mod("rate_field_id");

	$query = new WP_Query(array('post_type' => 'elv_product_rates', 'name' => $rate_structure));

	// loop through the posts
	while ($query->have_posts()) : $query->the_post();
		$options = get_the_content(null, false);
	endwhile;

	return $options;

	wp_reset_postdata();
}

add_shortcode('get_rates', 'get_rates');

/**
 * Class MyRatesPage
 * URL: https://codex.wordpress.org/Creating_Options_Pages
 *
 * Add Product Rates
 * Created by - Simon Adams
 * Updated by - Simon Adams
 * Updated on - 4 June 2016
 */
class MyRatesPage
{
	/**
	 * Holds the values to be used in the fields callbacks
	 */
	private $options;

	/**
	 * Start up
	 */
	public function __construct()
	{
		add_action('admin_menu', array($this, 'add_plugin_page'));
		add_action('admin_init', array($this, 'page_init'));
	}

	/**
	 * Loop through custom post types and create based on array
	 */
	public function add_cust_post($audience, $content)
	{
		$post_details = array('post_title' => $audience,
			'post_type' => 'elv_product_rates',
			'post_content' => json_encode($content));

		$id = wp_insert_post($post_details);

		return $id;
	}

	/**
	 * Add options page
	 */
	public function add_plugin_page()
	{
		// This page will be under "Rates"
		add_options_page(
			'Rates in Elevate',
			'Rates Admin',
			'manage_options',
			'rate-admin-panel',
			array($this, 'create_admin_page')
		);
	}

	/**
	 * Options page callback
	 */
	public function create_admin_page()
	{
		// Set class property
		/*$this->options = get_option('mq_rates_public');*/
		$this->rate_csv_array();
		?>
		<div class="wrap">
			<form action="" method="POST" enctype="multipart/form-data">
				<h2>Update Rates in Elevate</h2>
				<p>Update rates by uploading a CSV with the rate id and rate value (you must have admin access to make this change). </p>
				<input type="file" name="file" />
				<input type="submit" name="mq_rates_upload" id="mq_rates_upload" class="button-primary" value="Upload file" />
				<?php wp_nonce_field('mq_rates_upload', 'mq_rates_upload_nonce'); ?>
			</form>
			<h4> <?php echo get_rate(array(), "", ""); ?> | <?php echo get_rate(array(), "", ""); ?>
			</h4>
			<hr />
		</div>
		<?php
	}

	/**
	 * Register and add rates
	 */
	public function page_init()
	{
		register_setting(
			'my_option_group', // Option group
			'mq_rates_public' // Option name
		);
	}

	/**
	 * Get the rates from CSV and convert them to options
	 */
	public function rate_csv_array()
	{
		if (
			isset($_POST['mq_rates_upload'])
			&& wp_verify_nonce($_POST['mq_rates_upload_nonce'], 'mq_rates_upload')
		) {
			if ($_FILES["file"]["error"] > 0) {
				echo "error";
			} else {

				/* Get CSV file contents after upload and explode to array */
				$csv_lines = explode("\n", file_get_contents($_FILES["file"]["tmp_name"])); //explode by line
				foreach ($csv_lines as $line) { //loop through lines
					$csv_array = explode(',', $line); //explode into id and rate
					$id_rate_array[$csv_array[0]] = $csv_array[1]; // insert id and rate into array
				}

				$rate_array = [];

				foreach ($id_rate_array as $result_id => $result_value) {
					/* Insert or replace row into mq_rates_full */
					/* Explode rate id */

					$result_value = preg_replace( "/\r|\n/", "", $result_value);
					
					$rate_id = explode("_", str_replace('"', '', $result_id));
					$rate_data = [
						'rt_stct' => "",
						'rt_type' => "",
						'pd_name' => "",
						'pd_feat' => "",
						'rt_valu' => str_replace('"', '', $result_value),
						'in_type' => "",
						'fx_term' => "",
						'rt_t1' => "",
						'rt_t2' => "",
						'rt_t3' => "",
						'rt_t4' => "",
						'rt_t5' => "",
						'rt_t6' => ""
					];

					/* If row exists, then replace */
					foreach ($rate_id as $rate_feature) {
						switch ($rate_feature) {
							case (preg_match('/(mort)/', $rate_feature) ? true : false): // eg mort
								break;
							case (preg_match('/(ref)|(mstaff)|(qstaff)/', $rate_feature) ? true : false): // eg Association, Workplace, Referrer, Staff, Public
								$rate_data['rt_stct'] = sanitize_text_field($rate_feature);
								break;
							case (preg_match('/(rate)|(cmp)/', $rate_feature) ? true : false): // eg rate, comparison
								$rate_data['rt_type'] = sanitize_text_field($rate_feature);
								break;
							case (preg_match('/(basic)|(loc)|(offset)|(smsf)|(rev)/', $rate_feature) ? true : false): // eg Basic, LOC, SMSF
								$rate_data['pd_name'] = sanitize_text_field($rate_feature);
								break;
							case (preg_match('/(flyer)/', $rate_feature) ? true : false): // eg flyer, non-flyer, mac_reward
								$rate_data['pd_feat'] = sanitize_text_field($rate_feature);
								break;
							case (preg_match('/(fix)|(var)/', $rate_feature) ? true : false): // eg Fixed, Variable
								$rate_data['in_type'] = sanitize_text_field($rate_feature);
								break;
							case (preg_match('/(1year)|(2year)|(3year)|(4year)|(5year)/', $rate_feature) ? true : false): // eg 1 year, 2 years, 3 years..
								$rate_data['fx_term'] = sanitize_text_field($rate_feature);
								break;
							case (preg_match('/(inv)/', $rate_feature) ? true : false): // eg Owner occupier, Investment
								$rate_data['rt_t1'] = sanitize_text_field($rate_feature);
								break;
							case (preg_match('/(lte70)|(lte80)|(lte90)|(gt90)/', $rate_feature) ? true : false): // eg lte70, lte80, lte90, gt90
								$rate_data['rt_t2'] = sanitize_text_field($rate_feature);
								break;
							case (preg_match('/(tier1)|(tier2)|(tier3)|(tier4)/', $rate_feature) ? true : false): // eg < $500k, < $750k, < $1.5m, > $1.5m
								$rate_data['rt_t3'] = sanitize_text_field($rate_feature);
								break;
							case (preg_match('/(io)/', $rate_feature) ? true : false): // eg Principal, Principal & interest
								$rate_data['rt_t4'] = sanitize_text_field($rate_feature);
								break;
							case (false): // placeholder
								$rate_data['rt_t5'] = sanitize_text_field($rate_feature);
								break;
							default:
								$rate_data['rt_t6'] = sanitize_text_field($rate_feature);
								break;
						}
					}
					array_push($rate_array, $rate_data);
				}

				//get the structure and add it to a multi array
				foreach ($rate_array as $rate_array_line) {
					$audience_type = $rate_array_line['rt_stct'] ? $rate_array_line['rt_stct'] : 'public'; // update blank to be 'public'

					$audience[$audience_type][] = $rate_array_line;
				}
				//add to custom post type
				foreach ($audience as $audience_key => $audience_single) {
					$this->add_cust_post($audience_key, $audience_single);
				}
				return true;
			}
		}
	}
}

if (is_admin())
	$my_rates_page = new MyRatesPage();



