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
define('WP_CACHE', true);
define( 'WPCACHEHOME', 'C:\xampp\htdocs\WordPress Site for Software Brand\wp-content\plugins\wp-super-cache/' );
define( 'DB_NAME', 'software_brand_db' );

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
define( 'AUTH_KEY',         'K`?ckRY|JO$l!`,kL3c]Iu03!E{C&&/1R<QKPDk!L(XCF?( {qKm&^%}nwD`6n_W' );
define( 'SECURE_AUTH_KEY',  '#n(>K$nE=@7Z#DbA$WJKwrfT.-G G]U%EiGdg57$+DivhJDk$[yb&KMY>fk&l0Wr' );
define( 'LOGGED_IN_KEY',    '/.B:f%V!+$m*w>42}><1xdZO*H`Z_(n0X0a!^e#/(SY:_JzXm2+j};N5`;v&nHBW' );
define( 'NONCE_KEY',        '4~^4A?kqyz0&Da#6!JdDZx:Z3dtZF$HzYVVGZ97j<SLQGhoM|arW*_FF_pRif[$%' );
define( 'AUTH_SALT',        'RR4CD_B%4?IM_GH|.G~Oo%>-OgkR*izln-c6GJ<*rBd8SXjdUsX%D?(!:13k{Uh;' );
define( 'SECURE_AUTH_SALT', 'Mv&r<ni&zwzzTU[JrQJ=zc?x5h}K.iUmGWL~C&j!u>xT-5ANPA9.hjygBE|shqJJ' );
define( 'LOGGED_IN_SALT',   'Pycy[Y1siM|TIk{O;ca:T:XOc--_M^JCN<B6p#=v&0x=cSx0zqE,Zte^fBX^kh4@' );
define( 'NONCE_SALT',       'B,Lu-KcX;{XOQ!{jQ`vb}C3[sg?L?zGis0@A(Ry<FKx1plb5TR|_5}cK5}+9Aa;I' );

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
