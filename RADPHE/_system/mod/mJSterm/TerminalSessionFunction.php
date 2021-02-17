<?php
@require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php');//Fallback Hook.

function get_one_jpeg (){
global $link;
//if (!$_SESSION['mJSterm']['Running']) return false;
//
$colorArray[]='black';
$colorArray[]='red';
$colorArray[]='white';
$colorArray[]='blue';
	/* Set width and height in proportion of genuine PHP logo */
	$width = 1120;
	$height = 579;


            $dest_image = imagecreatetruecolor($width, $height);

            //make sure the transparency information is saved
            imagesavealpha($dest_image, true);

            //create a fully transparent background (127 means fully transparent)
            $trans_background = imagecolorallocatealpha($dest_image, 0, 0, 0, 127);

            //fill the image with a transparent background
            imagefill($dest_image, 0, 0, $trans_background);

            //take create image resources out of the 3 pngs we want to merge into destination image
            $a = imagecreatefrompng(__DIR__.'/1.png');
            $b = imagecreatefrompng(__DIR__.'/2.png');
$bwidth  = imagesx($b);
$bheight = imagesy($b);
$bCenterW = floor($bwidth/2);
$bCenterh = floor($bheight/2);
            $c = imagecreatefrompng(__DIR__.'/3.png');
	$controlledx = rand(0,$width);
	$controlledy = rand(0,$height);
$result = mysqli_query($link,"SELECT Session_Data FROM Session WHERE Session_Id = '".session_id()."' AND Session_Expires > '".date('Y-m-d H:i:s')."'");
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
		$result = mysqli_query($link,"REPLACE INTO Session SET Session_Id = '".session_id()."', Session_Expires = '".$NewDateTime."', Session_Data = '".serialize($_SESSIONthread)."'");
		if (isset($_SESSIONthread['mJSterm']['Running'])) if ($_SESSIONthread['mJSterm']['Running']==0) die();
	}
	if (!isset($Click['Click']['_x'])) {
//handled by root parent if later on.
//		$controlledx = rand(0,$width);
//		$controlledy = rand(0,$height);
		//		$controlledx = $Click['Click']['_x']-$bCenterW;
//		$controlledy = $Click['Click']['_y']-$bCenterh;
	} else {
		@$controlledx = $Click['Click']['_x']-$bCenterW;
		@$controlledy = $Click['Click']['_y']-$bCenterh;
	}
}
if (empty($Click['Click']['_x'])) {
    $controlledx = rand(0,$width);
    $controlledy = rand(0,$height);
}

            //copy each png file on top of the destination (result) png
            imagecopy($dest_image, $a, rand(0,$width), rand(0,$height), 0, 0, imagesx($a), imagesy($a));
            imagecopy($dest_image, $b, $controlledx, $controlledy, 0, 0, $bwidth, $bheight);
            imagecopy($dest_image, $c, rand(0,$width), rand(0,$height), 0, 0, imagesx($c), imagesy($c));

            //send the appropriate headers and output the image in the browser
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