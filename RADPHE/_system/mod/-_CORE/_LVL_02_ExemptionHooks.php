<?php
bench('EXCEPTIONS');
//foreach(glob($_SERVER['DOCUMENT_ROOT'].'/_system/mod/*/_LVL_*_ExemptionHooks.php') as $AutoMod) { include_once(realpath($AutoMod)); bench('EXCEPTIONS mod $AutoMod'); }
//When not to run site engine and where to direct root control.
bench('EXCEPTIONS core');
require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine_Exceptions.php');
/* For Example: api-server for example, or a ajax/json request response.
	would have its hooks added in here. */
//TODO remove, completely or mostly in favor of modules being able to hook event levels. or make a exception module which looks for exceptions in other modules then hooks them.
?>