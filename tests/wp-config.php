<?php

/*
 * This file is part of the wordpress functional test package.
 *
 * (c) Anthonius Munthi <me@itstoni.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


/** The name of the database for WordPress */
define('DB_NAME', 'wp_cli_test');

/** MySQL database username */
define('DB_USER', 'wp_cli_test');

/** MySQL database password */
define('DB_PASSWORD', 'password1');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/* * #@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'oYLiaW0o!fDecW!gt).b1-B3.hM&x%25Z2FAy.T?V@dcXwoFNbv~;HZ,+I7i!!)P');
define('SECURE_AUTH_KEY', '8US3l8?C]ai..^R]S0z&-/F(^={lH:h**dp~oyp|E%La3nF>mf(#jb|0wqbq~.x)');
define('LOGGED_IN_KEY', 'xn+{BYL1NxfKbAXWww}N7gDjub#LKH6^KKUQq4f*T:?yl,uuR@uOLW.dXqU8+p00');
define('NONCE_KEY', '&c;>VsDYD-)X+|p3-qeX/s)Q.vL1g}P]imS#oF]NdX P^e@JAL~FZB0n@pa/ui,;');
define('AUTH_SALT', '(J5Ou%-6{l;#5#2@aH`VVW}c<D*/T[IdgP:G$rDQ>@<>~-`4C6CIbA-+ihGx!ooi');
define('SECURE_AUTH_SALT', '_-?(L;5PQ~>KPB!~PMZ~>kzL;fw%R(MJ1m#H?u)p!%7|)AQYl@%PDd5FNU=d/L23');
define('LOGGED_IN_SALT', '^$X/9d!:ZQE4:#C?i+>>r~cU]K+AO<ly+ppUMp!%Tse(,n|<;W+PJe4hkkP3E@%Z');
define('NONCE_SALT', '+2dH^)8dd.~YNI#+hg?GwLl(-e?S?i,Z+]}.]|Zn]|>M$|~lh}PaR5axeH%^irw0');

/* * #@- */

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')){
    define('ABSPATH', dirname(__FILE__).'/');
}