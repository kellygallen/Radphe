<?php @require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php'); eval(RadpheFallBackHook);
	$_INTIN['Load Status']['Request']['Show Bench'] = '0';
	$_INTIN['Load Status']['Request']['Show Debug'] = '0';
	$_INTIN['Load Status']['Request']['Micro Debug'] = '0';
	
//FOR Production ONLY - 'No Help'.
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);
//				echo $_INTIN['MOD']['CMS']['Blocks']['Request'];

if (isset($_GET['Info'])) {
	switch ($_GET['Info']) {
		case 'Info':
			ob_start();
			echo '<h2>_GET Info</h2>';
			echo 'Server is Production<br>';
			@$_INTIN['MOD']['CMS']['Blocks']['SupplementaryContent'] .= ob_get_clean();
			@ob_end_flush();
			break;
	}
//	return;
}
if (isset($_GET['DevInfo'])) {
	switch ($_GET['DevInfo']) {
		case 'phpinfo':
			function phpinfo_array($return=false){
				/* Andale!  Andale!  Yee-Hah! */
				ob_start();
				phpinfo(-1);

				$pi = preg_replace(
						array('#^.*<body>(.*)</body>.*$#ms', '#<h2>PHP License</h2>.*$#ms',
								'#<h1>Configuration</h1>#',  "#\r?\n#", "#</(h1|h2|h3|tr)>#", '# +<#',
								"#[ \t]+#", '#&nbsp;#', '#  +#', '# class=".*?"#', '%&#039;%',
								'#<tr>(?:.*?)" src="(?:.*?)=(.*?)" alt="PHP Logo" /></a>'
								.'<h1>PHP Version (.*?)</h1>(?:\n+?)</td></tr>#',
								'#<h1><a href="(?:.*?)\?=(.*?)">PHP Credits</a></h1>#',
								'#<tr>(?:.*?)" src="(?:.*?)=(.*?)"(?:.*?)Zend Engine (.*?),(?:.*?)</tr>#',
								"# +#", '#<tr>#', '#</tr>#'),
						array('$1', '', '', '', '</$1>' . "\n", '<', ' ', ' ', ' ', '', ' ',
								'<h2>PHP Configuration</h2>'."\n".'<tr><td>PHP Version</td><td>$2</td></tr>'.
								"\n".'<tr><td>PHP Egg</td><td>$1</td></tr>',
								'<tr><td>PHP Credits Egg</td><td>$1</td></tr>',
								'<tr><td>Zend Engine</td><td>$2</td></tr>' . "\n" .
								'<tr><td>Zend Egg</td><td>$1</td></tr>', ' ', '%S%', '%E%'),
						ob_get_clean());

				$sections = explode('<h2>', strip_tags($pi, '<h2><th><td>'));
				unset($sections[0]);

				$pi = array();
				foreach($sections as $section){
					$n = substr($section, 0, strpos($section, '</h2>'));
					preg_match_all(
							'#%S%(?:<td>(.*?)</td>)?(?:<td>(.*?)</td>)?(?:<td>(.*?)</td>)?%E%#',
							$section, $askapache, PREG_SET_ORDER);
					foreach($askapache as $m)
						$pi[$n][$m[1]]=(!isset($m[3])||$m[2]==$m[3])?$m[2]:array_slice($m,2);
				}
				if ($return == 2) return var_dump($pi);
				return ($return === false) ? print_r($pi) : $pi;
			}
			ob_start();
			echo '<h2>_GET DevInfo</h2>';
			echo '<h1>PHP INFO only on DEV.</h1>';
			echo '<h2>Well Not Direct Anyway.</h2>';
			echo '<textarea style="border:1px solid #999999; width:90%; margin:5px 0; padding:3px;" cols="200" rows="30" disabled>';
			phpinfo_array();
			echo '</textarea><hr>';
/*			$testphpinfocodecolor='<?php '.phpinfo_array(2);
			$testphpinfocodecolor = highlight_string($testphpinfocodecolor, true);
			echo $testphpinfocodecolor;
			$_INTIN['Debug'][]='$testphpinfocodecolor';
*/			@$_INTIN['MOD']['CMS']['Blocks']['SupplementaryContent'] .= ob_get_clean();
			@ob_end_flush();
			break;
	}
//	return;
}
?>