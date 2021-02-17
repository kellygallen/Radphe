<?php @require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php'); RadpheFallBackHook;

//$_INTIN['Dump'][]='GLOBALS';

if (
    ($_SERVER['PHP_SELF']==='/-RADPHError404.php')&&
    (1)
    ) {
        if (!empty($_SERVER['REDIRECT_QUERY_STRING'])) parse_str($_SERVER['REDIRECT_QUERY_STRING'], $_GET);
        if (!empty($_SERVER['REDIRECT_URL'])) {

            $_GET['Resource'] = $_SERVER['REDIRECT_URL'];
            $_SERVER['PHP_SELF'] = $_SERVER['REDIRECT_URL'];
        }
    }
//	ob_clean();
	//Error Hook to recover misrouted or unroutable modual resources.
	//To optimize one could just copy resources to be accessable as a regualr request.
	include_once($_SERVER['DOCUMENT_ROOT'].'/_system/mod/_00_ResourceFinder/_ModualResourceFinder.php');
	if(!isset($foundInMod)) $foundInMod=0;
	$code = ($foundInMod) ? 200 : 404;
//	$code = http_response_code();
    if (($code==200)) {
        return;
    } else {
    }
    if (
    		(!empty($_INTIN['MOD']['CMS']['Blocks']['Request']))||
    		(!empty($_INTIN['MOD']['CMS']['Blocks']['SupplementryContent']))||
    		(!empty($_INTIN['MOD']['CMS']['Blocks']['SEOSupplementryContent']))
    ) {
        if (($code!==200)) {
//            http_response_code(200);
        	header('HTTP/1.1 200 OK',true,200);
        	return;
        } else header('HTTP/1.1 404 Not Found',true,404);
    }

	//Error Message Construction
	$Err404 = <<<ENDOFSTRING
<hr>
<center><h1 style="background: rgb(255, 255, 255) none repeat scroll 0%; margin-top: 0pt; -moz-background-clip: -moz-initial; -moz-background-origin: -moz-initial; -moz-background-inline-policy: -moz-initial; color: rgb(0, 0, 0);">Not Found</h1>
<div>The requested URL was not found on this server.</div>
<hr>
<address><b>Apache</b> Server</address><br>
Nothing agaist NGINX, its great at all it does, but if you want php done great you best use nginx to front an actual Apache+MOD_PHP stack.
</center>
<hr>
ENDOFSTRING;

//what it should be.
//	http_response_code(404);
	header('HTTP/1.1 404 Not Found',true,404);

//if your host hijacks your error pages.
//	header ("HTTP/1.0 200 Not Found",true,200);

	echo $Err404;
	return;

?>