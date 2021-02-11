<?php
	//if CMS is going and not rendored then 
		//then include one with preferance to config cache.
			//also check if was included as stand alone inline function (regular) or as cms mod.
				//this is for the inialization of its resources.
	include_once($_SERVER['DOCUMENT_ROOT'].'/_system/class/dBug/_dBug_CMS_mini.php'); //starts collapsted dbug
	//mini is the default and tries to implement both.
//	include_once($_SERVER['DOCUMENT_ROOT'].'/_system/class/dBug/_dBug_CMS_full.php'); //starts expanded

	//not CMS modualized, but recursion fixed and external resources are modualized includes.
//	include_once($_SERVER['DOCUMENT_ROOT'].'/_system/class/dBug/dBug.regular.php');


?>