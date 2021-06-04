<?php
    //do only stateless template and provide content for it's request, but then terminate as a 404 page and do nothing else BUT MAYBE still TO SOME #TAG# replacements... things could still run.
	require_once($_SERVER['DOCUMENT_ROOT'].'/_system/Rush/_INTIN.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/_system/mod/_00_StatelessOutputBuffer/_LVL_02_Enviorment.php');
    $_GET=array(); $_POST=array(); $_FILES=array();
    if (empty($_INTIN['MOD']['CMS']['Blocks']['Request'])) {
        $_INTIN['MOD']['CMS']['Blocks']['Request'] = $_INTIN['Error 404'];
        header('HTTP/1.1 404 Not Found',true,404);
    }
    require_once($_SERVER['DOCUMENT_ROOT'].'/_system/mod/-_CORE/_LVL_09_PreShutdown.php');
    die();
?>