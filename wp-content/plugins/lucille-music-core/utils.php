<?php

function LMC_SWP_render_select_options($options, $selected) {
	if (empty($selected)) {
		return;
	}

	foreach($options as $key => $value) {
		if ($value == $selected) {
			?>
			<option value="<?php echo esc_attr($value); ?>" selected="selected"> <?php echo esc_attr($key); ?> </option>
			<?php
		} else {
			?>
			<option value="<?php echo esc_attr($value); ?>"> <?php echo esc_attr($key); ?> </option>
			<?php
		}
	}
}