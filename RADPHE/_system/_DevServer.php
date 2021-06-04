<?php @require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php'); eval(RadpheFallBackHook);
	$_INTIN['Load Status']['Request']['Show Bench'] = '1';
	$_INTIN['Load Status']['Request']['Show Debug'] = '1';
	$_INTIN['Load Status']['Request']['Micro Debug'] = '';
	$_INTIN['StealthFirewallErrors'] = 0; //1|0 1=Show only 404 and fake 404 messages.

//FOR DEV ONLY - TO HELP YOU IN BEGINNING.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//				echo $_INTIN['MOD']['CMS']['Blocks']['Request'];

if (isset($_GET['Info'])) {
	switch ($_GET['Info']) {
		case 'Info':
			ob_start();
			echo '<h2>_GET Info</h2>';
			echo 'Server is Development<br>';
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
			phpinfo(-1);
			@$_INTIN['MOD']['CMS']['Blocks']['SupplementaryContent'] .= ob_get_clean();
			@ob_end_flush();
			break;
	}
//	return;
}
?>