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
define('DB_NAME', 'wpdev');

/** MySQL database username */
define('DB_USER', 'admin');

/** MySQL database password */
define('DB_PASSWORD', 'password');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/** Prevent FTP popup when trying to install plugins */
define('FS_METHOD', 'direct');


/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'j5*hBeQ.B){:@X8/Wi[vOfoSJ.)&ufx{B;8-S{FkOqN^JDRdNof3f/vx*{x U>VO');
define('SECURE_AUTH_KEY',  '_uoq AAb/TgWY~.xeFl^RMLw[jtO,LiVsTIlPm4kn4APLxWl)ESR]lX0S;yP ]ph');
define('LOGGED_IN_KEY',    'x}ELbE>z]33~Is%BYZO)3}1(_))xb6lpGH)jVM/<|XnmJAX;^t=zvq][@NJl7AdK');
define('NONCE_KEY',        ':_HEKd J{5*g3zgpGIkXQ9qi]`1Zk{uz0Kl !i`</%*KPY#LXS5GzPl9tqK}W1Bi');
define('AUTH_SALT',        '{3K]JUk9jQL([<cAS;X0 pDoj^g-%/L6:dMZoSG6#gJS+[r.r2E1%LTPkAnJBR}E');
define('SECURE_AUTH_SALT', '57:P[(K%(!!+y#<XvyNH TtI.FQWh!-;SyQH_pvo~!vXUf*ey/YoS}GC#6{AJiD$');
define('LOGGED_IN_SALT',   '%_y/XAZM[wK)cgvxqD)BIY}?.x3!,+9k7hclR_y/BOcpXzs|~M;;]Z+b2W(c-}*V');
define('NONCE_SALT',       'K.r1 fb0F_jOFX^T-/2[,u7$^@^g]dp8Q)6y[tO;b&g2*L/Z=bd=K6C8JB`zv8EL');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
