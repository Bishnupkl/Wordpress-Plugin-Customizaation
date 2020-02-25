<?php
/**
 * The template for displaying meeting details of zoom
 *
 * This template can be overridden by copying it to yourtheme/video-conferencing-zoom/fragments/meeting-details.php.
 *
 * @author Deepen.
 * @created_on 11/19/19
 */

global $zoom;

?>
<div class="dpn-zvc-sidebar-box">
    <div class="dpn-zvc-sidebar-tile">
        <h3><?php _e( 'Details', 'video-conferencing-with-zoom-api' ); ?></h3>
    </div>
    <div class="dpn-zvc-sidebar-content">
        <div class="dpn-zvc-sidebar-content-list">
            <span><strong><?php _e( 'Hosted By', 'video-conferencing-with-zoom-api' ); ?>:</strong></span>
            <span><?php echo get_the_author(); ?></span>
        </div>
		<?php if ( ! empty( $zoom['start_date'] ) ) { ?>
            <div class="dpn-zvc-sidebar-content-list">
                <span><strong><?php _e( 'Start', 'video-conferencing-with-zoom-api' ); ?>:</strong></span>
                <span class="sidebar-start-time"><?php echo date( 'F j, Y @ g:i a', strtotime( $zoom['start_date'] ) ); ?></span>
            </div>
		<?php } ?>
		<?php if ( ! empty( $zoom['duration'] ) ) { ?>
            <div class="dpn-zvc-sidebar-content-list">
                <span><strong><?php _e( 'Duration', 'video-conferencing-with-zoom-api' ); ?>:</strong></span>
                <span><?php echo $zoom['duration']; ?></span>
            </div>
		<?php } ?>
		<?php if ( ! empty( $zoom['timezone'] ) ) { ?>
            <div class="dpn-zvc-sidebar-content-list">
                <span><strong><?php _e( 'Timezone', 'video-conferencing-with-zoom-api' ); ?>:</strong></span>
                <span><?php echo $zoom['timezone']; ?></span>
            </div>
		<?php } ?>
        <p class="dpn-zvc-display-or-hide-localtimezone-notice"><?php printf( __( '%sNote%s: Countdown time is shown based on your local timezone. Meeting join links will show before and after 1 hour of meeting time.', 'video-conferencing-with-zoom-api' ), '<strong>', '</strong>' ); ?></p>
    </div>
</div>