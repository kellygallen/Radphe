<?php @require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php'); RadpheFallBackHook;

////	Internal Config
////			Site Wide Config
$_INTIN['Config']['Contacts']['Admin']['Name'] = 'Kelly Allen';
$_INTIN['Config']['Contacts']['Admin']['Email'] = 'KellyGAllen@Yahoo.com';
$_INTIN['Config']['Contacts']['Admin']['Phone'] = '702-900-KELLy [5355]';
$_INTIN['Config']['Contacts']['Admin']['Fax'] = '';
$_INTIN['Config']['Contacts']['Admin']['GMT']['N'] = -8;
$_INTIN['Config']['Contacts']['Admin']['GMT']['S'] = 'Pacific Time';

$_INTIN['Config']['Contact'] = &$_INTIN['Config']['Contacts']['Admin'];
$_INTIN['Config']['Manager'] = &$_INTIN['Config']['Contacts']['Admin'];
$_INTIN['Config']['Support']['Level 0'] = &$_INTIN['Config']['Contacts']['Admin'];
$_INTIN['Config']['Support']['Level 1'] = &$_INTIN['Config']['Contacts']['Admin'];
$_INTIN['Config']['Support']['Level 2'] = &$_INTIN['Config']['Contacts']['Admin'];


/*	$__IntIn['Awareness']['URL']['RequireSSL'] stores a 's' or ''
		Is literaly placed after 'http' and before '://' in urls. */
	$_INTIN['Awareness']['URL']['RequireSSL'] = 's';

/*	$__IntIn['Awareness']['URL']['RequireWWW'] stores a 'www.' or ''
		Is literaly placed after 'http://' and before the domain in urls. */
	if ((stripos($_SERVER['SERVER_NAME'], 'www.')!==FALSE) || (ltrim($_SERVER['SERVER_NAME'],'0123456789\.') == "")) { //DO NOT CHANGE THIS LINE
		$_INTIN['Awareness']['URL']['RequireWWW'] = ''; //DO NOT CHANGE THIS LINE
	} else //DO NOT CHANGE THIS LINE
	$_INTIN['Awareness']['URL']['RequireWWW'] = 'www.';

/*	$_IntIn['Load Status']['Request']['Show Debug'] stores a '1' or '0'
		Marks to display debug info in hidden div
		Alt+Shift+K Enter ~ to unhide debug info */
	$_INTIN['Load Status']['Request']['Show Debug'] = '1';

/*	$_IntIn['Load Status']['Request']['Micro Debug'] stores a '1' or '0'
		Marks to display debug info within request
		?debugme=someflag[,someflag[,...]] appended to a rul request to set flags */
	$_INTIN['Load Status']['Request']['Micro Debug'] = '0';

/*	$_IntIn['Load Status']['Request']['Layout'] stores a '' or name of the layout folder
		/_system/layout/_/Header.php
		'' is Default Layout: /_system/layout/Header.php
		else /_system/layout/SUBFOLDER/Header.php is used. */
	$_INTIN['Load Status']['Request']['Layout'] = 'Wide';

//	$_IntIn['Config']['History']['Items'] stores number of items to store in history.
	$_INTIN['Config']['Contacts']['Webmaster'] =  &$_INTIN['Config']['Contacts']['Admin'];// or 'Webmaster@Email';

//	$_IntIn['Config']['History']['Items'] stores number of items to store in history.
	$_INTIN['Config']['History']['Items'] = '5';

//	$_IntIn['Config']['Cache']['_DB_SERVER'] To use cache or not on _DB_SERVER, can be changed before logic T.
	$_INTIN['Config']['Cache']['_DB_SERVER'] = '1';

//	$_IntIn['Config']['Debug']['Redirect'] When Debug is set print a redirect link in a div ontop of everythign instead of redirecting.
	$_INTIN['Config']['Debug']['Redirect'] = '0';

//	$_IntIn['Config']['LogInAnywhere'] To allow login or logout from ALMOST any url.
	$_INTIN['Config']['LogInAnywhere']['Enable'] = '0';
	$_INTIN['Config']['LogInAnywhere']['PostUserField'] = 'uname';
	$_INTIN['Config']['LogInAnywhere']['PostPasswdField'] = 'passwd';
	$_INTIN['Config']['LogInAnywhere']['GetURLLogInTrigger'] = 'LogIn';
	$_INTIN['Config']['LogInAnywhere']['GetURLLogOutTrigger'] = 'LogOut';

//	$_IntIn['Config']['Srtict'] Die instead of logging errors.
//	$_IntIn['Config']['Srtict'] = '0';


	$_INTIN['Load Status']['Display Message'] = '';
	$_INTIN['Load Status']['Notice'] = '';
	$_INTIN['Load Status']['Warning'] = '';
?>