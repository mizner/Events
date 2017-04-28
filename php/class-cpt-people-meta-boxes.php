<?php
/**
 * Class CPT_People_Meta_Boxes
 *
 * @package mkdo\ted_hughes_core
 */

namespace mkdo\ted_hughes_core;

if ( ! class_exists( 'CPT_Person_Meta_Boxes' ) ) {

	/**
	 * Registers CPT "People" Metaboxes
	 */
	class CPT_Person_Meta_Boxes {

		/**
		 * Prefix for meta data
		 *
		 * @var string
		 */
		private $prefix = 'people_';

		/**
		 * Constructor
		 */
		function __construct() {}

		/**
		 * Getter forthe prefix
		 *
		 * @return string Prefix
		 */
		public function get_prefix() {
			return $this->prefix;
		}

		/**
		 * Do Work
		 */
		public function run() {
			add_action( 'cmb2_admin_init', array( $this, 'register_meta_boxes' ), 10, 5 );
			add_filter( 'gettext', array( $this, 'custom_enter_title' ) );
		}

		/**
		 * Change the title placeholder text
		 *
		 * @param  string $input The placeholder text.
		 * @return string        The altered placeholder text.
		 */
		public function custom_enter_title( $input ) {

			if ( is_admin() && 'Enter title here' === $input && 'people' === get_post_type( get_the_ID() ) ) {
				return __( "Enter Person's Name", 'ted-hughes' );
			}

			return $input;
		}

		/**
		 * Register meta boxes
		 */
		public function register_meta_boxes() {

			$prefix = $this->prefix;

			$cmb = new_cmb2_box( array(
				'id'           => 'contact_info',
				'title'        => 'Contact Details',
				'object_types' => array( 'people' ), // Post Type.
				'context'      => 'side', // Accepts normal, advanced, or side.
				'priority'     => 'core',  // Accepts high, core, default or low.
				'show_names'   => false, // Show field names on the left.
			) );

			$cmb->add_field( array(
				'name'       => __( 'Email', 'cmb2' ),
				'id'         => $prefix . 'email_url',
				'type'       => 'text_email',
				'attributes' => array(
					'placeholder' => 'Email',
				),
			) );

			$cmb->add_field( array(
				'name'       => __( 'Phone', 'cmb2' ),
				'id'         => $prefix . 'phone_number',
				'type'       => 'text',
				'attributes' => array(
					'placeholder' => 'Phone Number',
				),
			) );

			$cmb->add_field( array(
				'name'       => __( 'Facebook', 'cmb2' ),
				'id'         => $prefix . 'facebook_url',
				'type'       => 'text_url',
				'attributes' => array(
					'placeholder' => 'Facebook Profile',
				),
			) );

			$cmb->add_field( array(
				'name'       => __( 'Twitter', 'cmb2' ),
				'id'         => $prefix . 'twitter_url',
				'type'       => 'text_url',
				'attributes' => array(
					'placeholder' => 'Twitter Profile',
				),
			) );
		}
	}
};
