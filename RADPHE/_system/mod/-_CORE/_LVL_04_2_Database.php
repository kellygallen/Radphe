<?php
//Init Database connection for older php.

include_once($_SERVER['DOCUMENT_ROOT'].'/_system/mod/_01_DBLayer/DBConn.php');
//Default Database: 'pubic printable db user access by db server.
//include_once($_SERVER['DOCUMENT_ROOT'].'/_system/_DB_Connector.php');
//Build DB_Struct or get it from cache (PreCore)
if (is_file($_SERVER['DOCUMENT_ROOT'].'/_system/cache/_01_DBLayer/_DB_SERVER_CACHE.php') && ($_INTIN['Config']['Cache']['_DB_SERVER'])) {
    include_once $_SERVER['DOCUMENT_ROOT'].'/_system/cache/_01_DBLayer/_DB_SERVER_CACHE.php';
} elseif ($_INTIN['Config']['Cache']['_DB_SERVER']) {
//    include_once $_SERVER['DOCUMENT_ROOT'].'/_system/DBComBuildArray.php';
} else {
//    include_once $_SERVER['DOCUMENT_ROOT'].'/_system/DBComBuildArray.php';
}
?>