<?php
/**
 * Class CPT_People_Template
 *
 * @package mkdo\ted_hughes_core
 */

namespace mkdo\ted_hughes_core;

if ( ! class_exists( 'CPT_People_Template' ) ) {

	/**
	 * Registers CPT "People" Templates
	 */
	class CPT_People_Template {

		/**
		 * Constructor
		 */
		function __construct() {}

		/**
		 * Do Work
		 */
		public function run() {
			add_filter( 'single_template', array( $this, 'single_template_override' ), 10 );
			add_filter( 'archive_template', array( $this, 'archive_template_override' ), 10 );
		}

		/**
		 * Load single template
		 *
		 * @param  string $template Template file to load.
		 * @return string           Altered template file
		 */
		public function single_template_override( $template ) {

			if ( is_singular( 'people' ) && 'single-people.php' !== basename( $template ) ) {
				$template = TED_HUGHES_CORE_PATH . 'templates/single-people.php';
			}

			return $template;
		}

		/**
		 * Load archive template
		 *
		 * @param  string $template Template file to load.
		 * @return string           Altered template file
		 */
		public function archive_template_override( $template ) {

			if ( is_post_type_archive( 'people' ) && 'archive-people.php' !== basename( $template ) ) {
				$template = TED_HUGHES_CORE_PATH . 'templates/archive-people.php';
			}

			return $template;
		}
	}
}
