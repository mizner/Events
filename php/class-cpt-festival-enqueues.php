<?php
/**
 * Class CPT_Festival_Enqueues
 *
 * @package mkdo\ted_hughes_core
 */

namespace mkdo\ted_hughes_core;

if ( ! class_exists( 'CPT_Festival_Enqueues' ) ) {

	/**
	 * Enqueues
	 */
	class CPT_Festival_Enqueues {

		/**
		 * Constructor
		 */
		function __construct() {
		}

		/**
		 * Do Work
		 */
		public function run() {
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		}

		/**
		 * Enqueue Admin Scripts
		 */
		public function admin_enqueue_scripts() {
			wp_register_script( 'ted-hughes-festival-admin-js', TED_HUGHES_CORE_URI . '/dist/ted-hughes-festivals.min.js', null, null, true );
			wp_register_style( 'ted-hughes-festival-admin-css', TED_HUGHES_CORE_URI . '/css/ted-hughes-festivals.css' );
			wp_localize_script( 'ted-hughes-festival-admin-js', 'POST_SUBMITTER', array(
					'root'            => esc_url_raw( rest_url() ),
					'nonce'           => wp_create_nonce( 'wp_rest' ),
					'success'         => __( 'Thanks for your submission!', 'ted-hughes' ),
					'failure'         => __( 'Your submission could not be processed.', 'ted-hughes' ),
					'current_user_id' => get_current_user_id(),
				)
			);
			wp_localize_script( 'ted-hughes-festival-admin-js', 'POST', array(
				'root'     => esc_url_raw( rest_url() ),
				'id'       => get_the_ID(),
				'title'    => get_the_title(),
				'groups'   => get_post_meta( get_the_id(), 'festival_session_groups', true ),
				'sessions' => get_post_meta( get_the_ID(), 'festival_sessions', true ),
				'tracks'   => get_post_meta( get_the_ID(), 'festival_tracks', true )
			) );
		}

	}

}