<?php @require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php'); eval(RadpheFallBackHook);
	$_INTIN['Load Status']['Request']['Show Bench'] = '0';
	$_INTIN['Load Status']['Request']['Show Debug'] = '0';
	$_INTIN['Load Status']['Request']['Micro Debug'] = '0';
	$_INTIN['StealthFirewallErrors'] = 1; //1|0 1=Show only 404 and fake 404 messages.

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);

?>