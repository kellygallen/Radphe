<?php
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
//CMS_Blocks::Init();
//CMS_Blocks::startBlock('Layout');//Root of recursive block call and replace.
//CMS_Blocks::endBlock();//not required if you call a new block unless you terminate it.
//CMS_Blocks::startBlock('SEOKeywords');//Example Keywords meta overide in layout
//CMS_Blocks::startBlock('SEOPageTitle');//Example Page Title overide in layout
//CMS_Blocks::startBlock('SEODescription');//Example Page Description Everide in layout.
//CMS_Blocks::startBlock('SEOMeta');//Example meta tags to MERGE in.
//CMS_Blocks::endBlock('SEOMeta');//Like right there it might have been nessesary to finish a block clean. endBlock


?>