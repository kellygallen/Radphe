<?php //Spechal Hooks or Exceptions Just For Dev
@require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php');//Fallback Hook.

//FOR DEV ONLY - TO HELP YOU IN BEGINING.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//				echo $_INTIN['MOD']['CMS']['Blocks']['Request'];

if (isset($_GET['Info'])) {
	switch ($_GET['Info']) {
		case 'HookInfo':
			ob_start();
			echo '<h2>_GET Info</h2>';
			echo 'Server is Development<br>';
			@$_INTIN['MOD']['CMS']['Blocks']['SupplementryContent'] .= ob_get_clean();
			@ob_end_flush();
			break;
	}
	return;
}

if (isset($_GET['DevInfo'])) {
	switch ($_GET['DevInfo']) {
		case 'phpinfo':
			ob_start();
			echo '<h2>_GET DevInfo</h2>';
			phpinfo(-1);
			@$_INTIN['MOD']['CMS']['Blocks']['SupplementryContent'] .= ob_get_clean();
			@ob_end_flush();
			break;
	}
	return;
}
?>