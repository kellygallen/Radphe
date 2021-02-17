<?php
//@require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php');//Fallback Hook.
date_default_timezone_set('America/Los_Angeles');
ob_start();
//TODO: Namespace and Namespace browsing enabled dump.
//Init Core Variables
global $_INTIN;
$_QUERY=array();
//PreCore
@include($_SERVER['DOCUMENT_ROOT'].'/_system/function/bench.php');


bench('BEGIN'); //bench('MAJOR'); bench('Minor');

bench('BEGIN compatibility');
// Cross Server Compatibility - For Unifying Distributions.
@include_once $_SERVER['DOCUMENT_ROOT'].'/_system/_Cross_Server_Compatibility.php';


//CORE & RunLevel Manager
require_once($_SERVER['DOCUMENT_ROOT'].'/_system/mod/-_CORE/_MODE_Level_Manager.php');
die();







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
	bench('DB config core');
	include_once($_SERVER['DOCUMENT_ROOT'].'/_system/_DBConn_Config.php');

	// Site Config override for DEV env.
	//Allowing for Dev or Production Server Configurations.
	@include_once $_SERVER['DOCUMENT_ROOT'].'/_system/_DEV_Config.php';
	if (file_exists($_SERVER['DOCUMENT_ROOT'].'/_system/_DevServer.php')) {
		bench('Dev.Production');
		@include_once $_SERVER['DOCUMENT_ROOT'].'/_system/_DEV_Config.php'; //config changes for dev server and code,cache,config,jogging
		@include($_SERVER['DOCUMENT_ROOT'].'/_system/_DevServer.php'); //HOOKS, Responces. what dev stuff should be production //kinda for staging.
		//        @include($_SERVER['DOCUMENT_ROOT'].'/_system/_ProServer.php'); //HOOKS, Responces.production stuff gets last say. besides cache...
	} else {
		bench('Production');
		//        @include($_SERVER['DOCUMENT_ROOT'].'/_system/_DevServer.php'); //what dev stuff should be production //included that way if you uncomment it
		@include_once($_SERVER['DOCUMENT_ROOT'].'/_system/_ProServer.php'); //production stuff gets last say. besides cache...
	}
	//TODO: cache script jogging... stateful cache jogging if it can carry loads possibly with noise filter. and installer.
	//only for now is some stuff in rescued cache working.
	//will also need an editor and smart lodgic for if it can successfully write it's own cache. maybe a db mode failover.
	require_once($_SERVER['DOCUMENT_ROOT'].'/_system/jogging/_INTIN.php');
} else {
	//Sitewide: Information, API Credentials, Banned IP's, SEO Meta Merge, SEO Terms heredoc
	require_once($_SERVER['DOCUMENT_ROOT'].'/_system/jogging/_INTIN.php');
}
//Register initial request. So it may be modified or examined by other pre request code.
$_INTIN['Load Status']['Request']['URL'] = strtr($_SERVER["SCRIPT_FILENAME"], array($_SERVER['DOCUMENT_ROOT'] => ""));

//Lay Sitewide or default Foundation
bench('Init Enviornment');
//Init Database connection for older php.
include_once($_SERVER['DOCUMENT_ROOT'].'/_system/class/DBConn.php');
//Default Database: 'pubic permittable db user access by db server.
//include_once($_SERVER['DOCUMENT_ROOT'].'/_system/_DB_Connector.php');
//Build DB_Struct or get it from cache (PreCore)
if (is_file($_SERVER['DOCUMENT_ROOT'].'_system/_cache/_DB_SERVER_CACHE.php') && ($_INTIN['Config']['Cache']['_DB_SERVER'])) {
    include_once $_SERVER['DOCUMENT_ROOT'].'/_system/_cache/_DB_SERVER_CACHE.php';
} elseif ($_INTIN['Config']['Cache']['_DB_SERVER']) {
//    include_once $_SERVER['DOCUMENT_ROOT'].'/_system/DBComBuildArray.php';
} else {
//    include_once $_SERVER['DOCUMENT_ROOT'].'/_system/DBComBuildArray.php';
}

bench('DB Layor');

//Init Sessions leave it to things that work with sessions once started cant go back.
//if (empty($_SESSION)) session_start();

//Include Closest - Used to check for and include the closest file if it exists.
/*	_application.php uses this to find the first parent folder with this blanket fype file.
	it will split the unification of the site and give a sub folder its on branch of unification.
	you can also use .htaccess php-prepend NONE to terminate automatic inheritance at the branch folder. */
include_once($_SERVER['DOCUMENT_ROOT'].'/_system/function/include_closest.php');
//_application happens much later for it's own zones.

//CMS-Blocks - Stateless Managemnt at any time, of the building blocks of a responce.
require_once($_SERVER['DOCUMENT_ROOT'].'/_system/class/CMS.php');
//CMS-SEO - Seemingly pointless but through alteration of the html metadata per responce.
require_once($_SERVER['DOCUMENT_ROOT'].'/_system/class/CMS-SEO.php');
//CMS-Skinner -
require_once($_SERVER['DOCUMENT_ROOT'].'/_system/class/CMS-SKINNER.php');
CMS_Skinner::Init();
CMS_Blocks::SetTopBlock('Layout');

//TODO: Shutdown Protocol and fuction to shutdown ahead of time still operating site functions after die.
//but right now not ready. on some systems you may be able to overload die();
//prevent die from cutting off engine.
//register_shutdown_function(array('CMS_Blocks','obreplace')); //should call rendor.
//register_shutdown_function(array('CMS_Blocks','render'));

//menu items
CMS_Blocks::startAppendBlock('PageNavigation1');
	echo '| ';
	echo ' <a href="/">Front Page</a> <sup><a href="/index.php">php</a></sup> <sub><a href="/index.html">html</a></sub> <sup><a href="/style.css">virtual</a></sup> |';
	echo ' <a href="?DevInfo=phpinfo&Info=Info" title="Non Request">PHP Info</a> <sup><a href="/DevInfo.php?DevInfo=phpinfo&Info=Info" title="Virtually Routed and Non Request Content.">Virtual</a></sup> |';
	echo ' <a href="/mJSterm.php">mJPEG JS Terminal</a> |';
	echo ' <a href="#DevDebugPreKurser">Footer</a> |';
	echo ' <a href="RADPHE.php">Simple Direct</a> |';
	echo '<hr>';
	echo ' Local: <a href="/wordpress/">Wordpress</a> <sup><a href="/wordpress/wp-admin/">Admin</a></sup> |';
	echo ' <a href="http://kellygallen.lovestoblog.com/">Remote</a>: <a href="http://kellygallen.lovestoblog.com/WordPress/">Wordpress</a> <sup><a href="http://kellygallen.lovestoblog.com/WordPress/wp-admin/">Admin</a></sup> <sub><a href="http://192.168.1.26/wordpress/">local LAMP</a></sub> |';

CMS_Blocks::endAppendBlock();
CMS_Blocks::startAppendBlock('PageNavigation3');
	echo '<h3>the footer nav</h3>| ';
	echo '| ';
	echo '#mem:PageNavigation1;#';
CMS_Blocks::endAppendBlock();
//CMS_Blocks::Init();
//CMS_Blocks::startBlock('Layout');//Root of recursive block call and replace.
//CMS_Blocks::endBlock();//not required if you call a new block unless you terminate it.
//CMS_Blocks::startBlock('SEOKeywords');//Example Keywords meta overide in layout
//CMS_Blocks::startBlock('SEOPageTitle');//Example Page Title overide in layout
//CMS_Blocks::startBlock('SEODescription');//Example Page Description Everide in layout.
//CMS_Blocks::startBlock('SEOMeta');//Example meta tags to MERGE in.
//CMS_Blocks::endBlock('SEOMeta');//Like right there it might have been nessesary to finish a block clean. endBlock


//Application Area Code - Code that is run before any other code in an area.
bench('APP START');
bench('app core');
if (file_exists(dirname($_SERVER['PHP_SELF']).'/_Application.php')) {
    bench('Application Overide');
    include dirname($_SERVER['PHP_SELF']).'/_Application.php';
} elseif (include_closest(dirname($_SERVER['PHP_SELF']).'/_application.php')) {
    bench('Application Stackable');
} else {
    bench('Application not present');
}
bench('APP DONE');

//Proceed into Request.
CMS_Blocks::startBlock('Request');
// The request.php may have a request.SEO.php file which sets seo or maybe does something.
if (file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$_SERVER['PHP_SELF'].'.SEO.php')) {
	bench('Request-SEO Defaults');
	include $_SERVER['DOCUMENT_ROOT'].'/'.$_SERVER['PHP_SELF'].'.SEO.php';
}

//THE REQUEST
bench('pre ready mods');
//foreach(glob($_SERVER['DOCUMENT_ROOT'].'/_system/mod/*/_LVL_*_PreApplication.php') as $AutoMod) { include_once(realpath($AutoMod)); bench('pre ready MOD $AutoMod');}
bench('READY');

//Handle Get post if unified to 1 handler.
//But this is an example of a Exception Hook.
//If there is a post, then handle it for a simple site.
//This should probably be left to the states of your request.
//but really the request can handle and terminate before this or at least empty the post array after its been handled.
if (!empty($_POST)) {
	//Was for login only being available on in-house self-hosted dev server.
	if (isset($_POST['LoginType'])) {
		require_once($_SERVER['DOCUMENT_ROOT'].'/_system/functions/_Login.php');//?
	} else {
//		require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_post.php');//unified post handler??
	}//might consider switch case default break(s) for more complex.
	bench('POSTED');
} else bench('Posted');

//CMS_Blocks::startBlock('Request');//The Request or body of the changing pages.
//DO THE ACTUAL REQUEST,
//	it may take over and die or preferably exit for callback purposes unless you want to stop them.
//------------------------------------------------------
include $_SERVER['DOCUMENT_ROOT'].'/'.$_SERVER['PHP_SELF'];
//------------------------------------------------------
bench('REQUEST LOADED');
CMS_Blocks::endBlock();

//moduals after?
include_once($_SERVER['DOCUMENT_ROOT'].'/_system/mod/OtherApp/_LVL_0_Pre.php');


//Render Request from Blocks
bench('RENDER');
CMS_Blocks::render();
bench('RENDERED');

//Commit Session. - Usualy Not needed.
session_write_close();
//CMS_Blocks::closeBuffers(-1);
//OTHERWISE you can keep contol of the request like this.
$endOB =0; //count opb buffers i didnt do.
//Close All open nested output buffering into their blocks.
while (@ob_end_flush()) $endOB++;
//otherwise die... done here.

?>