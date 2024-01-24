<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.api-telegram-bot.fun/
 * @since      1.0.0
 *
 * @package    Real_Estate_Object
 * @subpackage PReal_Estate_Object/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Real_Estate_Object
 * @subpackage Real_Estate_Object/admin
 * @author     Andrii Postoliuk <an.postoliuk@gmail.com>
 */
class Real_Estate_Object_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @param string $plugin_name The name of this plugin.
	 * @param string $version The version of this plugin.
	 *
	 * @since    1.0.0
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

		/**
		 * The class responsible for defining Real estate object Widget
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-real-estate-object-widget.php';

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/css/real-estate-object-admin' . $suffix, array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/js/real-estate-object-admin' . $suffix, array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register new post types.
	 *
	 * @since    1.0.0
	 */
	public function register_new_post_types() {
		register_post_type( 'real_estates',
			array(
				'labels'        => array(
					'name'          => __( 'Real Estates', $this->plugin_name ),
					'singular_name' => __( 'Real Estate', $this->plugin_name )
				),
				'public'        => true,
				'show_in_rest'  => true,
				'supports'      => array(
					'title',
				),
				'has_archive'   => true,
				'rewrite'       => array(
					'slug' => 'real-estates'
				),
				'menu_position' => 5,
				'menu_icon'     => 'dashicons-building',
			)
		);
	}

	/**
	 * Register new post types.
	 *
	 * @since    1.0.0
	 */
	public function register_new_taxonomies() {
		register_taxonomy(
			'real_estates_region',
			'real_estates',
			array(
				'hierarchical'      => true,
				'labels'            => array(
					'name'          => __( 'Regions', $this->plugin_name ),
					'singular_name' => __( 'Region', $this->plugin_name ),
				),
				'show_ui'           => true,
				'show_in_rest'      => true,
				'show_admin_column' => true,
			) );
	}

	/**
	 * Register new post types.
	 *
	 * @since    1.0.0
	 */
	public function register_new_ACF_fields() {
		if ( function_exists( 'acf_add_local_field_group' ) ) {

			acf_add_local_field_group( array(
					'key'                   => 'group_65b037ce77f77',
					'title'                 => __( 'Real Estate Custom Fields', $this->plugin_name ),
					'fields'                => array(
						array(
							'key'               => 'field_65b037cec4d5e',
							'label'             => __( 'Building Name', $this->plugin_name ),
							'name'              => 'building_name',
							'aria-label'        => '',
							'type'              => 'text',
							'instructions'      => '',
							'required'          => 1,
							'conditional_logic' => 0,
							'wrapper'           => array(
								'width' => '',
								'class' => '',
								'id'    => '',
							),
							'default_value'     => '',
							'maxlength'         => '',
							'placeholder'       => '',
							'prepend'           => '',
							'append'            => '',
						),
						array(
							'key'               => 'field_65b03877c4d5f',
							'label'             => __( 'Location Coordinates', $this->plugin_name ),
							'name'              => 'location_coordinates',
							'aria-label'        => '',
							'type'              => 'text',
							'instructions'      => '',
							'required'          => 1,
							'conditional_logic' => 0,
							'wrapper'           => array(
								'width' => '',
								'class' => '',
								'id'    => '',
							),
							'default_value'     => '',
							'maxlength'         => '',
							'placeholder'       => '',
							'prepend'           => '',
							'append'            => '',
						),
						array(
							'key'               => 'field_65b038a4c4d60',
							'label'             => __( 'Number of floors', $this->plugin_name ),
							'name'              => 'floors_number',
							'aria-label'        => '',
							'type'              => 'select',
							'instructions'      => '',
							'required'          => 1,
							'conditional_logic' => 0,
							'wrapper'           => array(
								'width' => '',
								'class' => '',
								'id'    => '',
							),
							'choices'           => array(
								1  => '1',
								2  => '2',
								3  => '3',
								4  => '4',
								5  => '5',
								6  => '6',
								7  => '7',
								8  => '8',
								9  => '9',
								10 => '10',
								11 => '11',
								12 => '12',
								13 => '13',
								14 => '14',
								15 => '15',
								16 => '16',
								17 => '17',
								18 => '18',
								19 => '19',
								20 => '20',
							),
							'default_value'     => 1,
							'return_format'     => 'value',
							'multiple'          => 0,
							'allow_null'        => 0,
							'ui'                => 0,
							'ajax'              => 0,
							'placeholder'       => '',
						),
						array(
							'key'               => 'field_65b0396ec4d61',
							'label'             => __( 'Type of Structure', $this->plugin_name ),
							'name'              => 'structure_type',
							'aria-label'        => '',
							'type'              => 'radio',
							'instructions'      => '',
							'required'          => 1,
							'conditional_logic' => 0,
							'wrapper'           => array(
								'width' => '',
								'class' => '',
								'id'    => '',
							),
							'choices'           => array(
								'panel'      => __('Panel', $this->plugin_name),
								'brick'      => __('Brick', $this->plugin_name),
								'foam block' => __('Foam block', $this->plugin_name),
							),
							'default_value'     => 'panel',
							'return_format'     => 'value',
							'allow_null'        => 0,
							'other_choice'      => 0,
							'layout'            => 'vertical',
							'save_other_choice' => 0,
						),
					),
					'location'              => array(
						array(
							array(
								'param'    => 'post_type',
								'operator' => '==',
								'value'    => 'real_estates',
							),
						),
					),
					'menu_order'            => 0,
					'position'              => 'normal',
					'style'                 => 'default',
					'label_placement'       => 'top',
					'instruction_placement' => 'label',
					'hide_on_screen'        => '',
					'active'                => true,
					'description'           => '',
					'show_in_rest'          => 0,
				)
			);

		}
	}

	/**
	 * Register custom widget.
	 *
	 * @since    1.0.0
	 */
	public function register_custom_widget() {
		register_widget('Real_Estate_Object_Widget');
	}

}
