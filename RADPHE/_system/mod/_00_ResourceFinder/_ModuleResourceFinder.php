<?php @require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php'); eval(RadpheFallBackHook);
	ini_set('open_basedir', $_SERVER['DOCUMENT_ROOT']);
	ini_set('html_errors', false);
	$foundInMod = 0;
	if (!empty($_GET['Resource'])) {
		$filename = $_GET['Resource'];
	} elseif (!empty($_POST['Resource'])) {
		$filename = $_POST['Resource'];
	} else $filename = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
	if (is_dir($_SERVER['DOCUMENT_ROOT'].'/'.$filename)) {
		$filename.='/index.php';
		if (file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$filename)) {
			return;
		} else {
		}
	}
	if (!empty($filename)){
		$file_extension = strtolower(substr(strrchr($filename,"."),1));
		$Deny = 0;
		$DisallowedFiles = array();
//		$DisallowedFiles[] = '.php';
//		$DisallowedFiles[] = '.htm';
//		$DisallowedFiles[] = '.html';
		$DisallowedFiles[] = '.inc';
		$DisallowedFiles[] = '.user.ini';
		$DisallowedFiles[] = 'php.ini';
		$DisallowedFiles[] = '.ini';
		$DisallowedFiles[] = '.htaccess';
		$DisallowedFiles[] = '..';
		$DisallowedFiles[] = '%';
		$DisallowedFiles[] = '&#';
		foreach ($DisallowedFiles as $FileNum => $FileType) {
			if (stripos($filename,$FileType) !== FALSE) $Deny =1;
		}
		$ModResourceLocations = array();
		$ModResourceLocationsPub = array();
		$ModuleInstances = array();
		$ModResourceLocations[] = '_system/mod/_00_StatelessOutputBuffer/Layouts';
		$ModResourceLocations[] = '_system/class';
		$ModResourceLocations[] = '_system/function';
		$ModResourceLocations[] = '_system/mod';
		$ModResourceLocations[] = '_system/mod/example';
		foreach ($ModResourceLocations as $MRLsI => $MRLSearch) {
			$ModuleInstances = glob($_SERVER['DOCUMENT_ROOT'].'/'.$MRLSearch.'/*/_Resources/'.$filename);
			if ($ModuleInstances === FALSE) {
			} else foreach ($ModuleInstances as $MRLfI => $MRLfound) {
				$ModResourceLocationsPub[] = $MRLfound;
			}
		}
		$foundInMod = 0;
		if (!isset($ModResourceLocationsPub[0])) return;
		$LayoutsPath = $ModResourceLocationsPub[0];
		$LayoutsPath = preg_replace('/(\.){2,}/', '', $LayoutsPath);
		$LayoutsPath = preg_replace('/(\/){2,}/', '/', $LayoutsPath);
		$LayoutsPath = preg_replace('/(\.\/){2,}/', '/', $LayoutsPath);
		$LayoutsPath = preg_replace('/(\/){2,}/', '/', $LayoutsPath);
		if (( $filename == "" ) || ( ! file_exists( realpath($LayoutsPath) ) ) || ($Deny==1)) {
			return;
		} else $foundInMod = 1;

	} else {
		return;
	}
if($foundInMod){
	switch( $file_extension ) {
		case "pdf": $ctype="application/pdf"; break;
		case "exe": $ctype="application/octet-stream"; break;
		case "zip": $ctype="application/zip"; break;
		case "doc": $ctype="application/msword"; break;
		case "xls": $ctype="application/vnd.ms-excel"; break;
		case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
		case  "shtml":
		case  "txt":
		case  "php":
		case  "xml":
		case  "htm":
		case  "html": $ctype="text/html;"; break;
		case  "js": $ctype="application/x-javascript"; break;
		case "css": $ctype="text/css"; break;
		case "gif": $ctype="image/gif"; break;
		case "png": $ctype="image/png"; break;
		case "jpeg":
		case "jpg": $ctype="image/jpg"; break;
		default: $ctype="application/force-download";
	}
	$file_last_mod_time = filemtime(__FILE__);
	$content_last_mod_time = filemtime($LayoutsPath);
	$ModuleRelativeLocation = str_replace($_SERVER["DOCUMENT_ROOT"].'_system/','',$LayoutsPath);
	$etag = '"' . $file_last_mod_time . '.' .$ModuleRelativeLocation. '.' . $content_last_mod_time . '.'.filesize($LayoutsPath).hash_file('md5',$LayoutsPath).'"';
	header_remove();
	switch( $file_extension ) {
		case  "php":
			header('HTTP/1.1 200 OK',true,200);
			if (0) {
				@ob_clean();
				include($LayoutsPath);
				die();
			} else {
				include($LayoutsPath);
				return;
			}
		case  "htm":
		case  "html":
			header('HTTP/1.1 200 OK',true,200);
			if (0) {
				@ob_clean();
				echo file_get_contents ( $LayoutsPath , false);
				die();
			} else {
				echo file_get_contents ( $LayoutsPath , false);
				return;
			}
			break;
		default: break;
	}
	bench('REQUEST LOADED');
	header('Cache-Control: max-age=86400');
	header('ETag: ' . $etag);
	if(isset($_SERVER['HTTP_IF_NONE_MATCH'])) {
		if($_SERVER['HTTP_IF_NONE_MATCH'] == $etag) {
			header('HTTP/1.1 304 Not Modified', true, 304);
			exit();
		}
	}
	header("Pragma: public");
	header("Expires: 0");
	header("Content-Type: $ctype");
	header("Content-Length: ".filesize($LayoutsPath));
	readfile($LayoutsPath);
	exit();
}
?>