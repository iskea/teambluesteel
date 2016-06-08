<?php

/**
 * Class MyRatesPage
 * URL: https://codex.wordpress.org/Creating_Options_Pages
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
	 * Get rates from options (shouldn't be used)
	 */
	public function add_cust_post_from_options()
	{
		//get rates from options
		$content = get_option('mq_rates_public');

		$audience = array();

		//get the structure and add it to a multi array
		foreach ($content as $contentChild) {
			$ca = $contentChild['rt_stct'];

			$audience[$ca][] = $contentChild;
		}

		$content = json_encode($content);

		//add to custom post type
		foreach ($audience as $audience_key => $audience_single) {

			if (!$audience_key) {
				$audience_key = 'public';
			}
			add_cust_post($audience_key, $audience_single);
		}
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
		$this->options = get_option('mq_rates_public');
		?>
		<div class="wrap">
			<form action="" method="POST" enctype="multipart/form-data">
				<h2>Update Rates in Elevate</h2>
				<p>Update rates by uploading a CSV with the rate id and rate value (you must have admin access to make this change). </p>
				<input type="file" name="file" />
				<input type="submit" name="mq_rates_upload" id="mq_rates_upload" class="button-primary" value="Upload file" />
				<?php wp_nonce_field('mq_rates_upload', 'mq_rates_upload_nonce'); ?>
			</form>
			<h4> <?php echo get_rate(array(
				'rt_stct' => 'mstaff',        // optional
				'rt_type' => '',        // optional
				'pd_name' => 'offset',    // required
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
			), "", ""); ?> | <?php echo get_rate(array(
					'rt_stct' => 'mstaff',        // optional
					'rt_type' => 'cmp',        // optional
					'pd_name' => 'offset',    // required
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
				), "", ""); ?> >
				<?php echo get_rates(array(
					'rt_stct' => 'mstaff',        // optional
					'rt_type' => '',        // optional
					'pd_name' => 'offset',    // required
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
				), "", ""); ?>
			</h4>
			<hr />
		</div>
		<?php
	}

	public function rates_init()
	{
		/* https://codex.wordpress.org/Function_Reference/register_post_type */
		$labels = array(
			'name' => _x('Rates', 'post type general name'),
			'singular_name' => _x('Rate', 'post type singular name'),
			'menu_name' => _x('Rates', 'admin menu'),
			'name_admin_bar' => _x('Rate', 'add new on admin bar'),
			'add_new' => _x('Add New', 'rate'),
			'add_new_item' => __('Add New Rate'),
			'new_item' => __('New Rate'),
			'edit_item' => __('Edit Rate'),
			'view_item' => __('View Rate'),
			'all_items' => __('All Rates'),
			'search_items' => __('Search Rates'),
			'parent_item_colon' => __('Parent Rates:'),
			'not_found' => __('No rates found.'),
			'not_found_in_trash' => __('No rates found in Trash.')
		);

		$args = array(
			'labels' => $labels,
			'description' => __('Description.'),
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'rate'),
			'capability_type' => 'post',
			'has_archive' => true,
			'hierarchical' => false,
			'menu_position' => 2,
			'show_in_rest' => true,
			'rest_base' => 'rates-api',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments')
		);

		register_post_type('mq_rates', $args);
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
	 * Print the Section text
	 */
	public function print_section_info()
	{
		print 'View rates both existing and new when CSV is uploaded.';
	}

	public function rates_elevate()
	{
		$this->existing_rates();
		$this->new_rates();
		//$this->get_rates1();
	}

	/**
	 * Display rate information from database and update
	 */
	public function rate_update()
	{
		?>
		<form action="" method="POST" enctype="multipart/form-data">
			<p><input type="file" name="file" />
				<input type="submit" name="mq_rates_upload" id="mq_rates_upload" class="button-primary" value="Upload file" />
			</p>
			<?php wp_nonce_field('mq_rates_upload', 'mq_rates_upload_nonce'); ?>
		</form>
		<?php
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
					$csv_array = explode(',', $line); //exlode intp id and rate
					$id_rate_array[$csv_array[0]] = $csv_array[1]; // insert id and rate into array
				}

				$rate_array = [];

				foreach ($id_rate_array as $result_id => $result_value) {
					/* Insert or replace row into mq_rates_full */
					/* Explode rate id */
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

				/* */
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



