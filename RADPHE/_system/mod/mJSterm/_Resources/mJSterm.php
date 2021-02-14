<?php
@require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php');//Fallback Hook.

if (session_status() == PHP_SESSION_NONE) session_start();
session_write_close();
$link = @mysqli_connect("localhost","mod_mJSterm","","radphe");
if (!$link) $link = @mysqli_connect("dev.localhost","user","password","db");
//include(__DIR__.'/../_DB_SESSIONS.php');
CMS_Skinner::$Page['LayoutFile']='WP';

function is_func_enabled($func) {
	$disabled = explode(',', ini_get('disable_functions'));
	foreach ($disabled as $disableFunction) {
		$is_disabled[] = trim($disableFunction);
	}
	if ((in_array($func,$is_disabled))&&(function_exists($func))) {
		return false;
	} else {
		return true;
	}
	return false;
}
function skippy_sleep($timeout=1) {
	$Start = time();
	$StartPart = explode('.',$Start);
	$finishStart=$StartPart[0]+$timeout;
	$finishStart=$finishStart.'.'.$StartPart[1];
	$finishStart=$Start+$timeout;
	
	$MEthod=false;
	if ((1)&&(is_func_enabled('sleep'))) {
		$MEthod='sleep';
		@sleep($timeout);
	} elseif ((1)&&(is_func_enabled('usleep'))) {
		$MEthod='usleep';
		@usleep(1000000*$timeout);
	} elseif ((1)&&(is_func_enabled('curl_exec'))) {
		$MEthod='curl';
		$ch = curl_init('http://10.200.100.20/No_Sleep_Makes_NGINX_Posing_As_Apache_To_Do_Weird_Things');
		//localhost or a site that putposly never flushes output and keeps a iniated but null connection open for atleast a few seconds. or just a slow to respond site like my wordpress.
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_VERBOSE, 0);    
		curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);//maybe+1
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$response = curl_exec($ch);
		if ($response === false) {
			$info = curl_getinfo($ch);
			if ($info['http_code'] === 0) {
				// timeouth=
			}
		}
	} elseif (0) {//BURN IT UP ================================= 0 = not.
		//This one gets cpu hot.
//microtime is slower. fix use it explode by space and make its time boundery use the unix ts plus the mtime for the measure. if a resonable delay was made allow it to recall it self.
//		$MEthod='microtime';
		$MEthod='time';
		$end = time();
//		$diff=round($end,2)-round($Start,2);
		$diff=$end-$Start;
//		die('sleepy:'.$end.'-'.$Start.'='.$diff.'>?'.$timeout.' But the fiish is '.$finishStart);
//		if( floatval( (string) $a ) < floatval( (string) $b) ) { //do something }
//		$diff=bcsub($end, $Start, 4); //nobcmath
		while(
				($diff < $timeout)
			) {
//			error_log('sleepy:'.$end.'-'.$Start.'='.$diff.'>?'.$timeout.' But the fiish is '.$finishStart,0);
			$end = time();
//			$diff=round($end,2)-round($Start,2);
			$diff=$end-$Start;
			continue;
		}
	} else {//fail.
		return array('ME'=>false);
	}
	$end = time();
//	while (($end-$Start)<$timeout) skippy_sleep(1);
	$diff=$end-$Start;
	return array('Begin'=>$Start,'End'=>$end,'ME'=>$MEthod,'Diff'=>$diff);
}
//View,rendor
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
	var_dump($_POST);
	$_SESSIONthread['mJSterm']['Running'] = $_POST['LINK'];
	$_SESSIONthread['mJSterm']['TermClicks'][] = array('Click'=>$_POST['Term'],'TS'=>time(),'HandledTS'=>0,'FrameSerial'=>'');
		$DateTime = date('Y-m-d H:i:s');
		$NewDateTime = date('Y-m-d H:i:s',strtotime($DateTime.' + 1 hour'));
		$result = mysqli_query($link,"REPLACE INTO Session SET Session_Id = '".session_id()."', Session_Expires = '".$NewDateTime."', Session_Data = '".serialize($_SESSIONthread)."'");

//	session_write_close();
//	$_INTIN['Dump'][]='GetQuery';
//	$_INTIN['Dump'][]='_POST';
//	$_INTIN['Dump'][]='_GET';
//	$_INTIN['Dump'][]='_Globals';
die();
}
//$_POST['LINK']=1;

//Model
?>
<style>
.OneInLiners {
	display:inline;
}
</style>
<script>
function formSubmit(event) {
  event.preventDefault();
  var url = "mJSterm.php";
  var request = new XMLHttpRequest();
  var imgMAPInputEle = document.getElementById('Terminal');
  var FormTargetEle = document.getElementById('TermResponce');
  request.open('POST', url, true);
  request.onload = function() { // request successful
  // we can use server response to our request now
//    console.log(request.responseText);
    FormTargetEle.srcdoc = request.responseText;
  };

  request.onerror = function() {
    // request failed
	alert('POST FAILED, TERMINAL BROKEN.');
	return false;
  };

  request.send(new FormData(document.forms.mJSterm)); // create FormData from form that triggered event
 // document.getElementById('Terminal').value
  console.log("Terminal Interaction");
//  FormTargetEle.srcdoc = request.responseText;
//	alert('POST SENT.');

  return false;
}

// and you can attach form submit event like this for example
function attachFormSubmitEvent(formId){
  document.getElementById(formId).addEventListener("submit", formSubmit);
}
</script>
<h3>For now just 20 frames.</h3>
<pre>Work aroound needded for free hosting. it allows no sleep() and no set_time_limit(). So i will have to be tricky telling time and juggleing living handlers. ... or say forget free hosting!
Its currently Dumb. Please disconnect before you leave... and I am setting to run for 20 seconds max.
So you may need to press connect to get it going even though it shows connected.</pre>
<form id="Term" target="TermResponce" action="mJSterm.php" method="post" name="mJSterm" enctype="multipart/form-data"  onsubmit="formSubmit(event);return false">
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
				&emsp;&emsp;&emsp;
				<label>The Last X,Y
					<input type="text" value="" id="TermClickX" name="Term[_x]" size=3 />
					x
					<input type="text" value="" id="TermClickY" name="Term[_y]" size=3 />
				</label>
				&emsp;&emsp;&emsp;
				<iframe width=600 height=80 id="TermResponce" name="TermResponce"></iframe>
			</h3>
		</legend>
		<input type="image" name="Terminal" id="Terminal" src="mJSterm.php?GUI=<?php if (!empty($_POST['LINK'])) echo $_POST['LINK']; else echo '0'; ?>" style="border:6px solid red;" />
	</fieldset>
</form>
<script>
 // https://stackoverflow.com/questions/34867066/javascript-mouse-click-coordinates-for-image
  document.getElementById("Terminal").addEventListener('click', function (event) {
	var ImageDOM = document.getElementById("Terminal");
	var ImageFieldFridgeX = document.getElementById("TermClickX");
	var ImageFieldFridgeY = document.getElementById("TermClickY");

    // https://stackoverflow.com/a/288731/1497139
    bounds=this.getBoundingClientRect();
    var left=bounds.left;
    var top=bounds.top;
    var x = event.pageX - left;
    var y = event.pageY - top;
    var cw = this.clientWidth;
    var ch = this.clientHeight;
//    var iw = ImageDOM.naturalWidth;
//    var ih = ImageDOM.naturalHeight;
    var iw = ImageDOM.width;
    var ih = ImageDOM.height;
    var px = x/cw*iw;
    var py = y/ch*ih;
	ImageFieldFridgeX.value = Math.round(px);
	ImageFieldFridgeY.value = Math.round(py);

//    alert("click on "+this.tagName+" at pixel ("+px+","+py+") mouse pos ("+x+"," + y+ ") relative to boundingClientRect at ("+left+","+top+") client image size: "+cw+" x "+ch+" natural image size: "+iw+" x "+ih );
  });

</script>
