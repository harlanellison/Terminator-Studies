<?php
/* This is a sample config file.
 * Edit this file with your own settings and save it as "config.php"
 * You can leave it in the "includes" directory, or, better, move it to
 * the "user" directory. This way, when a new version of YOURLS is available,
 * simply delete everything but "/user", and upload the new version.
 */


/*
 ** MySQL settings - You can get this info from your web host
 */

/** MySQL database username */
define( 'YOURLS_DB_USER', 'harlan' );

/** MySQL database password */
define( 'YOURLS_DB_PASS', 'realharlan' );

/** The name of the database for YOURLS */
define( 'YOURLS_DB_NAME', 'terminator_69' );

/** MySQL hostname */
define( 'YOURLS_DB_HOST', 'localhost' );

/** MySQL tables prefix */
define( 'YOURLS_DB_PREFIX', 'yourls_' );

/*
 ** Site options
 */

/** YOURLS installation URL, no trailing slash */
//define( 'YOURLS_SITE', 'http://terminat.org/yrl' );
define( 'YOURLS_SITE', 'http://terminator.edu/y' );
/** Timezone GMT offset */
define( 'YOURLS_HOURS_OFFSET', 0 ); 

/** Allow multiple short URLs for a same long URL
 ** Set to true to have only one pair of shortURL/longURL (default YOURLS behavior)
 ** Set to false to allow multiple short URLs pointing to the same long URL (bit.ly behavior) */
define( 'YOURLS_UNIQUE_URLS', false );

/** Private means protected with login/pass as defined below. Set to false for public usage. */
define( 'YOURLS_PRIVATE', true );

/** A random secret hash used to encrypt cookies. You don't have to remember it, make it long and complicated. Hint: copy from http://yourls.org/cookie **/
define( 'YOURLS_COOKIEKEY', 'qQ4KhL_pu|s@Zm7n#%:b^{A[vhm' );

/**  Username(s) and password(s) allowed to access the site */
$yourls_user_passwords = array(
	'nf' => 'realfuture',
	);

/*
 ** URL Shortening settings
 */

/** URL shortening method: 36 or 62 */
define( 'YOURLS_URL_CONVERT', 62 );
/*
 * 36: generates case insentitive lowercase keywords (ie: 13jkm)
 * 62: generate case sensitive keywords (ie: 13jKm or 13JKm)
 * Stick to one setting, don't change after you've created links as it will change all your short URLs!
 * Base 36 should be picked. Use 62 only if you understand what it implies.
 */

/** 
* Reserved keywords (so that generated URLs won't match them)
* Define here negative, unwanted or potentially misleading keywords.
*/
$yourls_reserved_URL = array(
	'porn', 'faggot', 'sex', 'nigger', 'fuck', 'cunt', 'dick', 'gay',
);

/*
 ** Personal settings would go after here.
 */

if(! defined('WEBSHOT_ENABLED') ) 	define ('WEBSHOT_ENABLED', true);			//Beta feature. Adding webshot=1 to your query string will cause the script to return a browser screenshot rather than try to fetch an image.
if(! defined('WEBSHOT_CUTYCAPT') ) 	define ('WEBSHOT_CUTYCAPT', '/usr/bin/cutycapt'); //The path to CutyCapt. 
if(! defined('WEBSHOT_XVFB') ) 		define ('WEBSHOT_XVFB', '/usr/bin/xvfb-run');		//The path to the Xvfb server
if(! defined('WEBSHOT_SCREEN_X') ) 	define ('WEBSHOT_SCREEN_X', '1024');			//1024 works ok
if(! defined('WEBSHOT_SCREEN_Y') ) 	define ('WEBSHOT_SCREEN_Y', '768');			//768 works ok
if(! defined('WEBSHOT_COLOR_DEPTH') ) 	define ('WEBSHOT_COLOR_DEPTH', '24');			//I haven't tested anything besides 24
if(! defined('WEBSHOT_IMAGE_FORMAT') ) 	define ('WEBSHOT_IMAGE_FORMAT', 'png');			//png is about 2.5 times the size of jpg but is a LOT better quality
if(! defined('WEBSHOT_TIMEOUT') ) 	define ('WEBSHOT_TIMEOUT', '60');			//Seconds to wait for a webshot
if(! defined('WEBSHOT_USER_AGENT') ) 	define ('WEBSHOT_USER_AGENT', "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.9.2.18) Gecko/20110614 Firefox/3.6.18"); //I hate to do this, but a non-browser robot user agent might not show what humans see. So we pretend to be Firefox
if(! defined('WEBSHOT_JAVASCRIPT_ON') ) define ('WEBSHOT_JAVASCRIPT_ON', true);			//Setting to false might give you a slight speedup and block ads. But it could cause other issues.
if(! defined('WEBSHOT_JAVA_ON') ) 	define ('WEBSHOT_JAVA_ON', false);			//Have only tested this as fase
if(! defined('WEBSHOT_PLUGINS_ON') ) 	define ('WEBSHOT_PLUGINS_ON', true);			//Enable flash and other plugins
if(! defined('WEBSHOT_PROXY') ) 	define ('WEBSHOT_PROXY', '');				//In case you're behind a proxy server. 
///**********///
if(! defined('TERMINAT_SERV') )	define ('TERMINAT_SERV', 	"http://terminator.edu/"			);			//ADVANCED: Enable this if you've got Xvfb running in the background.
if(! defined('TERMINAT_URL') )	define ('TERMINAT_URL', 	TERMINAT_SERV. "http://terminator.edu/"		);			//ADVANCED: Enable this if you've got Xvfb running in the background.
if(! defined('TERMINAT_IMG') )	define ('TERMINAT_IMG', 	TERMINAT_SERV. "png/"			);			//ADVANCED: Enable this if you've got Xvfb running in the background.
if(! defined('LOCAL_PATH') )	define ('LOCAL_PATH', 		"/home/bob/images/NF__/www/"	);			//ADVANCED: Enable this if you've got Xvfb running in the background.
define('HOME', TERMINAT_SERV. "yrl/");
define('WEBSHOT_W' ,"149"); //thumb w
define('WEBSHOT_H' , "99"); //thumb h
define('WEBSHOT_URL' , TERMINAT_SERV."thumb.php?&a=tl&w=".WEBSHOT_W."&h=".WEBSHOT_H."&src=". TERMINAT_IMG);





