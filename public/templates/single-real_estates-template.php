<?php
/**
 * Custom single page template for the "real_estates" post type
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */

get_header(); // Include your header file

if ( function_exists('get_field') ) :
?>

	<div class="real-estate__container">
	<?php
	while ( have_posts() ) : the_post();
		// Display the post content here
		$building_name = get_field( 'building_name' ) ? get_field( 'building_name' ) : get_the_title();
		$location_coordinates = get_field( 'location_coordinates' ) ? get_field( 'location_coordinates' ) : get_the_title();
		$floors_number = get_field( 'floors_number' ) ? get_field( 'floors_number' ) : 1;
		$structure_type = get_field( 'structure_type' ) ? get_field( 'structure_type' ) : __('Panel', 'real-estate-object');

		$region_list = wp_get_object_terms( $post->ID, 'real_estates_region', array( 'fields' => 'names' ) );
		$region = empty($region_list) ? __('No regions', 'real-estate-object') : implode(',', $region_list);
		;
    ?>
		<h1><?php echo $building_name; ?></h1>
		<p class="real-estate__location-coordinates">
			<strong><?php _e('Location coordinates: ','real-estate-object');?></strong>
			<?php echo $location_coordinates; ?>
		</p>
		<p class="real-estate__floors-number">
			<strong><?php _e('Number of floors: ','real-estate-object');?></strong>
			<?php echo $floors_number; ?>
		</p>
		<p class="real-estate__structure-type">
			<strong><?php _e('Type of Structure: ','real-estate-object');?></strong>
			<?php echo $structure_type; ?>
		</p>
		<p class="real-estate__region">
			<strong><?php _e('Region: ','real-estate-object');?></strong>
			<?php echo $region; ?>
		</p>

	<?php
	endwhile;
	?>
	</div>

<?php
else :
	_e('Page can\'t be displayed, course ACF plugin is deactivated', 'real-estate-object');
endif;

get_footer(); // Include your footer file
