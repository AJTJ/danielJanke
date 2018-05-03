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
define('DB_NAME', 'danielJanke');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'DSkHO]{Y)]{#5|NNb?gMy 57lUs_PdUiD+71TH]wpHu#;!gC~`7+#LweXBnBOe6o');
define('SECURE_AUTH_KEY',  'pbe3x;>I+VA]dOmakOCxm!r&L5Ge,D `ajmCT+j*}SZ^6j9pQx:lSglV;plWA?HV');
define('LOGGED_IN_KEY',    '!pU])B884VwyTG|/mbbl7<nPn-g92}}b{w`r_{hYv}&W:&>(ty8,q@%t65B#h_@(');
define('NONCE_KEY',        'blD|+i5E]wo&Nt{:&K/*td7f&o-:pHbofZV~USU:ThtX0ChiCQ)N]T7zK9>a;v8a');
define('AUTH_SALT',        '%;},?Sz_]G?%a^//?l/BY*YsWM{{exyA0g;.@qpf:H*@uwjkm99@-kybFx(2u6$*');
define('SECURE_AUTH_SALT', '(G{uQg}mX|K[7NqTC6-?XVP%*Y]TinS}xrFZ/g.JjcxaN9R|fH{0tqNz;6|=_6k[');
define('LOGGED_IN_SALT',   'dn@LGOcS9c-?arOmY6I:)Z<QMmuA7R%.[KJtq47OpH9W6-Qf6(<_duuh;;]16&vP');
define('NONCE_SALT',       '|W}he?^=?jycrLxf(JfzPf;z7bindTgw<nv0Owtzw&T-zl&Gp*&w; m2a1t1C7-8');

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
