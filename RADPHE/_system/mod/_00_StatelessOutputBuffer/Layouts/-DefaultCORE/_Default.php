<?php @require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php'); RadpheFallBackHook;
@require_once($_SERVER['DOCUMENT_ROOT'].'/_system/mod/_00_StatelessOutputBuffer/CMS.php');
if ($_SERVER['PHP_SELF']=="/index.php") {
	include('FrontPage.php');
} else {
	include('Wide.php');
}
?>