<?php
/**
 * About configuration
 *
 * @package Magazine Newspaper
 */

$config = array(
	'menu_name' => esc_html__( 'Magazine Newspaper Setup', 'magazine-newspaper' ),
	'page_name' => esc_html__( 'Magazine Newspaper Setup', 'magazine-newspaper' ),

	/* translators: theme version */
	'welcome_title' => sprintf( esc_html__( 'Welcome to %s - ', 'magazine-newspaper' ), 'Magazine Newspaper' ),

	/* translators: 1: theme name */
	'welcome_content' => sprintf( esc_html__( 'We hope this page will help you to setup %1$s with few clicks. We believe you will find it easy to use and perfect for your website development.', 'magazine-newspaper' ), 'Magazine Newspaper' ),

	// Quick links.
	'quick_links' => array(
		'theme_url' => array(
			'text' => esc_html__( 'Theme Details','magazine-newspaper' ),
			'url'  => 'https://thebootstrapthemes.com/downloads/free-magazine-newspaper-wordpress-theme/',
			),
		'demo_url' => array(
			'text' => esc_html__( 'View Demo','magazine-newspaper' ),
			'url'  => 'http://thebootstrapthemes.com/preview/?demo=magazine-newspaper',
			),
		'documentation_url' => array(
			'text'   => esc_html__( 'Upgrade to Pro','magazine-newspaper' ),
			'url'    => 'https://thebootstrapthemes.com/downloads/magazine-newspaper-pro/',
			'button' => 'primary',
			),
		),

	// Tabs.
	'tabs' => array(
		'getting_started'     => esc_html__( 'Getting Started', 'magazine-newspaper' ),
		'recommended_actions' => esc_html__( 'Recommended Actions', 'magazine-newspaper' ),
		'support'             => esc_html__( 'Support', 'magazine-newspaper' ),
	),

	// Getting started.
	'getting_started' => array(
		array(
			'title'               => esc_html__( 'Theme Documentation', 'magazine-newspaper' ),
			'text'                => esc_html__( 'Find step by step instructions to setup theme easily.', 'magazine-newspaper' ),
			'button_label'        => esc_html__( 'View documentation', 'magazine-newspaper' ),
			'button_link'         => 'https://thebootstrapthemes.com/magazine-newspaper-wordpress-theme-documentation/',
			'is_button'           => true,
			'recommended_actions' => false,
			'is_new_tab'          => true,
		),
		array(
			'title'               => esc_html__( 'Recommended Actions', 'magazine-newspaper' ),
			'text'                => esc_html__( 'We recommend few steps to take so that you can get complete site like shown in demo.', 'magazine-newspaper' ),
			'button_label'        => esc_html__( 'Check recommended actions', 'magazine-newspaper' ),
			'button_link'         => esc_url( admin_url( 'themes.php?page=magazine-newspaper-about&tab=recommended_actions' ) ),
			'is_button'           => true,
			'recommended_actions' => false,
			'is_new_tab'          => false,
		),
		array(
			'title'               => esc_html__( 'Customize Everything', 'magazine-newspaper' ),
			'text'                => esc_html__( 'Start customizing every aspect of the website with customizer.', 'magazine-newspaper' ),
			'button_label'        => esc_html__( 'Go to Customizer', 'magazine-newspaper' ),
			'button_link'         => esc_url( wp_customize_url() ),
			'is_button'           => true,
			'recommended_actions' => false,
			'is_new_tab'          => false,
		),
	),

	// Recommended actions.
	'recommended_actions' => array(
		'content' => array(
			
			'front-page' => array(
				'title'       => esc_html__( 'Setting Static Front Page','magazine-newspaper' ),
				'description' => esc_html__( 'Create a new page to display on front page ( Ex: Home ) and assign "Home" template. Select A static page then Front page and Posts page to display front page specific sections. Note: Static page will be set automatically when you import demo content.', 'magazine-newspaper' ),
				'id'          => 'front-page',
				'check'       => ( 'page' === get_option( 'show_on_front' ) ) ? true : false,
				'help'        => '<a href="' . esc_url( wp_customize_url() ) . '?autofocus[section]=static_front_page" class="button button-secondary">' . esc_html__( 'Static Front Page', 'magazine-newspaper' ) . '</a>',
			),

			'one-click-demo-import' => array(
				'title'       => esc_html__( 'One Click Demo Import', 'magazine-newspaper' ),
				'description' => esc_html__( 'Please install the One Click Demo Import plugin to import the demo content. After activation go to Appearance >> Import Demo Data and import it.', 'magazine-newspaper' ),
				'check'       => class_exists( 'OCDI_Plugin' ),
				'plugin_slug' => 'one-click-demo-import',
				'id'          => 'one-click-demo-import',
			),
			
		),
	),

	// Support.
	'support_content' => array(
		'first' => array(
			'title'        => esc_html__( 'Contact Support', 'magazine-newspaper' ),
			'icon'         => 'dashicons dashicons-sos',
			'text'         => esc_html__( 'If you have any problem, feel free to create ticket on our dedicated Support forum.', 'magazine-newspaper' ),
			'button_label' => esc_html__( 'Contact Support', 'magazine-newspaper' ),
			'button_link'  => esc_url( 'https://thebootstrapthemes.com/downloads/magazine-newspaper/' ),
			'is_button'    => true,
			'is_new_tab'   => true,
		),
		'second' => array(
			'title'        => esc_html__( 'Theme Documentation', 'magazine-newspaper' ),
			'icon'         => 'dashicons dashicons-book-alt',
			'text'         => esc_html__( 'Kindly check our theme documentation for detailed information and video instructions.', 'magazine-newspaper' ),
			'button_label' => esc_html__( 'View Documentation', 'magazine-newspaper' ),
			'button_link'  => 'https://thebootstrapthemes.com/downloads/magazine-newspaper/',
			'is_button'    => true,
			'is_new_tab'   => true,
		),
	),


);
Magazine_Newspaper_About::init( apply_filters( 'magazine_newspaper_about_filter', $config ) );