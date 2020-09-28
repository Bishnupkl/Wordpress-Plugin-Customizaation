<?php
/**
 * @author Deepen.
 * @created_on 11/20/19
 */

//Globals
add_action( 'vczoom_before_main_content', 'video_conference_zoom_output_content_start', 10 );
add_action( 'vczoom_after_main_content', 'video_conference_zoom_output_content_end', 10 );

//Left Section Single Content
add_action( 'vczoom_single_content_left', 'video_conference_zoom_featured_image', 10 );
add_action( 'vczoom_single_content_left', 'video_conference_zoom_main_content', 20 );

//Right Section Single Content
add_action( 'vczoom_single_content_right', 'video_conference_zoom_countdown_timer', 10 );
add_action( 'vczoom_single_content_right', 'video_conference_zoom_meeting_details', 20 );
add_action( 'vczoom_single_content_right', 'video_conference_zoom_meeting_join', 30 );

//single content
add_action( 'vczoom_meeting_join_links', 'video_conference_zoom_meeting_join_link', 10 );

//Shortcode Hooks
add_action( 'vczoom_meeting_before_shortcode', 'video_conference_zoom_shortcode_table', 10 );
add_action( 'vczoom_meeting_shortcode_join_links', 'video_conference_zoom_shortcode_join_link', 10 );