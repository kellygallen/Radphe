<?php
//Proceed into Request.
CMS_Blocks::startBlock('SEOSupplementaryContent');
// The request.php may have a request.SEO.php file which sets seo or maybe does something.
if (file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$_SERVER['PHP_SELF'].'.SEO.php')) {
	bench('Request-SEO Defaults');
	include $_SERVER['DOCUMENT_ROOT'].'/'.$_SERVER['PHP_SELF'].'.SEO.php';
}
CMS_Blocks::endBlock();

?>