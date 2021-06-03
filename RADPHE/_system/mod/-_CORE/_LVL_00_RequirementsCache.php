<?php @require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php'); eval(RadpheFallBackHook);
$_INTIN['KERNEL']['FIREWALL']['RequestPath'] = pathinfo($_SERVER['REQUEST_URI']);
if (preg_match('/^\_/', $_INTIN['KERNEL']['FIREWALL']['RequestPath']['filename']) == 1) {
	die('This File should not be requested, system file!');
}
if (preg_match('/^\_/', $_INTIN['KERNEL']['FIREWALL']['RequestPath']['dirname']) == 1) {
	die('This Directory should not be requested, system file!');
}
if (!empty($_GET['Resource'])) {
	if (preg_match('/^\_/', $_GET['Resource']) == 1) {
		die('This File does not exist and should not be requested, system file!');
	}
}

if (preg_match('/^\-RADPHError404\.php$/', $_INTIN['KERNEL']['FIREWALL']['RequestPath']['basename']) == 1) {
	die('This File should not be requested, why request a 404?!');
}

if (preg_match('/\.SEO$/', $_INTIN['KERNEL']['FIREWALL']['RequestPath']['filename']) == 1) {
	die('This File should not be requested, SEO customizations!');
}

if (@$_INTIN['Config']['DEV']) {
	switch ($_SERVER['REMOTE_ADDR']) {
		case (@$_GET['DevPeek']==date('d')):
			break;
		default:
			if (
			(0) &&
			($_SERVER['REMOTE_ADDR'] != $_INTIN['Config']['IPs']['Office']) &&
			($_SERVER['REMOTE_ADDR'] != $_INTIN['Config']['IPs']['KGAHOME'])
			){
				die ('Restricted IP Address');
			}
			break;
	}
}
?>