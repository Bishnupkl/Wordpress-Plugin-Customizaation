<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wc' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         ']}MS$tmPG;yKdh+N+izDg7#{+DCYbBCCox6g)S2jQd~;Hy1-9mCBF75V=|}q?W~C' );
define( 'SECURE_AUTH_KEY',  'q2oEO8q*<7_F[Ja-r&n-6`L8]dn#e}0z[uy)a|kspA>J>,ku!l98t6ntJZ}`#-~c' );
define( 'LOGGED_IN_KEY',    'uy3cgk.$)D Xf[<*Qsqcc_6q&TDXs1}S@=J4ez&A9U9KUSIQsdd,$BS#3ZM^,*DV' );
define( 'NONCE_KEY',        'i*yPXaTxJ^:Yx0fRYV26+@iVA=g}(gDV0g|pr$Y|C+inhD1Y72&8mD,_NeWpJj_ ' );
define( 'AUTH_SALT',        '@N*Si|fl_76+FBO_a AYk!j#&zGyrYUgob|lWv9.*>(_PXUg}-3P&M$w$_enF8%i' );
define( 'SECURE_AUTH_SALT', '7GlX){LsEe#o&}Y4m?l~b|^bDTVv7@OAM>,QY.M@cm(qnhKg]&O1^n^%WF:xwo0(' );
define( 'LOGGED_IN_SALT',   '}wG/ >ECk*/RJNP^*jM^/cU%<1.qS~JLn-,$b~-Wh<ynm`BJ&gp0C&ngjH?CN*] ' );
define( 'NONCE_SALT',       't``qL0&(x0kl46p]QOxdn(CQD3)YCreV9&&9J}Su+/qV60 n$zu=;CqU1VqjE)<!' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
