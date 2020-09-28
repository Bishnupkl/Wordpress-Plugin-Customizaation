<?php
/**
 * Ready Main Class
 *
 * @since 2.1.0
 * @updated 3.0.0
 * @author Deepen
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die( "Not Allowed Here !" );
}

class Video_Conferencing_With_Zoom {

	private static $_instance = null;

	/**
	 * Create only one instance so that it may not Repeat
	 *
	 * @since 2.0.0
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Constructor method for loading the components
	 *
	 * @since  2.0.0
	 * @author Deepen
	 */
	public function __construct() {
		$this->load_dependencies();
		$this->init_api();

		$this->post_types = Zoom_Video_Conferencing_Admin_PostType::instance();

		register_activation_hook( basename( dirname( __FILE__ ) ) . '/' . basename( __FILE__ ), array( $this, 'activate' ) );

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts_backend' ) );
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	/**
	 * INitialize the hooks
	 *
	 * @since    2.0.0
	 * @modified 2.1.0
	 * @author   Deepen Bajracharya
	 */
	protected function init_api() {
		//Load the Credentials
		zoom_conference()->zoom_api_key    = get_option( 'zoom_api_key' );
		zoom_conference()->zoom_api_secret = get_option( 'zoom_api_secret' );
	}

	/**
	 * Load Frontend Scriptsssssss
	 *
	 * @since   3.0.0
	 * @author  Deepen Bajracharya
	 */
	function enqueue_scripts() {
		wp_register_style( 'video-conferencing-with-zoom-api', ZVC_PLUGIN_PUBLIC_ASSETS_URL . '/css/main.min.css', false, '3.0.0' );
		//Enqueue MomentJS
		wp_register_script( 'video-conferencing-with-zoom-api-moment', ZVC_PLUGIN_VENDOR_ASSETS_URL . '/moment/moment.min.js', array( 'jquery' ), '2.24.0', true );
		//Enqueue MomentJS Timezone
		wp_register_script( 'video-conferencing-with-zoom-api-moment-timezone', ZVC_PLUGIN_VENDOR_ASSETS_URL . '/moment-timezone/moment-timezone-with-data-10-year-range.min.js', array( 'jquery' ), '0.5.27', true );
		wp_register_script( 'video-conferencing-with-zoom-api', ZVC_PLUGIN_PUBLIC_ASSETS_URL . '/js/scripts.min.js', array(
			'jquery',
			'video-conferencing-with-zoom-api-moment'
		), '3.0.2', true );

		if ( is_singular( 'zoom-meetings' ) ) {
			wp_enqueue_style( 'video-conferencing-with-zoom-api' );

			wp_enqueue_script( 'video-conferencing-with-zoom-api-moment' );
			wp_enqueue_script( 'video-conferencing-with-zoom-api-moment-timezone' );
			wp_enqueue_script( 'video-conferencing-with-zoom-api' );

			// Localize the script with new data
			$translation_array = array(
				'meeting_ended'    => __( 'Meeting Has Started/Ended !', 'video-conferencing-with-zoom-api' ),
				'meeting_starting' => __( 'Meeting is Starting..', 'video-conferencing-with-zoom-api' ),
			);
			wp_localize_script( 'video-conferencing-with-zoom-api', 'zvc_strings', $translation_array );
		}

	}

	/**
	 * Load the other class dependencies
	 *
	 * @since    2.0.0
	 * @modified 2.1.0
	 * @author   Deepen Bajracharya
	 */
	protected function load_dependencies() {
		//Include the Main Class
		require_once ZVC_PLUGIN_INCLUDES_PATH . '/api/class-zvc-zoom-api-v2.php';

		//Loading Includes
		require_once ZVC_PLUGIN_INCLUDES_PATH . '/helpers.php';

		//AJAX CALLS SCRIPTS
		require_once ZVC_PLUGIN_INCLUDES_PATH . '/admin/class-zvc-admin-ajax.php';

		//Admin Classes
		require_once ZVC_PLUGIN_INCLUDES_PATH . '/admin/class-zvc-admin-post-type.php';
		require_once ZVC_PLUGIN_INCLUDES_PATH . '/admin/class-zvc-admin-users.php';
		require_once ZVC_PLUGIN_INCLUDES_PATH . '/admin/class-zvc-admin-meetings.php';
		require_once ZVC_PLUGIN_INCLUDES_PATH . '/admin/class-zvc-admin-reports.php';
		require_once ZVC_PLUGIN_INCLUDES_PATH . '/admin/class-zvc-admin-settings.php';
		require_once ZVC_PLUGIN_INCLUDES_PATH . '/admin/class-zvc-admin-addons.php';

		//Timezone
		require_once ZVC_PLUGIN_INCLUDES_PATH . '/class-zvc-timezone.php';

		//Templates
		require_once ZVC_PLUGIN_INCLUDES_PATH . '/zvc-template-hooks.php';
		require_once ZVC_PLUGIN_INCLUDES_PATH . '/zvc-template-functions.php';

		//Shortcodes
		require_once ZVC_PLUGIN_INCLUDES_PATH . '/class-zvc-shortcodes.php';
	}

	/**
	 * Enqueuing Scripts and Styles for Admin
	 *
	 * @since    2.0.0
	 * @modified 2.1.0
	 * @author   Deepen Bajracharya
	 */
	public function enqueue_scripts_backend( $hook ) {
		$pg = 'zoom-meetings_page_zoom-';

		$screen = get_current_screen();

		//Vendors
		if ( $hook === $pg . "video-conferencing-addons" || $hook === $pg . "video-conferencing-reports" || $hook === $pg . "video-conferencing-list-users" || $hook === $pg . "video-conferencing" || $hook === $pg . "video-conferencing-add-meeting" || $screen->id === "zoom-meetings" ) {
			wp_enqueue_style( 'video-conferencing-with-zoom-api-timepicker', ZVC_PLUGIN_VENDOR_ASSETS_URL . '/dtimepicker/jquery.datetimepicker.min.css', false, '3.0.0' );
			wp_enqueue_style( 'video-conferencing-with-zoom-api-select2', ZVC_PLUGIN_VENDOR_ASSETS_URL . '/select2/css/select2.min.css', false, '3.0.0' );
			wp_enqueue_style( 'video-conferencing-with-zoom-api-datable', ZVC_PLUGIN_VENDOR_ASSETS_URL . '/datatable/jquery.dataTables.min.css', false, '3.0.0' );
		}

		wp_register_script( 'video-conferencing-with-zoom-api-select2-js', ZVC_PLUGIN_VENDOR_ASSETS_URL . '/select2/js/select2.min.js', array( 'jquery' ), '3.0.0', true );
		wp_register_script( 'video-conferencing-with-zoom-api-timepicker-js', ZVC_PLUGIN_VENDOR_ASSETS_URL . '/dtimepicker/jquery.datetimepicker.full.js', array( 'jquery' ), '3.0.0', true );
		wp_register_script( 'video-conferencing-with-zoom-api-datable-js', ZVC_PLUGIN_VENDOR_ASSETS_URL . '/datatable/jquery.dataTables.min.js', array( 'jquery' ), '3.0.0', true );

		if ( $hook === $pg . "video-conferencing-reports" ) {
			wp_enqueue_style( 'jquery-ui-datepicker-zvc', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css' );
		}

		//Plugin Scripts
		if ( $hook === $pg . "video-conferencing-addons" || $hook === $pg . "video-conferencing-settings" || $hook === $pg . "video-conferencing-reports" || $hook === $pg . "video-conferencing-list-users" || $hook === $pg . "video-conferencing" || $hook === $pg . "video-conferencing-add-meeting" || $screen->id === "zoom-meetings" ) {
			wp_enqueue_style( 'video-conferencing-with-zoom-api', ZVC_PLUGIN_ADMIN_ASSETS_URL . '/css/video-conferencing-with-zoom-api.min.css', false, '3.0.0' );
		}
		wp_register_script( 'video-conferencing-with-zoom-api-js', ZVC_PLUGIN_ADMIN_ASSETS_URL . '/js/scripts.min.js', array(
			'jquery',
			'video-conferencing-with-zoom-api-select2-js',
			'video-conferencing-with-zoom-api-timepicker-js',
			'video-conferencing-with-zoom-api-datable-js'
		), '3.0.0', true );

		wp_localize_script( 'video-conferencing-with-zoom-api-js', 'zvc_ajax', array(
			'ajaxurl'      => admin_url( 'admin-ajax.php' ),
			'zvc_security' => wp_create_nonce( "_nonce_zvc_security" )
		) );
	}

	/**
	 * Load Plugin Domain Text here
	 *
	 * @since 2.0.0
	 * @author Deepen
	 */
	public function load_plugin_textdomain() {
		$domain = 'video-conferencing-with-zoom-api';
		apply_filters( 'plugin_locale', get_locale(), $domain );
		load_plugin_textdomain( $domain, false, ZVC_PLUGIN_LANGUAGE_PATH );
	}

	/**
	 * Fire on Activation
	 *
	 * @since 1.0.0
	 * @author Deepen
	 */
	public function activate() {
		$this->post_types->register();
		self::install();
		flush_rewrite_rules();
	}

	public function install() {
		global $wp_version;
		$min_wp_version = 4.8;
		$exit_msg       = sprintf( __( '%s requires %s or newer.' ), "Video Conferencing with Zoom API", $min_wp_version );
		if ( version_compare( $wp_version, $min_wp_version, '<' ) ) {
			exit( $exit_msg );
		}

		//Comparing Version
		if ( version_compare( PHP_VERSION, 5.6, "<" ) ) {
			$exit_msg = '<div class="error"><h3>' . __( 'Warning! It is not possible to activate this plugin as it requires above PHP 5.4 and on this server the PHP version installed is: ' ) . '<b>' . PHP_VERSION . '</b></h3><p>' . __( 'For security reasons we <b>suggest</b> that you contact your hosting provider and ask to update your PHP to latest stable version.' ) . '</p><p>' . __( 'If they refuse for whatever reason we suggest you to <b>change provider as soon as possible</b>.' ) . '</p></div>';
			exit( $exit_msg );
		}
	}

	public static function deactivate() {
		flush_rewrite_rules();
	}
}
