<?php
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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'chizaipark' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'NS[;[I[ }QuJR_j`b|}[ep|6i>(/OAjUs8d)SDuA/>9x=I19ZpK}Dkw7J>},I]_3' );
define( 'SECURE_AUTH_KEY',  '+JLO|fC_wU+kI#_u9qK8G&+ayIIwb?48LjbrRYeE2@g(x/]3{JSIO)!]Vf5z{/@j' );
define( 'LOGGED_IN_KEY',    'T }O5[oG)HA18,!Qk*)374&t&N+;P!Mj2),?30]-D*$%N2C)51o F3j]ck_mCuz ' );
define( 'NONCE_KEY',        'hkg6AA=%UqGw4qttH-/!$@5EF);|#p|5@E_.+lEh}27:nlI~mpbe1/.C*JduQxx ' );
define( 'AUTH_SALT',        'f5K;JyQ31A_y:n>uE*Y:enaueaw(FXQPa3w*JcRAaa]|7aBHb,Z&qp|2UwyUcX|J' );
define( 'SECURE_AUTH_SALT', 'M02v$b[%YoB-H~2h1$=U;x*gT{`fkqp#VQslV8LHQo-c<ThJ>,j-ICjlat{}N,Ho' );
define( 'LOGGED_IN_SALT',   '0:R^SQEUF#bc-~6/6NsH.xijyBr{kn(~=f![JVqtE;BVuG,uWQe$7MYns-Cmip8Z' );
define( 'NONCE_SALT',       'H9TsSvH~WaUcGAT@3+(:-AB@RC=}&FX~!^;]|?cD}OTQr&<]MZ[eTz>zLI({cS/#' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
