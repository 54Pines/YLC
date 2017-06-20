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
define('DB_NAME', 'pines54_wp');

/** MySQL database username */
define('DB_USER', 'pines54_wp');

/** MySQL database password */
define('DB_PASSWORD', 'ChangeMe123!');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'EFEFf1Q6W&rh[D]SwoSjn0ru.Fv%#<`2L3{-m86GPU]x51.Wim/k3x#Rc,`D?]:Z');
define('SECURE_AUTH_KEY',  'jl]sQ(e*9y&y$5ZS-~C[$;Gy9SmC;$U(x)&d^mH1</NfAT8{4V7%%:p667yD.]EW');
define('LOGGED_IN_KEY',    'OsWvN/_k+b!&tL!8){oa>&!h}@{2er5Ud2]BHpzyw 76##V)f)%sMz$|XRR8J[h+');
define('NONCE_KEY',        '`|N~;hft5]!G24,To1OE5|7R^%ia:VXigYQJ4)7R/2(r^tR((JU$v{vk~qvTzUu!');
define('AUTH_SALT',        'W4K*L9;KQQ7B?pV~8> [}MDI#,S)8+y?BY4d-&Hzh1On:5u3}5(;Htvi2KC.S8_x');
define('SECURE_AUTH_SALT', '7+2k@~>w:c YGtP &>V?)Z7L^k*zKYj5@lPcn8Z@9lP xbfl%As^1CvV@cao(&(]');
define('LOGGED_IN_SALT',   'Kb[xR0~4z,5>Z{aghV2ml)7)o9n%*qCJYn+h.$:1k1wyFj!#!sK8@ <&8R%p3F5r');
define('NONCE_SALT',       'u.|U<gOR43Y1RvHTD*$=$n5._b1/=G3J=?(Eh%#^iI(wJ5/FkSdDai_1I8sn.PJH');

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
