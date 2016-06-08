<?php


$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = !empty($css) ? vc_shortcode_custom_css_class( $css ) : '';
//$url = vc_build_link( $link );


$output = '<table>
	<tr>
		<td>Heading</td>
		<td>'.$heading.'</td>
	</tr>
	<tr>
		<td>Sub-Heading</td>
		<td>'.$subheading.'</td>
	</tr>
	<tr>
		<td>Bundle</td>
		<td>'.$bundle.'</td>
	</tr>
	
</table>';



$url_1 = vc_build_link( $btn_link_1 );
$product_1_id = url_to_postid(esc_url($url_1['url']));

$url_2 = vc_build_link( $btn_link_2 );
$product_2_id = url_to_postid(esc_url($url_2['url']));

$url_3 = vc_build_link( $btn_link_3 );
$product_3_id = url_to_postid(esc_url($url_3['url']));

$url_4 = vc_build_link( $btn_link_4 );
$product_4_id = url_to_postid(esc_url($url_4['url']));



$output = '<div class="container-fluid l-paddding-t-2 l-paddding-b-2 bg-white bundle-tool-feature">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>'.$heading.'</h4>
                <h2>'.$subheading.'</h2>
            </div>
        </div>
        
        <form method="post" action="'.get_home_url().'/do-not-delete/" id="bundle-tool">
        
        <div class="row bundle-tool-tiles">
            <div class="col-md-3 l-padding-b-1 l-padding-t-1">
                <div class="bg-grey feature-tile">
                    <div class="tile-head"><span class="h4">'.get_the_title($product_1_id).'</span></div>
                    <div class="tile-body tile-not-selected">
                        <div class="tile-image">'.get_the_post_thumbnail($product_1_id,array( 200, 200)).'</div>
                        <div class="tile-cta"><a class="btn btn-default">Select your card</a></div>
                    </div>
                    <div class="tile-plus-sign">
                        <p class="plus-sign-icon">
                        <input type="hidden" name="product_url_1" id="product_url_1" value="'.get_permalink($product_1_id).'">
                        <input type="hidden" name="product_select_1" id="product_select_1" value="yes">
                            <button type="submit" id="product_1_added"><span class="picon picon-0151-plus-add-new"><!-- fill --></span></button></p>
                        <p class="plus-sign-label">Add</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 l-padding-t-1 l-padding-b-1">
                <div class="bg-grey feature-tile">
                    <div class="tile-head"><span class="h4">'.get_the_title($product_2_id).'</span></div>
                    <div class="tile-body tile-not-selected">
                        <div class="tile-image">'.get_the_post_thumbnail($product_2_id,array( 200, 200)).'</div>
                        <div class="tile-cta"><a class="btn btn-default">Select your card</a></div>
                    </div>
                    <div class="tile-plus-sign">
                        <p class="plus-sign-icon">
                        <input type="hidden" name="product_url_2" id="product_url_2" value="'.get_permalink($product_2_id).'"> 
                                               <input type="hidden" name="product_select_2" id="product_select_2" value="no">
                           <button type="submit" id="product_2_added"><span class="picon picon-0151-plus-add-new"><!-- fill --></span></button></p>
                        <p class="plus-sign-label">Add</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 l-padding-t-1 l-padding-b-1">
                <div class="bg-grey feature-tile">
                    <div class="tile-head"><span class="h4">'.get_the_title($product_3_id).'</span></div>
                    <div class="tile-body tile-not-selected">
                        <div class="tile-image">'.get_the_post_thumbnail($product_3_id,array( 200, 200)).'</div>
                        <div class="tile-cta"><a class="btn btn-default">Get a quote</a></div>
                    </div>
                    <div class="tile-plus-sign">
                        <p class="plus-sign-icon">
                        <input type="hidden" name="product_url_3" id="product_url_3" value="'.get_permalink($product_3_id).'"> 
                                               <input type="hidden" name="product_select_3" id="product_select_3" value="no">
                           <button type="submit" id="product_2_added"><span class="picon picon-0151-plus-add-new" id="product_3_added"><!-- fill --></span></button></p>
                        <p class="plus-sign-label">Add</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 l-padding-t-1 l-padding-b-1">
                <div class="bg-grey feature-tile">
                    <div class="tile-head"><span class="h4">'.get_the_title($product_4_id).'</span></div>
                    <div class="tile-body tile-not-selected">
                        <div class="tile-image">'.get_the_post_thumbnail($product_4_id,array( 200, 200)).'</div>
                        <div class="tile-cta"><a class="btn btn-default">Select your card</a></div>
                    </div>
                    <div class="tile-plus-sign">
                        <p class="plus-sign-icon">
                        <input type="hidden" name="product_url_4" id="product_url_4" value="'.get_permalink($product_4_id).'">  
                                              <input type="hidden" name="product_select_4" id="product_select_4" value="no">
                             <button type="submit" id="product_2_added"><span class="picon picon-0151-plus-add-new" id="product_4_added"><!-- fill --></span></button></p>
                        <p class="plus-sign-label">Add</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="bundle-tool-result" name="bundle-tool-result">

        </div>
        
        
        </form>
    </div>
</div>

<script>


$(\'#product_1_added\').click(function (e) {
        e.preventDefault();
        
        
		var yes = "yes";
		$(\'#product_select_1\').val(yes);
		// catch the form\'s submit event
		$.ajax({ // create an AJAX call...
			data: $("#bundle-tool").serialize(), // get the form data
			type: $("#bundle-tool").attr(\'method\'), // GET or POST
			url: $("#bundle-tool").attr(\'action\'), // the file to call
			success: function (response) { // on success..
				$(\'#bundle-tool-result\').html(response); // update the DIV
							}
		});
		return false; // cancel original event to prevent form submitting
	});
	
$(\'#product_2_added\').click(function () {

        
		var yes = "yes";
		$(\'#product_select_2\').val(yes);
		// catch the form\'s submit event
		$.ajax({ // create an AJAX call...
			data: $("#bundle-tool").serialize(), // get the form data
			type: $("#bundle-tool").attr(\'method\'), // GET or POST
			url: $("#bundle-tool").attr(\'action\'), // the file to call
			success: function (response) { // on success..
				$(\'#bundle-tool-result\').html(response); // update the DIV
			}
		});
		return false; // cancel original event to prevent form submitting
	});	
	
	$(\'#product_3_added\').click(function () {

		var yes = "yes";
		$(\'#product_select_3\').val(yes);
		// catch the form\'s submit event
		$.ajax({ // create an AJAX call...
			data: $("#bundle-tool").serialize(), // get the form data
			type: $("#bundle-tool").attr(\'method\'), // GET or POST
			url: $("#bundle-tool").attr(\'action\'), // the file to call
			success: function (response) { // on success..
				$(\'#bundle-tool-result\').html(response); // update the DIV
			}
		});
		return false; // cancel original event to prevent form submitting
	});	
	
	$(\'#product_4_added\').click(function () {

		var yes = "yes";
		$(\'#product_select_4\').val(yes);
		// catch the form\'s submit event
		$.ajax({ // create an AJAX call...
			data: $("#bundle-tool").serialize(), // get the form data
			type: $("#bundle-tool").attr(\'method\'), // GET or POST
			url: $("#bundle-tool").attr(\'action\'), // the file to call
			success: function (response) { // on success..
				$(\'#bundle-tool-result\').html(response); // update the DIV
			}
		});
		return false; // cancel original event to prevent form submitting
	});	
</script>


';



print balanceTags($output);
