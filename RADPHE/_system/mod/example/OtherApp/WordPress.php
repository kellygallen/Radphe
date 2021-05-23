<?php
@require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php');//Fallback Hook.
global $_INTIN;

//TODO worpress on free hosting is useing include only in index.
//thats why remote made post without spider bridge.
//detect it better.
//handle die with shutdown hook that is harmless to set.

$WordpressFound=0;
//local
if (
		(1)&&
		(false !== stripos(dirname($_SERVER["PHP_SELF"]),'wordpress'))&&
		(
			(!empty($_INTIN['MOD']['CMS']['Blocks']['Request']))||
			(10<ob_get_length())
		)
) {
	CMS_Skinner::$Page['LayoutFile']='Wide';
	@$_INTIN['MOD']['CMS']['Blocks']['SupplementryContent'] .=  '<h1 class="text-dark">Wordpress Works - In Output Buffer</h1><h2 class="text-dark">Post is passthrough! It WILL WORK ALL THE WAY!</h2><h3 class="text-dark">This is becasue it is assumed to be already in output uncaptured by a block.</h3>';
	return;
} elseif (false !== stripos(dirname($_SERVER["PHP_SELF"]),'wordpress')){
	CMS_Skinner::$Page['LayoutFile']='Wide';
	@$_INTIN['MOD']['CMS']['Blocks']['SupplementryContent'] .= '<h1 class="text-dark">Wordpress Works - included</h1>';
//		echo '#mem:Request3;#';
		CMS_Blocks::startBlock('Request');
//		include($_SERVER['PHP_SELF']) or
		include($_SERVER['DOCUMENT_ROOT'].'/wordpress/index.php');
		CMS_Blocks::startBlock('Request');
}

if (
		(1)&&
		(false !== strpos(dirname($_SERVER["PHP_SELF"]),'wordpress'))
) {
	CMS_Skinner::$Page['LayoutFile']='Wide';
	if ((1)&&((false !== stripos(dirname($_SERVER["PHP_SELF"]),'wp-admin'))||(false !== stripos($_SERVER["REQUEST_URI"],'wp-login')))) {
//		CMS_Blocks::CancelOutput();
//		@$_INTIN['MOD']['CMS']['Blocks']['SupplementryContent'] .=  '<h1 class="text-dark">Wordpress Works - In block</h1><h2 class="text-dark">Post is passthrough! It WILL WORK ALL THE WAY!</h2><h3 class="text-dark">This is becasue it was captured by a block and hooked in.</h3>';
//		echo $_INTIN['MOD']['CMS']['Blocks']['Request'];
//		die();
	}
	@$_INTIN['MOD']['CMS']['Blocks']['SupplementryContent'] .=  '<h1 class="text-dark">Wordpress Works - In block</h1><h2 class="text-dark">Post is passthrough! It WILL WORK ALL THE WAY!</h2><h3 class="text-dark">This is becasue it was captured by a block and hooked in.</h3>';
//	CMS_Blocks::startBlock('Request'); //should continue to append.
//	CMS_Blocks::endBlock('Request'); //need it to be in mem block.

	$dom = new DOMDocument();
	$dom->preserveWhiteSpace = false;
	$dom->strictErrorChecking = false;
	$dom->recover = true;

	libxml_use_internal_errors(true);
	//@$dom->loadHTMLFile("$url");
	$dom->loadHTML($_INTIN['MOD']['CMS']['Blocks']['Request']);
	libxml_use_internal_errors(false);

//$fragment = $dom->createDocumentFragment();
//	$_INTIN['MOD']['CMS']['Blocks']['Request'] = $dom->getElementById("primary")->textContent;
	$remove_other = $dom->getElementById('comments');
	if (isset($remove_other)) $dom->removeChild($remove_other);
	$specialdiv = $dom->getElementById('primary');
//    $_INTIN['MOD']['CMS']['Blocks']['Request']=  $dom->saveHTML($specialdiv); //just div area as variable.
    $_INTIN['MOD']['CMS']['Blocks']['Request']=  $dom->saveHTML(); //whole page
    unset($_INTIN['MOD']['CMS']['Blocks']['Request3'],$_INTIN['MOD']['CMS']['Blocks']['Request2']);
    $WordpressFound=1;
} else

//remote
//only many problems with this remote... cant proxy post for it.
//redirects might throw it off its not a spider of any intel at all.
//its a straight pointer get address without sessions.
if ((1)&&(false !== strpos(dirname($_SERVER["PHP_SELF"]),'WordPress'))) {
	CMS_Skinner::$Page['LayoutFile']='Wide';
	@$_INTIN['MOD']['CMS']['Blocks']['SupplementryContent'] .= '<h1 class="text-dark">Wordpress Works - by proxy</h1><h2 class="text-dark">Post is currently dropped! It WILL WORK up until interaction!</h2><h3 class="text-dark">This is becasue it a block captured by proxy and post passthrough is not implemented... yet.</h3><pre class="text-dark">You should try the local word press link... its either a manual install or a MOVE or COPY of the one alisously installed in a integrated directory sub site where .htaccess dosent have all.
the goal is no mod wordpress, though an include line will do it too.</pre><h2 class="text-dark">I could be wrong, I was able to login!</h2><pre class="text-dark">Post works becasue it it tried to run content.
this file needs to be tested outside of contect of running in a worpress request for its proxy function.
I could be double running proxy on a condition after block is detected.</pre>';
//	echo '#mem:Request3;#';
//	CMS_Blocks::startBlock('Request3');
	if($_SERVER['SERVER_NAME']=='192.168.1.26') {
		$_SERVER['REQUEST_URI'] = str_replace('WordPress','wordpress',$_SERVER['REQUEST_URI']);
	}
	$doc = new DOMDocument;
	$doc->preserveWhiteSpace = false;
	$doc->strictErrorChecking = false;
	$doc->recover = true;
	libxml_use_internal_errors(true);
	//@$doc->loadHTMLFile("$url");
//	$doc->loadHTML($_INTIN['MOD']['CMS']['Blocks']['Request']);
	//requires Scriptalisious installer .htaccess taken down becasue it makes url corrections all the time.
	@$doc->loadHTMLFile('http://'.$_SERVER['SERVER_NAME'].'/'.$_SERVER['REQUEST_URI'],LIBXML_NOERROR);
	libxml_use_internal_errors(false);
	//	$_INTIN['MOD']['CMS']['Blocks']['Request'] = $doc->getElementById("primary")->textContent;
	$remove_other = $doc->getElementById('comments');
	if (isset($remove_other)) $doc->removeChild($remove_other);
	$specialdiv = $doc->getElementById('primary');
//    $_INTIN['MOD']['CMS']['Blocks']['Request']=  $doc->saveHTML($specialdiv); //just div area
    $_INTIN['MOD']['CMS']['Blocks']['Request']=  $doc->saveHTML(); //whole page
	$WordpressFound=1;

if ((1)&&((false !== stripos(dirname($_SERVER["PHP_SELF"]),'wp-admin'))||(false !== stripos($_SERVER["REQUEST_URI"],'wp-login')))) {
		CMS_Blocks::CancelOutput();
		@$_INTIN['MOD']['CMS']['Blocks']['SupplementryContent'] .= '<h1 class="text-dark">Wordpress Works - by proxy</h1><h2 class="text-dark">Post is currently dropped! It WILL WORK up until interaction!</h2><h3 class="text-dark">This is becasue it a block captured by proxy and post passthrough is not implemented... yet.</h3><pre class="text-dark">You should try the local word press link... its either a manual install or a MOVE or COPY of the one alisously installed in a integrated directory sub site where .htaccess dosent have all.
the goal is no mod wordpress, though an include line will do it too.</pre><h2 class="text-dark">I could be wrong, I was able to login!</h2>';
		echo $_INTIN['MOD']['CMS']['Blocks']['Request3'];
		die();
	}
}
unset($_INTIN['MOD']['CMS']['Blocks']['Request3'],$_INTIN['MOD']['CMS']['Blocks']['Request2']);

unset($WordpressFound);
//die();

?>