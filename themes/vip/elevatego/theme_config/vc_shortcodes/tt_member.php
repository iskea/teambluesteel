<?php 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$social_array = (array) vc_param_group_parse_atts( $socials );
$data = array('name'=> $member_name,'content'=>$content,'job'=>$member_job,'cover'=>wp_get_attachment_url($member_image),'socials'=>$social_array);
?>

<div class="team-member <?php echo esc_attr($el_class);?>" data-json='<?php echo json_encode($data);?>'>
	<img src="<?php echo wp_get_attachment_url($member_thumb);?>" alt="<?php echo esc_attr($member_name);?>">
	<span class="name"><?php echo esc_attr($member_name);?></span>
</div>