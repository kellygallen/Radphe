<?php
@require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php');//Fallback Hook.
function get_one_jpeg (){
	global $_INTIN;
	$ConnIndex='mJSterm';
	$colorArray[]='black';
	$colorArray[]='red';
	$colorArray[]='white';
	$colorArray[]='blue';
	$width = 1120;
	$height = 579;
	$dest_image = imagecreatetruecolor($width, $height);
	imagesavealpha($dest_image, true);
	$trans_background = imagecolorallocatealpha($dest_image, 0, 0, 0, 127);
	imagefill($dest_image, 0, 0, $trans_background);
	$a = imagecreatefrompng(__DIR__.'/1.png');
	$b = imagecreatefrompng(__DIR__.'/2.png');
	$bwidth  = imagesx($b);
	$bheight = imagesy($b);
	$bCenterW = floor($bwidth/2);
	$bCenterh = floor($bheight/2);
    $c = imagecreatefrompng(__DIR__.'/3.png');
	$controlledx = rand(0,$width);
	$controlledy = rand(0,$height);
	$result = mysqli_query($_INTIN['DB']['Connections'][$ConnIndex],"SELECT Session_Data FROM Session WHERE Session_Id = '".session_id()."' AND Session_Expires > '".date('Y-m-d H:i:s')."'");
	if($row = mysqli_fetch_assoc($result)) $_SESSIONthread = @unserialize($row['Session_Data']);
		if (!empty($_SESSIONthread['mJSterm']['TermClicks'])) {
			//$handler->read(session_id());
			end($_SESSIONthread['mJSterm']['TermClicks']);
			$ClickOrden = key($_SESSIONthread['mJSterm']['TermClicks']);
			reset($_SESSIONthread['mJSterm']['TermClicks']);
			$Click = $_SESSIONthread['mJSterm']['TermClicks'][$ClickOrden];
			if (empty($Click['Click']['_x'])) {//Trying to make last position stay just for the ball exmple game.//but if it dont know then it is random... not good for poll kiosk either way.
				prev($_SESSIONthread['mJSterm']['TermClicks']);
				$ClickOrdenPrevious = key($_SESSIONthread['mJSterm']['TermClicks']);
				if (empty( $_SESSIONthread['mJSterm']['TermClicks'][$ClickOrdenPrevious]['Click']['_x'])) {
					prev($_SESSIONthread['mJSterm']['TermClicks']);
					$ClickOrdenPrevious = key($_SESSIONthread['mJSterm']['TermClicks']);
				}
				@$_SESSIONthread['mJSterm']['TermClicks'][$ClickOrden]['Click'] = $_SESSIONthread['mJSterm']['TermClicks'][$ClickOrdenPrevious]['Click'];
			}
			if ($Click['HandledTS']===0) {
//	$_SESSIONthread['mJSterm']['TermClicks'][] = array('Click'=>$_POST['Term'],'TS'=>time(),'HandledTS'=>0,'FrameSerial'=>'');
				$_SESSIONthread['mJSterm']['TermClicks'][$ClickOrden]['HandledTS']=time();
				$DateTime = date('Y-m-d H:i:s');
				$NewDateTime = date('Y-m-d H:i:s',strtotime($DateTime.' + 1 hour'));
				$result = mysqli_query($_INTIN['DB']['Connections'][$ConnIndex],"REPLACE INTO Session SET Session_Id = '".session_id()."', Session_Expires = '".$NewDateTime."', Session_Data = '".serialize($_SESSIONthread)."'");
				if (isset($_SESSIONthread['mJSterm']['Running'])) if ($_SESSIONthread['mJSterm']['Running']==0) die();
			}
			if (!isset($Click['Click']['_x'])) {
			} else {
				@$controlledx = $Click['Click']['_x']-$bCenterW;
				@$controlledy = $Click['Click']['_y']-$bCenterh;
			}
		}
		if (empty($Click['Click']['_x'])) {
			$controlledx = rand(0,$width);
			$controlledy = rand(0,$height);
		}
		imagecopy($dest_image, $a, rand(0,$width), rand(0,$height), 0, 0, imagesx($a), imagesy($a));
		imagecopy($dest_image, $b, $controlledx, $controlledy, 0, 0, $bwidth, $bheight);
		imagecopy($dest_image, $c, rand(0,$width), rand(0,$height), 0, 0, imagesx($c), imagesy($c));
//            header('Content-Type: image/png');
		imagejpeg($dest_image);
		//destroy all the image resources to free up memory
		imagedestroy($a);
		imagedestroy($b);
		imagedestroy($c);
		imagedestroy($dest_image);
		return $dest_image;
}
?>