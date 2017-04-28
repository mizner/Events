<?php
/**
 * Class CPT_Festival_Rest_Data
 *
 * @package mkdo\ted_hughes_core
 */

namespace mkdo\ted_hughes_core;

if ( ! class_exists( 'CPT_Festival_Rest_Data' ) ) {

	/**
	 * Registers CPT Festival Data to the Rest API
	 */
	class CPT_Festival_Rest_Data {
		/**
		 * Constructor
		 */
		function __construct() {
		}

		/**
		 * Do Work
		 */
		public function run() {

			// registering the festivals_festival_views field
			register_rest_field(
				'festival',
				'festival_session_groups',
				array(
					'get_callback'    => array( $this, 'festivals_get_festival' ),
					'update_callback' => array( $this, 'festivals_update_festival' ),
					'schema'          => array(
						'description' => 'Amount of parent posts',
						'type'        => 'integer',
						'context'     => array( 'view', 'edit' )
					)
				)
			);

			// registering the festivals_amount field
			register_rest_field(
				'festival',
				'festival_sessions',
				array(
					'get_callback'    => array( $this, 'festivals_get_festival' ),
					'update_callback' => array( $this, 'festivals_update_festival' ),
					'schema'          => array(
						'description' => 'Amount of festivals per track',
						'type'        => 'integer',
						'context'     => array( 'view', 'edit' )
					)
				)
			);

			// registering the festivals_tracks field
			register_rest_field(
				'festival',
				'festival_tracks',
				array(
					'get_callback'    => array( $this, 'festivals_get_festival' ),
					'update_callback' => array( $this, 'festivals_update_festival' ),
					'schema'          => array(
						'description' => 'Amount of tracks per festival',
						'type'        => 'integer',
						'context'     => array( 'view', 'edit' )
					)
				)
			);

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
		function festivals_get_festival( $object, $field_name, $request ) {
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
		function festivals_update_festival( $value, $object, $field_name ) {
			if ( ! $value || ! is_numeric( $value ) ) {
				return;
			}

			return update_post_meta( $object->ID, $field_name, (int) $value );
		}
	}
}