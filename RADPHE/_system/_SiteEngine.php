<?php define('RadpheFallBackHook', ' global $_INTIN; // ', true);//Fallback Hook Line.
@require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php'); RadpheFallBackHook;


date_default_timezone_set('America/Los_Angeles');
ob_start();
//TODO: Namespace and Namespace browsing enabled dump.
//Init Core Variables
$_QUERY=array();
//PreCore
@include($_SERVER['DOCUMENT_ROOT'].'/_system/mod/-_Bench/bench.function.php');


bench('BEGIN'); //bench('MAJOR'); bench('Minor');

bench('BEGIN compatibility');
// Cross Server Compatibility - For Unifying Distributions.
@include_once $_SERVER['DOCUMENT_ROOT'].'/_system/_Cross_Server_Compatibility.php';

clearstatcache();
//CORE & RunLevel Manager
require_once($_SERVER['DOCUMENT_ROOT'].'/_system/mod/-_CORE/_MODE_Level_Manager.php');
?>