<?php //@require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php'); eval(RadpheFallBackHook);
global $_INTIN;
//test link.
$link = @mysqli_connect("localhost","mod_mJSterm","","radphe");
 
include_once($_SERVER['DOCUMENT_ROOT'].'/_system/function/array_filter_by_key.php');
if (!defined('TRACKING_FILTER_test')) define('TRACKING_FILTER_test',['GLOBALS','_INTIN','KERNEL','Dump','_it']);
 
echo '<pre>';
include($_SERVER['DOCUMENT_ROOT'].'/_system/MOD/_00_DumpTHAT/_dBug_CMS_mini.php');
//new dBugM(get_defined_vars());
$_it[] = request_filter(get_defined_vars(), TRACKING_FILTER_test);
$var=0;
$_it[] = request_filter(get_defined_vars(), TRACKING_FILTER_test);
$var++;
$_it[] = request_filter(get_defined_vars(), TRACKING_FILTER_test);
$var++;
$test=1111111;
$_it[] = request_filter(get_defined_vars(), TRACKING_FILTER_test);

$var++;
$_it[] = request_filter(get_defined_vars(), TRACKING_FILTER_test);
$var++;
$_it[] = request_filter(get_defined_vars(), TRACKING_FILTER_test);
//var_dump($_it);
$intr=0;
$that['(allmost) all']=@request_filter(get_defined_vars(), TRACKING_FILTER_test);
$that[$intr]=@array_diff_assoc($_it[$intr+1],$_it[$intr++]);
$that[$intr]=@array_diff_assoc($_it[$intr+1],$_it[$intr++]);
$that[$intr]=@array_diff_assoc($_it[$intr+1],$_it[$intr++]);
$that[$intr]=@array_diff_assoc($_it[$intr+1],$_it[$intr++]);
$that[$intr]=@array_diff_assoc($_it[$intr+1],$_it[$intr++]);
$that[$intr]=@array_diff_assoc($_it[$intr+1],$_it[$intr++]);
$that[$intr]=@array_diff_assoc($_it[$intr+1],$_it[$intr++]);
$that[$intr]=@array_diff_assoc($_it[$intr+1],$_it[$intr++]);
$that[$intr]=@array_diff_assoc($_it[$intr+1],$_it[$intr++]);

new dBug($that);
?>