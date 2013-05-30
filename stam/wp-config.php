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
define('DB_NAME', 'inglesencadiz');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         ' b?2vau-!P4N?s)(YO@=v*tQlm>OR=qlxP=uL+:sv<V R7M|5:c|4j+LYNMe5-8-');
define('SECURE_AUTH_KEY',  'p{H<2Y]f4m[bK>#`U`w~-XSK)LnIa)JqCn8&)`wx_]E5cO,7T,mDyEkR0BK?7:Wd');
define('LOGGED_IN_KEY',    'k8wBQ25+T L3_YY+M[V@BKQE$d/BDT`/0uR]S-R8VEwWkW9eSQ(#H)S-]T<zLB[l');
define('NONCE_KEY',        'mE>M34!jCwUOC`)x#QoK`/EukQ):-x94D#BWg$P61u)L|6U,iJ0%uZ]xn(V^+>.J');
define('AUTH_SALT',        'T=a1|@-rUQ}X2|Aw>ql0O*x++-|#Pjqkb-J=XQS5D -VOe,/BcUg[;j0OEO>2D-&');
define('SECURE_AUTH_SALT', 'J>TD9*.X`+/@v2xd^C,y_e-) )4h7l6pYM~C71R)sg,<n#7wc-C?(,5MkrTuTcv_');
define('LOGGED_IN_SALT',   'k A^dmb1~ck|9L}(FhLm@#DIfB]Ulb=<-p`DpjS|hjYie<kY|JP$>%>rw1Oe0G4+');
define('NONCE_SALT',       'm|LxZGHZg2{Y,z~4(<:Pwg&|=@H~_JL!b)l~WeJn<n|d :T+Y=#?wwWr}C~Tio^`');

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
