<?php
/**
 * @author Deepen.
 * @created_on 11/19/19
 */
?>

<table class="form-table">
    <tbody>
    <tr>
        <th scope="row"><label for="userId"><?php _e( 'Meeting Host *', 'video-conferencing-with-zoom-api' ); ?></label></th>
        <td>
            <select name="userId" required class="zvc-hacking-select">
                <option value=""><?php _e( 'Select a Host', 'video-conferencing-with-zoom-api' ); ?></option>
				<?php foreach ( $users as $user ): ?>
                    <option value="<?php echo $user->id; ?>" <?php ! empty( $meeting_fields['userId'] ) ? selected( $meeting_fields['userId'], $user->id ) : false; ?> ><?php echo $user->first_name . ' ( ' . $user->email . ' )'; ?></option>
				<?php endforeach; ?>
            </select>
            <p class="description" id="userId-description"><?php _e( 'This is host ID for the meeting (Required).', 'video-conferencing-with-zoom-api' ); ?></p>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="start_date"><?php _e( 'Start Date/Time *', 'video-conferencing-with-zoom-api' ); ?></label></th>
        <td>
            <input type="text" name="start_date" id="datetimepicker" data-existingdate="<?php echo isset( $meeting_fields['start_date'] ) ? $meeting_fields['start_date'] : false; ?>" required class="regular-text" value="<?php echo isset( $meeting_fields['start_date'] ) ? $meeting_fields['start_date'] : false; ?>">
            <p class="description" id="start_date-description"><?php _e( 'Starting Date and Time of the Meeting (Required).', 'video-conferencing-with-zoom-api' ); ?></p>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="timezone"><?php _e( 'Timezone', 'video-conferencing-with-zoom-api' ); ?></label></th>
        <td>
			<?php $tzlists = zvc_get_timezone_options(); ?>
            <select id="timezone" name="timezone" class="zvc-hacking-select">
				<?php foreach ( $tzlists as $k => $tzlist ) { ?>
                    <option value="<?php echo $k; ?>" <?php ! empty( $meeting_fields['timezone'] ) ? selected( $k, $meeting_fields['timezone'] ) : false; ?>><?php echo $tzlist; ?></option>
				<?php } ?>
            </select>
            <p class="description" id="timezone-description"><?php _e( 'Meeting Timezone', 'video-conferencing-with-zoom-api' ); ?></p>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="duration"><?php _e( 'Duration', 'video-conferencing-with-zoom-api' ); ?></label></th>
        <td>
            <input type="number" name="duration" class="regular-text" value="<?php echo isset( $meeting_fields['duration'] ) ? $meeting_fields['duration'] : false; ?>">
            <p class="description" id="duration-description"><?php _e( 'Meeting duration (minutes). (optional)', 'video-conferencing-with-zoom-api' ); ?></p>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="join_before_host"><?php _e( 'Join Before Host', 'video-conferencing-with-zoom-api' ); ?></label></th>
        <td>
            <p class="description" id="join_before_host-description"><input type="checkbox" name="join_before_host" value="1" <?php ! empty( $meeting_fields['join_before_host'] ) ? checked( '1', $meeting_fields['join_before_host'] ) : false; ?> class="regular-text"><?php _e( 'Join meeting before host start the meeting. Only for scheduled or recurring meetings.', 'video-conferencing-with-zoom-api' ); ?></p>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="option_host_video"><?php _e( 'Host join start', 'video-conferencing-with-zoom-api' ); ?></label></th>
        <td>
            <p class="description" id="option_host_video-description"><input type="checkbox" name="option_host_video" value="1" <?php ! empty( $meeting_fields['option_host_video'] ) ? checked( '1', $meeting_fields['option_host_video'] ) : false; ?> class="regular-text"><?php _e( 'Start video when host join meeting.', 'video-conferencing-with-zoom-api' ); ?></p>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="option_participants_video"><?php _e( 'Participants Video', 'video-conferencing-with-zoom-api' ); ?></label></th>
        <td>
            <p class="description" id="option_participants_video-description"><input type="checkbox" name="option_participants_video" <?php ! empty( $meeting_fields['option_participants_video'] ) ? checked( '1', $meeting_fields['option_participants_video'] ) : false; ?> value="1" class="regular-text"><?php _e( 'Start video when participants join meeting.', 'video-conferencing-with-zoom-api' ); ?></p>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="option_mute_participants_upon_entry"><?php _e( 'Mute Participants upon entry', 'video-conferencing-with-zoom-api' ); ?></label></th>
        <td>
            <p class="description" id="option_mute_participants_upon_entry"><input type="checkbox" name="option_mute_participants" value="1" <?php ! empty( $meeting_fields['option_mute_participants'] ) ? checked( '1', $meeting_fields['option_mute_participants'] ) : false; ?> class="regular-text"><?php _e( 'Mutes Participants when entering the meeting.', 'video-conferencing-with-zoom-api' ); ?></p>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="option_auto_recording"><?php _e( 'Auto Recording', 'video-conferencing-with-zoom-api' ); ?></label></th>
        <td>
            <select id="option_auto_recording" name="option_auto_recording">
                <option value="none" <?php ! empty( $meeting_fields['option_auto_recording'] ) ? selected( 'none', $meeting_fields['option_auto_recording'] ) : false; ?>>No Recordings</option>
                <option value="local" <?php ! empty( $meeting_fields['option_auto_recording'] ) ? selected( 'local', $meeting_fields['option_auto_recording'] ) : false; ?>>Local</option>
                <option value="cloud" <?php ! empty( $meeting_fields['option_auto_recording'] ) ? selected( 'cloud', $meeting_fields['option_auto_recording'] ) : false; ?>>Cloud</option>
            </select>
            <p class="description" id="option_auto_recording_description"><?php _e( 'Set what type of auto recording feature you want to add. Default is none.', 'video-conferencing-with-zoom-api' ); ?></p>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="settings_alternative_hosts"><?php _e( 'Alternative Hosts', 'video-conferencing-with-zoom-api' ); ?></label></th>
        <td>
            <select name="alternative_host_ids[]" multiple class="zvc-hacking-select">
                <option value=""><?php _e( 'Select a Host', 'video-conferencing-with-zoom-api' ); ?></option>
				<?php foreach ( $users as $user ): ?>
                    <option value="<?php echo $user->id; ?>" <?php echo ! empty( $meeting_fields['alternative_host_ids'] ) && in_array( $user->id, $meeting_fields['alternative_host_ids'] ) ? 'selected' : false; ?>><?php echo $user->first_name . ' ( ' . $user->email . ' )'; ?></option>
				<?php endforeach; ?>
            </select>
            <p class="description" id="settings_alternative_hosts"><?php _e( 'Alternative hosts IDs. Multiple value separated by comma.', 'video-conferencing-with-zoom-api' ); ?></p>
        </td>
    </tr>
    </tbody>
</table>