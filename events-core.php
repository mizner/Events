<?php
/**
 * Core Plugin for "Events Plugin"
 *
 * @link              https://www.makedo.net
 * @author            Make Do <hello@makedo.net>
 * @package           mkdo\mkdo_ted_hughes_core
 * @version           1.0
 *
 * @WordPress-plugin
 * Plugin Name:       Events
 * Plugin URI:        https://github.com/Mizner/Events
 * Description:       Core Plugin for "Events Plugin"
 * Version:           1.0
 * Author:            Michael Mizner
 * Author URI:        http://www.mizner.io
 * Text Domain:       events-plugin
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

defined( 'ABSPATH' ) || exit;

/**
 * Helper DEV function Only, NOT FOR PRODUCTION
 */
function _log( $message ) {
	if ( is_array( $message ) || is_object( $message ) ) {
		error_log( print_r( $message, true ) );
	} else {
		error_log( $message );
	}
}


// Constants.
define( 'EVENTS_CORE_PATH', plugin_dir_path( __FILE__ ) );
define( 'EVENTS_CORE_URI', plugin_dir_url( __FILE__ ) );

// Load Classes.
require_once 'php/class-meta-carousel.php';
require_once 'php/class-meta-home.php';
require_once 'php/class-post-carousel.php';
require_once 'php/class-post-news.php';
require_once 'php/class-post-testimonial.php';
require_once 'php/class-taxonomy-global.php';

require_once 'php/class-cpt-people.php';
require_once 'php/class-cpt-people-meta-boxes.php';
require_once 'php/class-cpt-people-templates.php';

require_once 'php/class-cpt-festival.php';
require_once 'php/class-cpt-festival-enqueues.php';
require_once 'php/class-cpt-festival-meta-boxes.php';
require_once 'php/class-cpt-festival-rest-data.php';
require_once 'php/class-cpt-session.php';
require_once 'php/class-cpt-session-rest-data.php';

require_once 'php/class-cpt-event-meta-boxes.php';

require_once 'php/class-controller-main.php';

// Namespaces.
use mkdo\ted_hughes_core\Meta_Carousel;
use mkdo\ted_hughes_core\Meta_Home;
use mkdo\ted_hughes_core\Post_Carousel;
use mkdo\ted_hughes_core\Post_News;
use mkdo\ted_hughes_core\Post_Testimonial;
use mkdo\ted_hughes_core\Taxonomy_Global;

use mkdo\ted_hughes_core\CPT_People_Register;
use mkdo\ted_hughes_core\CPT_Person_Meta_Boxes;
use mkdo\ted_hughes_core\CPT_People_Template;

use mkdo\ted_hughes_core\CPT_Festival_Register;
use mkdo\ted_hughes_core\CPT_Festival_Enqueues;
use mkdo\ted_hughes_core\CPT_Festival_Meta_Boxes;
use mkdo\ted_hughes_core\CPT_Festival_Rest_Data;

use mkdo\ted_hughes_core\CPT_Session_Register;
use mkdo\ted_hughes_core\CPT_Session_Rest_Data;

use mkdo\ted_hughes_core\CPT_Event_Meta_Boxes;

use mkdo\ted_hughes_core\Controller_Main;

// Instantiate.
$cpt_people             = new CPT_People_Register();
$cpt_people_boxes       = new CPT_Person_Meta_Boxes();
$cpt_people_templates   = new CPT_People_Template();
$cpt_festival           = new CPT_Festival_Register();
$cpt_festival_enqueues  = new CPT_Festival_Enqueues();
$cpt_festival_boxes     = new CPT_Festival_Meta_Boxes();
$cpt_festival_rest_data = new CPT_Festival_Rest_Data();
$cpt_session            = new CPT_Session_Register();
$cpt_session_rest_data  = new CPT_Session_Rest_Data();
$meta_carousel          = new Meta_Carousel();
$meta_home              = new Meta_Home();
$post_carousel          = new Post_Carousel();
$post_news              = new Post_News();
$post_testimonial       = new Post_Testimonial();
$taxonomy_global        = new Taxonomy_Global();
$cpt_event_boxes        = new CPT_Event_Meta_Boxes();
$controller             = new Controller_Main(
	$cpt_people,
	$cpt_people_boxes,
	$cpt_people_templates,
	$cpt_festival,
	$cpt_festival_enqueues,
	$cpt_festival_boxes,
	$cpt_festival_rest_data,
	$cpt_session,
	$cpt_session_rest_data,
	$meta_carousel,
	$meta_home,
	$post_carousel,
	$post_news,
	$post_testimonial,
	$taxonomy_global,
	$cpt_event_boxes
);

// Run the Plugin.
$controller->run();
