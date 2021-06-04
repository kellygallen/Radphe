<?php @require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php'); eval(RadpheFallBackHook);
	$_INTIN['Load Status']['Request']['Show Bench'] = '0';
	$_INTIN['Load Status']['Request']['Show Debug'] = '0';
	$_INTIN['Load Status']['Request']['Micro Debug'] = '0';
	$_INTIN['StealthFirewallErrors'] = 1; //1|0 1=Show only 404 and fake 404 messages.

//FOR Production ONLY - 'No Help'.
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);
//				echo $_INTIN['MOD']['CMS']['Blocks']['Request'];

if (isset($_GET['Info'])) {
	switch ($_GET['Info']) {
		case 'Info':
			ob_start();
			echo '<h2>_GET Info</h2>';
			echo 'Server is Production<br>';
			@$_INTIN['MOD']['CMS']['Blocks']['SupplementaryContent'] .= ob_get_clean();
			@ob_end_flush();
			break;
	}
//	return;
}
if (isset($_GET['DevInfo'])) {
	switch ($_GET['DevInfo']) {
		case 'phpinfo':
			ob_start();
			echo '<h2>_GET DevInfo</h2>';
			echo '<h1>PHP INFO only on DEV.</h1>';
 			@$_INTIN['MOD']['CMS']['Blocks']['SupplementaryContent'] .= ob_get_clean();
			@ob_end_flush();
			break;
	}
//	return;
}
?>