<?php

global $_INTIN;

$_INTIN['KERNEL']['MANAGERS']=glob($_SERVER['DOCUMENT_ROOT'].'/_system/mod/*/_MODE_Level_Manager.php');
foreach($_INTIN['KERNEL']['MANAGERS'] as $_INTIN['KERNEL']['LEVEL']['Kernel_CORE_Orden'] => $_INTIN['KERNEL']['LEVEL']['Kernel_Level']) {
    $_INTIN['KERNEL']['MANAGERS'][$_INTIN['KERNEL']['LEVEL']['Kernel_CORE_Orden']] = realpath($_INTIN['KERNEL']['LEVEL']['Kernel_Level']);
}

$_INTIN['KERNEL']['CORE']=glob($_SERVER['DOCUMENT_ROOT'].'/_system/mod/-_CORE/_LVL_*.php');
foreach($_INTIN['KERNEL']['CORE'] as $_INTIN['KERNEL']['LEVEL']['Kernel_CORE_Orden'] => $_INTIN['KERNEL']['LEVEL']['Kernel_Level']) {
    $_INTIN['KERNEL']['FILES'][$_INTIN['KERNEL']['LEVEL']['Kernel_CORE_Orden']] = realpath($_INTIN['KERNEL']['LEVEL']['Kernel_Level']);
    preg_match('/_LVL_(?<LVL>\d{1,4})_?(?<subLVL>[.\dazA-Z]{1,10})?_(?<LEVEL>.*).php$/', $_INTIN['KERNEL']['CORE'][$_INTIN['KERNEL']['LEVEL']['Kernel_CORE_Orden']], $_INTIN['KERNEL']['EVENTSdetected'][$_INTIN['KERNEL']['LEVEL']['Kernel_CORE_Orden']]);
    $_INTIN['KERNEL']['EVENTS'][$_INTIN['KERNEL']['EVENTSdetected'][$_INTIN['KERNEL']['LEVEL']['Kernel_CORE_Orden']]['LEVEL']]=array();
}

$_INTIN['KERNEL']['BEFOREs']=glob($_SERVER['DOCUMENT_ROOT'].'/_system/mod/*/_LVL_*_before_*.php');
foreach($_INTIN['KERNEL']['BEFOREs'] as $_INTIN['KERNEL']['LEVEL']['Kernel_Level_Orden'] => $_INTIN['KERNEL']['LEVEL']['Kernel_Level']) {
    $_INTIN['KERNEL']['BEFORE'][$_INTIN['KERNEL']['LEVEL']['Kernel_Level_Orden']] = realpath($_INTIN['KERNEL']['LEVEL']['Kernel_Level']);
    preg_match('/_LVL_(?<LVL>\d{1,4})(_before_){1}(?<LEVEL>.*).php$/i', $_INTIN['KERNEL']['BEFORE'][$_INTIN['KERNEL']['LEVEL']['Kernel_Level_Orden']], $_INTIN['KERNEL']['EVENTSdetected'][$_INTIN['KERNEL']['LEVEL']['Kernel_Level_Orden']]);
    $_INTIN['KERNEL']['EVENTS'][$_INTIN['KERNEL']['EVENTSdetected'][$_INTIN['KERNEL']['LEVEL']['Kernel_Level_Orden']]['LEVEL']][]=realpath($_INTIN['KERNEL']['LEVEL']['Kernel_Level']);
}

$_INTIN['KERNEL']['FILES']=glob($_SERVER['DOCUMENT_ROOT'].'/_system/mod/*/_LVL_*_*.php');
foreach($_INTIN['KERNEL']['FILES'] as $_INTIN['KERNEL']['LEVEL']['Kernel_Level_Orden'] => $_INTIN['KERNEL']['LEVEL']['Kernel_Level']) {
    $_INTIN['KERNEL']['FILES'][$_INTIN['KERNEL']['LEVEL']['Kernel_Level_Orden']] = realpath($_INTIN['KERNEL']['LEVEL']['Kernel_Level']);
    preg_match('/_LVL_(?<LVL>\d{1,4})_?(?<subLVL>\d{1,4})?_(?<LEVEL>.*).php$/', $_INTIN['KERNEL']['FILES'][$_INTIN['KERNEL']['LEVEL']['Kernel_Level_Orden']], $_INTIN['KERNEL']['EVENTSdetected'][$_INTIN['KERNEL']['LEVEL']['Kernel_Level_Orden']]);
    if (stripos($_INTIN['KERNEL']['LEVEL']['Kernel_Level'],'_before_')==FALSE)
        if (stripos($_INTIN['KERNEL']['LEVEL']['Kernel_Level'],'_after_')==FALSE)
            $_INTIN['KERNEL']['EVENTS'][$_INTIN['KERNEL']['EVENTSdetected'][$_INTIN['KERNEL']['LEVEL']['Kernel_Level_Orden']]['LEVEL']][]=realpath($_INTIN['KERNEL']['LEVEL']['Kernel_Level']);
}

$_INTIN['KERNEL']['AFTERs']=glob($_SERVER['DOCUMENT_ROOT'].'/_system/mod/*/_LVL_*_after_*.php');
foreach($_INTIN['KERNEL']['AFTERs'] as $_INTIN['KERNEL']['LEVEL']['Kernel_Level_Orden'] => $_INTIN['KERNEL']['LEVEL']['Kernel_Level']) {
    $_INTIN['KERNEL']['AFTER'][$_INTIN['KERNEL']['LEVEL']['Kernel_Level_Orden']] = realpath($_INTIN['KERNEL']['LEVEL']['Kernel_Level']);
    preg_match('/_LVL_(?<LVL>\d{1,4})(_after_){1}(?<LEVEL>.*).php$/i', $_INTIN['KERNEL']['AFTER'][$_INTIN['KERNEL']['LEVEL']['Kernel_Level_Orden']], $_INTIN['KERNEL']['EVENTSdetected'][$_INTIN['KERNEL']['LEVEL']['Kernel_Level_Orden']]);
    $_INTIN['KERNEL']['EVENTS'][$_INTIN['KERNEL']['EVENTSdetected'][$_INTIN['KERNEL']['LEVEL']['Kernel_Level_Orden']]['LEVEL']][]=realpath($_INTIN['KERNEL']['LEVEL']['Kernel_Level']);
}
$_INTIN['KERNEL'] = array('EVENTS'=>$_INTIN['KERNEL']['EVENTS'],'MANAGERS'=>$_INTIN['KERNEL']['MANAGERS']);

//do each level manager and let it prune its own events or add in non core events with the parallel module as the core in loop. TO REDUCE EVENTS and ADD DYNAMIC ONES. the non demo will have nothing near "the long route"... i could use just the site engine merged from the first commit as the stages flat.

bench('CORE');

$_INTIN['KERNEL']['Tracking']['Memory']['LastTime']=array();
$_INTIN['KERNEL']['Tracking']['Blocks']['LastTime']=array();
foreach ($_INTIN['KERNEL']['EVENTS'] as $_INTIN['KERNEL']['EVENT'] => $_INTIN['KERNEL']['EVENTlevel']) {
    bench(strtoupper(''.$_INTIN['KERNEL']['EVENT'].''));
    foreach ($_INTIN['KERNEL']['EVENTlevel'] as $_INTIN['KERNEL']['EVENTlevelORDEN'] => $_INTIN['KERNEL']['EVENTlevelFILE']) {
        if (filesize($_INTIN['KERNEL']['EVENTlevelFILE'])>2) {
            if (!in_array($_INTIN['KERNEL']['EVENTlevelFILE'],get_included_files())) {
                bench(strtolower(''.$_INTIN['KERNEL']['EVENT'].''.$_INTIN['KERNEL']['EVENTlevelFILE']));
                try {
                    $_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['KERNEL']['EVENT']][$_INTIN['KERNEL']['EVENTlevelORDEN']][$_INTIN['KERNEL']['EVENTlevelFILE']]		['ACL'] = include_once($_INTIN['KERNEL']['EVENTlevelFILE']);
                } catch (exception $eMOD) {
                    $_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['KERNEL']['EVENT']][$_INTIN['KERNEL']['EVENTlevelORDEN']][$_INTIN['KERNEL']['EVENTlevelFILE']]		['ACL'] = 1; //1 whole problem; ah, ;ah; ah. 0 or "" is prefered.
                    do {
                        @$_INTIN['Dump'][$_INTIN['KERNEL']['EVENTlevelFILE']]['_ERRORS'][count($_INTIN['Dump'][$_INTIN['KERNEL']['EVENTlevelFILE']]['_ERRORS'])] .= "\n\n".sprintf('INSTANCE '.count($eMOD)."\n %s:%d %s (%d) [%s]\n%s", $eMOD->getFile(), $eMOD->getLine(), $eMOD->getMessage(), $eMOD->getCode(), get_class($eMOD),$eMOD->getTraceAsString());
                    } while ($eMOD = $eMOD->getPrevious());
                    $eMOD=null;
                }
                if (!isset($_INTIN['MOD']['CMS']['Blocks']))
                   $_INTIN['MOD']['CMS']['Blocks']=array();
                if (!isset($_INTIN['KERNEL']['Tracking']['Blocks']['AllTime']))
                    $_INTIN['KERNEL']['Tracking']['Blocks']['AllTime']=&$_INTIN['MOD']['CMS']['Blocks'];
               // if (!isset($_INTIN['KERNEL']['Tracking']['Memory']['AllTime']))
               //     $_INTIN['KERNEL']['Tracking']['Blocks']['AllTime']=array_merge_recursive(get_defined_vars(),array('GLOBALS'=>'NO','_INTIN'=>'No'));
                
               //if empty $_INTIN['Dump'] 
                $_INTIN['KERNEL']['Tracking']['Memory'][$_INTIN['KERNEL']['EVENT']][$_INTIN['KERNEL']['EVENTlevelORDEN']][$_INTIN['KERNEL']['EVENTlevelFILE']]=@array_diff_assoc(array_merge_recursive(get_defined_vars(),array('_INTIN'=>array('KERNEL'=>array('Tracking'=>array('No'))))),$_INTIN['KERNEL']['Tracking']['Memory']['LastTime']);
                //else dont track. //AND CLEAN THIS UP! (in memory structure and organization how you want the click through to be.)

                $_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['KERNEL']['EVENT']][$_INTIN['KERNEL']['EVENTlevelORDEN']][$_INTIN['KERNEL']['EVENTlevelFILE']]['BLOCK-Changes'] = @array_diff_assoc($_INTIN['MOD']['CMS']['Blocks'],$_INTIN['KERNEL']['Tracking']['Blocks']['LastTime']);

                $_INTIN['KERNEL']['Tracking']['Memory'][$_INTIN['KERNEL']['EVENT']][$_INTIN['KERNEL']['EVENTlevelORDEN']][$_INTIN['KERNEL']['EVENTlevelFILE'].'Blocks']=&$_INTIN['MOD']['']['AWARENESS']['Mods'][$_INTIN['KERNEL']['EVENT']][$_INTIN['KERNEL']['EVENTlevelORDEN']][$_INTIN['KERNEL']['EVENTlevelFILE']]['BLOCK-Changes'];

                $_INTIN['KERNEL']['Tracking']['Blocks']['LastTime']=$_INTIN['MOD']['CMS']['Blocks'];
                $_INTIN['KERNEL']['Tracking']['Memory']['LastTime']=array_merge_recursive(get_defined_vars(),array('GLOBALS'=>'','_INTIN'=>NULL));
                
                bench(strtolower('END '.$_INTIN['KERNEL']['EVENT'].''.$_INTIN['KERNEL']['EVENTlevelORDEN']));
            }
        }
    }
    bench(strtoupper(''.$_INTIN['KERNEL']['EVENT'].''));
}
unset($_INTIN['KERNEL']['Tracking']['Memory'],$_INTIN['KERNEL']['EVENTlevelORDEN'],$_INTIN['KERNEL']['EVENTlevel'],$_INTIN['KERNEL']['EVENTlevelFILE']);
/*
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
*/
?>