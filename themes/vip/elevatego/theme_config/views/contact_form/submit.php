<input 
	type="submit"
 	class="btn medium" 
 	value="<?php echo isset($label) && $label !== '' ? $label : 'Send' ?>"
 	data-sending='<?php _e('Sending Message','advent') ?>'
	data-sent='<?php _e('Message Successfully Sent','advent') ?>'>