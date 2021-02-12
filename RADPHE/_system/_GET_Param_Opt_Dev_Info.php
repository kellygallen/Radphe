<?php
@require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php');//Fallback Hook.
// Get phpinfo
	if (isset($_GET['DevInfo'])) {
		switch ($_GET['DevInfo']) {
			case 'phpinfo':
				phpinfo();
				break;
		}
//		exit;
	}
?>