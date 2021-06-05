<?php
//ob_start();//force silent mode.
date_default_timezone_set('America/Los_Angeles');
//Init Core Variables
$_QUERY=array();
$_INTIN=array();
define('RadpheFallBackHook', ' global $_INTIN; ');//Fallback Hook Line. NOT a C++ defined macro, must be eval()'ed.
@require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php'); eval(RadpheFallBackHook);
//TODO: Namespace and Namespace browsing enabled dump.

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