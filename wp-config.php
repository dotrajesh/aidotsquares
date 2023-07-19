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
define( 'DB_NAME', 'aidotsquares-elementor' );

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
define( 'AUTH_KEY',         '!G_=A_aH7PXXyRLsex<Rsp7NDf6CKfhOH,0f#V+2M<yXl-?~x|!q&B@KF)Ao*aJd' );
define( 'SECURE_AUTH_KEY',  '9HUQUxN[&n@EzSL-hG/ouL>5jP^d~tirfX7|DSU^I6N>0(y1#a?,ZSY;mFK(|=?d' );
define( 'LOGGED_IN_KEY',    '`u**ieM`wGGM]m(80jxiB8XPoqj#BTNSQwKv]8d]U7gJ=FtW.H**]gY@QV})EuE-' );
define( 'NONCE_KEY',        'wAi4biH%LH0?nOy$RU l;(s9pwq1 ZM_PH-=1>BBR{z*}v.M^~*,zX|Yv-&<k|BH' );
define( 'AUTH_SALT',        '<D;i%|:&:Up7k_3>;_6_xGzj9OSF<jJ$QP^c<dE4-Rh1L3T.f|3>]Z=0vzxIDzGs' );
define( 'SECURE_AUTH_SALT', 'UKxa>J[vX-IJOCE Q.4bC<yBkL#T{Ru>rQDf$98E;*Pskfty.1;QckIZyv6KHvkw' );
define( 'LOGGED_IN_SALT',   ')i]C;h IuR**}FQ6:Kx:::ABO[IBOXLwJrV!^Ht}2&uOoWtU=PeGUC59f&v7PaSn' );
define( 'NONCE_SALT',       'G4h!EX4)a?Qm|qrk(W#Rt;cv8K9bF]ui@OEpTGdWznY@o3o[5cQ16?J(W`R5_BZ?' );

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
