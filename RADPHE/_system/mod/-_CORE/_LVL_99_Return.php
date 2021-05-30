<?php
if (!isset($_GET['ShowLongestRoute'])) {
	echo '<h2>From The TOP!</h2><pre>';
	var_export(get_included_files());
	echo '</pre>';
	new dBugM($GLOBALS);
	die();
}
?>