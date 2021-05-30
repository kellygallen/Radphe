<?php
CMS_Blocks::startBlock('Request');
	$_INTIN['KERNEL']['REQUEST ACL'] = include $_SERVER['DOCUMENT_ROOT'].'/'.$_SERVER['PHP_SELF'];
bench('REQUEST LOADED');
CMS_Blocks::endBlock();
return $_INTIN['KERNEL']['REQUEST ACL'];
?>