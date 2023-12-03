<?php
define( 'WP_CACHE', true );
//Begin Really Simple SSL session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple SSL

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'raspberrypiprojects' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'PJHEOaPWhDX0dnZ1XWlQVG7tiRCJWqmwbPpqEM1N0b1f8uu1NUE5cCx44XFEkVbZ');
define('SECURE_AUTH_KEY',  'PeqKjkbSEL2xiZ9SKBrqlwNvOs09V06hpv58pJjTIagIYXgrcnho7LkxbIy1Gti8');
define('LOGGED_IN_KEY',    'F5nc4w1kPZKtoi3p3fAd8DvJjnyUv8u1y0L57XfuSJ0mHf7JWNZ4iCP4QvE9hlit');
define('NONCE_KEY',        '1Iec45vAl7FnOjV8p6F2M2CmTXPgBzbuu4UoUGvF4xRGo1VHiMczowYA72Aum9YR');
define('AUTH_SALT',        '2Gq23Se0eujT98gf3V50qnTTIrv1tiTw2gslfTIigKUTePPqbOwPLByXcol0yXJQ');
define('SECURE_AUTH_SALT', 'pepJAcffhqebmU2lAzbtRbF8rsm07BlZCMFatBqpp0lwGTLxWm2JzIULvH2oSBG9');
define('LOGGED_IN_SALT',   'IzxeGWEJelz0IIUKBRPqagpqqa3J3cLrK6qPVuGARLVu57qbBpZh4N9J0HkqfiIy');
define('NONCE_SALT',       'JMzH1ztDznxhCLugWK4Op3SFBAyPO6wcCGue6Er2NuALeGpjRBJKA71rTCJYkQD9');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');
define('FS_CHMOD_DIR',0755);
define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');


/**#@-*/

/**
 * WordPress database table prefix.
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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
