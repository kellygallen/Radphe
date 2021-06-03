<?php @require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php'); eval(RadpheFallBackHook);
class CMS_Blocks{
	public static
		$Rendered=0;//set to one if already finished.
	private static
		$SEOcompile = 1,//Use SEO class intervention.
		$SKINcompile = 1,//Use Automatic Skinner class compile.
		$DEBUG_DIV=0,//Debug Blocks
		$DEBUG_DIE=0,//Debug Blocks and Die
		$BlockCurrentResource=NULL,//Name of current Block being built.
		$BlockCurrentLevel = 0,//ob_get_level of current Block being built.
		$ReplaceLevel = 0,//current recursive depth of obreplace call back.
		$ReplaceLevelMax = 15, //How many recursive obreplace calls were needed?
		$OBReplaceLastRun = FALSE,
		$ReplaceLevelCleanup = 0,
		$TopBlock = '', //output this if no output replaced on first call or obreplace.
		$BufferDeTag=1,//Make Buffers readable in dBug dump.
		$OBLevel = -1,//ob_get_level of this class. -1 means never initialized
		$OBTangentBlockName = NULL, //Currently limited to one instance.
		$SubBufferCMSLevel = NULL; //not used uet for OBTangentBlockName. and tangent sub blocks.

	const
		TagBlockHead = '#',
		TagBlockPart2Delimiter = ':',
		TagBlockPart3Delimiter = ';',
		TagBlockFoot = '#',
		TagPart1 = 'obj|mem|db|url|file|null|mod',
		TagPart2 = '[a-zA-Z0-9_\/\:\=\&\?]*',
		TagPart3 = '[a-zA-Z0-9_ \-\:\&\>\=]*',
		OBLEVELNAME = 'CMS_Blocks::obreplace',//obstart callback function name
		OBTanCalBack = 'CMS_Blocks::TangentBlockCallBack',
		DEBUG_DIV_INIT_STYLE = 'display:block; border:solid;',
		DEBUG_DIV_CMS_BLOCK_STYLE = 'display:block; border:dashed; margin:5px;';

	public static function __constructor(){
		self::init();
	}

	public static function getPrivateVar($Name) {
		if (isset(self::${$Name})) return self::${$Name};
		return NULL;
	}

	public static function SetTopBlock($Name=NULL) {
		if ((self::$BlockCurrentResource != NULL)&&($Name===NULL)) $Name=self::$BlockCurrentResource;
		self::$TopBlock=$Name;
		return TRUE;
	}

	public static function Debug($SetDiv=1,$SetDie=0,$BufferDeTag=0){
		self::$DEBUG_DIV = $SetDiv;
		self::$DEBUG_DIE = $SetDie;
		self::$BufferDeTag = $BufferDeTag;
	}

//	Enable Nestable block replacement.
	public static function init(){
		self::$OBLevel = ob_get_level();
		if (self::$DEBUG_DIV === 1) {
			echo "\r\n",'<div name=\'CMS_RecursiveOutputBlocks','__INIT','\' id=\'CMS_RecursiveOutputBlocks','__INIT','\' style=\'',self::DEBUG_DIV_INIT_STYLE,'\'>',"\r\n";
		} else {
			global $_INTIN;
			//Init NameSpace Used.
			if (!isset($_INTIN['MOD']['CMS']['Blocks'])) $_INTIN['MOD']['CMS']['Blocks'] = array();
			$_INTIN['MOD']['CMS']['Blocks']['NULL'] = '';
			ob_start(array('CMS_Blocks','obreplace'),0);
			self::$OBLevel=ob_get_level();
		}
	}

	public static function obreplace($buffer){
		global $_INTIN;
		$EmptyBuffer = 0;
		$ReplaceCount = 0;

		preg_match_all('/'.self::TagBlockHead.'('.self::TagPart1.')'.self::TagBlockPart2Delimiter.'('.self::TagPart2.')'.self::TagBlockPart3Delimiter.'('.self::TagPart3.')'.self::TagBlockFoot.'/i', $buffer, $matches, PREG_SET_ORDER);
			//$MatchArr[0] is full match
		if (empty($matches)) {
			$EmptyBuffer = 1;
		}
		if (($EmptyBuffer)&&(self::$TopBlock != '')&&(self::$OBReplaceLastRun === FALSE)&&(!isset($_INTIN['MOD']['CMS']['UsedBlocks'][self::$TopBlock]))) {
			$buffer = self::obreplace($buffer.self::TagBlockHead.'mem'.self::TagBlockPart2Delimiter.self::$TopBlock.self::TagBlockPart3Delimiter.'Render content with no seeds and Top Buffer specified'.self::TagBlockFoot);
			$_INTIN['MOD']['CMS']['Blocks'][NULL][1] = self::TagBlockHead.'mem'.self::TagBlockPart2Delimiter.self::$TopBlock.self::TagBlockPart3Delimiter.'Render content with no seeds and Top Buffer specified'.self::TagBlockFoot;
			return $buffer;
		} else
		foreach ($matches as $MatchNum=>$MatchArr) {
			$MatchArr[1] = strtolower($MatchArr[1]);
			//Replace Block with content or remove blocks without content.
			switch($MatchArr[1]){
				case 'obj':
				case 'mem':
					if (isset($_INTIN['MOD']['CMS']['Blocks'][$MatchArr[2]])) {
						if (!empty($_INTIN['MOD']['CMS']['Blocks'][$MatchArr[2]])) {
							if (self::$OBReplaceLastRun === TRUE) {
								$buffer = str_replace($MatchArr[0], "<!--- DEBUG: ".$MatchArr[0]." CMS Block with Content was not replaced due to recursion depth limits imposed by ReplaceLevelMax. Your probably placing a block that leads back to itself. --->", $buffer);
							} else $buffer = str_replace($MatchArr[0], $_INTIN['MOD']['CMS']['Blocks'][$MatchArr[2]], $buffer);
							$_INTIN['MOD']['CMS']['UsedBlocks'][$MatchArr[2]] = $MatchArr[0];
							$ReplaceCount++;
						} else {
							//Empty Tag Content
							//Remove Tag on last recursive instance
							if (self::$OBReplaceLastRun === TRUE) $buffer = str_replace($MatchArr[0], "", $buffer);
							$_INTIN['MOD']['CMS']['OrfanBlocks']['Empty'][$MatchArr[2]] = $MatchArr[0];
						}
					} else {
						//Orfan Tag
						//Remove Tag on last recursive instance
						if (self::$OBReplaceLastRun === TRUE) $buffer = str_replace($MatchArr[0], "", $buffer);
						$_INTIN['MOD']['CMS']['OrfanBlocks']['Missing'][$MatchArr[2]] = $MatchArr[0];
					}
					break;
				case 'db':
					break;
				case 'url': //not supported yet
						//Remove Tag on last recursive instance
						if (self::$OBReplaceLastRun === TRUE) $buffer = str_replace($MatchArr[0], " URLBlockTag ", $buffer);
					break;
				case 'null':
				case NULL:
					//output the block anyway. do not replace it
					break;
				case 'mod':
					if (file_exists(realpath($_SERVER['DOCUMENT_ROOT'].'/_system/mod/'.$MatchArr[2].'/_MODE_SELF_INITIATE.php')))
							include_once(realpath($_SERVER['DOCUMENT_ROOT'].'/_system/mod/'.$MatchArr[2].'/_MODE_SELF_INITIATE.php'));
					if (!empty($MatchArr[3])) try {
							$buffer = (string) str_replace($MatchArr[0], eval('return '.$MatchArr[3].'();'), $buffer);	
						} catch (throwable $CMSe) {
							$buffer = str_replace($MatchArr[0], '', $buffer);
//							do {
//								@$_INTIN['Dump'][$_INTIN['KERNEL']['EVENTlevelFILE']]['_ERRORS'][count($_INTIN['Dump'][$_INTIN['KERNEL']['EVENTlevelFILE']]['_ERRORS'])] .= "\n\n".sprintf("%s:%d %s (%d) [%s]\n%s", $CMSe->getFile(), $CMSe->getLine(), $CMSe->getMessage(), $CMSe->getCode(), get_class($CMSe), $CMSe->getTraceAsString());
//							} while($CMSe = $CMSe->getPrevious());
							$CMSe=null;
						}
					break;
				default:
					//Remove Tag on last recursive instance
					if (self::$OBReplaceLastRun === TRUE) $buffer = str_replace($MatchArr[0], " UnknownBlockTagType ", $buffer);
					break;
			}
		}

		if (($ReplaceCount > 0)&&(self::$ReplaceLevel+2 <= self::$ReplaceLevelMax)) {
			self::$ReplaceLevel++;
			$buffer = self::obreplace($buffer);
			self::$ReplaceLevel--;
		}

		//How many recursive obreplace calls were needed?
		if (self::$ReplaceLevelMax < self::$ReplaceLevel) self::$ReplaceLevelMax = self::$ReplaceLevel;

		//Cleanup Orfan Block Tags
		if (self::$OBReplaceLastRun === FALSE) {
			self::$ReplaceLevelCleanup = self::$ReplaceLevel+1;
			self::$OBReplaceLastRun = TRUE;
			$buffer = self::obreplace($buffer);
		}


		if (self::$ReplaceLevel == 0) { //THE FINAL COUNTDOWN.
			//SEO::Keywords
			//SEO::DESCRIPTION
			//DO orfan blocks
			//DO session related external content.
				//CombinedSessionJava
				//CombinesSessionCSS
				//IndividualExternalSessionFiles gif,jpg,jpeg,png,doc,txt,xml,pdf,xls,zip
		}

		return $buffer;
	}

//todo use append block vs tangent blocks to allow multi tasking creation of blocks.
	public static function startAppendBlock($Resource=NULL){
		self::$OBTangentBlockName = $Resource;
		self::$SubBufferCMSLevel = ob_get_level();
		ob_start(array('CMS_Blocks','AppendBlockCallBack'),0);
	}
	public static function AppendBlockCallBack($buffer){
		$Resource = self::$OBTangentBlockName;
		if (empty($GLOBALS['_INTIN']['MOD']['CMS']['Blocks'][$Resource])) {
			$GLOBALS['_INTIN']['MOD']['CMS']['Blocks'][$Resource] = $buffer;
		} else $GLOBALS['_INTIN']['MOD']['CMS']['Blocks'][$Resource] = $GLOBALS['_INTIN']['MOD']['CMS']['Blocks'][$Resource].$buffer;
	}
	public static function endAppendBlock($Resource=NULL){
//		ob_end_flush();
//		self::closeBuffers(self::$SubBufferCMSLevel);
		while (self::$SubBufferCMSLevel < ob_get_level()) ob_end_flush();
	}
	public static function startPrependBlock($Resource=NULL){
		self::$OBTangentBlockName = $Resource;
		self::$SubBufferCMSLevel = ob_get_level();
		ob_start(array('CMS_Blocks','PrependBlockCallBack'),0);
	}
	public static function PrependBlockCallBack($buffer){
		$Resource = self::$OBTangentBlockName;
		if (empty($GLOBALS['_INTIN']['MOD']['CMS']['Blocks'][$Resource])) {
			$GLOBALS['_INTIN']['MOD']['CMS']['Blocks'][$Resource] = $buffer;
		} else $GLOBALS['_INTIN']['MOD']['CMS']['Blocks'][$Resource] = $buffer.$GLOBALS['_INTIN']['MOD']['CMS']['Blocks'][$Resource];
	}
	public static function endPrependBlock($Resource=NULL){
//		ob_end_flush();
//		self::closeBuffers(self::$SubBufferCMSLevel);
		while (self::$SubBufferCMSLevel < ob_get_level()) ob_end_flush();
	}

	public static function startTangentBlock($Resource=NULL){
//		echo '#mem:'.$Resource.';#';
		self::$OBTangentBlockName = $Resource;
		self::$SubBufferCMSLevel = ob_get_level();
		ob_start(array('CMS_Blocks','TangentBlockCallBack'),0);
	}
	public static function TangentBlockCallBack($buffer){
		$Resource = self::$OBTangentBlockName;
		$GLOBALS['_INTIN']['MOD']['CMS']['Blocks'][$Resource] = $buffer;
	}
	public static function endTangentBlock($Resource=NULL){
//		ob_end_flush();
//		self::closeBuffers(self::$SubBufferCMSLevel);
		while (self::$SubBufferCMSLevel < ob_get_level()) ob_end_flush();
	}
/*	Mem Block Creation
*/	public static function startBlock($Resource=NULL){
		if (self::$OBLevel < 0) {
			$msg = 'need \'new CMS_Blocks();\' line constructor not loaded.';
			//Break or DIE?
//			exit $msg;
			self::init();
		}
		if (self::$DEBUG_DIV === 1) {
			if (self::$BlockCurrentResource === NULL) {
				self::$BlockCurrentResource = $Resource;
				echo "\r\n",'<div name=\'CMS_RecursiveOutputBlock_',$Resource,'\' id=\'CMS_RecursiveOutputBlock_',$Resource,'\' style=\'',self::DEBUG_DIV_CMS_BLOCK_STYLE,'\'>',"\r\n";
			} else {
				self::endBlock(self::$BlockCurrentResource);
				self::startBlock($Resource);
			}
			return TRUE;
		}
		if ($Resource === NULL) {
			$msg = 'NULL mem name? are you kidding?';
			//Break or DIE?
			exit($msg);
		}

		if (self::$BlockCurrentResource === NULL) {
			self::$BlockCurrentResource = $Resource;
			ob_start();
			self::$BlockCurrentLevel = (ob_get_level()-self::$OBLevel);//get ob build level
		} else {
			self::endBlock(self::$BlockCurrentResource);
			self::startBlock($Resource);
		}
	}
	public static function endBlock($Resource=NULL){
		if (self::$DEBUG_DIV === 1) {
			if (self::$BlockCurrentResource != NULL) {
				self::$BlockCurrentResource = NULL;
				echo "\r\n",'</div><!-- CMS_BLOCKS::endBlock CMS_RecursiveOutputBlock_',$Resource,'\ -->',"\r\n";
			}	else return FALSE;
			return TRUE;
		}

		global $_INTIN;

		if (($Resource === NULL) && (self::$BlockCurrentResource != NULL)) $Resource =self::$BlockCurrentResource;

		if (($Resource === NULL) && (self::$BlockCurrentResource === NULL)) {
			$_INTIN['MOD']['CMS']['OrfanBlocks']['Content'][] = ob_get_clean();
			self::$BlockCurrentLevel = (ob_get_level()-self::$OBLevel);//get ob build level
		} else {
			if ((self::$BlockCurrentLevel+1) < ob_get_level()) self::closeBuffers(NULL);
			//enforce ob build level with closeBlocks(ob build level)
			if (!empty($_INTIN['MOD']['CMS']['Blocks'][$Resource] )){
			    @$_INTIN['MOD']['CMS']['Blocks'][$Resource] .= ob_get_clean();
			} else
			     $_INTIN['MOD']['CMS']['Blocks'][$Resource] = ob_get_clean();
			self::$BlockCurrentLevel = (ob_get_level()-self::$OBLevel);//get ob build level
			self::$BlockCurrentResource = NULL;
		}
	}

/*	Save External file linked to session.
*/	public static function startLinkedRequest($filename=NULL){
		if ($filename=NULL) $mode = 'iframe';
		//check .htaccess config is installed and working
		if (is_file($filenamepath)) {
			$filenamepathinfo = pathinfo($filename);
			$filenamepath = $filenamepathinfo['dirname'];
		} elseif(is_dir($filenamepath)) {
			$filenamepath = $filenamepath;
		} elseif(is_link($filenamepath)) {
		} //filenamepath

		$browserpath = '/Resources/CMS/SESSION/';
		$filepath=$_SERVER['DOCUMENT_ROOT'].$browserpath.$filename;
		if(session_id() == "") {
			//require session class to start session.
		} else $SessionID = session_id();
//disect filename parts.
//		$ext =
//		$filenameParts
		self::$LinkedCurrentRequest[$ext][$path.$SessionID.$filename] = '';
//		$URL = $;
	}
	public static function endLinkedRequest(){
//		return $LinkedRequestURL;
	}

/*	Script Assembly
*/	public static function addHeaderScript($Script){
		//Script is file location, or mem buffer name, or sting containg script.
		//APPEND to 'Script' buffer
		//Header['Request']['Script'][]
		//if mem block remove mem block
	}
	public static function addHeaderLinkedScript($ScriptLocation){
		//Script is file location of precanned script
		//add location to Header['Linked']['Script'][] array
	}

/*	Style Assembly
*/	public static function addHeaderStyle($Style,$Media=''){
		//Script is file location, or mem buffer name, or sting containg script.
		//APPEND to 'Script' buffer
		//$media = all or if media = '' do not specify property.
		//Header['Request']['Style'][$media][]
		//if mem block remove mem block
	}
	public static function addHeaderLinkedStyle($StyleLocation,$Media=''){
		//$media = all or if media = '' do not specify property.
		//add location to Header['Linked']['Style'][$media][] array
	}

//	Closes output buffers not associates or manages with block levels.
	private static function closeBuffers($Level=NULL){
		//-1 to clear all
		$GetLevel = ob_get_level();
		if ($Level === NULL) $Level = self::$OBLevel+self::$BlockCurrentLevel+1;
		if ($Level === $GetLevel) return TRUE;
		while ($Level <= ob_get_level()) ob_end_flush();
		if ($Level < 0) while (ob_end_flush()) self::$BlockCurrentLevel--;
	}

//	Cancel all output. Even Site Layout
	public static function CancelOutput($ReInitBuffering=0){
		if (self::$BlockCurrentResource===NULL) self::endBlock();
		while (@ob_end_clean()) $GetLevel = ob_get_level();
		if ($ReInitBuffering) {
			self::init();
		}
	}

	public static function dehtmlblocks() {
		global $_INTIN;
		foreach ($_INTIN['MOD']['CMS']['Blocks'] as $BlockName => $BlockContent) {
			if (is_string($BlockContent)) {
				$BlockContent = str_replace("<","&lt;", $BlockContent);
				$BlockContent = str_replace("<","&lt;", $BlockContent);
				$BlockContent = str_replace("#","#\n", $BlockContent);
				$_INTIN['MOD']['CMS']['Blocks'][$BlockName] = ''.$BlockContent.'';
			}
		}
		return TRUE;
	}

//	End the block management level and therefore run the callback.
	public static function render() {
		if( class_exists('CMS_Skinner')&&(1)) {
			if (self::$SKINcompile) {
				CMS_Skinner::compile();
				self::$SKINcompile = 0;
			}
		}// Template Module else { TRUST all trunk blocks are correct.}
		if( class_exists('SEO')&&(1)) {
			if (self::$SEOcompile) {
				SEO::compile();
				self::$SEOcompile = 0;
			}
		}// else { Basic SEO Compile built in to CMS.}
		if (self::$DEBUG_DIV === 1) {
			echo "\r\n",'</div><!-- CMS_BLOCKS::render -- class closing -- ','CMS_RecursiveOutputBlocks','__INIT',' -->',"\r\n",'THE CLASS EXECUTED IN DEBUG MODE AND will end app.',"\r\n<br>";
			if (self::$DEBUG_DIE === 1) exit();
		} else {
			global $_INTIN;
			if (self::$BlockCurrentResource != NULL) self::endBlock();
			if (self::$OBLevel == -1) return FALSE;
			if (self::$OBLevel == -2) return FALSE;
			if ((ob_get_level())>self::$OBLevel) self::closeBuffers(self::$OBLevel);
			@$_INTIN['MOD']['CMS']['Blocks']['NULL'][0] = @ob_get_contents();
			if (empty($_INTIN['MOD']['CMS']['Blocks']['NULL'][0])) {
				echo self::TagBlockHead,'mem',self::TagBlockPart2Delimiter,self::$TopBlock,self::TagBlockPart3Delimiter,'Render Empty Content with top level specified',self::TagBlockFoot;
				$_INTIN['MOD']['CMS']['Blocks']['NULL'][0] = @ob_get_contents();
			} else echo '<pre>'.var_export($_INTIN['MOD']['CMS']['Blocks'],true).'</pre>';//@ob_end_flush();
			@ob_end_flush();
			self::$OBLevel = -2;
			if (self::$BufferDeTag) self::dehtmlblocks();
		}
		self::$Rendered=1;
	}

	public static function __destructor(){
		self::render(); // CMS_Blocks::?
	}
}
//CMS_Blocks::init();
?>
