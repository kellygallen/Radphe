<?php
global $_INTIN;
////	Internal Config
////			Site Wide Config
	$IntIn['MainConfig']['Admin']['Name'] = '';
	$IntIn['MainConfig']['Admin']['Email'] = '';
	$IntIn['MainConfig']['Admin']['Phone'] = '';
	$IntIn['MainConfig']['Admin']['Fax'] = '';
	$IntIn['MainConfig']['Admin']['GMT']['N'] = -8;
	$IntIn['MainConfig']['Admin']['GMT']['S'] = 'Pacific Time';

	$IntIn['MainConfig']['Contact'] = &$IntIn['MainConfig']['Admin'];
	$IntIn['MainConfig']['Manager'] = &$IntIn['MainConfig']['Admin'];
	$IntIn['MainConfig']['Support']['Level 0'] = &$IntIn['MainConfig']['Admin'];
	$IntIn['MainConfig']['Support']['Level 1'] = &$IntIn['MainConfig']['Admin'];
	$IntIn['MainConfig']['Support']['Level 2'] = &$IntIn['MainConfig']['Admin'];

$_INTIN['DB']['Profiles']['Defaults']['Host']='';
$_INTIN['DB']['Profiles']['Defaults']['User']='';
$_INTIN['DB']['Profiles']['Defaults']['Pass']='';
$_INTIN['DB']['Profiles']['Defaults']['Schema']='';

$_INTIN['DB']['Profiles']['Dev']['Host']='127.0.0.1';
$_INTIN['DB']['Profiles']['Dev']['User']='dev';
$_INTIN['DB']['Profiles']['Dev']['Pass']='';
$_INTIN['DB']['Profiles']['Dev']['Schema']='';

$_INTIN['DB']['Profiles']['Pro']['Host']='';
$_INTIN['DB']['Profiles']['Pro']['User']='';
$_INTIN['DB']['Profiles']['Pro']['Pass']='';
$_INTIN['DB']['Profiles']['Pro']['Schema']=&$_INTIN['DB']['Profiles']['Defaults']['Schema'];

//$_INTIN['DB']['Profiles']['Defaults'] = &$_INTIN['DB']['Profiles']['Dev'];
//$_INTIN['DB']['Profiles']['Defaults'] = &$_INTIN['DB']['Profiles']['Pro'];
?>
