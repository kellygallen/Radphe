<?php @require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php'); eval(RadpheFallBackHook);
global $_INTIN;
@require_once($_SERVER['DOCUMENT_ROOT'].'/_system/mod/_00_StatelessOutputBuffer/CMS.php');
switch(1){
	case ($_SERVER['PHP_SELF']=="/index.php"):
	case ($_SERVER['PHP_SELF']=="/"):
	case ($_SERVER['PHP_SELF']==""):
	case ($_SERVER['PHP_SELF']==null):
		require($_SERVER['DOCUMENT_ROOT'].'/_system/mod/_00_StatelessOutputBuffer/Layouts/'.$_INTIN['Design']['Template'].'/FrontPage.php');
		break;
	default:
		require($_SERVER['DOCUMENT_ROOT'].'/_system/mod/_00_StatelessOutputBuffer/Layouts/'.$_INTIN['Design']['Template'].'/_Default.php');
}

?>
