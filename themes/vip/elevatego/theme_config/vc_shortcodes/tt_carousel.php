<?php 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = !empty($css) ? vc_shortcode_custom_css_class( $css ) : '';

if(!empty($images)):?>
<div class="slick-carousel <?php echo esc_attr($css_class.' '.$el_class);?>" data-speed="<?php print !empty($it_speed) ? $it_speed : '1200';?>" data-infinite="true" data-items-desktop="1" data-fade="true" data-dots="false">	
	<ul class="clean-list carousel-items">
		<?php $images = explode(',', $images);
		foreach($images as $id):?>
			<li class="carousel-item">
				<img class="fitted" src="<?php echo wp_get_attachment_url($id) ? wp_get_attachment_url($id) : 'https://unsplash.it/1000/1080/?image='.$id;?>" alt="<?php echo get_the_title($id);?>">
			</li>
		<?php endforeach;?>
	</ul>
</div>
<?php endif;?>