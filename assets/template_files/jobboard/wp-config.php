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
define( 'WPCACHEHOME', '/home/firstexe/public_html/jobboard/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'firstexe_wrdp3');

/** MySQL database username */
define('DB_USER', 'firstexe_wrdp3');

/** MySQL database password */
define('DB_PASSWORD', '7mqga7ULcWbOO3Ll');

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
define('AUTH_KEY',         'F?N4rw<f?_OYW:yrn=r$QJW7>EueI^(TElWh$8Ww|K;QZd?Kh=*e4:;atJq7X|Of5=i*u!vsLM');
define('SECURE_AUTH_KEY',  '@FFR\`)~PeFqnjc)v|r)N;fk-?N$qoQfSQG^0R?a_dpipNhg:;FU4e\`tDmg;2kW9YGhSfxR2');
define('LOGGED_IN_KEY',    '(@<bxFi_eD3_)|6e-zt:yOX|k-;e(9wY:DaI~JUp?M*!!#H$it>ho)RGjL\`9?nK2e!-iskgpU1v');
define('NONCE_KEY',        'fHM|Ne~A@wYGy@y_u@uQo7pS6Tv1x9FkuDbRKP<DV-d09ewLxG)b#\`vHDZ24GMw\`7hSrZGy?sY^6Qi/6');
define('AUTH_SALT',        'lG\`fsrsM9/>ke04TBzvKlH*Yd@sN$9vPwOmfqaaAw?cY\`~yoNbj|Lvw^*Xp1!Pbw_zy3Crb(bY\`h2');
define('SECURE_AUTH_SALT', 'DAq3r#)Wegw?F5X|a#HSTLQ@6lNwT1do2V8CnJK@\`yWD2)vewV_ep_3p;RQgOQnM4|qTs*0vf*PcP');
define('LOGGED_IN_SALT',   '=s=Ad29$D(P7(>r2ZB>1uW;ciUb8BQkUTK13W\`@U4w4Pq6F3$W<lq|7vY_zAQ7iFQB#BJ18RLhsc');
define('NONCE_SALT',       'R_$UM^Zx@q<Oc_kW)4laqFt4?pTgelCkEc;cmPOR#br2*v/n0vPhf76E\`GumFFpo');

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
