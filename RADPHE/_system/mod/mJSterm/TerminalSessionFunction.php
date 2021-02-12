<?php
@require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php');//Fallback Hook.

/*if(extension_loaded('gd')) {
    print_r(gd_info());
}
else {
    echo 'GD is not available.';
}

if(extension_loaded('imagick')) {
    $imagick = new Imagick();
    print_r($imagick->queryFormats());
}
else {
    echo 'ImageMagick is not available.';
}
return;*/

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
$bCenterW = ($bwidth/2);
$bCenterh = ($bheight/2);
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
	if ($Click['HandledTS']===0) {
//	$_SESSIONthread['mJSterm']['TermClicks'][] = array('Click'=>$_POST['Term'],'TS'=>time(),'HandledTS'=>0,'FrameSerial'=>'');
		$_SESSIONthread['mJSterm']['TermClicks'][$ClickOrden]['HandledTS']=time();
		$DateTime = date('Y-m-d H:i:s');
		$NewDateTime = date('Y-m-d H:i:s',strtotime($DateTime.' + 1 hour'));
		$result = mysqli_query($link,"REPLACE INTO Session SET Session_Id = '".session_id()."', Session_Expires = '".$NewDateTime."', Session_Data = '".serialize($_SESSIONthread)."'");
	}
	if (!isset($Click['Click']['_x'])) {
		$controlledx = $Click['Click']['_x']-$bCenterW;
		$controlledy = $Click['Click']['_y']-$bCenterh;
	} else {
		@$controlledx = $Click['Click']['_x']-$bCenterW;
		@$controlledy = $Click['Click']['_y']-$bCenterh;
	}
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
/*
// Layer clipart over texture and convert black to transparent (works)
$im = imagecreatetruecolor($width,$height);
imagecopy($im, $texture, 0, 0, 0, 0, $width, $height);
imagecopy($im, $clipart, 0, 0, 0, 0, $width, $height);    
imagecolortransparent($im, imagecolorclosest($clipart, 0, 0, 0));

// Layer above image with transparency over background (non-working)
$img = imagecreatetruecolor($width,$height);
imagecopymerge($img, $background, 0, 0, 0, 0, $width, $height, 100);
imagecopymerge($img, $im, 0, 0, 0, 0, $width, $height, 100);
header('Content-Type: image/png');

//imagepng($im); // Correctly outputs first step
imagejpeg($img); // Incorrectly outputs final result
imagedestroy($im);
//imagedestroy($img);
return $img;
*/



//return;



/*
 //fine no imgk! well GD then!
	// Create an Imagick object with transparent canvas /
	$img = new Imagick();
	$img->newImage($width, $height, new ImagickPixel('transparent'));

	// New ImagickDraw instance for ellipse draw /
	$draw = new ImagickDraw();
	// Set purple fill color for ellipse /
	$draw->setFillColor('#777bb4');
	// Set ellipse dimensions /
	$draw->ellipse($width / 2, $height / 2, $width / 2, $height / 2, 0, 360);
	// Draw ellipse onto the canvas /
	$img->drawImage($draw);

	// Reset fill color from purple to black for text (note: we are reusing ImagickDraw object) /
//	$draw->setFillColor('black');
	$draw->setFillColor(array_rand($colorArray, 1));
	// Set stroke border to white color /
	$draw->setStrokeColor('white');
	// Set stroke border thickness /
	$draw->setStrokeWidth(2);
	// Set font kerning (negative value means that letters are closer to each other) /
	$draw->setTextKerning(-8);
	// Set font and font size used in PHP logo /
	$draw->setFont('Handel Gothic.ttf');
	$draw->setFontSize(150);
	// Center text horizontally and vertically /
	$draw->setGravity(Imagick::GRAVITY_CENTER);

	// add center "php" with Y offset of -10 to canvas (inside ellipse) /
	$img->annotateImage($draw, 0, -10, 0, 'php');
	$img->setImageFormat('jpeg');

	return $img->getImageBlob();
	//* Set appropriate header for PNG and output the image /
*/
}
/*
if(extension_loaded('gd')) {
    print_r(gd_info());
}
else {
    echo 'GD is not available.';
}

if(extension_loaded('imagick')) {
    $imagick = new Imagick();
    print_r($imagick->queryFormats());
}
else {
    echo 'ImageMagick is not available.';
}
*/
?>