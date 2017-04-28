<?php
/**
 * Class Post_Carousel
 *
 * @package mkdo\ted_hughes_core
 */

namespace mkdo\ted_hughes_core;

/**
 * Register the Carousel Post Type
 */
class Post_Carousel {

	/**
	 * Constructor
	 */
	function __construct() {}

	/**
	 * Do Work
	 */
	public function run() {
		add_action( 'init', array( $this, 'register_post_type' ) );
	}

	 /**
	  * Register Post Type
	  */
	public function register_post_type() {

		$labels = array(
			'name'                  => _x( 'Carousels', 'Post Type General Name', 'ted-hughes-core' ),
			'singular_name'         => _x( 'Carousel', 'Post Type Singular Name', 'ted-hughes-core' ),
			'menu_name'             => __( 'Carousels', 'ted-hughes-core' ),
			'name_admin_bar'        => __( 'Carousels', 'ted-hughes-core' ),
			'archives'              => __( 'Carousel Archives', 'ted-hughes-core' ),
			'parent_item_colon'     => __( 'Parent Carousel:', 'ted-hughes-core' ),
			'all_items'             => __( 'All Carousels', 'ted-hughes-core' ),
			'add_new_item'          => __( 'Add New Carousel', 'ted-hughes-core' ),
			'add_new'               => __( 'Add New', 'ted-hughes-core' ),
			'new_item'              => __( 'New Carousel', 'ted-hughes-core' ),
			'edit_item'             => __( 'Edit Carousel', 'ted-hughes-core' ),
			'update_item'           => __( 'Update Carousel', 'ted-hughes-core' ),
			'view_item'             => __( 'View Carousel', 'ted-hughes-core' ),
			'search_items'          => __( 'Search Carousels', 'ted-hughes-core' ),
			'not_found'             => __( 'Not found', 'ted-hughes-core' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'ted-hughes-core' ),
			'featured_image'        => __( 'Featured Image', 'ted-hughes-core' ),
			'set_featured_image'    => __( 'Set featured image', 'ted-hughes-core' ),
			'remove_featured_image' => __( 'Remove featured image', 'ted-hughes-core' ),
			'use_featured_image'    => __( 'Use as featured image', 'ted-hughes-core' ),
			'insert_into_item'      => __( 'Insert into Carousel', 'ted-hughes-core' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Carousel', 'ted-hughes-core' ),
			'items_list'            => __( 'Carousel list', 'ted-hughes-core' ),
			'items_list_navigation' => __( 'Carousel list navigation', 'ted-hughes-core' ),
			'filter_items_list'     => __( 'Filter Carousel list', 'ted-hughes-core' ),
		);

		$args = array(
			'label'               => __( 'Carousel', 'ted-hughes-core' ),
			'description'         => __( 'Custom Post Type for Carousel', 'ted-hughes-core' ),
			'labels'              => $labels,
			'supports'            => array(
			'title',
			 // 'editor',
			 // 'author',
			 // 'thumbnail',
			 // 'excerpt',
			 // 'trackbacks',
			 // 'custom-fields',
			 // 'comments',
			 // 'revisions',
			 // 'page-attributes',
			 // 'post-formats',
			),
			'hierarchical'        => false,
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 20,
			'menu_icon'           => 'dashicons-format-gallery',
			'show_in_admin_bar'   => false,
			'show_in_nav_menus'   => false,
			'show_in_rest'        => false,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
			'rewrite'             => array( 'slug' => _x( '/carousel', 'Carousel URL', 'ted-hughes-core' ) ),
		);

		register_post_type( 'carousel', $args );
	}
}
