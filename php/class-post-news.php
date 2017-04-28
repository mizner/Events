<?php
/**
 * Class Post_News
 *
 * @package mkdo\ted_hughes_core
 */

namespace mkdo\ted_hughes_core;

/**
 * Register the News Post Type
 */
class Post_News {

	/**
	 * Constructor
	 */
	function __construct() {}

	/**
	 * Do Work
	 */
	public function run() {
		add_filter( 'gettext', array( $this, 'custom_enter_title' ) );
		add_action( 'init', array( $this, 'register_post_type' ) );
	}

	/**
	 * Custom Enter Title
	 *
	 * @param  string $input The placeholder text.
	 * @return string        The altered placeholder text.
	 */
	public function custom_enter_title( $input ) {

		if ( is_admin() && 'Enter title here' === $input && 'news' === get_post_type( get_the_ID() ) ) {
			return __( 'Enter News Headline', 'ted-hughes-core' );
		}

		return $input;
	}

	/**
	 * Register Post Type
	 */
	public function register_post_type() {

		$labels = array(
			'name'                  => _x( 'News', 'Post Type General Name', 'ted-hughes-core' ),
			'singular_name'         => _x( 'News Item', 'Post Type Singular Name', 'ted-hughes-core' ),
			'menu_name'             => __( 'News', 'ted-hughes-core' ),
			'name_admin_bar'        => __( 'News', 'ted-hughes-core' ),
			'archives'              => __( 'News Item Archives', 'ted-hughes-core' ),
			'parent_item_colon'     => __( 'Parent News Item:', 'ted-hughes-core' ),
			'all_items'             => __( 'All News', 'ted-hughes-core' ),
			'add_new_item'          => __( 'Add New News', 'ted-hughes-core' ),
			'add_new'               => __( 'Add New', 'ted-hughes-core' ),
			'new_item'              => __( 'New News Item', 'ted-hughes-core' ),
			'edit_item'             => __( 'Edit News Item', 'ted-hughes-core' ),
			'update_item'           => __( 'Update News Item', 'ted-hughes-core' ),
			'view_item'             => __( 'View News Item', 'ted-hughes-core' ),
			'search_items'          => __( 'Search News Item', 'ted-hughes-core' ),
			'not_found'             => __( 'Not found', 'ted-hughes-core' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'ted-hughes-core' ),
			'featured_image'        => __( 'Featured Image', 'ted-hughes-core' ),
			'set_featured_image'    => __( 'Set featured image', 'ted-hughes-core' ),
			'remove_featured_image' => __( 'Remove featured image', 'ted-hughes-core' ),
			'use_featured_image'    => __( 'Use as featured image', 'ted-hughes-core' ),
			'insert_into_item'      => __( 'Insert into News Item', 'ted-hughes-core' ),
			'uploaded_to_this_item' => __( 'Uploaded to this News Item', 'ted-hughes-core' ),
			'items_list'            => __( 'News list', 'ted-hughes-core' ),
			'items_list_navigation' => __( 'News list navigation', 'ted-hughes-core' ),
			'filter_items_list'     => __( 'Filter News list', 'ted-hughes-core' ),
		);
		$args = array(
			'label'               => __( 'News Item', 'ted-hughes-core' ),
			'description'         => __( 'Custom Post Type for News', 'ted-hughes-core' ),
			'labels'              => $labels,
			'supports'            => array(
				'title',
				'editor',
				// 'author',
				'thumbnail',
				'excerpt',
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
			'menu_position'       => 6,
			'menu_icon'           => 'dashicons-welcome-widgets-menus',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'show_in_rest'        => false,
			'can_export'          => true,
			'has_archive'         => 'news',
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'rewrite'             => array( 'slug' => _x( 'news', 'News URL', 'ted-hughes-core' ) ),
		);

		register_post_type( 'news', $args );
	}
}
