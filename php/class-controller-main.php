<?php
/**
 * Class MainController
 *
 * @package mkdo\ted_hughes_core
 */

namespace mkdo\ted_hughes_core;

/**
 * The main loader for this plugin
 */
class Controller_Main {

	/**
	 * People CPT
	 *
	 * @var object
	 */
	private $cpt_people;

	/**
	 * People Meta Boxes
	 *
	 * @var object
	 */
	private $cpt_people_boxes;

	/**
	 * People Fallback Templates
	 *
	 * @var object
	 */
	private $cpt_people_templates;

	/**
	 * Festival CPT
	 *
	 * @var object
	 */
	private $cpt_festival;

	/**
	 * Festival Enqueues
	 *
	 * @var object
	 */
	private $cpt_festival_enqueues;

	/**
	 * Festival Meta Boxes
	 *
	 * @var object
	 */
	private $cpt_festival_boxes;

	/**
	 * Festival Rest Data
	 *
	 * @var object
	 */
	private $cpt_festival_rest_data;

	/**
	 * Session CPT
	 *
	 * @var object
	 */
	private $cpt_session;


	/**
	 * Session Rest Data
	 *
	 * @var object
	 */
	private $cpt_session_rest_data;

	/**
	 * Carousel Meta
	 *
	 * @var object
	 */
	private $meta_carousel;

	/**
	 * Home Meta
	 *
	 * @var object
	 */
	private $meta_home;

	/**
	 * Carousel CPT
	 *
	 * @var object
	 */
	private $post_carousel;

	/**
	 * News CPT
	 *
	 * @var object
	 */
	private $post_news;

	/**
	 * Testimonial CPT
	 *
	 * @var object
	 */
	private $post_testimonial;

	/**
	 * Global Taxonomy
	 *
	 * @var object
	 */
	private $taxonomy_global;

	/**
	 * Festival Meta Boxes
	 *
	 * @var object
	 */
	private $cpt_event_boxes;

	/**
	 * Constructor
	 *
	 * @param CPT_People_Register     $cpt_people               Register the CPT.
	 * @param CPT_Person_Meta_Boxes   $cpt_people_boxes         Add Meta Boxes to the CPT.
	 * @param CPT_People_Template     $cpt_people_templates     Fallback Templates.
	 * @param CPT_Festival_Register   $cpt_festival             Register the CPT.
	 * @param CPT_Festival_Enqueues   $cpt_festival_enqueues    Register the CPT.
	 * @param CPT_Festival_Meta_Boxes $cpt_festival_boxes       Add Meta Boxes to the CPT.
	 * @param CPT_Festival_Rest_Data  $cpt_festival_rest_data   Register Festival Rest Data.
	 * @param CPT_Session_Register    $cpt_session              Register the CPT.
	 * @param CPT_Session_Rest_Data   $cpt_session_rest_data    Register Session Rest Data.
	 * @param Meta_Carousel           $meta_carousel            Carousel Meta.
	 * @param Meta_Home               $meta_home                Home Meta.
	 * @param Post_Carousel           $post_carousel            Carousel CPT.
	 * @param Post_News               $post_news                News CPT.
	 * @param Post_Testimonial        $post_testimonial         Testimonial CPT.
	 * @param Taxonomy_Global         $taxonomy_global          Global Taxonomy.
	 * @param CPT_Event_Meta_Boxes    $cpt_event_boxes          Add Meta Boxes to the CPT.
	 */
	public function __construct(
		CPT_People_Register $cpt_people,
		CPT_Person_Meta_Boxes $cpt_people_boxes,
		CPT_People_Template $cpt_people_templates,

		CPT_Festival_Register $cpt_festival,
		CPT_Festival_Enqueues $cpt_festival_enqueues,
		CPT_Festival_Meta_Boxes $cpt_festival_boxes,
		CPT_Festival_Rest_Data $cpt_festival_rest_data,

		CPT_Session_Register $cpt_session,
		CPT_Session_Rest_Data $cpt_session_rest_data,

		Meta_Carousel $meta_carousel,
		Meta_Home $meta_home,
		Post_Carousel $post_carousel,
		Post_News $post_news,
		Post_Testimonial $post_testimonial,
		Taxonomy_Global $taxonomy_global,

		CPT_Event_Meta_Boxes $cpt_event_boxes
	) {
		$this->cpt_people               = $cpt_people;
		$this->cpt_people_boxes         = $cpt_people_boxes;
		$this->cpt_people_templates     = $cpt_people_templates;

		$this->cpt_festival             = $cpt_festival;
		$this->cpt_festival_enqueues    = $cpt_festival_enqueues;
		$this->cpt_festival_boxes       = $cpt_festival_boxes;
		$this->cpt_festival_rest_data    = $cpt_festival_rest_data;

		$this->cpt_session              = $cpt_session;
		$this->cpt_session_rest_data    = $cpt_session_rest_data;

		$this->meta_carousel            = $meta_carousel;
		$this->meta_home                = $meta_home;
		$this->post_carousel            = $post_carousel;
		$this->post_news                = $post_news;
		$this->post_testimonial         = $post_testimonial;
		$this->taxonomy_global          = $taxonomy_global;
		$this->cpt_event_boxes          = $cpt_event_boxes;
	}

	/**
	 * Do Work
	 */
	public function run() {
		$this->cpt_people->run();
		$this->cpt_people_boxes->run();
		$this->cpt_people_templates->run();

		$this->cpt_festival->run();
		$this->cpt_festival_enqueues->run();
		$this->cpt_festival_boxes->run();
		$this->cpt_festival_rest_data->run();

		$this->cpt_session->run();
		$this->cpt_session_rest_data->run();

		$this->meta_carousel->run();
		$this->meta_home->run();
		$this->post_carousel->run();
		// $this->post_news->run();
		$this->post_testimonial->run();
		$this->taxonomy_global->run();

		$this->cpt_event_boxes->run();
	}
}
