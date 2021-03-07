<?php @require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php'); eval(RadpheFallBackHook);

$_INTIN['DB']['Profiles']['Defaults']['Host']='';
$_INTIN['DB']['Profiles']['Defaults']['User']='';
$_INTIN['DB']['Profiles']['Defaults']['Pass']='';
$_INTIN['DB']['Profiles']['Defaults']['Schema']='';

$_INTIN['DB']['Profiles']['Dev']['Host']='127.0.0.1';
$_INTIN['DB']['Profiles']['Dev']['User']='dev';
$_INTIN['DB']['Profiles']['Dev']['Pass']='';
$_INTIN['DB']['Profiles']['Dev']['Schema']=&$_INTIN['DB']['Profiles']['Defaults']['Schema'];

$_INTIN['DB']['Profiles']['Pro']['Host']='';
$_INTIN['DB']['Profiles']['Pro']['User']='';
$_INTIN['DB']['Profiles']['Pro']['Pass']='';
$_INTIN['DB']['Profiles']['Pro']['Schema']=&$_INTIN['DB']['Profiles']['Defaults']['Schema'];

//$_INTIN['DB']['Profiles']['Defaults'] = &$_INTIN['DB']['Profiles']['Dev'];
//$_INTIN['DB']['Profiles']['Defaults'] = &$_INTIN['DB']['Profiles']['Pro'];
?>
