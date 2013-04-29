<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home/firstexe/public_html/template/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'firstexe_jeuel');

/** MySQL database username */
define('DB_USER', 'firstexe_social');

/** MySQL database password */
define('DB_PASSWORD', '99queen');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'n/0Tyv~TXl1?:E2!kRxzsB^Qk\`R>kI\`g\`Yh~R6YOjuM)VhQ0~I)Xj~Wz\`yc!$2J9ExPrdkv~LZToM|4$>7=;G');
define('SECURE_AUTH_KEY',  '|@YkwECs;(jVs6J0LUfZIEwX-ark<(OokNU<k^*cx~/FgTq3i9o4$-;ndIG8AdAcGK@($~GYY');
define('LOGGED_IN_KEY',    '$Y$Cf\`wBJ)I=U/M$!)VwZb?$8nIeYv)eCxpVT)OYPv-B2x7;hvACHP?!\`id)~TVF73z(gZeB66:x)g4?m');
define('NONCE_KEY',        'IceA$J|u:A3tPMfjA5!-bM@@*(zDZ?A/F-oN!(A10loxEQx7Sj?29g_MNOuodO*Ky|Tuf');
define('AUTH_SALT',        'NYw5|yAadi5L<qBbNbCng3Arl>cl@$6XdP0eAt9|c(1ojggV4e?qr(bJaJtl5MAuZI(Q=');
define('SECURE_AUTH_SALT', 'X0j#RGqxSdebX4!AuG/7jDSY^=A!4qhOk*?UXI6O~lcI\`6-NS@/tls;rN^x4;7f$i^(_g(\`t');
define('LOGGED_IN_SALT',   'P=SAuE0WLTfJ@KS1JoFz-364e/PRF8mAwd0rLzf@G~IpRe5)O4\`6;YuV2ty8lk0ujFoup');
define('NONCE_SALT',       'm4?crOTfkV^RiYr?Mk-/sYSyB?n$Y$Ut:krX!ZvZ|1PA!b(5A#dHU<HhTtvX^fMWvIp6Tk^iRV5');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');