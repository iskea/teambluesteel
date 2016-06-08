<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$output = live_chat_area();

print balanceTags($output);

