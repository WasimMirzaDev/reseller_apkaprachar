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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('WP_CACHE', true);
define( 'WPCACHEHOME', '/home/apkaprachar/public_html/blogs/wp-content/plugins/wp-super-cache/' );
define( 'DB_NAME', 'apkaprachar_wp_utg0b' );

/** Database username */
define( 'DB_USER', 'apkaprachar_wp_0yzhz' );

/** Database password */
define( 'DB_PASSWORD', '3*~9rLTR1122ds17' );

/** Database hostname */
define( 'DB_HOST', 'localhost:3306' );

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
define('AUTH_KEY', 'pMbuPg9@WzK6q9i+36d1X&9S9uS%#2(CK2Np;&%QQY3_maI/)[X5l![ZW1yTOmvu');
define('SECURE_AUTH_KEY', '@&9;V%#i;V0!U/@l!10/-A[_JotJ!mx9]XJkd_8x5me*(u5Au1/I54Ri:3d++TB9');
define('LOGGED_IN_KEY', '16XAUx)6da:G1Ld]o01[PbsU|x8+:MIA&Pb!-579z2f4ZN9ao[9D6Y*E:3(oWBD-');
define('NONCE_KEY', 'c4_fKPO*n5tkzfC)F3AMo]8815d!Ff332(bJ2DseYKIaI2|dU840Pxg_|3Blm89j');
define('AUTH_SALT', ';7Rk&11K69Z)Du4h#STMxR8IDk310V7Bfq#h3JA_MN#7#18]pT/tB7PvKzc_C4kf');
define('SECURE_AUTH_SALT', 'Ao4;04e1&~_[2ci2xW*G:u9B;d_!7lz910606C7|M2MitpP#091E3tZ3L1kh3@-9');
define('LOGGED_IN_SALT', '3+t48W2~5/H14[50TQ)8rt;42q6d)|(04u@AI[[Dy51@)fXML7X+6oTty2&LM])8');
define('NONCE_SALT', 'B;H-7!8fS5Gen)GqMIy+9)]&xq%/hQ0n-h%6A)6r8]hn84Govg2Sc[Kq6Zu)%/dy');


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'pq5z4g_';


/* Add any custom values between this line and the "stop editing" line. */

define('WP_ALLOW_MULTISITE', true);
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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
