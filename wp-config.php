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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'healthyfood' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         'N#q$Qb-Fg*JQ`iRm6fA>o1!Kqp-v5Y,7yUsJ%s+8>VI|pxRP_*-r%@Y$H#4c+3Hv' );
define( 'SECURE_AUTH_KEY',  '{IBW:BpXmq;w.sKu$6Dwv:29fi[/s{o_u}uVJX8RNYQs0zgU%}rU?E;Z-v#kB1.k' );
define( 'LOGGED_IN_KEY',    '3QcE:yUr[k-I8nD+8A? Ovg[U.n!6?n7X8-Z()H:n=fL>&B~zVR]$_4Vna^Z0s8u' );
define( 'NONCE_KEY',        '/KO/5>IT 56<!k2/lpI]p_yjFE)l{L=X&G6( it8,-aXq$&#()HIzVon78Hs%Uw/' );
define( 'AUTH_SALT',        'EVOp`Dftai|YK~::T5aF! 5~2C8Iui`rWY2Q.]7U_faR|%l<ux^X-m]Y8Y-#.E8{' );
define( 'SECURE_AUTH_SALT', 'OfB=5FI G|U`++Y$s9>NgS-Awr!3g,HLLe.x?U,Q$=]p{WGjhW1y4]8|UwbvV=mZ' );
define( 'LOGGED_IN_SALT',   'eqNEsB+f/aoDv8%QI,o`?*V-p_dY1=~*RAa;]{)Ezvne~b{E#.i!x;js{Y52EC@m' );
define( 'NONCE_SALT',       '~^hWb_9bzDCAJVtH2[{w?XRlOA6DoX~g0txeqr2Xmw8K_wB*Ps./tLjRLv5;(x9k' );

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
