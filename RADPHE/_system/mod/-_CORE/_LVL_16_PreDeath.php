<?php if (!isset($_GET['ShowLongestRoute'])) { ?>
	<h1>The Long Route</h1>
<?php include($_SERVER['DOCUMENT_ROOT'].'/_system/mod/_00_DumpTHAT/_dBug_CMS_mini.php');
	$_INCLUDES[]=array_diff(get_included_files(),$_INCLUDES[array_key_last($_INCLUDES)]);
	echo '<pre>';
	var_export($_INCLUDES[array_key_last($_INCLUDES)]);
	echo '</pre>';

	bench('JOGGED');

	$_INTIN['Init']['Stats']['Time Report']['Report']=mini_bench_to($_INTIN['Init']['Stats']['Time'],false,NULL,NULL).'<br><b><u>ENV</u></b>: <sub>Hosting&nbsp;Scenario:&nbsp;Primary&nbsp;Web&nbsp;w/sub&nbsp;webs&nbsp;(Phisical)&nbsp;Private&nbsp;Server</sub> <sup>Server&nbsp;Load:&nbsp;'.@$EnvInfo['fs'].'</sup>';
	$_INTIN['Init']['Stats']['Time Report']['Data']=mini_bench_to($_INTIN['Init']['Stats']['Time'],true);

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
					($_INTIN['Init']['Stats']['Memory']['FINAL']['peak']-$_INTIN['Init']['Stats']['Memory']['RENDERED']['usage'])
					), 0, '.', ','). "&nbsp;b</sub>";

	echo '<br><b><u>EXE</u></b>: ';
	echo $_INTIN['Init']['Stats']['Time Report']['Report'];
	echo '</div><br><a id="bottom" name="bottom"></a>';
	echo '<h2>From The TOP!</h2><pre>';
	var_export(get_included_files());
	echo '</pre>';
	new dBugM($GLOBALS);
}
?>
