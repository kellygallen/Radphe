<?php @require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php'); eval(RadpheFallBackHook);
//Security Perimeter Sanity Check
require_once($_SERVER['DOCUMENT_ROOT'].'/_system/Rush/_INTIN.php');
$_INTIN['KERNEL']['FIREWALL']['RequestPath'] = pathinfo($_SERVER['REQUEST_URI']);
if (preg_match('/\_/', $_INTIN['KERNEL']['FIREWALL']['RequestPath']['filename']) == 1) {
	if ($_INTIN['StealthFirewallErrors']!=1) {
		die('Illegal Public File Name Convention. File MAY or NOT exist.');
	} else {
		require_once($_SERVER['DOCUMENT_ROOT'].'/_system/mod/-_CORE/_MODE_BasicCMSexit.php'); die();
	}
}
if (preg_match('/\_/', $_INTIN['KERNEL']['FIREWALL']['RequestPath']['dirname']) == 1) {
	if ($_INTIN['StealthFirewallErrors']!=1) {
		die('Illegal Public Folder Name Convention. FOLDER and FILE MAY or NOT exist.');
	} else {
		require_once($_SERVER['DOCUMENT_ROOT'].'/_system/mod/-_CORE/_MODE_BasicCMSexit.php'); die();
	}
}
if (!empty($_GET['Resource'])) {
	if (preg_match('/\_/', $_GET['Resource']) == 1) {
		if ($_INTIN['StealthFirewallErrors']!=1) {
			die('This VIRTUAL File does not exist and should not be requested, system file!');
		} else {
			require_once($_SERVER['DOCUMENT_ROOT'].'/_system/mod/-_CORE/_MODE_BasicCMSexit.php'); die();
		}
	}
}

if (preg_match('/^\-RADPHError404\.php$/', $_INTIN['KERNEL']['FIREWALL']['RequestPath']['basename']) == 1) {
	if ($_INTIN['StealthFirewallErrors']!=1) {
		die('This File should not be requested, why request a 404?!');
	} else {
		require_once($_SERVER['DOCUMENT_ROOT'].'/_system/mod/-_CORE/_MODE_BasicCMSexit.php'); die();
	}
}

if (preg_match('/\.SEO$/', $_INTIN['KERNEL']['FIREWALL']['RequestPath']['filename']) == 1) {
	if ($_INTIN['StealthFirewallErrors']!=1) {
		die('This File should not be requested, SEO customizations!');
	} else {
		require_once($_SERVER['DOCUMENT_ROOT'].'/_system/mod/-_CORE/_MODE_BasicCMSexit.php'); die();
	}
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
				if ($_INTIN['StealthFirewallErrors']!=1) {
					die ('Restricted IP Address');
				} else {
					require_once($_SERVER['DOCUMENT_ROOT'].'/_system/mod/-_CORE/_MODE_BasicCMSexit.php'); die();
				}
			}
			break;
	}
}
?>