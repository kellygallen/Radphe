<?php
@require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php');//Fallback Hook.
//Signal Catcher to make this modual work in later run levels or to take over.
if (
		(1)&&
		(false !== strpos(dirname($_SERVER["PHP_SELF"]),'wordpress'))
) include_once($_SERVER['DOCUMENT_ROOT'].'/_system/mod/OtherApp/WordPress.php');
?>