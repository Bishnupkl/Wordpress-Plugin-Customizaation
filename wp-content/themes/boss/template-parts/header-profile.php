<?php
global $rtl, $woocommerce;
$header_style = boss_get_option('boss_header');
$boxed = boss_get_option( 'boss_layout_style' );
?>

<div class="right-col<?php if($woocommerce) { echo ' woocommerce'; } ?>">

    <?php if ( '2' == $header_style ): ?>
    <div class="table">
    <?php endif; ?>

	<?php if ( '1' == $header_style ): ?>
	<?php if ( $boxed == 'boxed' ): ?>
		<div class="header-notifications search-toggle">
			<a href="#" class="fa fa-search closed"></a>
		</div>
	<?php endif; ?>

	<div class="right-col-inner">
    <?php endif; ?>

		<?php
		if ( is_user_logged_in() ) {

            if ( function_exists( "messages_get_unread_count" ) ) {
				$name_class = 'has_updates';
				$unread_message_count = messages_get_unread_count();
				$user_id = get_current_user_id();
				?>
				<!-- Notification -->
				<div class="header-notifications user-messages">
				<a id="user-messages" class="notification-link fa fa-envelope" href="<?php echo esc_url( bp_core_get_user_domain( $user_id ) . bp_get_messages_slug() ) ?>">
					<?php
					if ((int)$unread_message_count > 0 ) {
						echo '<span class="count">'. $unread_message_count .'</span>';
					} else {
						echo '<span class="no-alert"><b>0</b></span>';
					}
					?>
				</a>

				<div class="pop pop-links">
					<div class="pop-links-inner">
                        <?php echo buddyboss_get_unread_messages_html() ?>
                    </div>
                </div>
				</div><?php
			}

			if ( buddyboss_is_bp_active() && bp_is_active( 'notifications' ) ):

				if ( function_exists( 'buddyboss_notification_bp_members_shortcode_bar_notifications_menu' ) ) {
					echo do_shortcode( '[buddyboss_notification_bar]' );
				} else {

					$notifications = bp_notifications_get_notifications_for_user( bp_loggedin_user_id(), 'object' );
					$count         = ! empty( $notifications ) ? count( $notifications ) : 0;
					$alert_class   = (int) $count > 0 ? 'pending-count alert' : 'count no-alert';
					$menu_title    = '<span id="ab-pending-notifications" class="' . $alert_class . '">' . number_format_i18n( $count ) . '</span>';
					$menu_link     = trailingslashit( bp_loggedin_user_domain() . bp_get_notifications_slug() );
					?>

					<!-- Notification -->
					<div class="header-notifications all-notifications">
						<a class="notification-link fa fa-bell" href="<?php
						if ( $menu_link ) {
							echo $menu_link;
						}
						?>">
							   <?php
							   if ( $menu_title ) {
								   echo $menu_title;
							   }
							   ?>
						</a>

						<div class="pop pop-links">
							<div class="pop-links-inner">
								<?php
								if ( ! empty( $notifications ) && is_array( $notifications ) ) {
									foreach ( $notifications as $notification ) {
										echo '<a href="' . $notification->href . '">' . $notification->content . '</a>';
									}
								} else {
									echo '<a href="' . bp_loggedin_user_domain() . '' . BP_NOTIFICATIONS_SLUG . '/">' . __( "No new notifications", "boss" ) . '</a>';
								}
								?>
							</div>
						</div>
					</div>

					<?php
				}
				?>

			<?php endif; ?>

            <!-- Woocommerce Notification -->
            <?php echo boss_cart_icon_html(); ?>

			<?php if ( buddyboss_is_bp_active() ) { ?>

				<!--Account details -->
				<div class="header-account-login">

					<?php do_action( "buddyboss_before_header_account_login_block" ); ?>

					<a class="user-link" href="<?php echo bp_core_get_user_domain( get_current_user_id() ); ?>">
						<span class="name <?php echo $name_class; ?>"><?php echo bp_core_get_user_displayname( get_current_user_id() ); ?></span>
						<span>
							<?php echo bp_core_fetch_avatar( array( 'item_id' => get_current_user_id(), 'type' => 'full', 'width' => '100', 'height' => '100' ) ); ?>                        </span>
					</a>

					<div class="pop user-pop-links">
						<div class="pop-inner">
							<!-- Dashboard links -->
							<?php
							if ( boss_get_option( 'boss_dashboard' ) &&  current_user_can( 'read' ) ) :
								get_template_part( 'template-parts/header-dashboard-links' );
							endif;
							?>

							<!-- Adminbar -->
							<div id="adminbar-links" class="bp_components">
								<?php buddyboss_adminbar_myaccount(); ?>
							</div>

							<?php
							if ( boss_get_option( 'boss_profile_adminbar' ) ) {
								wp_nav_menu( array( 'theme_location' => 'header-my-account', 'fallback_cb' => '', 'menu_class' => 'links' ) );
							}
							?>

							<span class="logout">
								<a href="<?php echo wp_logout_url(); ?>"><?php _e( 'Logout', 'boss' ); ?></a>
							</span>
						</div>
					</div>

					<?php do_action( "buddyboss_after_header_account_login_block" ); ?>

				</div><!--.header-account-login-->

			<?php } ?>

		<?php } else { ?>

            <!-- Woocommerce Notification for guest users-->
            <?php echo boss_cart_icon_html(); ?>

			<!-- Register/Login links for logged out users -->
			<?php if ( !is_user_logged_in() && buddyboss_is_bp_active() ) : ?>

                <?php if( '2' == boss_get_option('boss_header') ){ ?>
                <div class="table-cell">
                <?php } ?>
                    <?php if ( buddyboss_is_bp_active() && bp_get_signup_allowed() ) : ?>
                        <a href="<?php echo bp_get_signup_page(); ?>" class="register screen-reader-shortcut"><?php _e( 'Register', 'boss' ); ?></a>
                    <?php endif; ?>

                    <a href="<?php echo wp_login_url(); ?>" class="login"><?php _e( 'Login', 'boss' ); ?></a>
                <?php if( '2' == boss_get_option('boss_header') ){ ?>
                </div>
                <?php } ?>

			<?php endif; ?>

		<?php } ?> <!-- if ( is_user_logged_in() ) -->

	</div><!--.left-col-inner/.table-->

</div><!--.left-col-->
