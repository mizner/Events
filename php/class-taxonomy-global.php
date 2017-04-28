<?php
/**
 * Class Taxonomy_Global
 *
 * @package mkdo\ted_hughes_core
 */

namespace mkdo\ted_hughes_core;

/**
 * Register Global Taxonomy
 */
class Taxonomy_Global {

	/**
	 * Font Awesome Icons
	 *
	 * @var array
	 */
	private $icons;

	/**
	 * Constructor
	 */
	function __construct() {}

	/**
	 * Do Work
	 */
	public function run() {
		add_action( 'init', array( $this, 'register_taxonomy' ), 9999 );
	}

	/**
	 * Register Taxonomy
	 */
	public function register_taxonomy() {

		$labels = array(
			'name'                       => _x( 'Global Taxonomy', 'Taxonomy General Name', 'ted-hughes-core' ),
			'singular_name'              => _x( 'Global Taxonomy', 'Taxonomy General Name', 'ted-hughes-core' ),
			'menu_name'                  => __( 'Global Taxonomy', 'ted-hughes-core' ),
			'all_items'                  => __( 'All Global Taxonomy', 'ted-hughes-core' ),
			'edit_item'                  => __( 'Edit Global Taxonomy', 'ted-hughes-core' ),
			'view_item'                  => __( 'View Global Taxonomy', 'ted-hughes-core' ),
			'update_item'                => __( 'Update Global Taxonomy', 'ted-hughes-core' ),
			'add_new_item'               => __( 'Add New Global Taxonomy', 'ted-hughes-core' ),
			'new_item_name'              => __( 'New Global Taxonomy Name', 'ted-hughes-core' ),
			'search_items'               => __( 'Search Global Taxonomy', 'ted-hughes-core' ),
			'popular_items'              => __( 'Popular Global Taxonomy', 'ted-hughes-core' ),
			'separate_items_with_commas' => __( 'Separate tags with commas', 'ted-hughes-core' ),
			'add_or_remove_items'        => __( 'Add or remove tags', 'ted-hughes-core' ),
			'choose_from_most_used'      => __( 'Choose from the most used tags', 'ted-hughes-core' ),
			'not_found'                  => __( 'No tags found.', 'ted-hughes-core' ),
		);
		$args = array(
			'hierarchical'          => true,
			'labels'                => $labels,
			'show_ui'               => true,
			'show_admin_column'     => true,
			'query_var'             => true,
			'public'                => true,
			'publicly_queryable'    => true,
		);

		register_taxonomy(
			'global_taxonomy',
			array(
				'page',
				'post',
				'news',
				'festival',
				'tribe_events',
				'people',
			),
			$args
		);
	}
}
