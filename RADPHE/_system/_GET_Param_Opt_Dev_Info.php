<?php
@require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php');//Fallback Hook.
// Get phpinfo
	if (isset($_GET['DevInfo'])) {
		switch ($_GET['DevInfo']) {
			case 'phpinfo':
			    ob_start();
				phpinfo(-1);
				$_INTIN['MOD']['CMS']['Blocks']['SEOSupplementryContent'] = ob_get_clean();
//				@ob_end_flush();
//				echo $_INTIN['MOD']['CMS']['Blocks']['Request'];
				break;
		}
		return;
	}
?>