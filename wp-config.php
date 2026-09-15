<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'woosaree' );

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
define( 'AUTH_KEY',         'BTYRWu76n9dw R~qe{P/+D.8Ze=d#vwOmi?0d`94cbNWlC[h>Xu+^PHUs38W]P.&' );
define( 'SECURE_AUTH_KEY',  '2i5U kl%&/ erL+nQ@<,fF[j6t-:tamCe3$S:hoyI=l#{V|v9>UP70NM`+*Dt;rT' );
define( 'LOGGED_IN_KEY',    '!+*wDu!d!S6gLA^&O*G*S_{(k6`L`0`8B(;?78XlZ+h5J?3;#=SJHD~}8^Q|#-+-' );
define( 'NONCE_KEY',        '@Quj9Q~u^uASW5YaW(DuF6d,V<.j~9Xy&!txZ~Ww6NCc/B8P0:Gy@z-|6{mNcuGr' );
define( 'AUTH_SALT',        '#=<0jGL3X8[ZA`d`CINg1aN=[pkLuzsE95(%/=OynNk)>[nY5I;f%V@A>9B8>b9l' );
define( 'SECURE_AUTH_SALT', 'lfzu8AnDO,b5@}}>WHR ^fH10vDhO5WhoK$mYd<q a#l0`nf?OK)GD[_,#3!Dkx~' );
define( 'LOGGED_IN_SALT',   'wKHEZP3W*nD~E!kFNR^ Tsd|hx=VuZB`7u;z W_QJQxV`!/k;7MS%K.xUR,mdH=t' );
define( 'NONCE_SALT',       '^+}a%m#QZFcdf0Nx5T%<gVTpLa|sNR)n)n}G5z!_Wl&)wzULY9I:rW6TN0`mA0,(' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'ws_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
