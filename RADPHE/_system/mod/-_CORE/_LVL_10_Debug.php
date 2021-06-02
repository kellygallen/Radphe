<?php
if ($_INTIN['Load Status']['Request']['Show Debug']!=1) return "";
global $_INTIN;
bench('DEBUG');
?>
<hr>
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
  } else {
    x.style.display = "none";
    y.style.display = "block";
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
$_INTIN['DevConfig']['RestrictAccess']['IP List'][] = $_SERVER["REMOTE_ADDR"];
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
	include($_SERVER['DOCUMENT_ROOT'].'/_system/mod/_00_DumpTHAT/public_mask.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/_system/mod/_00_DumpTHAT/_dBug_CMS_mini.php');
	if (!empty($_INTIN['Error'])) {
		echo '<h2>Errors</h2>';
		new dBug($_INTIN['Error']);
	}
	if (!empty($_INTIN['Dump'])) {
		echo '<h2>Dump</h2>';
		new dBugM($_INTIN['Dump']);
		//if you want to see globals you have to do it expanded.
		//new dBug($GLOBALS);

	}
	echo '<br><hr><h3> </h3>';
	echo '<h2>Ingredients</h2>';
	new dBugM(get_included_files());
	echo '<br><hr><h3> </h3>';
	echo '<h2>Stack Details</h2>';
	echo '<pre>';
	$e = new Exception();
	print_r(str_replace(realpath($_SERVER['DOCUMENT_ROOT']), '', $e->getTraceAsString()));
	echo '</pre><hr>';
	echo '<br>When running in debug mode memory usage is double. It takes extra ram to format code for display.<br>';
} else {
	echo '<br>Running in public benchmark mode.<br>';
	include($_SERVER['DOCUMENT_ROOT'].'/_system/mod/_00_DumpTHAT/public_mask.php');
	bench('Public Report');
}
	bench('Bench Report');
	$_INTIN['Init']['Stats']['Time Report']['Report']=mini_bench_to($_INTIN['Init']['Stats']['Time']);
	bench('FINAL');


	$os = strtolower(PHP_OS);
	if(strpos($os, "win") === false) {
		if ( @file_exists('/proc/loadavg') ) {
			$data = file_get_contents('/proc/loadavg');
			$loads = explode(' ', $data);
			$EnvInfo['fs'] = $loads[0];
		}
	}
	$EnvInfo['pid'] = getpidinfo();

	$_INTIN['Init']['Stats']['Time Report']['Report']=mini_bench_to($_INTIN['Init']['Stats']['Time'],false,NULL,NULL).'<br><b><u>ENV</u></b>: <sub>Hosting&nbsp;Scenario:&nbsp;Primary&nbsp;Web&nbsp;w/sub&nbsp;webs&nbsp;(Phisical)&nbsp;Private&nbsp;Server</sub> <sup>Server&nbsp;Load:&nbsp;'.@$EnvInfo['fs'].'</sup>';
	$_INTIN['Init']['Stats']['Time Report']['Data']=mini_bench_to($_INTIN['Init']['Stats']['Time'],true);

	echo '<b><u>MEMORY</u></b>: <sub>Final:&nbsp;<b>' .number_format($_INTIN['Init']['Stats']['Memory']['FINAL']['usage'], 0, '.', ','). "</b>&nbsp;b</sub>";
	echo ' <sup>Peak:&nbsp;' .number_format($_INTIN['Init']['Stats']['Memory']['FINAL']['peak'], 0, '.', ','). "&nbsp;b</sup>";
	echo ' <sub>System&nbsp;Base:&nbsp;' .number_format($_INTIN['Init']['Stats']['Memory']['BEGIN']['usage'], 0, '.', ','). "&nbsp;b</sub>";
	echo ' <sup>Site&nbsp;Engine:&nbsp;' .number_format(
		(
			($_INTIN['Init']['Stats']['Memory']['APP START']['usage']-$_INTIN['Init']['Stats']['Memory']['BEGIN']['usage'])+
			($_INTIN['Init']['Stats']['Memory']['READY']['usage']-$_INTIN['Init']['Stats']['Memory']['APP DONE']['usage'])+
			@($_INTIN['Init']['Stats']['Memory']['FINAL']['usage']-@$_INTIN['Init']['Stats']['Memory']['REQUEST LOADED']['usage'])
		), 0, '.', ','). "&nbsp;b</sup>";
	echo ' <sub>Application:&nbsp;' .number_format(
		(
			($_INTIN['Init']['Stats']['Memory']['APP DONE']['usage']-$_INTIN['Init']['Stats']['Memory']['APP START']['usage'])
		), 0, '.', ','). "&nbsp;b</sub>";
	echo ' <sup>Request:&nbsp;' .number_format(
		(
			@(@$_INTIN['Init']['Stats']['Memory']['REQUEST LOADED']['usage']-$_INTIN['Init']['Stats']['Memory']['READY']['usage'])
		), 0, '.', ','). "&nbsp;b</sup>";
	echo ' <sub>DEBUG&nbsp;REPORT:&nbsp;' .number_format(
		(
			($_INTIN['Init']['Stats']['Memory']['FINAL']['peak']-$_INTIN['Init']['Stats']['Memory']['RENDERED']['usage'])
		), 0, '.', ','). "&nbsp;b</sub>";

	echo '<br><b><u>EXE</u></b>: ';
	echo $_INTIN['Init']['Stats']['Time Report']['Report'];
echo '</div><br><a id="bottom" name="bottom"></a>';
?>