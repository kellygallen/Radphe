<?php
@require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php');//Fallback Hook.

function include_closest($Filename, $IncludeFn=NULL, $Direction='<',$Steps=10) {
	global $_INTIN;
	$Level=0;
	//Direction > Deeper, < To Root
	//Steps NULL is no limit, 0-+ stop searching when level is reached
	$RequestPath = pathinfo($_SERVER['REQUEST_URI']);
	list($HOLDER,$ScriptPath) = explode($_SERVER['DOCUMENT_ROOT'],__FILE__);
	$ScriptPath = pathinfo($ScriptPath);
	$FilenamePath = pathinfo($Filename);
	if ($FilenamePath['dirname']=='.') {
		$Target = $ScriptPath['dirname'].'/'.$FilenamePath['basename'];
	} else $Target = $Filename;

	$TryPath = array();
	$TryPath[] = $Filename; //Most obviously the closest.
	$TargetPath = pathinfo($Target);
	if ($Direction == '<') {
		$Levels = explode('/',$TargetPath['dirname']);
		$LevelCount = count($Levels);
		for($Level=1; $Level<=$LevelCount; $Level++) {
			$RPath = realpath($_SERVER['DOCUMENT_ROOT'].'/.'.substr($Target,0,strripos($Target, $Levels[($LevelCount-$Level)])+strlen($Levels[($LevelCount-$Level)])).'/'.$TargetPath['basename']);
			if (($Level < $Steps)&&($RPath !== FALSE)) {
				$TryPath[] = $RPath;
			}
		}
	}elseif($Direction == '>'){
	} else {
		//backtrace 
		error_log("include_closest() is lacking direction. > Deeper, < To Root. Called by:", 0);
		return FALSE;
	}

	foreach ($TryPath as $Order => $Path) {
		if (file_exists($Path)) {
			global $_INTIN;
			switch($IncludeFn){
				case 'include':
					include($Path);
					break;
				case 'include_once':
					include_once($Path);
					break;
				case 'require':
					require($Path);
					break;
				case 'require_once':
					require_once($Path);
					break;
				default:
					include($Path);
					break;
			}
			return TRUE;
		}
	}

/*
echo "<pre>";
echo var_dump($RequestPath);
echo var_dump($ScriptPath);
echo var_dump($FilenamePath);
echo var_dump($TargetPath);
echo var_dump($Levels);
echo var_dump($LevelCount);
echo var_dump($TryPath);
echo var_dump($TryPatha);
echo "</pre>";*/
	return FALSE;
}

?>