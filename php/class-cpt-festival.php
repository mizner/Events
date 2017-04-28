<?php
/**
 * Class CPT_Festival_Register
 *
 * @package mkdo\ted_hughes_core
 */

namespace mkdo\ted_hughes_core;

if ( ! class_exists( 'CPT_Festival_Register' ) ) {

	/**
	 * Registers Custom Post Types
	 */
	class CPT_Festival_Register {

		/**
		 * Constructor
		 */
		function __construct() {
		}

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
				'name'                  => _x( 'Festivals', 'Post Type General Name', 'ted-hughes' ),
				'singular_name'         => _x( 'Festival', 'Post Type Singular Name', 'ted-hughes' ),
				'menu_name'             => __( 'Festivals', 'ted-hughes' ),
				'name_admin_bar'        => __( 'Festival', 'ted-hughes' ),
				'archives'              => __( 'Festivals Archives', 'ted-hughes' ),
				'parent_item_colon'     => __( 'Parent Festivals:', 'ted-hughes' ),
				'all_items'             => __( 'All Festivals', 'ted-hughes' ),
				'add_new_item'          => __( 'Add New Festival', 'ted-hughes' ),
				'add_new'               => __( 'Add New', 'ted-hughes' ),
				'new_item'              => __( 'New Festival', 'ted-hughes' ),
				'edit_item'             => __( 'Edit Festival', 'ted-hughes' ),
				'update_item'           => __( 'Update Festival', 'ted-hughes' ),
				'view_item'             => __( 'View Festival', 'ted-hughes' ),
				'search_items'          => __( 'Search Festivals', 'ted-hughes' ),
				'not_found'             => __( 'Not found', 'ted-hughes' ),
				'not_found_in_trash'    => __( 'Not found in Trash', 'ted-hughes' ),
				'featured_image'        => __( 'Featured Image', 'ted-hughes' ),
				'set_featured_image'    => __( 'Set featured image', 'ted-hughes' ),
				'remove_featured_image' => __( 'Remove featured image', 'ted-hughes' ),
				'use_featured_image'    => __( 'Use as featured image', 'ted-hughes' ),
				'insert_into_item'      => __( 'Insert into Festivals', 'ted-hughes' ),
				'uploaded_to_this_item' => __( 'Uploaded to this Festivals', 'ted-hughes' ),
				'items_list'            => __( 'Festivals list', 'ted-hughes' ),
				'items_list_navigation' => __( 'Festivals list navigation', 'ted-hughes' ),
				'filter_items_list'     => __( 'Filter Festivals list', 'ted-hughes' ),
			);
			$args   = array(
				'label'               => __( 'Festivals', 'ted-hughes' ),
				'description'         => __( 'Custom Post Type for Festivals', 'ted-hughes' ),
				'labels'              => $labels,
				'supports'            => array(
					'title',
					// 'editor',
					// 'author',
					'thumbnail',
					// 'excerpt',
					// 'trackbacks',
					// 'custom-fields',
					// 'comments',
					// 'revisions',
					// 'page-attributes',
					// 'post-formats',
				),
				'hierarchical'        => false,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'menu_position'       => 20,
				'menu_icon'           => 'dashicons-tickets-alt',
				'show_in_admin_bar'   => true,
				'show_in_nav_menus'   => true,
				'show_in_rest'        => true,
				'can_export'          => true,
				'has_archive'         => true,
				'exclude_from_search' => false,
				'publicly_queryable'  => true,
				'capability_type'     => 'page',
				'rewrite'             => array( 'slug' => _x( 'festivals', 'Festivals URL', 'ted-hughes' ) ),
			);

			register_post_type( 'festival', $args );
		}
	}
}
