<?php
class Real_Estate_Object_Widget extends WP_Widget {

	// Constructor
	public function __construct() {
		parent::__construct(
			'real_estate_object_widget',
			__('Real Estate Object Filter', 'real-estate-object-widget'),
			array('description' => __('A widget for your displaying real estate objects filter', 'real-estate-object-widget'))
		);
	}

	// Widget Frontend
	public function widget($args, $instance) {
		// Output the widget content on the frontend
		echo $args['before_widget'];

		// Access the parameters
		$real_estate_objects_count = isset($instance['real_estate_objects_count']) ? $instance['real_estate_objects_count'] : 10;
		$real_estate_objects_per_page = isset($instance['real_estate_objects_per_page']) ? $instance['real_estate_objects_per_page'] : 3;

		echo do_shortcode('[real-estate-objects-filter real_estate_objects_count=' .$real_estate_objects_count. ' real_estate_objects_per_page=' .$real_estate_objects_per_page. ']');

		echo $args['after_widget'];
	}

	// Widget Backend
	public function form($instance) {
		// Output the widget admin form
		$real_estate_objects_count = isset($instance['real_estate_objects_count']) ? esc_attr($instance['real_estate_objects_count']) : 10;
		$real_estate_objects_per_page = isset($instance['real_estate_objects_per_page']) ? esc_attr($instance['real_estate_objects_per_page']) : 3;

		?>
		<p>
			<label for="<?php echo $this->get_field_id('real_estate_objects_count'); ?>"><?php _e('Count of Objects:', 'real-estate-object-widget'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('real_estate_objects_count'); ?>" name="<?php echo $this->get_field_name('real_estate_objects_count'); ?>" type="text" value="<?php echo $real_estate_objects_count; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('real_estate_objects_per_page'); ?>"><?php _e('Count of Objects per page:', 'real-estate-object-widget'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('real_estate_objects_per_page'); ?>" name="<?php echo $this->get_field_name('real_estate_objects_per_page'); ?>" type="text" value="<?php echo $real_estate_objects_per_page; ?>" />
		</p>
		<?php
	}

	// Save Widget Settings
	public function update($new_instance, $old_instance) {
		$instance = array();
		$instance['real_estate_objects_count'] = sanitize_text_field($new_instance['real_estate_objects_count']);
		$instance['real_estate_objects_per_page'] = sanitize_text_field($new_instance['real_estate_objects_per_page']);

		return $instance;
	}
}