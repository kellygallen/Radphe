<?php
/*
 ob_start();
 ob_start("ob_gzhandler");
 echo file_get_contents($filename);
 ob_end_flush();
 header('Content-Length: '.ob_get_length());
 ob_end_flush();
 * if GZ compress responce and you want acurate file size...
 *
 //TODO a core level thing where i work with headers to aupport GZ with right content length.
 */
if (empty($_INTIN['WoRkEr!'])) {
	@ob_flush();
	@flush();
	if (!isset($_GET['ShowLongestRoute'])) die();//nothing to implement yet... need something to work on.
} else {
	@ob_flush();
	@flush();
	sleep(10);//rest disk, connection send buffer so it can close, rest everything really.
}
//more like take a breather
?>