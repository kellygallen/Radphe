<?php @require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php'); eval(RadpheFallBackHook);
	ini_set('open_basedir', $_SERVER['DOCUMENT_ROOT']);
	ini_set('html_errors', false);
	$_INTIN['MOD']['ResourceFinder']['found']['foundInMod'] = 0;
	if (!empty($_GET['Resource'])) {
		$_INTIN['MOD']['ResourceFinder']['search']['filename'] = $_GET['Resource'];
	} elseif (!empty($_POST['Resource'])) {
		$_INTIN['MOD']['ResourceFinder']['search']['filename'] = $_POST['Resource'];
	} else $_INTIN['MOD']['ResourceFinder']['search']['filename'] = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
	if (is_dir($_SERVER['DOCUMENT_ROOT'].'/'.$_INTIN['MOD']['ResourceFinder']['search']['filename'])) {
		$_INTIN['MOD']['ResourceFinder']['search']['filename'].='index.php';
		if (file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$_INTIN['MOD']['ResourceFinder']['search']['filename'])) {
			return;
		} else {
		}
	}
	if (!empty($_INTIN['MOD']['ResourceFinder']['search']['filename'])){
		$_INTIN['MOD']['ResourceFinder']['search']['file_extension'] = strtolower(substr(strrchr($_INTIN['MOD']['ResourceFinder']['search']['filename'],"."),1));
		$_INTIN['MOD']['ResourceFinder']['Deny'] = 0;
		if (!empty($_INTIN['MOD']['ResourceFinder']['DisallowedFiles'])) $_INTIN['MOD']['ResourceFinder']['DisallowedFiles'] = array();
//		$_INTIN['MOD']['ResourceFinder']['DisallowedFiles'][] = '.php';
//		$_INTIN['MOD']['ResourceFinder']['DisallowedFiles'][] = '.htm';
//		$_INTIN['MOD']['ResourceFinder']['DisallowedFiles'][] = '.html';
		$_INTIN['MOD']['ResourceFinder']['DisallowedFiles'][] = '.inc';
		$_INTIN['MOD']['ResourceFinder']['DisallowedFiles'][] = '.user.ini';
		$_INTIN['MOD']['ResourceFinder']['DisallowedFiles'][] = 'php.ini';
		$_INTIN['MOD']['ResourceFinder']['DisallowedFiles'][] = '.ini';
		$_INTIN['MOD']['ResourceFinder']['DisallowedFiles'][] = '.htaccess';
		$_INTIN['MOD']['ResourceFinder']['DisallowedFiles'][] = '..';
		$_INTIN['MOD']['ResourceFinder']['DisallowedFiles'][] = '%';
		$_INTIN['MOD']['ResourceFinder']['DisallowedFiles'][] = '&#';
		foreach ($_INTIN['MOD']['ResourceFinder']['DisallowedFiles'] as $FileNum => $FileType) {
			if (stripos($_INTIN['MOD']['ResourceFinder']['search']['filename'],$FileType) !== FALSE) $_INTIN['MOD']['ResourceFinder']['Deny'] =1;
		} unset($FileNum,$FileType);
		if (empty($_INTIN['MOD']['ResourceFinder']['ModResourceLocations'])) $_INTIN['MOD']['ResourceFinder']['ModResourceLocations'] = array();
		$_INTIN['MOD']['ResourceFinder']['ModResourceLocationsPub'] = array();
		$_INTIN['MOD']['ResourceFinder']['ModuleInstances'] = array();
		$_INTIN['MOD']['ResourceFinder']['ModResourceLocations'][] = '_system/mod/_00_StatelessOutputBuffer/Layouts';
		$_INTIN['MOD']['ResourceFinder']['ModResourceLocations'][] = '_system/class';
		$_INTIN['MOD']['ResourceFinder']['ModResourceLocations'][] = '_system/function';
		$_INTIN['MOD']['ResourceFinder']['ModResourceLocations'][] = '_system/mod';
		$_INTIN['MOD']['ResourceFinder']['ModResourceLocations'][] = '_system/mod/example';
	
		foreach ($_INTIN['MOD']['ResourceFinder']['ModResourceLocations'] as $MRLsI => $MRLSearch) {
			$_INTIN['MOD']['ResourceFinder']['ModuleInstances'] = glob($_SERVER['DOCUMENT_ROOT'].'/'.$MRLSearch.'/*/_Resources/'.$_INTIN['MOD']['ResourceFinder']['search']['filename']);
			if ($_INTIN['MOD']['ResourceFinder']['ModuleInstances'] === FALSE) {
			} else foreach ($_INTIN['MOD']['ResourceFinder']['ModuleInstances'] as $MRLfI => $MRLfound) {
				$_INTIN['MOD']['ResourceFinder']['ModResourceLocationsPub'][] = $MRLfound;
			}
		} unset($MRLsI,$MRLSearch,$MRLfound,$MRLfI);
		$_INTIN['MOD']['ResourceFinder']['found']['foundInMod'] = 0;
		if (!isset($_INTIN['MOD']['ResourceFinder']['ModResourceLocationsPub'][0])) return;
		$_INTIN['MOD']['ResourceFinder']['LayoutsPath'] = $_INTIN['MOD']['ResourceFinder']['ModResourceLocationsPub'][0];
		$_INTIN['MOD']['ResourceFinder']['LayoutsPath'] = preg_replace('/(\.){2,}/', '', $_INTIN['MOD']['ResourceFinder']['LayoutsPath']);
		$_INTIN['MOD']['ResourceFinder']['LayoutsPath'] = preg_replace('/(\/){2,}/', '/', $_INTIN['MOD']['ResourceFinder']['LayoutsPath']);
		$_INTIN['MOD']['ResourceFinder']['LayoutsPath'] = preg_replace('/(\.\/){2,}/', '/', $_INTIN['MOD']['ResourceFinder']['LayoutsPath']);
		$_INTIN['MOD']['ResourceFinder']['LayoutsPath'] = preg_replace('/(\/){2,}/', '/', $_INTIN['MOD']['ResourceFinder']['LayoutsPath']);
		if (( $_INTIN['MOD']['ResourceFinder']['search']['filename'] == "" ) || ( ! file_exists( realpath($_INTIN['MOD']['ResourceFinder']['LayoutsPath']) ) ) || ($_INTIN['MOD']['ResourceFinder']['Deny']==1)) {
			return;
		} else $_INTIN['MOD']['ResourceFinder']['found']['foundInMod'] = 1;

	} else {
		return;
	}
if($_INTIN['MOD']['ResourceFinder']['found']['foundInMod']){
	switch( $_INTIN['MOD']['ResourceFinder']['search']['file_extension'] ) {
		case "pdf": $_INTIN['MOD']['ResourceFinder']['found']['ctype']="application/pdf"; break;
		case "exe": $_INTIN['MOD']['ResourceFinder']['found']['ctype']="application/octet-stream"; break;
		case "zip": $_INTIN['MOD']['ResourceFinder']['found']['ctype']="application/zip"; break;
		case "doc": $_INTIN['MOD']['ResourceFinder']['found']['ctype']="application/msword"; break;
		case "xls": $_INTIN['MOD']['ResourceFinder']['found']['ctype']="application/vnd.ms-excel"; break;
		case "ppt": $_INTIN['MOD']['ResourceFinder']['found']['ctype']="application/vnd.ms-powerpoint"; break;
		case  "shtml":
		case  "txt":
		case  "php":
		case  "xml":
		case  "htm":
		case  "html": $_INTIN['MOD']['ResourceFinder']['found']['ctype']="text/html;"; break;
		case  "js": $_INTIN['MOD']['ResourceFinder']['found']['ctype']="application/x-javascript"; break;
		case "css": $_INTIN['MOD']['ResourceFinder']['found']['ctype']="text/css"; break;
		case "gif": $_INTIN['MOD']['ResourceFinder']['found']['ctype']="image/gif"; break;
		case "png": $_INTIN['MOD']['ResourceFinder']['found']['ctype']="image/png"; break;
		case "jpeg":
		case "jpg": $_INTIN['MOD']['ResourceFinder']['found']['ctype']="image/jpg"; break;
		default: $_INTIN['MOD']['ResourceFinder']['found']['ctype']="application/force-download";
	}
	$_INTIN['MOD']['ResourceFinder']['FINDER_last_mod_time'] = filemtime(__FILE__);
	$_INTIN['MOD']['ResourceFinder']['found']['content_last_mod_time'] = filemtime($_INTIN['MOD']['ResourceFinder']['LayoutsPath']);
	$_INTIN['MOD']['ResourceFinder']['found']['ModuleRelativeLocation'] = str_replace($_SERVER["DOCUMENT_ROOT"].'_system/','',$_INTIN['MOD']['ResourceFinder']['LayoutsPath']);
	$_INTIN['MOD']['ResourceFinder']['response']['etag'] = '"' . $_INTIN['MOD']['ResourceFinder']['FINDER_last_mod_time'] . '.' .$_INTIN['MOD']['ResourceFinder']['found']['ModuleRelativeLocation']. '.' . $_INTIN['MOD']['ResourceFinder']['found']['content_last_mod_time'] . '.'.filesize($_INTIN['MOD']['ResourceFinder']['LayoutsPath']).hash_file('md5',$_INTIN['MOD']['ResourceFinder']['LayoutsPath']).'"';
	header_remove();
	switch( $_INTIN['MOD']['ResourceFinder']['search']['file_extension'] ) {
		case  "php":
			header('HTTP/1.1 200 OK',true,200);
			if (0) {
				@ob_clean();
				include($_INTIN['MOD']['ResourceFinder']['LayoutsPath']);
				die();
			} else {
				include($_INTIN['MOD']['ResourceFinder']['LayoutsPath']);
				return;
			}
		case  "htm":
		case  "html":
			header('HTTP/1.1 200 OK',true,200);
			if (0) {
				@ob_clean();
				echo file_get_contents ( $_INTIN['MOD']['ResourceFinder']['LayoutsPath'] , false);
				die();
			} else {
				echo file_get_contents ( $_INTIN['MOD']['ResourceFinder']['LayoutsPath'] , false);
				return;
			}
			break;
		default: break;
	}
	bench('REQUEST LOADED');
	header('Cache-Control: max-age=86400');
	header('ETag: ' . $_INTIN['MOD']['ResourceFinder']['response']['etag']);
	if(isset($_SERVER['HTTP_IF_NONE_MATCH'])&&1) {//was maybe to aggressive; usually i dev with browser cache off
		if($_SERVER['HTTP_IF_NONE_MATCH'] == $_INTIN['MOD']['ResourceFinder']['response']['etag']) {
			header('HTTP/1.1 304 Not Modified', true, 304);
			exit();
		}
	}
	header("Content-Type: ".$_INTIN['MOD']['ResourceFinder']['found']['ctype']);
	header("Content-Length: ".filesize($_INTIN['MOD']['ResourceFinder']['LayoutsPath']));
	header("Pragma: public");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s", time()-10) . " GMT");
	header("Expires: " . gmdate("D, d M Y H:i:s", time() + 500) . " GMT");
	header("Cache-Control: max-age=5, s-maxage=5, cache, must-revalidate");

	readfile($_INTIN['MOD']['ResourceFinder']['LayoutsPath']);
	exit();
}
?>