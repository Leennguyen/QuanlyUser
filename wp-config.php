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
define( 'DB_NAME', 'exampleSite' );

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
define( 'AUTH_KEY',         '+Qt4FgS:ccwjbt_X,I0 Q)XR/P~?yO2wUXAh]8LcWuBfx8JIAm7%xSgHBehXO7)z' );
define( 'SECURE_AUTH_KEY',  'no[W(0;Efjz(-G*C&Gup:lb%Cviu52t61$k]tY Q{eOARgLf6ep&Z>S2#U<I_nqT' );
define( 'LOGGED_IN_KEY',    'tx1<Qe+)s7CMbP~QJ=!9<1>0MZsSAmnp>Iu/sz~HY}dAURo:O-y}4n|h7^f*G;o;' );
define( 'NONCE_KEY',        '~g[[{gd)#Y;tq@DH`DharLSY MXC~_o<4p#qe8Yt*R9w*EZ^qqh`k(W8Q9EMzU;r' );
define( 'AUTH_SALT',        'b-ZA*!KEkz0+.4Y-7MXPcR{QxxISDy{ea_z8fR90?UB~H*~G:aMDgMTOu!H`3uHp' );
define( 'SECURE_AUTH_SALT', '{B+;g*~WYk^(|9*d66oi3jIqrYc9,W@lC#8Hp$!^z@8o [HsgCSz?9Opj!Rt:?Yb' );
define( 'LOGGED_IN_SALT',   'i3L3I#}_7TjV7h,@|Gjxh b|P0x]ru[yP^54GE9U[W[JGdgT0V1dEm!8Yw-E0%$[' );
define( 'NONCE_SALT',       '^G?IFE^3j[cln=Z.:t=1e41,N5AG=S0AF:T[@~*XMNn*Yo;8|7?ajt?9t5P^hY|b' );

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
