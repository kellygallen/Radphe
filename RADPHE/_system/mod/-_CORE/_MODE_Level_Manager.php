<?php
global $_INTIN;

/* psudoprocrss build kernel print
//find all befores use them to make place holder before events in core.
$_INTIN['KERNEL']['MODULES']['CORE'] //just making this key means core files will be first.
//Make all CORE, then make all rest.
$_INTIN['KERNEL']['MODULES'][$MOD]
KERNEL
    MOD
        EVENTS
            BEFORE event lvl files
            NATSORTED LVL Files with befores removed or omitted [moved to front].
*/
//$_INTIN['KERNEL']['MODfiles']=glob($_SERVER['DOCUMENT_ROOT'].'/_system/mod/*/*.php');
$_INTIN['KERNEL']['FILES']=glob($_SERVER['DOCUMENT_ROOT'].'/_system/mod/*/_LVL_*_*.php');
$_INTIN['KERNEL']['MANAGERS']=glob($_SERVER['DOCUMENT_ROOT'].'/_system/mod/*/_MODE_Level_Manager.php');
//do just core events... toggle point. or all
//and only make event names = array();
$_INTIN['KERNEL']['BEFOREs']=glob($_SERVER['DOCUMENT_ROOT'].'/_system/mod/*/_LVL_*_before_*.php');
foreach($_INTIN['KERNEL']['BEFOREs'] as $Before_Orden => $Kernel_Level) {
    $_INTIN['KERNEL']['BEFORE'][$Before_Orden] = realpath($Kernel_Level);
    preg_match('/_LVL_(?<LVL>\d{1,4})(_before_){1}(?<LEVEL>.*).php$/i', $_INTIN['KERNEL']['BEFORE'][$Before_Orden], $_INTIN['KERNEL']['EVENTSdetected'][$Before_Orden]);
    //make path relative site root or site engine | which is right or full... as is. or include path option.
    $_INTIN['KERNEL']['EVENTS'][$_INTIN['KERNEL']['EVENTSdetected'][$Before_Orden]['LEVEL']][]=$_INTIN['KERNEL']['BEFORE'][$Before_Orden];
}

foreach($_INTIN['KERNEL']['FILES'] as $Kernel_Level_Orden => $Kernel_Level) {
    $_INTIN['KERNEL']['FILES'][$Kernel_Level_Orden] = realpath($Kernel_Level);
    preg_match('/_LVL_(?<LVL>\d{1,4})_?(?<subLVL>[.\dazA-Z]{1,10})?_(?<LEVEL>.*).php$/', $_INTIN['KERNEL']['FILES'][$Kernel_Level_Orden], $_INTIN['KERNEL']['EVENTSdetected'][$Kernel_Level_Orden]);
    $_INTIN['KERNEL']['EVENTS'][$_INTIN['KERNEL']['EVENTSdetected'][$Kernel_Level_Orden]['LEVEL']][]=$Kernel_Level;
}
$_INTIN['Dump'][]=$_INTIN['KERNEL'];


bench('CORE');
$_INTIN['MOD']['CORE']=glob($_SERVER['DOCUMENT_ROOT'].'/_system/mod/-_CORE/_LVL_*_*.php');
$lasttime=array();
//$alltime=array();
//if (empty($_INTIN['MOD']['CMS']['Blocks'])) $_INTIN['MOD']['CMS']['Blocks'] = array();
foreach($_INTIN['MOD']['CORE'] as $_INTIN['CORE Level'] => $_INTIN['CORE']) {
	//	if (!is_array($alltime)) $alltime = array();
//	$alltime=array_diff($_INTIN['MOD']['CMS']['Blocks'],$alltime);
	$_INTIN['CORE'] = realpath($_INTIN['CORE']);
	$_INTIN['RUN']=array();
	preg_match('/_LVL_(?<LVL>\d{1,4})_?(?<subLVL>[.]{1,10})?_(?<LEVEL>.*).php$/', $_INTIN['CORE'], $_INTIN['RUN']);
	$_INTIN['MOD Level']='CORE Level'.$_INTIN['CORE Level'];
//	$lasttime=$_INTIN['MOD']['CMS']['Blocks'];
	if ((1)||(!empty($_INTIN['RUN']['LEVEL']))) foreach(glob($_SERVER['DOCUMENT_ROOT'].'/_system/mod/*/_LVL_*_'.$_INTIN['RUN']['LEVEL'].'.php') as $_INTIN['MOD Level'] => $_INTIN['CoreMOD']) {
		$_INTIN['CoreMOD'] = realpath($_INTIN['CoreMOD']);
		$_INTIN['MODRUN']=array();
		preg_match('/_LVL_(?<LVL>\d{1,4})_?(?<subLVL>[.a-zA-Z]{1,10})?_(?<LEVEL>.*).php$/', $_INTIN['CoreMOD'], $_INTIN['MODRUN']);
        if (!isset($_INTIN['MODRUN']['subLVL'])) $_INTIN['MODRUN']['subLVL'] = 'normal';
        switch (true) {
            case ($_INTIN['MODRUN']['subLVL'] == 'before'):
            case ($_INTIN['MODRUN']['subLVL'] == 'Before'):
                if (filesize($_INTIN['CoreMOD'])>2) {
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
                        //$_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][@$_INTIN['MOD Level']][$_INTIN['CORE']][CORE'.$_INTIN['CORE Level'].' Relativity'.$_INTIN['RUN']['subLVL'].' MOD'.@$_INTIN['MOD Level'].' Priority'.$_INTIN['MODRUN']['LVL'].' Relativity'.$_INTIN['MODRUN']['subLVL']]['BLOCK-Changes'] = @array_diff($_INTIN['MOD']['CMS']['Blocks'],$alltime);
                        $lasttime=@array_diff($_INTIN['MOD']['CMS']['Blocks'],$alltime);
                        $alltime=$_INTIN['MOD']['CMS']['Blocks'];
                        break;
                    }
                }
            case ($_INTIN['MODRUN']['subLVL'] == null)://normal
            case ($_INTIN['MODRUN']['subLVL'] == '')://normal
            case ($_INTIN['RUN']['subLVL'] == 'normal')://normal
            case ($_INTIN['MODRUN']['subLVL'] == 'normal')://normal
            case ($_INTIN['MODRUN']['subLVL'] == 'after'):
                if (filesize($_INTIN['CORE'])>2) {
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
                        $_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][@$_INTIN['MOD Level']][$_INTIN['CORE']]['C'.$_INTIN['CORE Level'].'-R'.$_INTIN['RUN']['subLVL'].'-M'.@$_INTIN['MOD Level'].'-P'.$_INTIN['RUN']['LVL'].'-R'.$_INTIN['MODRUN']['subLVL']]['BLOCK-Changes'] = @array_diff($_INTIN['MOD']['CMS']['Blocks'],$alltime);
                        //$_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['CORE Level']][@$_INTIN['MOD Level']][$_INTIN['CORE']][CORE'.$_INTIN['CORE Level'].' Relativity'.$_INTIN['RUN']['subLVL'].' MOD'.@$_INTIN['MOD Level'].' Priority'.$_INTIN['MODRUN']['LVL'].' Relativity'.$_INTIN['MODRUN']['subLVL']]['BLOCK-Changes'] = @array_diff($_INTIN['MOD']['CMS']['Blocks'],$alltime);
                        $lasttime=@array_diff($_INTIN['MOD']['CMS']['Blocks'],$alltime);
                        $alltime=$_INTIN['MOD']['CMS']['Blocks'];

                    }
                }
                break;
            case 'overload':
                //new level manager
                break;
            case 'debug':
                break;
            case 'again':
                //include vs include_0nce for force //can regular include after include_once if not read and eval i guess.
                break;
            default:
//                die('nope!');
                break;
		}
	} else {
		$_INTIN['MODRUN']['subLVL'] = '';
		$_INTIN['MODRUN']['LVL'] = '';//actually priority request among group later on.
		$_INTIN['MODRUN']['LEVEL'] = '';
		$_INTIN['MOD Level'] = '';
		$_INTIN['CoreMOD'] = '';
	}
}
//TODO: also mods may run their level before or after core level in the mod priority order.
?>