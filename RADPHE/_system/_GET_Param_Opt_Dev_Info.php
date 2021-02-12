<?php
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