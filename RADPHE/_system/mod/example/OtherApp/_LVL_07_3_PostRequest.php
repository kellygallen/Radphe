<?php
@require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php');//Fallback Hook.
//Signal Catcher to make this modual work in later run levels or to take over.

if (
		(1)&&
		(false !== stripos(dirname($_SERVER["PHP_SELF"]),'wordpress'))
) include_once($_SERVER['DOCUMENT_ROOT'].'/_system/mod/OtherApp/WordPress.php');
if (
		(1)&&
		(false !== stripos(dirname($_SERVER["PHP_SELF"]),'bb3'))
) include_once($_SERVER['DOCUMENT_ROOT'].'/_system/mod/OtherApp/BB3.php');
if (
		(1)&&
		(false !== stripos(dirname($_SERVER["PHP_SELF"]),'ph7cms'))
) include_once($_SERVER['DOCUMENT_ROOT'].'/_system/mod/OtherApp/pH7CMS.php');
?>