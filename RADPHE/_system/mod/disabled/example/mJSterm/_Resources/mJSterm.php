<?php
@require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php');//Fallback Hook.
@$_INTIN['DB']['Profiles']['Pro']['Pass'] = danGit;
//TODO Does not work in XAMPP, possibly header mod behind back. Possibly forced compression deflate? Figure it out.
// https://www.jeffgeerling.com/blog/2016/streaming-php-disabling-output-buffering-php-apache-nginx-and-varnish
// Suspected Outputbuffering is not turning off, also gzip not off with  
if (session_status() == PHP_SESSION_NONE) {
	session_start(); //because it needs a session id and i dont get it from cookies.
	//session_write_close();
	// if history diffs change write. might be an anywhere login of a stream. this should be managed better as a blanket.
	// also disabled to maximize timing on shared hosting with kernel microtime hack.
	session_abort();
}// else @session_abort();

//needs a session id.... or a sticky unique cookie.
$link = @mysqli_connect("localhost","mod_mJSterm","","radphe");
if (!$link) $link = @mysqli_connect($_INTIN['DB']['Profiles']['Pro']['Host'],$_INTIN['DB']['Profiles']['Pro']['User'],$_INTIN['DB']['Profiles']['Pro']['Pass'],$_INTIN['DB']['Profiles']['Pro']['Schema']);
CMS_Skinner::$Page['LayoutFile']='Wide';
//$_INTIN['Design']['Layout']
include(__DIR__.'/../functions.php');

//View,render
if (isset($_GET['GUI'])) {
	if ($_GET['GUI']==0) {
		CMS_Blocks::CancelOutput();
		header_remove();
		header('Content-Type: image/png');
		header('Content-Length: ' . filesize(__DIR__.'/img/TermOff.png'));
		readfile(__DIR__.'/img/TermOff.png');
		die();
	}
//	if ($_GET['GUI']>=1) {
	if (1) {
		CMS_Blocks::CancelOutput();
		include(__DIR__.'/../frameServer.php');
		die();
	}
}

//Control,input
if (!empty($_POST)) {
	CMS_Blocks::CancelOutput();
	$runningtext = ($_POST['LINK']) ? '' : 'not ';
	echo "<html><body style='margin: 0;padding: 0;'>OK: [".$_POST['Term']['_x'].','.$_POST['Term']['_y']."]<sup><sup<sub>xy</sub></sup></sup> ".'While '.$runningtext.'running <br>';
	$_SESSIONthread['mJSterm']['Running'] = $_POST['LINK'];
	$_SESSIONthread['mJSterm']['TermClicks'][] = array('Click'=>$_POST['Term'],'TS'=>time(),'HandledTS'=>0,'FrameSerial'=>'');
		$DateTime = date('Y-m-d H:i:s');
		$NewDateTime = date('Y-m-d H:i:s',strtotime($DateTime.' + 1 hour'));
		$result = mysqli_query($link,"REPLACE INTO Session SET Session_Id = '".session_id()."', Session_Expires = '".$NewDateTime."', Session_Data = '".serialize($_SESSIONthread)."'");

//	session_write_close();
die();
}

//$_POST['LINK']=1;
$schema = (!empty($_INTIN['DB']['Profiles']['Pro']['Schema'])) ? $_INTIN['DB']['Profiles']['Pro']['Schema'] : 'DB';
if ((0)||(!$link)) {
	@$_INTIN['MOD']['CMS']['Blocks']['SupplementaryContent'] .= <<<THEREuGO
<h2>How to set up database.</h2>
Database Example DB SCHEMA.table currently set in config as {$schema}.Session<hr>
<h1>Install</h1>
<h2>Database Table</h2>
<pre>
CREATE TABLE `Session` (
	`Session_Id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
	`Session_Expires` datetime NOT NULL,
	`Session_Data` text COLLATE utf8_unicode_ci,
	PRIMARY KEY (`Session_Id`)
) DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

and you will want /_system/_DBConn_Config.php
to have something like this prevail (final reference ending)
but with your values in the ' single quotes.<br>
<br>
<h2>Radphe DB Config. <siteroot>/System/_DBConn_Config.php</h2>
This is for the DATABASE SERVER Credentials.<br> This reflects most of your current config. <br>
THEREuGO;
	@$_INTIN['MOD']['CMS']['Blocks']['SupplementaryContent'] .= <<<THEREuGO
\$_INTIN['DB']['Profiles']['Pro']['Host']='{$_INTIN['DB']['Profiles']['Pro']['Host']}';
\$_INTIN['DB']['Profiles']['Pro']['User']='{$_INTIN['DB']['Profiles']['Pro']['User']}';
\$_INTIN['DB']['Profiles']['Pro']['Pass']='.NOT.SHOWN.';
\$_INTIN['DB']['Profiles']['Pro']['Schema']='{$_INTIN['DB']['Profiles']['Pro']['Schema']}';
</pre>

THEREuGO;
	if (!empty($_INTIN['DB']['Profiles']['Pro']['Schema'])) @$_INTIN['MOD']['CMS']['Blocks']['SupplementaryContent'] .= 'for your config it is your '.$_INTIN['DB']['Profiles']['Pro']['Schema'].'.Session is your table.<br>';
	@$_INTIN['MOD']['CMS']['Blocks']['SupplementaryContent'] .= 'This SQL command or a slight adjustment installs the table for threading with session individuality and threading updates on your db server if the site has your db credentials and _DB_Config.php.';
}
//Model
?>
<script src="/js/mJStermFunct.js"></script>
<link rel="stylesheet" href="/css/mJStermStyle.css" type="text/css" />
<h1>proof of concept for something later</h1>
<h2>input injected into php generated graphic stream</h2> with sleep rates to control fps in animation bursts. the bandwidth you will use will be according to the frames you want to send. then the frame is rendered, and if a user clicks on it the coordinates are send back over ajax and injected back into the already and ongoing php stream process with their session id into a database along with weather it was a stream received and handled click for the session; the session is immediately aborted to prevent session hang across tabs and pages and only provides a system deep uuid with the mastery that sessions already has.
<h3>Needs a flushed stream on php fcgi or xampp.</h3> if image doesn't load on connect and you open the image into a new tab, then open the source of the image url'page' into yet another tab to see the raw stream. if you dont see an error (site engine in dev setup), and you dont see some cms block fragment, then your problem is that your output is likely being buffered or nginx is chunking, or apache has a interfering module. 
<pre>I am setting to run for 20 seconds max be nice and disconnect it when done just incase.
if you find your way to my free hosting test server, notice that the server has fake microtime and disallowed sleep at the os and php levels.</pre>
The point is that you could run a server side gui or slide survey or terminal at http3 jpeg fps on http 1.1; bandwidth aside, you might get higher frames with a mjpeg stream than of mpeg on weak systems and due to connection latency.
<form id="Term" target="TermResponse" action="mJSterm.php" method="post" name="mJSterm" enctype="multipart/form-data"  onsubmit="formSubmit(event);return false">
	<fieldset>
		<legend>
			<h1 class="OneInLiners">&emsp;mJSterm&emsp;&emsp;&emsp;</h1>
			<h2 class="OneInLiners"><label><b>State:</b></label></h2>
			<h3 class="OneInLiners">
				<label>
					<input type="radio" name="LINK" value="1" onclick="document.getElementById('Terminal').src='mJSterm.php?GUI=1';document.getElementById('TermClickX').value=null;document.getElementById('TermClickY').value=null;document.forms.mJSterm.submit()" <?php if (@$_POST['LINK']==1) echo 'checked'; ?>>Connect
				</label>
				&emsp;
				<label>
					<input type="radio" name="LINK" value="0" onclick="document.getElementById('Terminal').src='/img/TermOff.png';document.getElementById('TermClickX').value=null;document.getElementById('TermClickY').value=null;document.forms.mJSterm.submit()" <?php if (@$_POST['LINK']!=1) echo 'checked'; ?>>Disconnect
				</label>
				&emsp;
				<a href="?"><sup><sub>RESET</sub></sup></a>
				&emsp;
				<label style="display: none;">X,Y
					<input type="text" value="" id="TermClickX" name="Term[_x]" style="display: none;" size=5 />
					x
					<input type="text" value="" id="TermClickY" name="Term[_y]" style="display: none;" size=5 />
				</label>
				&emsp;
				<iframe width=300 height=22; id="TermResponse" name="TermResponse" style="border:hidden;"></iframe>
			</h3>
		</legend>
		<input type="image" name="Terminal" id="Terminal" src="mJSterm.php?GUI=<?php if (!empty($_POST['LINK'])) echo $_POST['LINK']; else echo '0'; ?>" style="border:6px solid red;" />
	</fieldset>
</form>
<script src="/js/mJStermPostLoad.js"></script>
