<?php

//AJAX Request.
if((isset($_GET['AjaxGetPart']))||(isset($_POST['AjaxGetPart']))) {
	if (isset($_GET['AjaxCountHit'])) {
		if (!isset($_SESSION['HitCount'])) {
			$_SESSION['HitCount'] = 0;
		}
		$_SESSION['HitCount']++;
	}
	header("Cache-Control: no-cache");
	header("Pragma: nocache");
	echo $_GET['AjaxGetPart'],"=>";
	include $_SERVER['DOCUMENT_ROOT'].'/'.$_SERVER['PHP_SELF'];
	die();
}

if ($_SERVER['PHP_SELF']=='/Paypal-Instant-Payment-Notification.php') {
	include_once($_SERVER['DOCUMENT_ROOT'].'/_system/Paypal-Instant-Payment-Notification.php');
	die();
}

//var_dump($_POST);
//die();

?>