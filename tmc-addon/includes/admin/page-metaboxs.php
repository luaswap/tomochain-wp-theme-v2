<?php
if(!class_exists('TMC_Add_Metabox')):
	class TMC_Add_Metabox {
		/*
		 * Render metabox for Page
		*/
		public function __construct() {
			add_action( 'cmb2_admin_init', array( $this,'tmc_add_metaboxes' ));
		}
		
		/**
		 * Define the metabox and field configurations.
		 */
		public function tmc_add_metaboxes() {

			$prefix = 'tmc_';

			/*-------------------------------------------------------*
			 * Page Metabox
			 *-------------------------------------------------------*/
			
			$cmb_page = new_cmb2_box( array(
				'id'            => $prefix . 'metabox',
				'title'         => esc_html__( 'Page Options', 'tmc' ),
				'object_types'  => array( 'page' ), // Post type
				'context'       => 'normal',
				'priority'      => 'high',
				'show_names'    => true, // Show field names on the left
				// 'hookup'       => false, // Only display on frontend
		        // 'save_fields'  => false, // Not Save field
				// 'cmb_styles' => false, // false to disable the CMB stylesheet
				// 'closed'     => true, // Keep the metabox closed by default
			) );
			

			$cmb_page->add_field( array(
				'name'    => __( 'Hide Page Heading','tmc'),
				'id'      => 'hide_page_heading',
				'type'    => 'checkbox',
			) );

			/*--------------------------------------------------------------------
			* Event Metabox
			*--------------------------------------------------------------------*/
			$cmb_event = new_cmb2_box( array(
				'id'            => $prefix . 'event_metabox',
				'title'         => esc_html__( 'Event Options', 'tmc' ),
				'object_types'  => array( 'tmc_event' ), // Post type
				'context'       => 'normal',
				'priority'      => 'high',
				'show_names'    => true, // Show field names on the left
				// 'hookup'       => false, // Only display on frontend
		        // 'save_fields'  => false, // Not Save field
				// 'cmb_styles' => false, // false to disable the CMB stylesheet
				// 'closed'     => true, // Keep the metabox closed by default
			) );
			

			$cmb_event->add_field( array(
				'name' => esc_html__('Open Date','tmc'),
				'id'   => 'open_date',
				'type' => 'text_datetime_timestamp',
			) );

			$cmb_event->add_field( array(
				'name' => esc_html__('Add Close Date','tmc'),
				'desc' => esc_html__('Use when the event lasts several days','tmc'),
				'id'   => 'multi_date',
				'type' => 'checkbox',
			) );

			$cmb_event->add_field( array(
				'name' => esc_html__('Close Date','tmc'),
				'id'   => 'close_date',
				'type' => 'text_datetime_timestamp',
				'attributes' => array(
					// 'required'               => true, // Will be required only if visible.
					'data-conditional-id'    => 'multi_date',
					'data-conditional-value' => 'on',
				),
			) );
			$cmb_event->add_field( array(
				'name'    => esc_html__('Place','tmc'),
				'desc'    => esc_html__('Place of the event','tmc'),
				'id'      => 'event_place',
				'type'    => 'text',
			) );

		}
	}
	new TMC_Add_Metabox();
endif;