<?php
/**
 * Class CPT_Session_Rest_Data
 *
 * @package mkdo\ted_hughes_core
 */

namespace mkdo\ted_hughes_core;

if ( ! class_exists( 'CPT_Session_Rest_Data' ) ) {

	/**
	 * Registers CPT Session Data to the Rest API
	 */
	class CPT_Session_Rest_Data {
		/**
		 * Constructor
		 */
		function __construct() {
		}

		/**
		 * Do Work
		 */
		public function run() {

			// Registering the sessions_festival_views field
			register_rest_field(
				'session',
				'sessions_festival',
				array(
					'get_callback'    => array( $this, 'sessions_get_festival' ),
					'update_callback' => array( $this, 'sessions_update_festival' ),
					'schema'          => array(
						'description' => 'festival views count',
						'type'        => 'integer',
						'context'     => array( 'view', 'edit' )
					)
				)
			);

			add_filter( 'the_content', array( $this, 'remove_wpautop' ), 10 );
		}

		/**
		 * Callback for retrieving festival views count
		 *
		 * @param  array $object The current festival object
		 * @param  string $field_name The name of the field
		 * @param  WP_REST_request $request The current request
		 *
		 * @return integer                           festival views count
		 */
		function sessions_get_festival( $object, $field_name, $request ) {
			return (int) get_post_meta( $object['id'], $field_name, true );
		}

		/**
		 * Callback for updating festival views count
		 *
		 * @param  mixed $value festival views count
		 * @param  object $object The object from the response
		 * @param  string $field_name Name of the current field
		 *
		 * @return bool|int
		 */
		function sessions_update_festival( $value, $object, $field_name ) {
			if ( ! $value || ! is_numeric( $value ) ) {
				return;
			}

			return update_post_meta( $object->ID, $field_name, (int) $value );
		}

		function remove_wpautop($content) {
			// edit the post type here
			'session' === get_post_type() && remove_filter( 'the_content', 'wpautop' );
			return $content;
		}
	}
}