<?php @require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php'); RadpheFallBackHook;

//Service Configuration
//Consider array building as stacking.
//its not a solid array that gets added in. for cache and if it was some values would be specified for last or carry thorugh if it is traverse merged.
//stacking the final state of setting things.
//it could be simpler... indeed.
//it could also get a lot more crazy
bench('Configuration');
if (1) {
    // Site Config
    @require_once $_SERVER['DOCUMENT_ROOT'].'/_system/_Config.php';

    //DB Settings and Connection Init.
    //@include_once $_SERVER['DOCUMENT_ROOT'].'/_system/Config_DB.php';
    //Database Settings - you can use ofuscation.
    include_once($_SERVER['DOCUMENT_ROOT'].'/_system/mod/_01_DBLayer/_DBConn_Config.php');

    // Site Config override for DEV env.
    //Allowing for Dev or Production Server Configurations.
    @include_once $_SERVER['DOCUMENT_ROOT'].'/_system/_DEV_Config.php';
    if (file_exists($_SERVER['DOCUMENT_ROOT'].'/_system/_DevServer.php')) {
        bench('Dev.Production');
        @include_once $_SERVER['DOCUMENT_ROOT'].'/_system/_DEV_Config.php'; //what makes it dev by being present
        @include($_SERVER['DOCUMENT_ROOT'].'/_system/_DevServer.php'); //what dev stuff should be production //kinda for staging.
    } else {
        bench('Production');
    //    @include($_SERVER['DOCUMENT_ROOT'].'/_system/_DevServer.php'); //what dev stuff should be production //included that way if you uncomment it
        @include($_SERVER['DOCUMENT_ROOT'].'/_system/_ProServer.php'); //production stuff gets last say. besides cache...
    }
//TODO: cache script jogging... stateful cache jogging if it can carry loads possibly with noise filter. and installer.
//only for now is some stuff in rescued cache working.
//will also need an editor and smart lodgic for if it can successfully write it's own cache. maybe a db mode failover.
    require_once($_SERVER['DOCUMENT_ROOT'].'/_system/Rush/_INTIN.php');
} else //Sitewide: Information, API Credentials, Banned IP's, SEO Meta Merge, SEO Terms heredoc
    require_once($_SERVER['DOCUMENT_ROOT'].'/_system/Rush/_INTIN.php');

//Register initial request. So it may be modified or examined by other pre request code.
$_INTIN['Load Status']['Request']['URL'] = strtr($_SERVER["SCRIPT_FILENAME"], array($_SERVER['DOCUMENT_ROOT'] => ""));
?>