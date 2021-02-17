<?php /* @require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php'); RadpheFallBackHook; */
//@require_once($_SERVER['DOCUMENT_ROOT'].'/_system/mod/_00_StatelessOutputBuffer/CMS.php');
switch(1){
	case ($_SERVER['PHP_SELF']=="/index.php"):
		require($_SERVER['DOCUMENT_ROOT'].'/_system/mod/_00_StatelessOutputBuffer/Layouts/'.$_INTIN['Design']['Tempalte'].'/FrontPage.php');
		break;
	default:
		require($_SERVER['DOCUMENT_ROOT'].'/_system/mod/_00_StatelessOutputBuffer/Layouts/'.$_INTIN['Design']['Tempalte'].'/_Default.php');
}

?>
