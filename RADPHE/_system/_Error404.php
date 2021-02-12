<?php
@require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php');//Fallback Hook.

//	ob_clean();
	//Error Hook to recover misrouted or unroutable modual resources.
	//To optimize one could just copy resources to be accessable as a regualr request.
	include_once($_SERVER['DOCUMENT_ROOT'].'/_system/_ModualResourceFinder.php');
$code = http_response_code();
if ($code==200) {
	return;
}

	//Error Message Construction
	$Err404 = <<<ENDOFSTRING
<hr>
<center><h1 style="background: rgb(255, 255, 255) none repeat scroll 0%; margin-top: 0pt; -moz-background-clip: -moz-initial; -moz-background-origin: -moz-initial; -moz-background-inline-policy: -moz-initial; color: rgb(0, 0, 0);">Not Found</h1>
<div>The requested URL was not found on this server.</div>
<hr>
<address><b>Apache</b> Server</address></center>
<hr>
ENDOFSTRING;

//what it should be.
	http_response_code(404);
	header ("HTTP/1.0 404 Page Not Found",true,404);

//if your host hijacks your error pages.
//	header ("HTTP/1.0 200 Not Found",true,200);

	echo $Err404;
	return;

?>