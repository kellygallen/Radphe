<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/_system/mod/_01_DBLayer/DBConn.php');
if (is_file($_SERVER['DOCUMENT_ROOT'].'/_system/cache/_01_DBLayer/_DB_SERVER_CACHE.php') && ($_INTIN['Config']['Cache']['_DB_SERVER'])) {
    include_once $_SERVER['DOCUMENT_ROOT'].'/_system/cache/_01_DBLayer/_DB_SERVER_CACHE.php';
} elseif ($_INTIN['Config']['Cache']['_DB_SERVER']) {
} else {
}
?>