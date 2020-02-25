<div class="wrap">
    <h2><?php _e( "Assign Host ID", "video-conferencing-with-zoom-api" ); ?></h2>
    <div id="message" class="notice notice-warning">
        <p class="description"><strong>This section allows you to assign "Zoom" host ID to your users from WordPress !!!</strong></p>
        <p>Copy <strong>HOST ID</strong> from <strong>User ID</strong> column in <a href="<?php echo admin_url( 'admin.php?page=zoom-video-conferencing-host-id-assign' ); ?>">users</a> page, then paste it into HOST ID for any users below, to assign this system users to users in zoom system. Please contact developer if this feature is confusing to you.</p>
        <p>In order to pull HOST ID from user meta just do: <code>get_user_meta( $user_id, 'user_zoom_hostid', true );</code></p>
        <p><strong>THIS FEATURE IS INTENTED FOR DEVLEOPERS AND DEVELOPMENT PURPOSE ONLY !!!</strong></p>
    </div>

    <div class="message">
		<?php
		$message = self::get_message();
		if ( isset( $message ) && ! empty( $message ) ) {
			echo $message;
		}
		?>
    </div>

    <div class="zvc_listing_table">
        <form action="" method="POST">
			<?php wp_nonce_field( '_zoom_assign_hostid_nonce_action', '_zoom_assign_hostid_nonce' ); ?>
            <table id="zvc_users_list_table" class="display">
                <thead>
                <tr>
                    <th width="5%"><?php _e( 'SN', 'video-conferencing-with-zoom-api' ); ?></th>
                    <th style="text-align: left;"><?php _e( 'Email', 'video-conferencing-with-zoom-api' ); ?></th>
                    <th style="text-align: left;"><?php _e( 'Name', 'video-conferencing-with-zoom-api' ); ?></th>
                    <th width="30%" style="text-align: left;"><?php _e( 'Host ID', 'video-conferencing-with-zoom-api' ); ?></th>
                </tr>
                </thead>
                <tbody>
				<?php $count = 1;
				$users       = get_users( array( 'number' => - 1, 'role__in' => apply_filters( 'zvc_allow_zoom_host_id_user_role', array( 'subscriber', 'administrator', 'contributor' ) ) ) );
				foreach ( $users as $user ):
					$user_zoom_hostid = get_user_meta( $user->ID, 'user_zoom_hostid', true );
					?>
                    <tr>
                        <td style="text-align: center;"><?php echo $count ++; ?></td>
                        <td><?php echo $user->user_email; ?></td>
                        <td><?php echo empty( $user->first_name ) ? $user->display_name : $user->first_name . ' ' . $user->last_name; ?></td>
                        <td><input type="text" name="zoom_host_id[<?php echo $user->ID; ?>]" value="<?php echo ! empty( $user_zoom_hostid ) ? $user_zoom_hostid : null; ?>" placeholder="dy23xxdVuX23g" style="border:1px solid #ff8a8a;padding:6px;width: 100%;"></td>
                    </tr>
				<?php endforeach; ?>
                </tbody>
            </table>
            <p class="submit"><input type="submit" name="saving_host_id" class="button button-primary" value="Save"></p>
        </form>
    </div>
</div>
