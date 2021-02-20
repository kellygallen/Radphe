<?php
global $_INTIN;

bench('CORE');
$_INTIN['MOD']['CORE']=glob($_SERVER['DOCUMENT_ROOT'].'/_system/mod/-_CORE/_LVL_*_*.php');
//$lasttime=array();
//$alltime=array();
//if (empty($_INTIN['MOD']['CMS']['Blocks'])) $_INTIN['MOD']['CMS']['Blocks'] = array();
foreach($_INTIN['MOD']['CORE'] as $_INTIN['CORE Level'] => $_INTIN['CORE']) {
//	if (!is_array($alltime)) $alltime = array();
//	$alltime=array_diff($_INTIN['MOD']['CMS']['Blocks'],$alltime);
	$_INTIN['CORE'] = realpath($_INTIN['CORE']);
	preg_match('/_LVL_(?<LVL>\d{1,4})_?(?<subLVL>\d{1,2})?_(?<LEVEL>.*?).php$/', $_INTIN['CORE'], $_INTIN['RUN']);
	$_INTIN['MOD Level']='CORE Level'.$_INTIN['CORE Level'];
//	$lasttime=$_INTIN['MOD']['CMS']['Blocks'];
	if ((1)||(!empty($_INTIN['RUN']['LEVEL']))) foreach(glob($_SERVER['DOCUMENT_ROOT'].'/_system/mod/*/_LVL_*_'.$_INTIN['RUN']['LEVEL'].'.php') as $_INTIN['MOD Level'] => $_INTIN['CoreMOD']) {
		$_INTIN['CoreMOD'] = realpath($_INTIN['CoreMOD']);
		preg_match('/_LVL_(?<LVL>\d{1,4})_?(?<subLVL>[\d\w]{1,2})?_(?<LEVEL>.*?).php$/', $_INTIN['CoreMOD'], $_INTIN['MODRUN']);
	} else {
		$_INTIN['MODRUN']['subLVL'] = '';
		$_INTIN['MODRUN']['LVL'] = '';//actualy priority request amung group later on.
		$_INTIN['MODRUN']['LEVEL'] = '';
		$_INTIN['MOD Level'] = '';
		$_INTIN['CoreMOD'] = '';
	}
	if (@$_INTIN['MODRUN']['subLVL']=='before') {
		bench('CORE#'.$_INTIN['CORE Level'].' MOD#'.$_INTIN['MOD Level'].': '.$_INTIN['MODRUN']['LEVEL'].' as '.$_INTIN['CoreMOD']);
		if (filesize($_INTIN['CoreMOD'])>10) $_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][$_INTIN['CoreMOD']] = include_once($_INTIN['CoreMOD']);
		$_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][$_INTIN['CoreMOD'].' OUTPUT'] = &$_INTIN['MOD']['CMS']['Blocks'];
		bench('CORE '.$_INTIN['CORE Level'].': '.$_INTIN['CORE'].'');
		if (filesize($_INTIN['CORE'])>10) $_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][$_INTIN['CORE']] = include_once($_INTIN['CORE']);
	} else {
		bench('CORE '.$_INTIN['CORE Level'].': '.$_INTIN['CORE'].'');
		if (filesize($_INTIN['CORE'])>10) $_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][$_INTIN['CORE']] = include_once($_INTIN['CORE']);
		bench('CORE#'.$_INTIN['CORE Level'].' MOD#'.$_INTIN['MOD Level'].': '.$_INTIN['MODRUN']['LEVEL'].' as '.$_INTIN['CoreMOD']);
		if (filesize($_INTIN['CoreMOD'])>10) $_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][$_INTIN['CoreMOD']] = include_once($_INTIN['CoreMOD']);
	}
	if (!isset($_INTIN['MOD']['CMS']['Blocks'])) $_INTIN['MOD']['CMS']['Blocks']=array();
	if (!isset($alltime)) $alltime=array();
	$_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][@$_INTIN['MOD Level']]['Core Level OUTPUT Captured [delayd?]'] = @array_diff($_INTIN['MOD']['CMS']['Blocks'],$alltime);
	$alltime=$_INTIN['MOD']['CMS']['Blocks'];
/*8
//	error_log($_INTIN['CoreMOD']);
//probably best to get all modified levels or meta levles inbetween on seporate glob loop.
	if (!is_set($_INTIN['MODRUN']['subLVL'])) $_INTIN['MODRUN']['subLVL'] = 'normal';

	switch (1) {
		case (@$_INTIN['MODRUN']['subLVL'] == null)://normal
		case ($_INTIN['MODRUN']['subLVL'] == '')://normal
		case ($_INTIN['RUN']['subLVL'] == 'normal')://normal
		case ($_INTIN['MODRUN']['subLVL'] == 'normal')://normal
			bench('Normal CORE '.$_INTIN['CORE Level'].': '.$_INTIN['CORE'].'');
			if (filesize($_INTIN['CORE'])>10) $_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][$_INTIN['CORE']] = include_once($_INTIN['CORE']);
		case ($_INTIN['MODRUN']['subLVL'] == 'before') :
			bench('Before CORE#'.$_INTIN['CORE Level'].' MOD#'.$_INTIN['MOD Level'].': '.$_INTIN['MODRUN']['LEVEL'].' as '.$_INTIN['CoreMOD']);
			if (filesize($_INTIN['CoreMOD'])>10) $_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][$_INTIN['CoreMOD']] = include_once($_INTIN['CoreMOD']);
		case ($_INTIN['MODRUN']['subLVL'] == 'after'):
			bench('After CORE '.$_INTIN['CORE Level'].': '.$_INTIN['CORE'].'');
			if (filesize($_INTIN['CORE'])>10) $_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][$_INTIN['CORE']] = include_once($_INTIN['CORE']);
//its complicated but optimized trust me.
		case ($_INTIN['MODRUN']['subLVL'] == 'debug'):
//			bench('Debug CMS '.$_INTIN['CORE Level'].': '.$_INTIN['CORE'].'');
			//level output and buffer watcher.
//			if (!empty($alltime)) if (!empty($_INTIN['MOD']['CMS']['Blocks'])) $_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][$_INTIN['CORE']] = array_diff($alltime,$_INTIN['MOD']['CMS']['Blocks']);
			break;
		case 'overload':
			//new level manager
			break;
		case 'debug':
			//new level manager
			break;
		case 'again':
			//include vs include_0nce for force //can regular include after include_once if not read and eval i guess.
			break;
		default:
			die('nope!');
			break;
	}
**/
//	$_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][$_INTIN['CORE']]
//	$_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][NULL][$_INTIN['MOD Level']] = &$_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']];
}
//TODO: also mods may run their level before or after core level in the mod priority order.
?>