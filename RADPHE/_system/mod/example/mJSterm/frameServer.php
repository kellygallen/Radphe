<?php
@require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php');//Fallback Hook.
/* thats not good
on free production server...
Warning: set_time_limit() has been disabled for security reasons in /home/vol12_1/epizy.com/epiz_27737017/htdocs/_system/mod/mJSterm/frameServer.php on line 18
Content-type: image/jpeg


Warning: sleep() has been disabled for security reasons in /home/vol12_1/epizy.com/epiz_27737017/htdocs/_system/mod/mJSterm/frameServer.php on line 41
WONT WORK*/
ob_start();
//https://ben-collins.blogspot.com/2010/06/php-sending-motion-jpeg.html
# Used to separate multipart
$boundary = "my_mjpeg";

# We start with the standard headers. PHP allows us this much
header_remove();
header("Cache-Control: no-cache");
header("Cache-Control: private");
header("Pragma: no-cache");
header("Content-type: multipart/x-mixed-replace; boundary=$boundary");

# From here out, we no longer expect to be able to use the header() function
print "--$boundary\n";

# Set this so PHP doesn't timeout during a long stream
//@set_time_limit(0);
@set_time_limit(20);

# Disable Apache and PHP's compression of output to the client
@setenv('no-gzip', 1);
@ini_set('zlib.output_compression', 0);
//TODO not working on fpm and nginx.
//https://www.jeffgeerling.com/blog/2016/streaming-php-disabling-output-buffering-php-apache-nginx-and-varnish

# Set implicit flush, and flush all current buffers
@ini_set('implicit_flush', 1);
for ($i = 0; $i < ob_get_level(); $i++)
	ob_end_flush();
ob_implicit_flush(1);

//get_one_jpeg function;
include(__DIR__.'/TerminalSessionFunction.php');// and get_one_jpeg function.

# The loop, producing one jpeg frame per iteration
	$count=1;
while (true) {
	$count++;
	# Per-image header, note the two new-lines
	print "Content-type: image/jpeg\n\n";

	# Your function to get one jpeg image
	@sleep(1) or @skippy_sleep(1);

//	error_log($test['ME'], 0);
	print get_one_jpeg();

	# The separator
	print "--$boundary\n";
	if ($count >=65500 ) break;
}
?>