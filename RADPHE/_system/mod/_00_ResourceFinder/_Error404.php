<?php @require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php'); eval(RadpheFallBackHook);
if (
    ($_SERVER['PHP_SELF']==='/-RADPHError404.php')&&
    (1)
    ) {
        if ((!empty($_SERVER['REDIRECT_QUERY_STRING']))&&(empty($_GET))) parse_str($_SERVER['REDIRECT_QUERY_STRING'], $_GET);
        if (!empty($_SERVER['REDIRECT_URL'])) {

            $_GET['Resource'] = $_SERVER['REDIRECT_URL'];
            $_SERVER['PHP_SELF'] = $_SERVER['REDIRECT_URL'];
        }
    }
//	ob_clean();
	//Error Hook to recover mis-routed or un-routable module resources.
	//To optimize one could just copy resources to be accessible as a regular request.
	include_once($_SERVER['DOCUMENT_ROOT'].'/_system/mod/_00_ResourceFinder/_ModuleResourceFinder.php');
	if(!isset($_INTIN['MOD']['ResourceFinder']['found']['foundInMod'])) $_INTIN['MOD']['ResourceFinder']['found']['foundInMod']=0;
	$_INTIN['MOD']['ResourceFinder']['code'] = ($_INTIN['MOD']['ResourceFinder']['found']['foundInMod']) ? 200 : 404;
//	$code = http_response_code();
    if (($_INTIN['MOD']['ResourceFinder']['code']==200)) {
        return;
    } else {
    }
    if (
    		(!empty($_INTIN['MOD']['CMS']['Blocks']['Request']))||
    		(!empty($_INTIN['MOD']['CMS']['Blocks']['SupplementaryContent']))||
    		(!empty($_INTIN['MOD']['CMS']['Blocks']['SEOSupplementaryContent']))
    ) {
        if (($_INTIN['MOD']['ResourceFinder']['code']!==200)) {
//            http_response_code(200);
        	header('HTTP/1.1 200 OK',true,200);
        	return;
        } else {
            header('HTTP/1.1 404 Not Found',true,404);
            header("Cache-Control: max-age=5, s-maxage=5, cache, must-revalidate");    
        }
    }
//what it should be.
//	http_response_code(404);
	header('HTTP/1.1 404 Not Found',true,404);
    header("Cache-Control: max-age=5, s-maxage=5, cache, must-revalidate");    

//if your host hijacks your error pages.
//	header ("HTTP/1.0 200 Not Found",true,200);

	echo $_INTIN['Error 404'];
	return;
?>