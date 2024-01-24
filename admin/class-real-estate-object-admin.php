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
								'panel'      => __( 'Panel', $this->plugin_name ),
								'brick'      => __( 'Brick', $this->plugin_name ),
								'foam block' => __( 'Foam block', $this->plugin_name ),
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
		register_widget( 'Real_Estate_Object_Widget' );
	}

	/**
	 * Filter Ajax callback function.
	 *
	 * @since    1.0.0
	 */
	public function real_estate_object_run_filter_callback() {
		$pagination_data = '';

		$page             = empty( $_POST['page'] ) ? 1 : $_POST['page'];
		$objects_per_page = empty( $_POST['objects_per_page'] ) ? 3 : $_POST['objects_per_page'];
		$objects_count    = empty( $_POST['objects_count'] ) ? 10 : $_POST['objects_count'];

		if ( empty( $_POST['building_name'] ) && empty( $_POST['location_coordinates'] ) && empty( $_POST['floors_number'] ) && empty( $_POST['structure_type'] ) ) {
			$meta_query = '';
		} else {
			$meta_query = array(
				'relation' => 'AND'
			);

			if ( ! empty( $_POST['building_name'] ) ) {
				$meta_query[] = array(
					array(
						'key'     => 'building_name',
						'value'   => $_POST['building_name'],
						'compare' => '=',
					),
				);
			};

			if ( ! empty( $_POST['location_coordinates'] ) ) {
				$meta_query[] = array(
					array(
						'key'     => 'location_coordinates',
						'value'   => $_POST['location_coordinates'],
						'compare' => '=',
					),
				);
			};

			if ( ! empty( $_POST['floors_number'] ) ) {
				$meta_query[] = array(
					array(
						'key'     => 'floors_number',
						'value'   => $_POST['floors_number'],
						'compare' => '=',
					),
				);
			};

			if ( ! empty( $_POST['structure_type'] ) ) {
				$meta_query[] = array(
					array(
						'key'     => 'structure_type',
						'value'   => $_POST['structure_type'],
						'compare' => '=',
					),
				);
			};
		}

		if ( empty( $_POST['region'] ) ) {
			$tax_query = '';
		} else {
			$tax_query = array(
				array(
					'taxonomy' => 'real_estates_region',
					'field'    => 'slug',
					'terms'    => $_POST['region'],
				),
			);
		}

		$args = array(
			'post_type'      => 'real_estates',
			'numberposts'    => $objects_count,
			'posts_per_page' => $objects_per_page,
			'offset'         => ( $page - 1 ) * $objects_per_page,
			'meta_query'     => $meta_query,
			'tax_query'      => $tax_query,
		);

		$real_estate_objects = get_posts( $args );

		if ( ! empty( $real_estate_objects ) ) {
			$real_estate_data = '<div class="real-estate__items">';

			foreach ( $real_estate_objects as $real_estate_object ) {
				$building_name        = get_field( 'building_name', $real_estate_object->ID ) ? get_field( 'building_name', $real_estate_object->ID ) : get_the_title();
				$location_coordinates = get_field( 'location_coordinates', $real_estate_object->ID ) ? get_field( 'location_coordinates', $real_estate_object->ID ) : get_the_title();
				$floors_number        = get_field( 'floors_number', $real_estate_object->ID ) ? get_field( 'floors_number', $real_estate_object->ID ) : 1;
				$structure_type       = get_field( 'structure_type', $real_estate_object->ID ) ? get_field( 'structure_type', $real_estate_object->ID ) : __( 'Panel', 'real-estate-object' );

				$region_list = wp_get_object_terms( $real_estate_object->ID, 'real_estates_region', array( 'fields' => 'names' ) );
				$region      = empty( $region_list ) ? __( 'No regions', 'real-estate-object' ) : implode( ',', $region_list );

				$real_estate_data .= '
					<div class="real-estate__item">
						<h3>' . $building_name . '</h3>
						<p class="real-estate__location-coordinates">
							<strong>' . __( 'Location coordinates: ', 'real-estate-object' ) . '</strong>
							' . $location_coordinates . '
						</p>
						<p class="real-estate__floors-number">
							<strong>' . __( 'Number of floors: ', 'real-estate-object' ) . '</strong>
							' . $floors_number . '
						</p>
						<p class="real-estate__structure-type">
							<strong>' . __( 'Type of Structure: ', 'real-estate-object' ) . '</strong>
							' . $structure_type . '
						</p>
						<p class="real-estate__region">
							<strong>' . __( 'Region: ', 'real-estate-object' ) . '</strong>
							' . $region . '
						</p>	
					</div>			
				';
			}
			$real_estate_data .= '</div>';

			if ( $page == 1 ) {
				$args_all = array(
					'post_type'      => 'real_estates',
					'numberposts'    => $objects_count,
					'posts_per_page' => - 1,
					'offset'         => 0,
					'meta_query'     => $meta_query,
					'tax_query'      => $tax_query,
				);

				$real_estate_pages_count = ceil( count( get_posts( $args_all ) ) / $objects_per_page );

				if ($real_estate_pages_count > 1) {
					$pagination_data .= '<p class="pagination-item pagination-item--active">1</p>';

					for ( $i = 2; $i <= $real_estate_pages_count; $i ++ ) {
						$pagination_data .= '<p class="pagination-item">' . $i . '</p>';
					}
				}
			}
		} else {
			$real_estate_data = '<p>' . __( 'No data found', 'real-estate-object' ) . '</p>';
		}

		$response_data = array(
			'response'         => 'Hello',
			'post'             => $_POST,
			'args'             => $args,
			'real_estate_data' => $real_estate_data,
			'pagination_data'  => $pagination_data
		);

		wp_send_json_success( $response_data );
	}

}
