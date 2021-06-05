<?php
@require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php');//Fallback Hook.
ob_start();
$boundary = "my_mjpeg";
header_remove();
header("Cache-Control: no-cache");
header("Cache-Control: private");
header("Pragma: no-cache");
header("Content-type: multipart/x-mixed-replace; boundary=$boundary");
print "--$boundary\n";
@set_time_limit(20);
@setenv('no-gzip', 1);
@ini_set('zlib.output_compression', 0);
@ini_set('implicit_flush', 1);
for ($i = 0; $i < ob_get_level(); $i++)
	ob_end_flush();
ob_implicit_flush(1);
include(__DIR__.'/TerminalSessionFunction.php');// and get_one_jpeg function.
	$count=1;
while (true) {
	$count++;
	print "Content-type: image/jpeg\n\n";
	@sleep(1) or @skippy_sleep(1);
	print get_one_jpeg();
	print "--$boundary\n";
	if ($count >=65500 ) break;
}
?>