<?php @require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php'); eval(RadpheFallBackHook);
bench('Configuration');
if (1) {
    @require_once $_SERVER['DOCUMENT_ROOT'].'/_system/_Config.php';
    include_once($_SERVER['DOCUMENT_ROOT'].'/_system/mod/_01_DBLayer/_DBConn_Config.php');
    @include_once $_SERVER['DOCUMENT_ROOT'].'/_system/_DEV_Config.php';
    if (file_exists($_SERVER['DOCUMENT_ROOT'].'/_system/_DevServer.php')) {
        bench('Dev.Production');
        @include_once $_SERVER['DOCUMENT_ROOT'].'/_system/_DEV_Config.php';
        @include($_SERVER['DOCUMENT_ROOT'].'/_system/_DevServer.php');
    } else {
        bench('Production');
        @include($_SERVER['DOCUMENT_ROOT'].'/_system/_ProServer.php');
    }
    require_once($_SERVER['DOCUMENT_ROOT'].'/_system/Rush/_INTIN.php');
} else require_once($_SERVER['DOCUMENT_ROOT'].'/_system/Rush/_INTIN.php');

$_INTIN['Load Status']['Request']['URL'] = strtr($_SERVER["SCRIPT_FILENAME"], array($_SERVER['DOCUMENT_ROOT'] => ""));
?>