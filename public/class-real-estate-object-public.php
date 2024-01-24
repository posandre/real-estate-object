<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.api-telegram-bot.fun/
 * @since      1.0.0
 *
 * @package    Real_Estate_Object
 * @subpackage Real_Estate_Object/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Real_Estate_Object
 * @subpackage Real_Estate_Object/public
 * @author     Andrii Postoliuk <an.postoliuk@gmail.com>
 */
class Real_Estate_Object_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Real_Estate_Object_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Real_Estate_Object_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		if ( WP_DEBUG ) {
			$suffix = '.css';
		} else {
			$suffix = '.min.css';
		}

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/css/real-estate-object-public' . $suffix, array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Real_Estate_Object_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Real_Estate_Object_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		if ( WP_DEBUG ) {
			$suffix = '.js';
		} else {
			$suffix = '.min.js';
		}

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/js/real-estate-object-public' . $suffix, array( 'jquery' ), $this->version, false );

		$json = json_encode( array(
			'ajax_url' => admin_url('admin-ajax.php'),
		) );

		wp_add_inline_script( $this->plugin_name, "const realEstateObjectSettings = $json", 'before' );
	}

	/**
	 * Load custom single template for the "real_estates" post type
	 *
	 * @since    1.0.0
	 */
	public function load_custom_single_template($single_template) {
		global $post;

		if ($post->post_type == 'real_estates') {
			$single_template = plugin_dir_path( dirname( __FILE__ ) ) . 'public/templates/single-real_estates-template.php';
		}

		return $single_template;
	}

	/**
	 * This function generate form shortcode
	 *
	 * @param $atts
	 *
	 * @since    1.0.0
	 *
	 * @return string
	 */
	public function add_real_estate_objects_filter_shortcode($atts) {

		$atts = shortcode_atts(
				array(
					'class'                         =>  '',
					'real_estate_objects_count'     =>  10,
					'real_estate_objects_per_page'  =>  3,
		), $atts );

		$classes = array('real-estate-objects-filter__wrapper');

		if ( !empty($atts['class']) ) {
			$classes[] =  $atts['class'];
		}

		$region_items = get_terms([
			'taxonomy'      => 'real_estates_region',
			'hide_empty'    => false,
		]);

		$region_options = '<option value="0">' .__('All', $this->plugin_name). '</option>';

		foreach ($region_items as $region_item){
			$region_options .= '<option value="' .$region_item->slug. '">' .$region_item->name. '</option>';
		}

		$output  = '
		<div class="' . implode(' ', $classes). '">
			<div id="real-estate-objects-filter-form" class="real-estate-objects-filter__form">
				<h2>' . __('Real estate object filter', $this->plugin_name) . '</h2>
				<label for="building-name"><strong>' . __('Name of building: ', $this->plugin_name) . '</strong><input id="building-name" name="building-name" type="text" value=""></label>
				<label for="location-coordinates"><strong>' . __('Location coordinates: ', $this->plugin_name) . '</strong><input id="location-coordinates" name="location-coordinates" type="text" value=""></label>
				<label for="floors-number"><strong>' . __('Number of floors: ', $this->plugin_name) . '</strong>
					<select id="floors-number" name="floors-number">
						<option value="0">' .__('All', $this->plugin_name). '</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
						<option value="13">13</option>
						<option value="14">14</option>
						<option value="15">15</option>
						<option value="16">16</option>
						<option value="17">17</option>
						<option value="18">18</option>
						<option value="19">19</option>
						<option value="20">20</option>
					</select>
				</label>
				<label for="region"><strong>' . __('Region: ', $this->plugin_name) . '</strong>
					<select id="region" name="region">' .$region_options. '</select>
				</label>				
				<fieldset>
				    <legend>' .__('Please select type of structure:', $this->plugin_name). '</legend>
				      <label for="structure-type-2"><input type="radio" id="structure-type-2" name="structure-type" value="panel" >' .__('Panel', $this->plugin_name). '</label>		      
				      <label for="structure-type-3"><input type="radio" id="structure-type-3" name="structure-type" value="brick" >' .__('Brick', $this->plugin_name). '</label>     
				      <label for="structure-type-4"><input type="radio" id="structure-type-4" name="structure-type" value="foam block" >' .__('Foam block', $this->plugin_name). '</label>
				</fieldset>				
				<button id="real-estate-objects-filter-button" type="button">' .__('Filter', $this->plugin_name). '</button>
				<input type="hidden" id="objects-count" name="objects-count" value="' .$atts['real_estate_objects_count']. '" />		
				<input type="hidden" id="objects-per-page" name="objects-per-page" value="' .$atts['real_estate_objects_per_page']. '" />		
			</div>
			<div id="real-estate-objects-filter-results" class="real-estate-objects-filter__results"></div>
			<div id="real-estate-objects-filter-pagination" class="real-estate-objects-filter__pagination"></div>
		</div>
		';

		return $output;

	}

}
