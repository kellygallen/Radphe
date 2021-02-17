<?php
/CMS_Blocks::startBlock('Request');//The Request or body of the changing pages.
//DO THE ACTUAL REQUEST,
//	it may take over and die or preferably exit for callback purposes unless you want to stop them.
//------------------------------------------------------
try {
	include $_SERVER['DOCUMENT_ROOT'].'/'.$_SERVER['PHP_SELF'];
} catch (Exception $e) {
}
//------------------------------------------------------
bench('REQUEST LOADED');
CMS_Blocks::endBlock();
?>