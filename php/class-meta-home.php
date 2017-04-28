<?php
/**
 * Class Meta_Home
 *
 * @package mkdo\ted_hughes_core
 */

namespace mkdo\ted_hughes_core;

/**
 * Register the Home Meta Boxes
 */
class Meta_Home {

	/**
	 * The meta data prefix
	 *
	 * @var string
	 */
	private $prefix;


	/**
	 * Constructor
	 */
	function __construct() {
		$this->prefix = '_ted_hughes_core_home_';
	}

	/**
	 * Do Work
	 */
	public function run() {
		add_action( 'cmb2_admin_init', array( $this, 'register_meta_boxes' ), 0 );
	}

	/**
	 * Get prefix
	 */
	public function get_meta_prefix() {
		return $this->prefix;
	}

	/**
	 * Register Meta Boxes
	 */
	public function register_meta_boxes() {

		global $post;

		$cmb = new_cmb2_box(
			array(
				'id'            => 'secondary_title',
				'title'         => __( 'Secondary Title', 'ted-hughes-core' ),
				'object_types' => array( 'page' ), // post type.
				'show_on'      => array(
					'key'   => 'id',
					'value' => array(
						get_option( 'page_on_front' ),
					),
				),
				'priority'      => 'default',
				'context'       => 'primary',
				'show_names'    => false,
			)
		);
		$slides_group_field_1 = $cmb->add_field( array(
			'name'    => __( 'Secondary Title', 'ted-hughes-core' ),
			'id'      => $this->prefix . 'title',
			'type'    => 'text',
		) );
	}
}
