<?php @require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php'); eval(RadpheFallBackHook);
@require_once($_SERVER['DOCUMENT_ROOT'].'/_system/mod/_00_StatelessOutputBuffer/CMS.php');

CMS_Blocks::startTangentBlock('PageHeader');
	require($_SERVER['DOCUMENT_ROOT'].'/_system/mod/_00_StatelessOutputBuffer/Layouts/'.CMS_Skinner::$Selected.'/'.CMS_Skinner::$Page['HeaderFile'].'.php');
CMS_Blocks::endTangentBlock();
CMS_Blocks::startTangentBlock('PageFooter');
	require($_SERVER['DOCUMENT_ROOT'].'/_system/mod/_00_StatelessOutputBuffer/Layouts/'.CMS_Skinner::$Selected.'/'.CMS_Skinner::$Page['FooterFile'].'.php');
CMS_Blocks::endTangentBlock();

CMS_Blocks::startTangentBlock('PageSideBar');
?>
<?php
CMS_Blocks::endTangentBlock();
?>