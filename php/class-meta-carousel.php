<?php
/**
 * Class Meta_Carousel
 *
 * @package mkdo\ted_hughes_core
 */

namespace mkdo\ted_hughes_core;

/**
 * Register the Activity Meta Boxes
 */
class Meta_Carousel {

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
		$this->prefix = '_ted_hughes_core_carousel_';
	}

	/**
	 * Do Work
	 */
	public function run() {
		add_action( 'cmb2_admin_init', array( $this, 'register_meta_boxes' ), 0 );
		add_action( 'cmb2_after_post_form_carousel_slides', array( $this, 'js_limit_group_repeat' ), 10, 2 );
		add_action( 'cmb2_after_form', array( $this, 'cmb2_after_form_do_js_validation' ), 10, 2 );
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
				'id'            => 'carousel_slides',
				'title'         => __( 'Carousel Slides', 'ted-hughes-core' ),
				'object_types'  => array(
					'carousel',
				),
				'priority'      => 'high',
				'show_names'    => true,
			)
		);

		$slides_group = $cmb->add_field( array(
			'id'      => $this->prefix . 'slides',
			'type'    => 'group',
			'options' => array(
				'group_title'   => __( 'Slide {#}', 'ted-hughes-core' ),
				'add_button'    => __( 'Add Another Slide', 'ted-hughes-core' ),
				'remove_button' => __( 'Remove Slide', 'ted-hughes-core' ),
				'repeatable'    => true,
				'sortable'      => true,
				'closed'        => true,
			),
		) );

		$slides_group_field_1 = $cmb->add_group_field( $slides_group, array(
			'name'    => __( 'Slide Title', 'ted-hughes-core' ),
			'id'      => 'title',
			'type'    => 'text',
		) );

		$slides_group_field_2 = $cmb->add_group_field( $slides_group, array(
			'name'    => __( 'Slide Content', 'ted-hughes-core' ),
			'id'      => 'text',
			'type'    => 'textarea_small',
		) );

		$slides_group_field_3 = $cmb->add_group_field( $slides_group, array(
			'name'    => __( 'Slide Link', 'ted-hughes-core' ),
			'id'      => 'link',
			'type'    => 'link_picker',
		) );

		$slides_group_field_4 = $cmb->add_group_field( $slides_group, array(
			'name'    => __( 'Slide Image', 'ted-hughes-core' ),
			'id'      => 'image',
			'type'    => 'file',
			'options' => array(
			    'url' => false,
			),
			'text'    => array(
			    'add_upload_file_text' => 'Add Image',
			),
		) );
	}

	/**
	 * JS validation for required fields.
	 */
	public function cmb2_after_form_do_js_validation( $post_id, $cmb ) {
		static $added = false;

		// Only add this to the page once (not for every metabox).
		if ( $added ) {
			return;
		}

		$added = true;
		?>
		<script type="text/javascript">
		jQuery(document).ready(function($) {

			$form = $( document.getElementById( 'post' ) );
			$htmlbody = $( 'html, body' );
			$toValidate = $( '[data-validation]' );

			if ( ! $toValidate.length ) {
				return;
			}

			function checkValidation( evt ) {
				var labels = [];
				var $first_error_row = null;
				var $row = null;

				function add_required( $row ) {
					$row.css({ 'background-color': 'rgb(255, 170, 170)' });
					$first_error_row = $first_error_row ? $first_error_row : $row;
					labels.push( $row.find( '.cmb-th label' ).text() );
				}

				function remove_required( $row ) {
					$row.css({ background: '' });
				}

				$toValidate.each( function() {
					var $this = $(this);
					var val = $this.val();
					$row = $this.parents( '.cmb-row' );

					if ( $this.is( '[type="button"]' ) || $this.is( '.cmb2-upload-file-id' ) ) {
						return true;
					}

					if ( 'required' === $this.data( 'validation' ) ) {
						if ( $row.is( '.cmb-type-file-list' ) ) {

							var has_LIs = $row.find( 'ul.cmb-attach-list li' ).length > 0;

							if ( ! has_LIs ) {
								add_required( $row );
							} else {
								remove_required( $row );
							}

						} else {
							if ( ! val ) {
								add_required( $row );
							} else {
								remove_required( $row );
							}
						}
					}

				});

				if ( $first_error_row ) {
					evt.preventDefault();
					alert( 'The following fields are required and highlighted below:' + labels.join( ', ' ) );
					$htmlbody.animate({
						scrollTop: ( $first_error_row.offset().top - 200 )
					}, 1000);
				} else {
					// Feel free to comment this out or remove
					alert( 'submission is good!' );
				}

			}

			$form.on( 'submit', checkValidation );
		});
		</script>
		<?php
	}

	/**
	 * Limit the number of slides in the repeater,
	 */
	public function js_limit_group_repeat( $post_id, $cmb ) {
		?>
		<script type="text/javascript">
		jQuery(document).ready(function($){
			// Only allow 3 groups
			var limit            = 6;
			var fieldGroupId     = '_ted_hughes_core_carousel_slides';
			var $fieldGroupTable = $( document.getElementById( fieldGroupId + '_repeat' ) );
			var countRows = function() {
				return $fieldGroupTable.find( '> .cmb-row.cmb-repeatable-grouping' ).length;
			};
			var disableAdder = function() {
				$fieldGroupTable.find('.cmb-add-group-row.button').prop( 'disabled', true );
			};
			var enableAdder = function() {
				$fieldGroupTable.find('.cmb-add-group-row.button').prop( 'disabled', false );
			};
			$fieldGroupTable
				.on( 'cmb2_add_row', function() {
					if ( countRows() >= limit ) {
						disableAdder();
					}
				})
				.on( 'cmb2_remove_row', function() {
					if ( countRows() < limit ) {
						enableAdder();
					}
				});
		});
		</script>
		<?php
	}
}
