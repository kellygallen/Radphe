<?php
CMS_Blocks::startBlock('SEOSupplementaryContent');
if (file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$_SERVER['PHP_SELF'].'.SEO.php')) {
	bench('Request-SEO Defaults');
	include $_SERVER['DOCUMENT_ROOT'].'/'.$_SERVER['PHP_SELF'].'.SEO.php';
}
CMS_Blocks::endBlock();

?>