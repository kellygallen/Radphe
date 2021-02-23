<?php
global $_INTIN;

bench('CORE');
$_INTIN['MOD']['CORE']=glob($_SERVER['DOCUMENT_ROOT'].'/_system/mod/-_CORE/_LVL_*_*.php');
$lasttime=array();
//$alltime=array();
//if (empty($_INTIN['MOD']['CMS']['Blocks'])) $_INTIN['MOD']['CMS']['Blocks'] = array();
foreach($_INTIN['MOD']['CORE'] as $_INTIN['CORE Level'] => $_INTIN['CORE']) {
	//	if (!is_array($alltime)) $alltime = array();
//	$alltime=array_diff($_INTIN['MOD']['CMS']['Blocks'],$alltime);
	$_INTIN['CORE'] = realpath($_INTIN['CORE']);
	$_INTIN['CORE'] = preg_replace('/(\.){2,}/', '', $_INTIN['CORE']);
	$_INTIN['CORE'] = preg_replace('/(\/){2,}/', '/', $_INTIN['CORE']);
	$_INTIN['CORE'] = preg_replace('/(\.\/){2,}/', '/', $_INTIN['CORE']);
	$_INTIN['CORE'] = preg_replace('/(\/){2,}/', '/', $_INTIN['CORE']);

	$_INTIN['RUN']=array();
	preg_match('/_LVL_(?<LVL>\d{1,4})_?(?<subLVL>.*?)?_(?<LEVEL>.*).php$/', $_INTIN['CORE'], $_INTIN['RUN']);
	$_INTIN['MOD Level']='CORE Level'.$_INTIN['CORE Level'];
//	$lasttime=$_INTIN['MOD']['CMS']['Blocks'];
	$_INTIN['MOD']['COREmods'] = glob($_SERVER['DOCUMENT_ROOT'].'/_system/mod/*/_LVL_*_'.$_INTIN['RUN']['LEVEL'].'.php');
	foreach($_INTIN['MOD']['COREmods'] as $COREmodsOrden => $CoreModsCleaning){
//		$CoreModsCleaning = realpath($CoreModsCleaning);
//		$CoreModsCleaning = preg_replace('/([\.]{2,4})/', '', $CoreModsCleaning);
//		$CoreModsCleaning = preg_replace('/([\/]{2,4})/', '/', $CoreModsCleaning);
//		$CoreModsCleaning = preg_replace('/([\.\/]{2,4})/', '/', $CoreModsCleaning);
//		$CoreModsCleaning = preg_replace('/([\/]{2,4})/', '/', $CoreModsCleaning);
//		if (stripos($CoreModsCleaning,'-_CORE')==false)
			$_INTIN['MOD']['JustCOREmods'][] = $CoreModsCleaning;
	}
	var_dump($_INTIN['MOD']['COREmods']);
	var_dump($_INTIN['MOD']['JustCOREmods']);
	die();
	if ((1)||(!empty($_INTIN['RUN']['LEVEL']))) foreach($_INTIN['MOD']['JustCOREmods'] as $_INTIN['MOD Level'] => $_INTIN['CoreMOD']) {
		$_INTIN['CoreMOD'] = realpath($_INTIN['CoreMOD']);
		$_INTIN['CoreMOD'] = preg_replace('/(\.){2,}/', '', $_INTIN['CoreMOD']);
		$_INTIN['CoreMOD'] = preg_replace('/(\/){2,}/', '/', $_INTIN['CoreMOD']);
		$_INTIN['CoreMOD'] = preg_replace('/(\.\/){2,}/', '/', $_INTIN['CoreMOD']);
		$_INTIN['CoreMOD'] = preg_replace('/(\/){2,}/', '/', $_INTIN['CoreMOD']);
		$_INTIN['MODRUN']=array();
		preg_match('/_LVL_(?<LVL>\d{1,4})_?(?<subLVL>.*?)?_(?<LEVEL>.*).php$/', $_INTIN['CoreMOD'], $_INTIN['MODRUN']);
		if ($_INTIN['MODRUN']['subLVL']=='before') {
			if (filesize($_INTIN['CoreMOD'])>1) {
				if (!in_array($_INTIN['CoreMOD'],get_included_files())) {
					if (!empty($lasttime)) $_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][@$_INTIN['CoreMOD']]['Prior-STATE'] =$lasttime;
					bench('CORE#'.$_INTIN['CORE Level'].' MOD#'.$_INTIN['MOD Level'].': '.$_INTIN['MODRUN']['LEVEL'].' as '.$_INTIN['CoreMOD']);
					$_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][$_INTIN['CoreMOD']]	['RETURN']['MOD'] [$_INTIN['MODRUN']['subLVL']] = include_once($_INTIN['CoreMOD']);

					$_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][$_INTIN['CoreMOD']]	['ACL'] = &
					$_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][$_INTIN['CoreMOD']]	['RETURN']['MOD'][
	 array_key_last($_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][$_INTIN['CoreMOD']]	['RETURN']['MOD'])];

					if (!empty($_INTIN['Dump'])) {
						$_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][$_INTIN['CoreMOD']]['Prior-STATE'] = @array_diff($_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][$_INTIN['CoreMOD']]['Prior-STATE'],$alltime);
					} else $_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][$_INTIN['CoreMOD']]['Prior-STATE'] = '_INTIN[\'Dump\'][] = (&)? $var; not activated.<br>Light Mode';
					if (!isset($_INTIN['MOD']['CMS']['Blocks']))
						$_INTIN['MOD']['CMS']['Blocks']=array();
					if (!isset($alltime))
						$alltime=array();
					$_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][@$_INTIN['MOD Level']][$_INTIN['CoreMOD']]['C'.$_INTIN['CORE Level'].'-R'.$_INTIN['RUN']['subLVL'].'-M'.@$_INTIN['MOD Level'].'-P'.$_INTIN['MODRUN']['LVL'].'-R'.$_INTIN['MODRUN']['subLVL']]['BLOCK-Changes'] = @array_diff($_INTIN['MOD']['CMS']['Blocks'],$alltime);
					//$_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][@$_INTIN['MOD Level']][$_INTIN['CORE']][CORE'.$_INTIN['CORE Level'].' Relitivity'.$_INTIN['RUN']['subLVL'].' MOD'.@$_INTIN['MOD Level'].' Priority'.$_INTIN['MODRUN']['LVL'].' Relitivity'.$_INTIN['MODRUN']['subLVL']]['BLOCK-Changes'] = @array_diff($_INTIN['MOD']['CMS']['Blocks'],$alltime);
					$lasttime=@array_diff($_INTIN['MOD']['CMS']['Blocks'],$alltime);
					$alltime=$_INTIN['MOD']['CMS']['Blocks'];
					$_INTIN['Dump'][]=$GLOBALS;
				}
			}
			if (filesize($_INTIN['CORE'])>1) {
				if (!in_array($_INTIN['CORE'],get_included_files())) {
					if (!empty($lasttime)) $_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][@$_INTIN['CORE']]['Prior-STATE'] =$lasttime;
					bench('CORE '.$_INTIN['CORE Level'].': '.$_INTIN['CORE'].'');
					$_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][$_INTIN['CORE']]		['RETURN']['CORE'][$_INTIN['RUN']['subLVL']] = include_once($_INTIN['CORE']	);

					$_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][$_INTIN['CORE']]		['ACL'] = &
					$_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][$_INTIN['CORE']]		['RETURN']['CORE'][
	 array_key_last($_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][$_INTIN['CORE']]		['RETURN']['CORE'])];

					if (!empty($_INTIN['Dump'])) {
						$_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][$_INTIN['CoreMOD']]['Prior-STATE'] = @array_diff($_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][$_INTIN['CoreMOD']]['Prior-STATE'],$alltime);
					} else $_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][$_INTIN['CoreMOD']]['Prior-STATE'] = '_INTIN[\'Dump\'][] = (&)? $var; not activated.<br>Light Mode';
					if (!isset($_INTIN['MOD']['CMS']['Blocks']))
						$_INTIN['MOD']['CMS']['Blocks']=array();
					if (!isset($alltime))
						$alltime=array();
					$_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][@$_INTIN['MOD Level']][$_INTIN['CORE']]['C'.$_INTIN['CORE Level'].'-R'.$_INTIN['RUN']['subLVL'].'-M'.@$_INTIN['MOD Level'].'-P'.$_INTIN['MODRUN']['LVL'].'-R'.$_INTIN['MODRUN']['subLVL']]['BLOCK-Changes'] = @array_diff($_INTIN['MOD']['CMS']['Blocks'],$alltime);
					//$_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][@$_INTIN['MOD Level']][$_INTIN['CORE']][CORE'.$_INTIN['CORE Level'].' Relitivity'.$_INTIN['RUN']['subLVL'].' MOD'.@$_INTIN['MOD Level'].' Priority'.$_INTIN['MODRUN']['LVL'].' Relitivity'.$_INTIN['MODRUN']['subLVL']]['BLOCK-Changes'] = @array_diff($_INTIN['MOD']['CMS']['Blocks'],$alltime);
					$lasttime=@array_diff($_INTIN['MOD']['CMS']['Blocks'],$alltime);
					$alltime=$_INTIN['MOD']['CMS']['Blocks'];

				}
			}
		} else {
			if (filesize($_INTIN['CORE'])>1) {
				if (!in_array($_INTIN['CORE'],get_included_files())) {
					if (!empty($lasttime)) $_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][@$_INTIN['CORE']]['Prior-STATE'] =$lasttime;
					bench('CORE '.$_INTIN['CORE Level'].': '.$_INTIN['CORE'].'');
					$_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][$_INTIN['CORE']]		['RETURN']['CORE'][$_INTIN['RUN']['subLVL']] = include_once($_INTIN['CORE']	);

					$_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][$_INTIN['CORE']]		['ACL'] = &
					$_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][$_INTIN['CORE']]		['RETURN']['CORE'][
	 array_key_last($_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][$_INTIN['CORE']]		['RETURN']['CORE'])];

					if (!empty($_INTIN['Dump'])) {
						$_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][$_INTIN['CoreMOD']]['Prior-STATE'] = @array_diff($_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][$_INTIN['CoreMOD']]['Prior-STATE'],$alltime);
					} else $_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][$_INTIN['CoreMOD']]['Prior-STATE'] = '_INTIN[\'Dump\'][] = (&)? $var; not activated.<br>Light Mode';
					if (!isset($_INTIN['MOD']['CMS']['Blocks']))
						$_INTIN['MOD']['CMS']['Blocks']=array();
					if (!isset($alltime))
						$alltime=array();
					$_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][@$_INTIN['MOD Level']][$_INTIN['CORE']]['C'.$_INTIN['CORE Level'].'-R'.$_INTIN['RUN']['subLVL'].'-M'.@$_INTIN['MOD Level'].'-P'.$_INTIN['MODRUN']['LVL'].'-R'.$_INTIN['MODRUN']['subLVL']]['BLOCK-Changes'] = @array_diff($_INTIN['MOD']['CMS']['Blocks'],$alltime);
					//$_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][@$_INTIN['MOD Level']][$_INTIN['CORE']][CORE'.$_INTIN['CORE Level'].' Relitivity'.$_INTIN['RUN']['subLVL'].' MOD'.@$_INTIN['MOD Level'].' Priority'.$_INTIN['MODRUN']['LVL'].' Relitivity'.$_INTIN['MODRUN']['subLVL']]['BLOCK-Changes'] = @array_diff($_INTIN['MOD']['CMS']['Blocks'],$alltime);
					$lasttime=@array_diff($_INTIN['MOD']['CMS']['Blocks'],$alltime);
					$alltime=$_INTIN['MOD']['CMS']['Blocks'];
				}
			}
			if (filesize($_INTIN['CoreMOD'])>1) {
				if (!in_array($_INTIN['CoreMOD'],get_included_files())) {
					if (!empty($lasttime)) $_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][@$_INTIN['CoreMOD']]['Prior-STATE'] =$lasttime;
					bench('CORE#'.$_INTIN['CORE Level'].' MOD#'.$_INTIN['MOD Level'].': '.$_INTIN['MODRUN']['LEVEL'].' as '.$_INTIN['CoreMOD']);
					$_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][$_INTIN['CoreMOD']]	['RETURN']['MOD'] [$_INTIN['MODRUN']['subLVL']] = include_once($_INTIN['CoreMOD']);

					$_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][$_INTIN['CoreMOD']]	['ACL'] = &
					$_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][$_INTIN['CoreMOD']]	['RETURN']['MOD'][
	 array_key_last($_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][$_INTIN['CoreMOD']]	['RETURN']['MOD'])];

					if (!empty($_INTIN['Dump'])) {
						$_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][$_INTIN['CoreMOD']]['Prior-STATE'] = @array_diff($_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][$_INTIN['CoreMOD']]['Prior-STATE'],$alltime);
					} else $_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][$_INTIN['MOD Level']][$_INTIN['CoreMOD']]['Prior-STATE'] = '_INTIN[\'Dump\'][] = (&)? $var; not activated.<br>Light Mode';
					if (!isset($_INTIN['MOD']['CMS']['Blocks']))
						$_INTIN['MOD']['CMS']['Blocks']=array();
					if (!isset($alltime))
						$alltime=array();
					$_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][@$_INTIN['MOD Level']][$_INTIN['CoreMOD']]['C'.$_INTIN['CORE Level'].'-R'.$_INTIN['RUN']['subLVL'].'-M'.@$_INTIN['MOD Level'].'-P'.$_INTIN['MODRUN']['LVL'].'-R'.$_INTIN['MODRUN']['subLVL']]['BLOCK-Changes'] = @array_diff($_INTIN['MOD']['CMS']['Blocks'],$alltime);
					//$_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][@$_INTIN['MOD Level']][$_INTIN['CORE']][CORE'.$_INTIN['CORE Level'].' Relitivity'.$_INTIN['RUN']['subLVL'].' MOD'.@$_INTIN['MOD Level'].' Priority'.$_INTIN['MODRUN']['LVL'].' Relitivity'.$_INTIN['MODRUN']['subLVL']]['BLOCK-Changes'] = @array_diff($_INTIN['MOD']['CMS']['Blocks'],$alltime);
					$lasttime=@array_diff($_INTIN['MOD']['CMS']['Blocks'],$alltime);
					$alltime=$_INTIN['MOD']['CMS']['Blocks'];
				}
			}
		}
	} else {
		$_INTIN['MODRUN']['subLVL'] = '';
		$_INTIN['MODRUN']['LVL'] = '';//actualy priority request amung group later on.
		$_INTIN['MODRUN']['LEVEL'] = '';
		$_INTIN['MOD Level'] = '';
		$_INTIN['CoreMOD'] = '';
	}
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