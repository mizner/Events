<?php
/**
 * Class CPT_Event_Meta_Boxes
 *
 * @package mkdo\ted_hughes_core
 */

namespace mkdo\ted_hughes_core;

if ( ! class_exists( 'CPT_Event_Meta_Boxes' ) ) {

	/**
	 * Registers CPT "Event" Metaboxes
	 */
	class CPT_Event_Meta_Boxes {

		/**
		 * Prefix for meta data
		 *
		 * @var string
		 */
		private $prefix = 'event_';

		/**
		 * Constructor
		 */
		function __construct() {
		}

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
		}

		/**
		 * Register meta boxes
		 */
		public function register_meta_boxes() {

			$prefix = $this->prefix;

			$cmb = new_cmb2_box( array(
				'id'           => 'eventbrite',
				'title'        => 'EventBrite',
				'object_types' => array( 'tribe_events' ), // Post Type.
				'context'      => 'side', // Accepts normal, advanced, or side.
				'priority'     => 'core',  // Accepts high, core, default or low.
				'show_names'   => false, // Show field names on the left.
			) );

			$cmb->add_field( array(
				'name' => __( 'Link', 'cmb2' ),
				'id'   => $prefix . 'eventbrite_link',
				'type' => 'text',
				'attributes' => array(
					'placeholder' => 'Link to event',
				),
			) );

			$cmb->add_field( array(
				'name' => __( 'Embed code', 'cmb2' ),
				'id'   => $prefix . 'eventbrite_shortcode',
				'type' => 'textarea',
				'attributes' => array(
					'placeholder' => 'Embed code',
				),
			) );

			$cmb = new_cmb2_box( array(
				'id'           => 'ticket_taylor',
				'title'        => 'Ticket Taylor',
				'object_types' => array( 'tribe_events' ), // Post Type.
				'context'      => 'side', // Accepts normal, advanced, or side.
				'priority'     => 'core',  // Accepts high, core, default or low.
				'show_names'   => false, // Show field names on the left.
			) );

			$cmb->add_field( array(
				'name' => __( 'Link', 'cmb2' ),
				'id'   => $prefix . 'ticket_taylor_link',
				'type' => 'text',
				'attributes' => array(
					'placeholder' => 'Link to event',
				),
			) );

			$cmb->add_field( array(
				'name' => __( 'Embed code', 'cmb2' ),
				'id'   => $prefix . 'ticket_taylor_shortcode',
				'type' => 'textarea',
				'attributes' => array(
					'placeholder' => 'Embed code',
				),
			) );
		}
	}
};
