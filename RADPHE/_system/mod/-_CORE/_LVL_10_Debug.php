<?php
global $_INTIN;
bench('DEBUG');
//Auto Dev Debug
?>
<script type="text/javascript">
function toggleDiv(divId,alttriggerid,triggerid) {
  var x = document.getElementById(divId);
  var y = document.getElementById(alttriggerid);
  var z = document.getElementById(triggerid);
  var zend = document.getElementById("bottom");
    x.blur();
    y.blur();
    z.blur();
    x.focus();
    x.blur();
  if (x.style.display === "none") {
    x.style.display = "block";
    y.style.display = "none";
//    z.style.display = "none";
  } else {
    x.style.display = "none";
    y.style.display = "block";
//    z.style.display = "block";
  }
zend = document.getElementById("bottom");
zend.scrollIntoView();
zend.focus();
  return false;
}
</script>
<center><a href='javascript: ;' id="Trigger" accesskey="K" name="DevDebugPreKurser" onfocus='javascript: toggleDiv("dBug","AltTriggerFocus","Trigger");'><input id="AltTriggerFocus" type="button" style="display:none;" value="Performance &amp; dBug: Press Alt + Shift + K" onclick='javascript: toggleDiv("dBug","AltTriggerFocus","Trigger");'></a></center><br>
<div id='dBug' name='dBug' style=" background-color:#FFF; width:100%; display:none;">
<?php
//$_INTIN['Dump'][]='GLOBALS';
//$_INTIN['Dump'][]='_INTIN';
//Dump a resource like
/*$_INTIN['Dump'][]='namespace';
$_INTIN['Dump'][]='namespaces';
$_INTIN['Dump'][]='style';
$_INTIN['Dump'][]='_SERVER';
$_INTIN['Dump'][]='_REQUEST';
$_INTIN['Dump'][]='_POST';
$_INTIN['Dump'][]='_GET';
$_INTIN['Dump'][]='_FILES';
$_INTIN['Dump'][]='_ENV';
$_INTIN['Dump'][]='_COOKIE';
$_INTIN['Dump'][]='_SESSION';
$_INTIN['Dump'][]='GLOBALS';// It could be big.
$_INTIN['Debug']=1; //	force debug. i want yu to see this.

//else prefent this trigger.
//UNSET($_INTIN['Debug'],$_INTIN['Dump']);// force no debug.

//add your ip or wildIP to the list that cache\intin jogs prior to run
//$_INTIN['DevConfig']['RestrictAccess']['IP List'][]='127.0.0.2';
//uhh no that is primative down there.. its just in array so add exact ip to above, just copy lines and change the ip number that is all; it will build a list.
*/
//you might consider just dieing here... go ahead its probably better that way for production.
//die();

//TODO: so you can have your address in the access list array.
//$_SERVER["REMOTE_ADDR"] = isset($_SERVER["REMOTE_ADDR"]) ? $_SERVER["REMOTE_ADDR"] : '127.0.0.1';
//once you realize what your doing... then not above line... comment it out. might be a fake php hosting thing...
$_INTIN['DevConfig']['RestrictAccess']['IP List'][] = $_SERVER["REMOTE_ADDR"]; //lets call that a temporary go as well.
//$_INTIN['Debug'][]='_POST';
//$_INTIN['Debug'][]='_GET';
//$_INTIN['Dump'][]='_FILES';

//For internal loopback or application firewalling if you so choose.
$_INTIN['DevConfig']['RestrictAccess']['IP List'][]='127.0.0.1';
if(
    (
        (
            (!empty($_INTIN['Debug']))||
            (!empty($_INTIN['Dump']))
        )&&
        (
            (@$_INTIN['Load Status']['Request']['Show Debug']==1)
        )&&
        (in_array($_SERVER['REMOTE_ADDR'], $_INTIN['DevConfig']['RestrictAccess']['IP List']))&&
        (1)
    )
  ){
	bench('Debug Approved');
	//redundant but stopes privicy config concernes. built into cms mod. later session or debug ip bound.
	include($_SERVER['DOCUMENT_ROOT'].'/_system/class/dBug/public_mask.php');	//Maximized Normal dBug
	//for now 'regular' in place function runs without public mask.
	include_once($_SERVER['DOCUMENT_ROOT'].'/_system/class/dBug/dBug.php');	//cms modual
//	include_once($_SERVER['DOCUMENT_ROOT'].'/_system/class/dBug/_dBug.regular.php');	//patched/upgraded original unmasked

	if (!empty($_INTIN['Error'])) {
		echo '<h2>Errors</h2>';
		new dBug($_INTIN['Error']);
	}
	if (!empty($_INTIN['Dump'])) { //pass var by referance should follow.
		echo '<h2>Dump</h2>';
		foreach($_INTIN['Dump'] as $newDBugOrden => $newDBug){
			echo '<br><hr><h3>$'.$newDBug.'</h3>';
			if (!empty($newDBug)) if (isset($$newDBug)) if ($newDBug!=='GLOBALS') {
				eval("new dBug($$newDBug);");
			} else eval("new dBugM($$newDBug);");
		}
//		echo '<h3>phpinfo()</h3>';
//		phpinfo();
//		new dBugM($GLOBALS);
	}
	echo '<h2>Ingrediants</h2>';
	new dBugM(get_included_files());
	echo '<h2>Stack Details</h2>';
	echo '<pre>'.var_dump(debug_print_backtrace(true,true)).'</pre><hr>';
//	echo '<h2>Globals</h2>';
//	new dBugM($GLOBALS);
//		new dBugM($_INTIN['MOD']['CMS']['Blocks']);
//		new dBug($_INTIN['MOD']['SEO']['Keywords']);
//		new dBugM(@$_INTIN['MOD']['SEO']);
//		new dBug($_INTIN['MOD']['SEO']['RemovedKeywords']);
	echo '<br>When running in debug mode memory usage is double. It takes extra ram to format code for display.<br>';
} else {
	echo '<br>Running in public benchmark mode.<br>';
	echo '<h2>Ingrediants</h2>';
	var_export(get_included_files());
	//	include($_SERVER['DOCUMENT_ROOT'].'/_system/class/dBug/public_mask.php');	//Maximized Normal dBug
	bench('Public Report');
}

	bench('Bench Report');
	$_INTIN['Init']['Stats']['Time Report']['Report']=mini_bench_to($_INTIN['Init']['Stats']['Time']);
	bench('FINAL');


	//Get system load factor.
//TODO: Cash on disk and run if within timiing.
	$os = strtolower(PHP_OS);
	if(strpos($os, "win") === false) {
		if ( @file_exists('/proc/loadavg') ) {
			$data = file_get_contents('/proc/loadavg');
			$loads = explode(' ', $data);
			$EnvInfo['fs'] = $loads[0];
		}
	}
	$EnvInfo['pid'] = getpidinfo();
//TODO://Get system load factor.

	$_INTIN['Init']['Stats']['Time Report']['Report']=mini_bench_to($_INTIN['Init']['Stats']['Time'],false,NULL,NULL).'<br><b><u>ENV</u></b>: <sub>Hosting&nbsp;Scenario:&nbsp;Primary&nbsp;Web&nbsp;w/sub&nbsp;webs&nbsp;(Phisical)&nbsp;Private&nbsp;Server</sub> <sup>Server&nbsp;Load:&nbsp;'.@$EnvInfo['fs'].'</sup>';/* <sub>Visits&nbsp;'.@$_GoogleAnalytics['VPHLast'].'/hour</sub> <sup>Views&nbsp;'.@$_GoogleAnalytics['PageViewsTotal'].'/day</sup> <sub>Visitors&nbsp;'.@$_GoogleAnalytics['VisitorsTotal'].'/day</sub>';*/
	$_INTIN['Init']['Stats']['Time Report']['Data']=mini_bench_to($_INTIN['Init']['Stats']['Time'],true);

//	echo '<center>';
	echo '<b><u>MEMORY</u></b>: <sub>Final:&nbsp;<b>' .number_format($_INTIN['Init']['Stats']['Memory']['FINAL']['usage'], 0, '.', ','). "</b>&nbsp;b</sub>";
	echo ' <sup>Peak:&nbsp;' .number_format($_INTIN['Init']['Stats']['Memory']['FINAL']['peak'], 0, '.', ','). "&nbsp;b</sup>";
	echo ' <sub>System&nbsp;Base:&nbsp;' .number_format($_INTIN['Init']['Stats']['Memory']['BEGIN']['usage'], 0, '.', ','). "&nbsp;b</sub>";
	echo ' <sup>Site&nbsp;Engine:&nbsp;' .number_format(
		(
			($_INTIN['Init']['Stats']['Memory']['APP START']['usage']-$_INTIN['Init']['Stats']['Memory']['BEGIN']['usage'])+
			($_INTIN['Init']['Stats']['Memory']['READY']['usage']-$_INTIN['Init']['Stats']['Memory']['APP DONE']['usage'])+
			($_INTIN['Init']['Stats']['Memory']['FINAL']['usage']-$_INTIN['Init']['Stats']['Memory']['REQUEST LOADED']['usage'])
		), 0, '.', ','). "&nbsp;b</sup>";
	echo ' <sub>Application:&nbsp;' .number_format(
		(
			($_INTIN['Init']['Stats']['Memory']['APP DONE']['usage']-$_INTIN['Init']['Stats']['Memory']['APP START']['usage'])
		), 0, '.', ','). "&nbsp;b</sub>";
	echo ' <sup>Request:&nbsp;' .number_format(
		(
			($_INTIN['Init']['Stats']['Memory']['REQUEST LOADED']['usage']-$_INTIN['Init']['Stats']['Memory']['READY']['usage'])
		), 0, '.', ','). "&nbsp;b</sup>";
	echo ' <sub>DEBUG&nbsp;REPORT:&nbsp;' .number_format(
		(
//			($_INTIN['Init']['Stats']['Memory']['FINAL']['usage']-$_INTIN['Init']['Stats']['Memory']['DEBUG']['usage'])+
			($_INTIN['Init']['Stats']['Memory']['FINAL']['peak']-$_INTIN['Init']['Stats']['Memory']['RENDERED']['usage'])
		), 0, '.', ','). "&nbsp;b</sub>";

	echo '<br><b><u>EXE</u></b>: ';
	echo $_INTIN['Init']['Stats']['Time Report']['Report'];
//	echo 'Total: ' .$_INTIN['Init']['Stats']['Time']['Length']['Execution']. " ";
//	echo '</center>';
echo '</div><br><a id="bottom" name="bottom"></a>';



//The End
die();
?>