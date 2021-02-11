<?php
//require($_SERVER['DOCUMENT_ROOT'].'/_system/layout/'.$_INTIN['Design']['Tempalte'].'/_template.php');
switch(1){
	case ($_SERVER['PHP_SELF']=="/index.php"):
		require($_SERVER['DOCUMENT_ROOT'].'/_system/layout/'.$_INTIN['Design']['Tempalte'].'/FrontPage.php');
		break;
	default:
		require($_SERVER['DOCUMENT_ROOT'].'/_system/layout/'.$_INTIN['Design']['Tempalte'].'/Default.php');
}

?>
