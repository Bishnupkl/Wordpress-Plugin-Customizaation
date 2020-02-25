<?php

if ( ! function_exists( 'dump' ) ) {
	function dump( $var ) {
		echo '<pre>';
		var_dump( $var );
		echo '</pre>';
	}
}

if ( ! function_exists( 'zvc_get_timezone_options' ) ) {
	function zvc_get_timezone_options() {
		$zones_array = array(
			"Pacific/Midway"                 => "(GMT-11:00) Midway Island, Samoa ",
			"Pacific/Pago_Pago"              => "(GMT-11:00) Pago Pago ",
			"Pacific/Honolulu"               => "(GMT-10:00) Hawaii ",
			"America/Anchorage"              => "(GMT-8:00) Alaska ",
			"America/Vancouver"              => "(GMT-7:00) Vancouver ",
			"America/Los_Angeles"            => "(GMT-7:00) Pacific Time (US and Canada) ",
			"America/Tijuana"                => "(GMT-7:00) Tijuana ",
			"America/Phoenix"                => "(GMT-7:00) Arizona ",
			"America/Edmonton"               => "(GMT-6:00) Edmonton ",
			"America/Denver"                 => "(GMT-6:00) Mountain Time (US and Canada) ",
			"America/Mazatlan"               => "(GMT-6:00) Mazatlan ",
			"America/Regina"                 => "(GMT-6:00) Saskatchewan ",
			"America/Guatemala"              => "(GMT-6:00) Guatemala ",
			"America/El_Salvador"            => "(GMT-6:00) El Salvador ",
			"America/Managua"                => "(GMT-6:00) Managua ",
			"America/Costa_Rica"             => "(GMT-6:00) Costa Rica ",
			"America/Tegucigalpa"            => "(GMT-6:00) Tegucigalpa ",
			"America/Winnipeg"               => "(GMT-5:00) Winnipeg ",
			"America/Chicago"                => "(GMT-5:00) Central Time (US and Canada) ",
			"America/Mexico_City"            => "(GMT-5:00) Mexico City ",
			"America/Panama"                 => "(GMT-5:00) Panama ",
			"America/Bogota"                 => "(GMT-5:00) Bogota ",
			"America/Lima"                   => "(GMT-5:00) Lima ",
			"America/Caracas"                => "(GMT-4:30) Caracas ",
			"America/Montreal"               => "(GMT-4:00) Montreal ",
			"America/New_York"               => "(GMT-4:00) Eastern Time (US and Canada) ",
			"America/Indianapolis"           => "(GMT-4:00) Indiana (East) ",
			"America/Puerto_Rico"            => "(GMT-4:00) Puerto Rico ",
			"America/Santiago"               => "(GMT-4:00) Santiago ",
			"America/Halifax"                => "(GMT-3:00) Halifax ",
			"America/Montevideo"             => "(GMT-3:00) Montevideo ",
			"America/Araguaina"              => "(GMT-3:00) Brasilia ",
			"America/Argentina/Buenos_Aires" => "(GMT-3:00) Buenos Aires, Georgetown ",
			"America/Sao_Paulo"              => "(GMT-3:00) Sao Paulo ",
			"Canada/Atlantic"                => "(GMT-3:00) Atlantic Time (Canada) ",
			"America/St_Johns"               => "(GMT-2:30) Newfoundland and Labrador ",
			"America/Godthab"                => "(GMT-2:00) Greenland ",
			"Atlantic/Cape_Verde"            => "(GMT-1:00) Cape Verde Islands ",
			"Atlantic/Azores"                => "(GMT+0:00) Azores ",
			"UTC"                            => "(GMT+0:00) Universal Time UTC ",
			"Etc/Greenwich"                  => "(GMT+0:00) Greenwich Mean Time ",
			"Atlantic/Reykjavik"             => "(GMT+0:00) Reykjavik ",
			"Africa/Nouakchott"              => "(GMT+0:00) Nouakchott ",
			"Europe/Dublin"                  => "(GMT+1:00) Dublin ",
			"Europe/London"                  => "(GMT+1:00) London ",
			"Europe/Lisbon"                  => "(GMT+1:00) Lisbon ",
			"Africa/Casablanca"              => "(GMT+1:00) Casablanca ",
			"Africa/Bangui"                  => "(GMT+1:00) West Central Africa ",
			"Africa/Algiers"                 => "(GMT+1:00) Algiers ",
			"Africa/Tunis"                   => "(GMT+1:00) Tunis ",
			"Europe/Belgrade"                => "(GMT+2:00) Belgrade, Bratislava, Ljubljana ",
			"CET"                            => "(GMT+2:00) Sarajevo, Skopje, Zagreb ",
			"Europe/Oslo"                    => "(GMT+2:00) Oslo ",
			"Europe/Copenhagen"              => "(GMT+2:00) Copenhagen ",
			"Europe/Brussels"                => "(GMT+2:00) Brussels ",
			"Europe/Berlin"                  => "(GMT+2:00) Amsterdam, Berlin, Rome, Stockholm, Vienna ",
			"Europe/Amsterdam"               => "(GMT+2:00) Amsterdam ",
			"Europe/Rome"                    => "(GMT+2:00) Rome ",
			"Europe/Stockholm"               => "(GMT+2:00) Stockholm ",
			"Europe/Vienna"                  => "(GMT+2:00) Vienna ",
			"Europe/Luxembourg"              => "(GMT+2:00) Luxembourg ",
			"Europe/Paris"                   => "(GMT+2:00) Paris ",
			"Europe/Zurich"                  => "(GMT+2:00) Zurich ",
			"Europe/Madrid"                  => "(GMT+2:00) Madrid ",
			"Africa/Harare"                  => "(GMT+2:00) Harare, Pretoria ",
			"Europe/Warsaw"                  => "(GMT+2:00) Warsaw ",
			"Europe/Prague"                  => "(GMT+2:00) Prague Bratislava ",
			"Europe/Budapest"                => "(GMT+2:00) Budapest ",
			"Africa/Tripoli"                 => "(GMT+2:00) Tripoli ",
			"Africa/Cairo"                   => "(GMT+2:00) Cairo ",
			"Africa/Johannesburg"            => "(GMT+2:00) Johannesburg ",
			"Europe/Helsinki"                => "(GMT+3:00) Helsinki ",
			"Africa/Nairobi"                 => "(GMT+3:00) Nairobi ",
			"Europe/Sofia"                   => "(GMT+3:00) Sofia ",
			"Europe/Istanbul"                => "(GMT+3:00) Istanbul ",
			"Europe/Athens"                  => "(GMT+3:00) Athens ",
			"Europe/Bucharest"               => "(GMT+3:00) Bucharest ",
			"Asia/Nicosia"                   => "(GMT+3:00) Nicosia ",
			"Asia/Beirut"                    => "(GMT+3:00) Beirut ",
			"Asia/Damascus"                  => "(GMT+3:00) Damascus ",
			"Asia/Jerusalem"                 => "(GMT+3:00) Jerusalem ",
			"Asia/Amman"                     => "(GMT+3:00) Amman ",
			"Europe/Moscow"                  => "(GMT+3:00) Moscow ",
			"Asia/Baghdad"                   => "(GMT+3:00) Baghdad ",
			"Asia/Kuwait"                    => "(GMT+3:00) Kuwait ",
			"Asia/Riyadh"                    => "(GMT+3:00) Riyadh ",
			"Asia/Bahrain"                   => "(GMT+3:00) Bahrain ",
			"Asia/Qatar"                     => "(GMT+3:00) Qatar ",
			"Asia/Aden"                      => "(GMT+3:00) Aden ",
			"Africa/Khartoum"                => "(GMT+3:00) Khartoum ",
			"Africa/Djibouti"                => "(GMT+3:00) Djibouti ",
			"Africa/Mogadishu"               => "(GMT+3:00) Mogadishu ",
			"Europe/Kiev"                    => "(GMT+3:00) Kiev ",
			"Asia/Dubai"                     => "(GMT+4:00) Dubai ",
			"Asia/Muscat"                    => "(GMT+4:00) Muscat ",
			"Asia/Tehran"                    => "(GMT+4:30) Tehran ",
			"Asia/Kabul"                     => "(GMT+4:30) Kabul ",
			"Asia/Baku"                      => "(GMT+5:00) Baku, Tbilisi, Yerevan ",
			"Asia/Yekaterinburg"             => "(GMT+5:00) Yekaterinburg ",
			"Asia/Tashkent"                  => "(GMT+5:00) Islamabad, Karachi, Tashkent ",
			"Asia/Calcutta"                  => "(GMT+5:30) India ",
			"Asia/Kolkata"                   => "(GMT+5:30) Mumbai, Kolkata, New Delhi ",
			"Asia/Kathmandu"                 => "(GMT+5:45) Kathmandu ",
			"Asia/Novosibirsk"               => "(GMT+6:00) Novosibirsk ",
			"Asia/Almaty"                    => "(GMT+6:00) Almaty ",
			"Asia/Dacca"                     => "(GMT+6:00) Dacca ",
			"Asia/Dhaka"                     => "(GMT+6:00) Astana, Dhaka ",
			"Asia/Krasnoyarsk"               => "(GMT+7:00) Krasnoyarsk ",
			"Asia/Bangkok"                   => "(GMT+7:00) Bangkok ",
			"Asia/Saigon"                    => "(GMT+7:00) Vietnam ",
			"Asia/Jakarta"                   => "(GMT+7:00) Jakarta ",
			"Asia/Irkutsk"                   => "(GMT+8:00) Irkutsk, Ulaanbaatar ",
			"Asia/Shanghai"                  => "(GMT+8:00) Beijing, Shanghai ",
			"Asia/Hong_Kong"                 => "(GMT+8:00) Hong Kong ",
			"Asia/Taipei"                    => "(GMT+8:00) Taipei ",
			"Asia/Kuala_Lumpur"              => "(GMT+8:00) Kuala Lumpur ",
			"Asia/Singapore"                 => "(GMT+8:00) Singapore ",
			"Australia/Perth"                => "(GMT+8:00) Perth ",
			"Asia/Yakutsk"                   => "(GMT+9:00) Yakutsk ",
			"Asia/Seoul"                     => "(GMT+9:00) Seoul ",
			"Asia/Tokyo"                     => "(GMT+9:00) Osaka, Sapporo, Tokyo ",
			"Australia/Darwin"               => "(GMT+9:30) Darwin ",
			"Australia/Adelaide"             => "(GMT+9:30) Adelaide ",
			"Asia/Vladivostok"               => "(GMT+10:00) Vladivostok ",
			"Pacific/Port_Moresby"           => "(GMT+10:00) Guam, Port Moresby ",
			"Australia/Brisbane"             => "(GMT+10:00) Brisbane ",
			"Australia/Sydney"               => "(GMT+10:00) Canberra, Melbourne, Sydney ",
			"Australia/Hobart"               => "(GMT+10:00) Hobart ",
			"Asia/Magadan"                   => "(GMT+10:00) Magadan ",
			"SST"                            => "(GMT+11:00) Solomon Islands ",
			"Pacific/Noumea"                 => "(GMT+11:00) New Caledonia ",
			"Asia/Kamchatka"                 => "(GMT+12:00) Kamchatka ",
			"Pacific/Fiji"                   => "(GMT+12:00) Fiji Islands, Marshall Islands ",
			"Pacific/Auckland"               => "(GMT+12:00) Auckland, Wellington"
		);

		return $zones_array;
	}
}

/**
 * Get Users using transients
 *
 * @since  2.1.0
 * @author Deepen
 */
function video_conferencing_zoom_api_get_user_transients() {
	//Check if any transient by name is available
	$check_transient = get_transient( '_zvc_user_lists' );
	if ( $check_transient ) {
		$users = $check_transient->users;
	} else {
		$encoded_users = zoom_conference()->listUsers();
		$decoded_users = json_decode( $encoded_users );
		if ( ! empty( $decoded_users->code ) && $decoded_users->code == 300 ) {
			$users = false;
		} else {
			//storing data to transient and getting those data for fast load by setting to fetch every 15 minutes
			set_transient( '_zvc_user_lists', $decoded_users, 900 );
			$users = $decoded_users->users;
		}
	}

	return $users;
}

/**
 * @author Deepen
 * @since 3.0.0
 */
function video_conferencing_zoom_api_show_like_popup() {
	?>
    <div id="message" class="notice notice-warning">
        <h3><?php esc_html_e( 'Like this plugin ?', 'video-conferencing-with-zoom-api' ); ?></h3>
        <p>
			<?php
			printf( esc_html__( 'Please consider giving a %s if you found this useful at wordpress.org or ', 'video-conferencing-with-zoom-api' ), '<a href="https://wordpress.org/support/plugin/video-conferencing-with-zoom-api/reviews/#new-post">5 star thumbs up</a>' );
			printf( esc_html__( 'check %s for shortcode references.', 'video-conferencing-with-zoom-api' ), '<a href="?page=zoom-video-conferencing-settings">settings</a>' );
			?>
        </p>
    </div>
	<?php
}

/**
 * @author Deepen
 * @since 3.0.0
 */
function video_conferencing_zoom_api_show_api_notice() {
	$notice = get_option( 'zoom_api_notice' );
	if ( empty( $notice ) ) {
		?>
        <div id="message" class="notice notice-success"><p style="font-size:16px;"><strong><?php _e( "Do not get confused here !!", "video-conferencing-with-zoom-api" ); ?></strong>
            <p><strong><?php _e( "Please read !!! These below meetings are directly from your zoom.us account via API connection. Meetings added from here won't show up on your Post Type list. This will only create meeting in your zoom.us account !", "video-conferencing-with-zoom-api" ); ?></strong> <a href="javascript:void(0);" class="zvc-dismiss-message"><?php _e( "I understand ! Don't show this again !", "video-conferencing-with-zoom-api" ); ?></a></p></div>
		<?php
	}
}

function vczapi_get_template( $template_names, $load = false, $require_once = true ) {
	if ( ! is_array( $template_names ) ) {
		return '';
	}

	$located         = false;
	$this_plugin_dir = ZVC_PLUGIN_DIR_PATH;
	foreach ( $template_names as $template_name ) {
		if ( file_exists( STYLESHEETPATH . '/' . ZVC_PLUGIN_SLUG . '/' . $template_name ) ) {
			$located = STYLESHEETPATH . '/' . ZVC_PLUGIN_SLUG . '/' . $template_name;
			break;
		} elseif ( file_exists( TEMPLATEPATH . '/' . ZVC_PLUGIN_SLUG . '/' . $template_name ) ) {
			$located = TEMPLATEPATH . '/' . ZVC_PLUGIN_SLUG . '/' . $template_name;
			break;
		} elseif ( file_exists( $this_plugin_dir . 'templates/' . $template_name ) ) {
			$located = $this_plugin_dir . 'templates/' . $template_name;
			break;
		}
	}

	if ( $load && ! empty( $located ) ) {
		load_template( $located, $require_once );
	}

	return $located;
}

function vczapi_get_template_part( $slug, $name = '' ) {
	$template = false;
	if ( $name ) {
		$template = locate_template( array(
			"{$slug}-{$name}.php",
			ZVC_PLUGIN_SLUG . "{$slug}-{$name}.php",
		) );

		if ( ! $template ) {
			$fallback = ZVC_PLUGIN_DIR_PATH . "templates/{$slug}-{$name}.php";
			$template = file_exists( $fallback ) ? $fallback : '';
		}
	}

	if ( ! $template ) {
		$template = locate_template( array(
			"{$slug}-{$name}.php",
			ZVC_PLUGIN_SLUG . "{$slug}-{$name}.php",
		) );
	}

	// Allow 3rd party plugins to filter template file from their plugin.
	$template = apply_filters( 'vcz_get_template_part', $template, $slug, $name );

	if ( $template ) {
		load_template( $template, false );
	}
}

function vczapi_check_author( $post_id ) {
	$post_author_id = get_post_field( 'post_author', $post_id );
	$current_user   = get_current_user_id();
	if ( (int) $post_author_id === $current_user ) {
		return true;
	} else {
		return false;
	}
}

function vczapi_dateConverter( $start_time, $tz, $format = 'F j, Y, g:i a ( T )' ) {
	$timezone = ! empty( $tz ) ? $tz : "America/Los_Angeles";
	$tz       = new DateTimeZone( $timezone );
	$date     = new DateTime( $start_time );
	$date->setTimezone( $tz );

	return $date->format( $format );
}
