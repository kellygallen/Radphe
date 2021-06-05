<?php @require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php'); eval(RadpheFallBackHook);
//FOR Production ONLY - 'No Help'.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(1);
@require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php');//Fallback Hook.
$_INTIN['DB']['Profiles']['Pro']['Host']='sql204.epizy.com';
$_INTIN['DB']['Profiles']['Pro']['User']='epiz_27737017';

//.ht-pass-pipe functions not on every system. "getting cli environment variables from where web service was executed"
if (function_exists('getenv')) { $_INTIN['DB']['Profiles']['Pro']['Pass']=getenv('term').chr(rand(32,126)).getenv('mJS'); } else if (function_exists('apache_getenv')) { $_INTIN['DB']['Profiles']['Pro']['Pass']=apache_getenv('term').chr(rand(32,126)).apache_getenv('mJS'); }

$_INTIN['DB']['Profiles']['Pro']['Schema']='epiz_27737017_mjsterm';
//$_INTIN['DB']['Profiles']['Pro']['Pass']=();
//other nested obfuscation methods.might make it try the md5 of a file outside webroot.

//Toggle DEV Env Mode, remove this file on production.
//	@include $_SERVER['DOCUMENT_ROOT'].'/_system/_GET_Param_Opt_Dev_Info.php';
//DEPRECIATED BY PRESENCE OF _DEV_Config.php

/*	$__IntIn['Awareness']['URL']['RequireSSL'] stores a 's' or ''
 Is literally placed after 'http' and before '://' in urls. */
$_INTIN['Awareness']['URL']['RequireSSL'] = '';

/*	$__IntIn['Awareness']['URL']['RequireWWW'] stores a 'www.' or ''
 Is literally placed after 'http://' and before the domain in urls. */
if (stripos($_SERVER['SERVER_NAME'], 'www.')!==FALSE) { //DO NOT CHANGE THIS LINE
	$_INTIN['Awareness']['URL']['RequireWWW'] = ''; //DO NOT CHANGE THIS LINE
} else {
	$_INTIN['Awareness']['URL']['RequireWWW'] = '';
}
/*	$_IntIn['Load Status']['Request']['Show Debug'] stores a '1' or '0'
 Marks to display debug info in hidden div
 Alt+Shift+D Enter ~ to unhide debug info */
$_INTIN['Load Status']['Request']['Show Debug'] = '1';

/*	$_IntIn['Load Status']['Request']['Micro Debug'] stores a '1' or '0'
 Marks to display debug info within request
 ?debugme=someflag[,someflag[,...]] appended to a rul request to set flags */
$_INTIN['Load Status']['Request']['Micro Debug'] = '1';

/*	$_IntIn['Load Status']['Request']['Layout'] stores a '' or name of the layout folder
 /_system/layout/_/Header.php
 '' is Default Layout: /_system/layout/Header.php
 else /_system/layout/SUBFOLDER/Header.php is used. */
$_INTIN['Load Status']['Request']['Layout'] = '';

//	$_IntIn['Config']['Cache']['_DB_SERVER'] To use cache or not on _DB_SERVER, can be changed before logic T.
$_INTIN['Config']['Cache']['_DB_SERVER'] = '0';

//	$_IntIn['Config']['Debug']['Redirect'] When Debug is set print a redirect link in a div on top of everything instead of redirecting.
$_INTIN['Config']['Debug']['Redirect'] = '1';

$_INTIN['Config']['LogInAnywhere']['Enable'] = '1';

//	$_IntIn['Config']['Srtict'] Die instead of logging errors.
//	$_IntIn['Config']['Srtict'] = '1';
$_INTIN['DB']['Profiles']['Pro']['Pass']=substr($_INTIN['DB']['Profiles']['Pro']['Pass'], 0,floor(strlen($_INTIN['DB']['Profiles']['Pro']['Pass'])/2)).substr($_INTIN['DB']['Profiles']['Pro']['Pass'], 1+floor(strlen($_INTIN['DB']['Profiles']['Pro']['Pass'])/2),floor(strlen($_INTIN['DB']['Profiles']['Pro']['Pass'])));
define('danGit',$_INTIN['DB']['Profiles']['Pro']['Pass']);
$_INTIN['DB']['Profiles']['Pro']['Pass']='SomeBSDontWorryAboutIt';


?>