<?php
global $_INTIN;

bench('CORE');
$_INTIN['MOD']['CORE']=glob($_SERVER['DOCUMENT_ROOT'].'/_system/mod/-_CORE/_LVL_*_*.php');
foreach($_INTIN['MOD']['CORE'] as $_INTIN['CORE Level'] => $_INTIN['CORE']) {
	$_INTIN['CORE'] = realpath($_INTIN['CORE']);
	preg_match('/_LVL_(?<LVL>\d{1,4})_?(?<subLVL>\d{1,2})?_(?<LEVEL>.*?).php$/', $_INTIN['CORE'], $_INTIN['RUN']);
	if ((1)||(!empty($_INTIN['RUN']['LEVEL']))) foreach(glob($_SERVER['DOCUMENT_ROOT'].'/_system/mod/*/_LVL_*_'.$_INTIN['RUN']['LEVEL'].'.php') as $_INTIN['MOD Level'] => $_INTIN['CoreMOD']) {
		$_INTIN['CoreMOD'] = realpath($_INTIN['CoreMOD']);
		preg_match('/(?<file>_LVL_(?<LVL>\d{1,4})_?(?<subLVL>[\d\w]{1,2})?_(?<LEVEL>.*?).php)$/', $_INTIN['CoreMOD'], $_INTIN['MODRUN']);
		$_INTIN['MODRUN']['manager']=realpath(dirname($_INTIN['CoreMOD']).'_MODE_Before_Level_Manager.php');
		die($_INTIN['MODRUN']['manager']);
		if (file_exists($_INTIN['MODRUN']['manager'])) {
			if (filesize($_INTIN['MODRUN']['manager'])>10) include_once($_INTIN['MODRUN']['manager']);
		} else {//THIS IS THE AFTER MANAGER AS WELL AS DURING unless it is done first.
			if (@$_INTIN['MODRUN']['subLVL']=='before') {
				bench('CORE#'.$_INTIN['CORE Level'].' MOD#'.$_INTIN['MOD Level'].': '.$_INTIN['MODRUN']['LEVEL'].' as '.$_INTIN['CoreMOD']);
				if (filesize($_INTIN['CoreMOD'])>10) include_once($_INTIN['CoreMOD']);
				bench('CORE '.$_INTIN['CORE Level'].': '.$_INTIN['CORE'].'');
				if (filesize($_INTIN['CORE'])>10) include_once($_INTIN['CORE']);
			} else {
				bench('CORE '.$_INTIN['CORE Level'].': '.$_INTIN['CORE'].'');
				if (filesize($_INTIN['CORE'])>10) include_once($_INTIN['CORE']);
				bench('CORE#'.$_INTIN['CORE Level'].' MOD#'.$_INTIN['MOD Level'].': '.$_INTIN['MODRUN']['LEVEL'].' as '.$_INTIN['CoreMOD']);
				if (filesize($_INTIN['CoreMOD'])>10) include_once($_INTIN['CoreMOD']);
			}
		}
	}
}
?>