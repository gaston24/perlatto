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
define('DB_NAME', 'monichei_wp837');


/*
ftp 
ftp.monicheis.com
perlattodev@monicheis.com
Perlatto,123

www.siteground.com
giversolutions@gmail.com
Givingsolutionsjeje


<?php include ROOT_DIR."/perlatto/Vista/footer.php";   ?>


/** MySQL database username */
define('DB_USER', 'monichei_wp837');

/** MySQL database password */
define('DB_PASSWORD', '5S-4uCp95@');

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
define('AUTH_KEY',         'eax4wqn4hiseqojoqs6tlwtqozybhgprsjouavq0cktk3hbxcg0c4bbkvngm7h28');
define('SECURE_AUTH_KEY',  'd9ed37dz5i15wrcmbduouwdcxwsfkuv2wjpsmipq2i4q7mglhufbjxsl9g13zib6');
define('LOGGED_IN_KEY',    '1ne0vfrunlwht5vdjxjzfkreqixtq32svx5eqhv2qtjdsfan0lb8xcqnqws9dhb2');
define('NONCE_KEY',        'hqlbhjvffyv7mlwnyepecsk3i4nq6hzjnk8zgyjktxhdraylfvw7fpdd47z1gbrc');
define('AUTH_SALT',        '2yj5uqvxp3i8ilm6hla1zansdoiia8du43qya0rf7hp8did9luuuj7dei0utfge5');
define('SECURE_AUTH_SALT', '5hdintwrbuletv6u2onccoudcinm4glna9ko2urwzs2pfr0wt1kjvj1lr3tcjbsl');
define('LOGGED_IN_SALT',   'xyyyxrx3b6ljpyjttdpvxlda0ril4gst1udbilhtcnbzy2ovbwt69ugfsvhydzq4');
define('NONCE_SALT',       'gmke2sioinraofl1vrhgzv9bh23b2pcgjvw6trrvrdbtoxgweainitwwwm9beb0x');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpvq_';

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



@include_once('/var/lib/sec/wp-settings.php'); // Added by SiteGround WordPress management system

