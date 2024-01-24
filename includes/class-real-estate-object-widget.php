<?php
class Real_Estate_Object_Widget extends WP_Widget {

	// Constructor
	public function __construct() {
		parent::__construct(
			'custom_widget', // Base ID
			'Custom Widget', // Name
			array('description' => __('A custom widget for your plugin', 'text_domain'))
		);
	}

	// Widget Frontend
	public function widget($args, $instance) {
		// Output the widget content on the frontend
		echo $args['before_widget'];

		// Output your widget content here
		echo '<p>Hello, this is my custom widget content!</p>';

		// Access the parameters
		$param1 = isset($instance['param1']) ? $instance['param1'] : '';
		$param2 = isset($instance['param2']) ? $instance['param2'] : '';
		$param3 = isset($instance['param3']) ? $instance['param3'] : '';

		// Output the parameters
		echo '<p>Param 1: ' . esc_html($param1) . '</p>';
		echo '<p>Param 2: ' . esc_html($param2) . '</p>';
		echo '<p>Param 3: ' . esc_html($param3) . '</p>';

		echo $args['after_widget'];
	}

	// Widget Backend
	public function form($instance) {
		// Output the widget admin form
		$param1 = isset($instance['param1']) ? esc_attr($instance['param1']) : '';
		$param2 = isset($instance['param2']) ? esc_attr($instance['param2']) : '';
		$param3 = isset($instance['param3']) ? esc_attr($instance['param3']) : '';

		?>
		<p>
			<label for="<?php echo $this->get_field_id('param1'); ?>">Parameter 1:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('param1'); ?>" name="<?php echo $this->get_field_name('param1'); ?>" type="text" value="<?php echo $param1; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('param2'); ?>">Parameter 2:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('param2'); ?>" name="<?php echo $this->get_field_name('param2'); ?>" type="text" value="<?php echo $param2; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('param3'); ?>">Parameter 3:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('param3'); ?>" name="<?php echo $this->get_field_name('param3'); ?>" type="text" value="<?php echo $param3; ?>" />
		</p>
		<?php
	}

	// Save Widget Settings
	public function update($new_instance, $old_instance) {
		$instance = array();
		$instance['param1'] = sanitize_text_field($new_instance['param1']);
		$instance['param2'] = sanitize_text_field($new_instance['param2']);
		$instance['param3'] = sanitize_text_field($new_instance['param3']);

		return $instance;
	}
}

// Register the widget
function register_custom_widget() {
	register_widget('Custom_Widget');
}

add_action('widgets_init', 'register_custom_widget');