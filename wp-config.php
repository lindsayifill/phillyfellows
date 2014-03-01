<?php
# Database Configuration
define('DB_NAME','wp_phillyfellows');
define('DB_USER','phillyfellows');
define('DB_PASSWORD','Qnehq9f12Tzoi4q6Bi1Y');
define('DB_HOST','127.0.0.1');
define('DB_HOST_SLAVE','localhost');
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', 'utf8_unicode_ci');
$table_prefix = 'wp_';

# Security Salts, Keys, Etc
define('AUTH_KEY',         'I%A9,!Ho3n-2t2sQDOx3C:l{)E>8y;Iu h(--d_|`OAwi.bD$5E|v(:oxmwf*/[6');
define('SECURE_AUTH_KEY',  '+b~#Av*Q:xB]&Sx<XEkgzb`go&WyP:y6]nFQBS<hF9-Heyz|EWO`$*tPCGp4|rzt');
define('LOGGED_IN_KEY',    'TI(mis-f53`_11uT(Sv(>a8j{40lWlJG_,aO2P^+L=gJZGQf=N>tRvn#&+4UiskC');
define('NONCE_KEY',        '>R.rUUwHFhH~+vegatpq[mEJYhM>tSwY{ _Vs{Y%(@/*Txp{|1gI<l{gk_G11v-5');
define('AUTH_SALT',        '0PStT/L&p{F*kU=xr&ees&s4*E?<4z<?%q`25` `}O[B?jUW#K9MP;w@GW{9fVL0');
define('SECURE_AUTH_SALT', 'J?~@+ )p!-y<z2VOC3Yc-cd^{Y33RTr>7y@`Wn8|,,mGk]9lzRYv{.o+.D50:F:?');
define('LOGGED_IN_SALT',   '5imbKta0oo*3%*)F~miE4B]WS #|fN2`aMF-|S-+.Y.A8Ur?qF_Nz<et^8~A$|Jz');
define('NONCE_SALT',       'M7|a*Y+}~`>R(Md::]I 4NxfS!_0u/bP0F*=KPoYb78c1ZU<EJ?Ttr7&yfiDrefe');


# Localized Language Stuff

define('WP_CACHE',TRUE);

define('WP_AUTO_UPDATE_CORE',false);

define('PWP_NAME','phillyfellows');

define('FS_METHOD','direct');

define('FS_CHMOD_DIR',0775);

define('FS_CHMOD_FILE',0664);

define('PWP_ROOT_DIR','/nas/wp');

define('WPE_APIKEY','df561fb8425def73508dd008e77cc095386e653b');

define('WPE_FOOTER_HTML',"");

define('WPE_CLUSTER_ID','2780');

define('WPE_CLUSTER_TYPE','pod');

define('WPE_ISP',true);

define('WPE_BPOD',false);

define('WPE_RO_FILESYSTEM',false);

define('WPE_LARGEFS_BUCKET','largefs.wpengine');

define('WPE_CDN_DISABLE_ALLOWED',true);

define('DISALLOW_FILE_EDIT',FALSE);

define('DISALLOW_FILE_MODS',FALSE);

define('DISABLE_WP_CRON',false);

define('WPE_FORCE_SSL_LOGIN',false);

define('FORCE_SSL_LOGIN',false);

/*SSLSTART*/ if ( isset($_SERVER['HTTP_X_WPE_SSL']) && $_SERVER['HTTP_X_WPE_SSL'] ) $_SERVER['HTTPS'] = 'on'; /*SSLEND*/

define('WPE_EXTERNAL_URL',false);

define('WP_POST_REVISIONS',FALSE);

define('WPE_WHITELABEL','wpengine');

define('WP_TURN_OFF_ADMIN_BAR',false);

define('WPE_BETA_TESTER',false);

umask(0002);

$wpe_cdn_uris=array ();

$wpe_no_cdn_uris=array ();

$wpe_content_regexs=array ();

$wpe_all_domains=array (  0 => 'phillyfellows.wpengine.com',);

$wpe_varnish_servers=array (  0 => 'pod-2780',);

$wpe_special_ips=array ();

$wpe_ec_servers=array ();

$wpe_largefs=array ();

$wpe_netdna_domains=array ();

$wpe_netdna_domains_secure=array ();

$wpe_netdna_push_domains=array ();

$wpe_domain_mappings=array ();

$memcached_servers=array ();
define('WPLANG','');

# WP Engine ID


# WP Engine Settings






# That's It. Pencils down
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
require_once(ABSPATH . 'wp-settings.php');

$_wpe_preamble_path = null; if(false){}
