<?php
/**
 * Class CPT_Festival_Meta_Boxes
 *
 * @package mkdo\ted_hughes_core
 */

namespace mkdo\ted_hughes_core;

if ( ! class_exists( 'CPT_Festival_Meta_Boxes' ) ) {

	/**
	 * Registers CPT "Festival" Metaboxes
	 */
	class CPT_Festival_Meta_Boxes {

		/**
		 * Prefix for meta data
		 *
		 * @var string
		 */
		private $prefix = 'festival_';

		/**
		 * Constructor
		 */
		function __construct() {
		}

		/**
		 * Getter for the prefix
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
			add_filter( 'gettext', array( $this, 'custom_enter_title' ) );
			add_action( 'add_meta_boxes', array( $this, 'register_meta_boxes' ) );
			add_action( 'admin_head', array( $this, 'enqueue' ) );
		}

		/**
		 * Change the title placeholder text
		 *
		 * @param  string $input The placeholder text.
		 *
		 * @return string        The altered placeholder text.
		 */
		public function custom_enter_title( $input ) {

			if ( is_admin() && 'Enter title here' === $input && 'festival' === get_post_type( get_the_ID() ) ) {
				return __( "Enter Festival's Name", 'ted-hughes' );
			}

			return $input;
		}


		/**
		 * Register meta boxes
		 */
		public function register_meta_boxes() {
			add_meta_box(
				'festival-sessions-container',
				'SessionGroups',
				array(
					$this,
					'festival_sessions_html'
				),
				'festival',
				'normal',
				'default'
			);
		}

		/**
		 * HTML Template
		 */
		public function festival_sessions_html() {
			?>
            <section id="sessions"></section>
			<?php
		}

		/**
		 * Enqueue Assets
		 */
		public function enqueue() {
			if ( get_post_type( get_the_ID() ) == 'festival' ) {
				wp_enqueue_script( 'ted-hughes-festival-admin-js' );
				wp_enqueue_style( 'ted-hughes-festival-admin-css' );
			}
		}
	}
};
