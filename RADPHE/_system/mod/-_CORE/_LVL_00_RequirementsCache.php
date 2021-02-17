<?php
@require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php');//Fallback Hook.
global $_INTIN;
//Check core php.ini settings, check folder settings, check database for conditions that can make this code malfunction and die with a nice error if there are known problems.
//mod_php
//mod_rewrite
//loaded from siteengine
//apache
//database credentials and link
//

/*
 Access Config, and Access Rules for preventing mal use.
 */
//Lock down Execution
//Redundant. .htaccess should do this with mod rewrite.
//Never Process _Files Directly
$RequestPath = pathinfo($_SERVER['REQUEST_URI']);
if (preg_match('/^\_/', $RequestPath['filename']) == 1) {
	die('This File should not be requested, system file!');
}
if (preg_match('/^\_/', $RequestPath['dirname']) == 1) {
	die('This Directory should not be requested, system file!');
}
//virtual request.
if (!empty($_GET['Resource'])) {
	//    $RequestPath = pathinfo($_GET['Resource']);
	if (preg_match('/^\_/', $_GET['Resource']) == 1) {
		die('This File dosent exist and should not be requested, system file!');
	}
}

//Lock down Error404 page
//Why request an error?
if (preg_match('/^Error404.php$/', $RequestPath['basename']) == 1) {
	die('This File should not be requested, why request a 404?!');
}

//Disallow .SEO file exec.
//Not yet worked into .htaccess.
if (preg_match('/\.SEO$/', $RequestPath['filename']) == 1) {
	die('This File should not be requested, SEO customizations!');
}

//DEV Viewable
if (@$_INTIN['Config']['DEV']) {
	switch ($_SERVER['REMOTE_ADDR']) {
		case (@$_GET['DevPeek']==date('d')):
			break;
		default:
			if (
			(0) && //ip wildcard not implemented yet.
			($_SERVER['REMOTE_ADDR'] != $_INTIN['Config']['IPs']['Office']) &&
			($_SERVER['REMOTE_ADDR'] != $_INTIN['Config']['IPs']['KGAHOME'])
			){
				die ('Restricted IP Address');
			}
			break;
	}
}
?>