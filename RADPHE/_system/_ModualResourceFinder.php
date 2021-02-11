<?php

//Cant get below the site root.
	//if () //site engine not outside of wwwroot.
	ini_set('open_basedir', $_SERVER['DOCUMENT_ROOT']);

//Errors should be off for this but html error are even worse.
	ini_set('html_errors', false);
//	ini_set('display_errors', 0);
//	ini_set('display_startup_errors', 0);
//	error_reporting(E_ALL);


//	ob_clean();
	//Nothing to return yet.
	$foundInMod = 0;

	//What are we looking for?
	//Routed from URL or Mod_ReWrite
	if (!empty($_GET['Resource'])) {
		$filename = $_GET['Resource'];
	//A Seceret Post Method Resources.
	} elseif (!empty($_POST['Resource'])) {
		$filename = $_POST['Resource'];
	//ELSE Strip to request side path filename.
	} else $filename = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
//	echo '<hr>'.$filename.'<hr>'; //See what your working with.

	//Is this becasue .htaccess says if its not a DIR or FILE that exists, then ________?
	//Perhaps it is a default index file.
	if (is_dir($_SERVER['DOCUMENT_ROOT'].'/'.$filename)) {
		$filename.='/index.php';
//	echo '<hr>'.$filename.'<hr>'; //See what your working with.
		if (file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$filename)) {
			//Its a default index file. It will be included as PHP_Self.
			return;
		} else {
			//Its Still Missing, not found.
		}
	}


	//If a resource being requested can be decerned.
	if (!empty($filename)){
		// required for IE, otherwise Content-disposition is ignored
	//	if(ini_get('zlib.output_compression')) ini_set('zlib.output_compression', 'Off');
		$file_extension = strtolower(substr(strrchr($filename,"."),1));

		//What not to allow.
		$Deny = 0;	//Dont Deny.
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

		//Assemble locations and structures to look through.
		$ModResourceLocations = array();
		$ModResourceLocationsPub = array();
		$ModualInstances = array();
		$ModResourceLocations[] = '_system/layout';
		$ModResourceLocations[] = '_system/class';
		$ModResourceLocations[] = '_system/mod';
		foreach ($ModResourceLocations as $MRLsI => $MRLSearch) {
			$ModualInstances = glob($_SERVER['DOCUMENT_ROOT'].'/'.$MRLSearch.'/*/_Resources/'.$filename);
	//echo '<pre>'; echo var_dump($ModualInstances); echo '</pre><hr>';
			if ($ModualInstances === FALSE) {
				//continue;
			} else foreach ($ModualInstances as $MRLfI => $MRLfound) { 
				$ModResourceLocationsPub[] = $MRLfound;
			}
		}
		$foundInMod = 0;
	//echo '<pre>'; echo var_dump($ModResourceLocationsPub); echo '</pre><hr>';
		if (!isset($ModResourceLocationsPub[0])) return;
		$LayoutsPath = $ModResourceLocationsPub[0];
		if (( $filename == "" ) || ( ! file_exists( realpath($LayoutsPath) ) ) || ($Deny==1)) {
			return;
		} else $foundInMod = 1;

	} else {
		return;
/*		$Err404 = <<<ENDOFSTRING
<center><h1 style="background: rgb(255, 255, 255) none repeat scroll 0%; margin-top: 0pt; -moz-background-clip: -moz-initial; -moz-background-origin: -moz-initial; -moz-background-inline-policy: -moz-initial; color: rgb(0, 0, 0);">Not Found</h1>
<div>The requested URL was not found on this server.</div>
<hr>
ENDOFSTRING;
		http_response_code(404);*/
	}

if($foundInMod){
//TODO set to request, ignore 404. set to NULL if does not equate to a real file.
//	$filename = $_GET['file'];

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

	// Get last modification time of the current PHP file
	$file_last_mod_time = filemtime(__FILE__);
	// Get last modification time of the main content (that user sees)
	$content_last_mod_time = filemtime($LayoutsPath);
	//$LayoutsPathParts= pathinfo($LayoutsPath);
	$ModualRelativeLocation = str_replace($_SERVER["DOCUMENT_ROOT"].'_system/','',$LayoutsPath);
	// Combine both to generate a unique ETag for a unique content
	// Specification says ETag should be specified within double quotes
	$etag = '"' . $file_last_mod_time . '.' .$ModualRelativeLocation. '.' . $content_last_mod_time . '.'.filesize($LayoutsPath).'"';
	//rEMOVE HEADERS AND START BUILDING THEM OVER.
	header_remove(); 
	//should be useing set'top'block
	switch( $file_extension ) {
		case  "php":
			http_response_code(200);
			if (0) {//To run
				@ob_clean();
				include($LayoutsPath);
				die();
			} else {//insert to parent block
				include($LayoutsPath);
				return;
			}
		case  "htm":
		case  "html":
			http_response_code(200);
			if (0) {//To run
				@ob_clean();
				echo file_get_contents ( $LayoutsPath , false);
				die();//run over
			} else {//insert to parent block
				echo file_get_contents ( $LayoutsPath , false);
				return;
			}
			break;
		default: break;
	}
	// Set Cache-Control header
	header('Cache-Control: max-age=86400');
	// Set ETag header
	header('ETag: ' . $etag);
	// Check whether browser had sent a HTTP_IF_NONE_MATCH request header
	if(isset($_SERVER['HTTP_IF_NONE_MATCH'])) {
		if($_SERVER['HTTP_IF_NONE_MATCH'] == $etag) {
			header('HTTP/1.1 304 Not Modified', true, 304);
			exit();
		}
	}
	header("Pragma: public"); // required
	header("Expires: 0");
	header("Content-Type: $ctype");
	header("Content-Length: ".filesize($LayoutsPath));
	readfile($LayoutsPath);
	exit();
}
?>