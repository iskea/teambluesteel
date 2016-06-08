<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = !empty($css) ? vc_shortcode_custom_css_class( $css ) : '';
$items_array = (array) vc_param_group_parse_atts( $services_items );
$category = array();

if(!empty($items_array))
	foreach ($items_array as $key => $tab)
		if(!in_array($tab['item_category'], $category, true))
	        array_push($category, $tab['item_category']);
?>

<div class="isotope-filters">
	<?php if(!empty($category)):?>
	<ul class="clean-list">
		<?php foreach ($category as $key => $cat):?>
			<li><span class="<?php print $key == 0 ? 'current' : '';?>" data-filter=".<?php print sanitize_title($cat);?>"><?php print $cat;?></span></li>
		<?php endforeach;?>
	</ul>
	<?php endif;?>
</div>

<?php if(!empty($items_array)):?>
<div class="isotope-container row row-fit-10 services-list <?php echo esc_attr($css_class.' '.$el_class);?>" data-default-selection="<?php print !empty($category) ? '.'.sanitize_title($category[0]) : '*';?>">
	<?php foreach ($items_array as $key => $tab):
		vc_icon_element_fonts_enqueue( $tab['type'] );
		$service_icon = $tab['icon_'.$tab['type']];
		$bg_color = !empty($tab['bg_color']) ? esc_attr('background: '.$tab['bg_color']) : '';
		$tx_color = !empty($tab['text_color']) ? esc_attr('color: '.$tab['text_color']) : '';
		if($tab['item_size'] == 'big'):?>
			<div class="col-md-24 isotope-item <?php print sanitize_title($tab['item_category']);?>">
				<div class="service-big" style="<?php echo esc_attr($bg_color.';'.$tx_color);?>">
					<div class="icon">
						<h5><?php print $tab['item_title'];?></h5>
						<i class="<?php echo esc_attr($service_icon);?>"></i>
					</div>

					<p class="description"><?php print $tab['item_desc'];?></p>
				</div>
			</div>
		<?php else:?>
			<div class="col-lg-8 col-md-12 col-xs-12 isotope-item <?php print sanitize_title($tab['item_category']);?>">
				<div class="service-box">
					<div class="front" style="<?php echo esc_attr($bg_color.';'.$tx_color);?>">
						<div class="content">
							<i class="<?php echo esc_attr($service_icon);?>"></i>
							<h5><?php print $tab['item_title'];?></h5>
						</div>
					</div>

					<div class="back">
						<div class="content">
							<h5><?php print $tab['item_title'];?></h5>
							<p><?php print $tab['item_desc'];?></p>
						</div>
					</div>
				</div>
			</div>
		<?php endif;		
	endforeach;?>
</div>
<?php endif;?>