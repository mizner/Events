<?php
/**
 * Class CPT_Session_Register
 *
 * @package mkdo\ted_hughes_core
 */

namespace mkdo\ted_hughes_core;

if ( ! class_exists( 'CPT_Session_Register' ) ) {

	/**
	 * Registers Custom Post Types
	 */
	class CPT_Session_Register {

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
				'name'                  => _x( 'Sessions', 'Post Type General Name', 'ted-hughes' ),
				'singular_name'         => _x( 'Session', 'Post Type Singular Name', 'ted-hughes' ),
				'menu_name'             => __( 'Sessions', 'ted-hughes' ),
				'name_admin_bar'        => __( 'Session', 'ted-hughes' ),
				'archives'              => __( 'Sessions Archives', 'ted-hughes' ),
				'parent_item_colon'     => __( 'Parent Sessions:', 'ted-hughes' ),
				'all_items'             => __( 'All Sessions', 'ted-hughes' ),
				'add_new_item'          => __( 'Add New Session', 'ted-hughes' ),
				'add_new'               => __( 'Add New', 'ted-hughes' ),
				'new_item'              => __( 'New Session', 'ted-hughes' ),
				'edit_item'             => __( 'Edit Session', 'ted-hughes' ),
				'update_item'           => __( 'Update Session', 'ted-hughes' ),
				'view_item'             => __( 'View Session', 'ted-hughes' ),
				'search_items'          => __( 'Search Sessions', 'ted-hughes' ),
				'not_found'             => __( 'Not found', 'ted-hughes' ),
				'not_found_in_trash'    => __( 'Not found in Trash', 'ted-hughes' ),
				'featured_image'        => __( 'Featured Image', 'ted-hughes' ),
				'set_featured_image'    => __( 'Set featured image', 'ted-hughes' ),
				'remove_featured_image' => __( 'Remove featured image', 'ted-hughes' ),
				'use_featured_image'    => __( 'Use as featured image', 'ted-hughes' ),
				'insert_into_item'      => __( 'Insert into Sessions', 'ted-hughes' ),
				'uploaded_to_this_item' => __( 'Uploaded to this Sessions', 'ted-hughes' ),
				'items_list'            => __( 'Sessions list', 'ted-hughes' ),
				'items_list_navigation' => __( 'Sessions list navigation', 'ted-hughes' ),
				'filter_items_list'     => __( 'Filter Sessions list', 'ted-hughes' ),
			);
			$args   = array(
				'label'               => __( 'Sessions', 'ted-hughes' ),
				'description'         => __( 'Custom Post Type for Sessions', 'ted-hughes' ),
				'labels'              => $labels,
				'supports'            => array(
					'title',
					'editor',
					// 'author',
					'thumbnail',
					// 'excerpt',
					// 'trackbacks',
					// 'custom-fields',
					// 'comments',
					// 'revisions',
					'page-attributes',
					// 'post-formats',
				),
				'hierarchical'        => true,
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
				// 'rewrite'             => array( 'slug' => _x( 'sessions', 'Sessions URL', 'ted-hughes' ) ),
			);

			register_post_type( 'session', $args );
		}
	}
}
