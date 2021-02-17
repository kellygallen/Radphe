<?php @require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php'); RadpheFallBackHook;
require_once($_SERVER['DOCUMENT_ROOT'].'/_system/mod/_00_StatelessOutputBuffer/CMS.php');

class SEO{
	private static
		$PageTitle = '',
		$PageDescription = '',
		$MetaTagsTxt = '',
		$SupplementryContent = '',
		$MetaArray = array(),
		$Keywords = array(),//Default Base Keywords in SiteConfig
		$SEOfileKeywords = array(),//Keywords customized with SEO file.
		$NewKeywords = array(),//modified by class
		$ForcedKeywords = array(),//keywords that will be used by force
		$DeepKeywordSearch=0,
		$Debug=0,
		$SEOsearchBlockList = 'Request,SEODescription,SEOPageTitle,SEOSupplementryContent',
		$KeywordsText = '';

	public static function __constructor(){
		self::init();
	}

	//setPrivateVar(DeepKeywordSearch,1) //set deep keyword search.
	public static function setPrivateVar($Name,$Val) {
		if (isset(self::${$Name})) self::${$Name} = $Val;
		return NULL;
	}

	public static function getPrivateVar($Name) {
		if (isset(self::${$Name})) return self::${$Name};
		return NULL;
	}

	public static function Debug(){
		self::$Debug=1;
		global $_INTIN;
		$State = array();
		$State['PageTitle'] =self::$PageTitle;
		$State['PageDescription'] =self::$PageDescription;
		$State['MetaTagsTxt'] = '<pre>'.self::$MetaArray.'</pre>';
		$State['SupplementryContnet'] = '<pre>'.str_replace(">","&gt;", str_replace("<","&lt;", self::$SupplementryContent)).'</pre>';
		$State['Keywords'] =self::$Keywords;
		$State['ForcedKeywords'] =$CombinedForcedKeywords;
		$State['KeywordsText'] =self::$Keywords;
		$_INTIN['MOD']['SEO']['DEBUG'][] = $State;
	}

/*	Enable Nestable block replacement.
//==========================================================================
	This is done automaticaly since this is a static class.
	So if you ever call this function you better know what your doing
	Or I will find you, tie you up, and waist your time.
*/	public static function init(){
		global $_INTIN;
		if (CMS_Blocks::getPrivateVar('OBLevel')===-1) CMS_Blocks::init();
		if (!empty($_INTIN['MOD']['SEO']['Defaults']['SupplementalContent']))
			$SEO['Text']['SupplementalContent'][] = $_INTIN['MOD']['SEO']['Defaults']['SupplementalContent'];
		if (!empty($_INTIN['MOD']['SEO']['Defaults']['Meta']))
			$SEO['Text']['MetaTags'][] = $_INTIN['MOD']['SEO']['Defaults']['Meta'];//for debug history only, array ver is up to date. and used at SEOMeta gen time.
		if (!empty($_INTIN['MOD']['SEO']['Defaults']['Description']))
			$SEO['Text']['PageDescription'][] = $_INTIN['MOD']['SEO']['Defaults']['Description'];
		if (!empty($_INTIN['MOD']['SEO']['Defaults']['PageTitle']))
			$SEO['Text']['PageTitle'][] = $_INTIN['MOD']['SEO']['Defaults']['PageTitle'];
		if (!empty($_INTIN['MOD']['SEO']['Defaults']['Keywords']))
			$SEO['Text']['Keywords'][] = $_INTIN['MOD']['SEO']['Defaults']['Keywords'];
		if (!empty($_INTIN['MOD']['SEO']['Defaults']['ForcedKeywordsTxt']))
			$SEO['Text']['Forced Keywords'][] = $_INTIN['MOD']['SEO']['Defaults']['ForcedKeywordsTxt'];
		if (!empty(self::$Keywords))
			$SEO['Array']['Keywords'][] = self::$Keywords;
		if (!empty($_INTIN['MOD']['SEO']['Keywords']))
			$SEO['Array']['Keywords'][] = $_INTIN['MOD']['SEO']['Keywords'];
		if (!empty(self::$ForcedKeywords))
			$SEO['Array']['Forced Keywords'][] = self::$ForcedKeywords;
		$SEO['Array']['MetaTags'][] = array();//all meta txt immediatly added to metta array.

		if (file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$_SERVER['PHP_SELF'].'.SEO.php')) {
			include $_SERVER['DOCUMENT_ROOT'].'/'.$_SERVER['PHP_SELF'].'.SEO.php';
			if (!empty($_Template['SEO']['ForcedKeywordsTxt'])) $SEO['Text']['Forced Keywords'][] = $_Template['SEO']['ForcedKeywordsTxt'];
			if (!empty($_Template['SEO']['KeywordsTxt'])) $SEO['Text']['Keywords'][] = $_Template['SEO']['KeywordsTxt'];
			if (!empty($_Template['SEO']['PageTitle'])) $SEO['Text']['PageTitle'][] = $_Template['SEO']['PageTitle'];
			if (!empty($_Template['SEO']['Description'])) $SEO['Text']['PageDescription'][] = $_Template['SEO']['Description'];
			if (!empty($_Template['SEO']['SupplementContent'])) $SEO['Text']['SupplementalContent'][] = $_Template['SEO']['SupplementContent'];
			if (!empty($_Template['SEO']['MetaTags'])) $SEO['Text']['MetaTags'][] = $_Template['SEO']['MetaTags'];
//			unset($_Template);
		}

		//Meta
		foreach($SEO['Text']['MetaTags'] as $BirthOrder => $Text){
			$TempMetaTxt = $Text;
			$TempKeyTxt = '';
			$TempDescTxt = '';
			$TempMetaArray = self::ContentToMetaArray($TempMetaTxt);
			if (!empty($TempMetaArray['name']['keywords'])) {
				if ($TempMetaArray['name']['keywords'] != '#mem:SEOKeywords;#') {
					$TempKeyTxt = $TempMetaArray['name']['keywords'];
					$TempMetaArray['name']['keywords'] = '#mem:SEOKeywords;#';
					if (!empty($TempKeyTxt)) $SEO['Text']['Keywords'][] = $TempKeyTxt;
				}
			}
			if (!empty($TempMetaArray['name']['description'])) {
				if ($TempMetaArray['name']['description'] != '#mem:SEODescription;#') {
					$TempDescTxt = $TempMetaArray['name']['description'];
					$TempMetaArray['name']['description'] = '#mem:SEODescription;#';
					if (!empty($TempDescTxt)) $SEO['Text']['PageDescription'][] = $TempDescTxt;
				}
			}
			$SEO['Array']['MetaTags'][$BirthOrder] = $TempMetaArray;
		}
		unset($BirthOrder,$Text,$TempMetaTxt,$TempKeyTxt,$TempDescTxt,$TempMetaArray);

//		$_INTIN['MOD']['Test']['SEO Boil'] = $SEO;

		//StackedMetaArray
		$StackedMetaArray = array();
		if (!empty($SEO['Array']['MetaTags'])) {
			foreach($SEO['Array']['MetaTags'] as $BirthOrder => $MetaArray){
				foreach($MetaArray as $Type => $TagArray) {
					foreach($TagArray as $Value => $Content){
						$StackedMetaArray[$Type][$Value]=$Content;
					}
				}
			}
			unset($BirthOrder,$MetaArray,$Type,$TagArray,$Value,$Content);
		}
		self::$MetaArray = $StackedMetaArray;

		//FinalKeywords
		if (!empty($SEO['Text']['Forced Keywords'])) {
			$CombinedForcedKeywords = self::ConsolidateKeywordsArray($SEO['Text']['Forced Keywords']);
			self::$ForcedKeywords = $CombinedForcedKeywords;
		}

		//Keywords
		if (!empty($SEO['Text']['Keywords'])) {
			$CombinedKeywords = self::ConsolidateKeywordsArray($SEO['Text']['Keywords']);
			self::$Keywords = $CombinedKeywords;
		}

		//PageTitle
		foreach ($SEO['Text']['PageTitle'] as $BirthOrder => $Text) {
			if (!empty($Text)) $ValidPageTitle[] = $Text;
		}
		unset($BirthOrder,$Text);
		self::$PageTitle = end($ValidPageTitle);

		//PageDescription
		foreach ($SEO['Text']['PageDescription'] as $BirthOrder => $Text) {
			if (!empty($Text)) $ValidDescriptions[] = $Text;
		}
		unset($BirthOrder,$Text);
		self::$PageDescription = end($ValidDescriptions);

		//SupplementalContent
		$ValidSupplementalContent = '';
		if (!empty($SEO['Text']['SupplementalContent'])) {
			if (is_array($SEO['Text']['SupplementalContent'])) {
				foreach ($SEO['Text']['SupplementalContent'] as $BirthOrder => $Text) {
					if (!empty($Text)) $ValidSupplementalContent.=" ".$Text;
				}
			}
		}
		unset($BirthOrder,$Text);
		self::$SupplementryContent = $ValidSupplementalContent;
	}

	public static function AddBlockKeywordSearch($Block){
		if (!is_string($Block)) return FALSE;
		if ($Block == '') return FALSE;
		global $_INTIN;
		if (!isset($_INTIN['MOD']['CMS']['Blocks'][$Block])) return FALSE;
		self::$SEOsearchBlockList .= ','.$Block;
	}

	public static function KeywordsTxtToArr($Txt){
		$Final=array();
		if (!is_string($Txt)) return FALSE;
		$Items = preg_split('/([,\r\n\|])/i',$Txt,0);
//		$Items = @spliti (",|\r|\n|\|", $Txt);//TODO migrate to preg_split
		//Make array of unique and lowercase.
		foreach ($Items as $Item) {
			$Array[trim(strtolower($Item))] = NULL;
		}
		$Items=NULL;
		//make standard array
		foreach ($Array as $Key => $Item) {
			$DontAdd = 0;
			if (in_array($Key,self::$ForcedKeywords)) $DontAdd++;
			if (empty($Key)) $DontAdd++;
			if ($DontAdd === 0) $Final[] = $Key;
		}
		return $Final;
	}

	public static function KeywordsArrToTxt($Array){
		return implode(',',$Array);
	}

	public static function ConsolidateKeywordsArray($Array){
		if (!is_array($Array)) return FALSE;
		$KeywordsTxt = '';
		foreach($Array as $BirthOrder => $Text){
			$KeywordsTxt .= "\n".$Text;
		}
		$CombinedKeywords = self::KeywordsTxtToArr($KeywordsTxt);
		return $CombinedKeywords;
	}

	public static function MetaArrayToTags($MetaArray){
		$MetaArray['name']['keywords'] = '#mem:SEOKeywords;#';
		$MetaArray['name']['description'] = '#mem:SEODescription;#';
		$txtBlock = '';
			foreach($MetaArray as $Type => $TagArray) {
				foreach($TagArray as $Value => $Content){
					$txtBlock.="\t\t".'<meta '.$Type.'="'.$Value.'" content="'.$Content.'" />'."\r\n";
				}
			}
		return $txtBlock;
	}

	public static function ContentToMetaArray($content){
		$pregStatus = preg_match_all("/<meta[^>]+(http\-equiv|name)=\"([^\"]*)\"[^>]" . "+content=\"([^\"]*)\"[^>]*>/i", $content, $MetaTagParts,PREG_PATTERN_ORDER);
		if (($pregStatus==FALSE)||(($pregStatus==0))) return FALSE;
		foreach ($MetaTagParts[1] as $MetaTagNumber => $MetaTagPart) {
			$MetaTags[strtolower($MetaTagPart)][strtolower($MetaTagParts[2][$MetaTagNumber])] = $MetaTagParts[3][$MetaTagNumber];
		}
		return $MetaTags;
	}

	public static function addKeyword($Keyword,$Forced=0) {
		$Keyword = trim(strtolower($Keyword));
		if (empty($Keyword)) return FALSE;
		$DontAdd = 0;
		if ($Forced) {
			if (in_array($Keyword,self::$ForcedKeywords)) $DontAdd++;
			if ($DontAdd === 0) self::$ForcedKeywords[] = $Keyword;
			return TRUE;
		} else {
			if (in_array($Keyword,self::$Keywords)) $DontAdd++;
			if ($DontAdd === 0) self::$Keywords[] = $Keyword;
			return TRUE;
		}
		return FALSE;
	}

	public static function removeKeyword($RemoveKeyword,$Forced=1) {
		$Removed=0;
		$RemoveKeyword = trim(strtolower($RemoveKeyword));
		$Keywords = self::$Keywords;
		$ForcedKeywords = self::$ForcedKeywords;
		foreach($Keywords as $Keyword){
			if ($RemoveKeyword != $Keyword) {
				$NewKeywords[]=$Keyword;
			} else $Removed++;
		}
		foreach($ForcedKeywords as $Keyword){
			if ($RemoveKeyword != $Keyword) {
				$NewForcedKeywords[]=$Keyword;
			} else $Removed++;
		}
		if ($Removed == 0) return FALSE;
		self::$Keywords = $NewKeywords;
		if ($Forced==1) {
			self::$ForcedKeywords = $NewForcedKeywords;
		}
		return TRUE;
	}

	public static function ClearKeywords($Forced=0) {
		self::$Keywords = array();
		if ($Forced ==1) self::$ForcedKeywords = array();
		return TRUE;
	}

	public static function addMeta($Content,$TypeValue,$Type=1) {
		if (($Type == 1)||(strtolower($Type) == 'name')) $Type = 'name';
		if (($Type == 2)||(strtolower($Type) == 'http-equiv')) $Type = 'http-equiv';
		self::$MetaArray[$Type][$TypeValue] = $Content;
		return TRUE;
	}

	public static function removeMeta($TypeValue,$Type=0) {
		if ($Type == 0) {
			if (isset(self::$MetaArray['name'][$TypeValue])) {
				unset(self::$MetaArray['name'][$TypeValue]);
				return TRUE;
			}
			if (isset(self::$MetaArray['http-equiv'][$TypeValue])) {
				unset(self::$MetaArray['http-equiv'][$TypeValue]);
				return TRUE;
			}
			return FALSE;
		}
		if (($Type == 1)||(strtolower($Type) == 'name')) $Type = 'name';
		if (($Type == 2)||(strtolower($Type) == 'http-equiv')) $Type = 'http-equiv';
		if (isset(self::$MetaArray[$Type][$TypeValue])) {
			unset(self::$MetaArray[$Type][$TypeValue]);
			return TRUE;
		}
		return FALSE;
	}

	public static function ClearMeta($SetTo=0) {
		if ($SetTo !=0) {
			if ($SetTo==1) {
				global $_INTIN;
				self::$MetaArray = ContentToMetaArray($_INTIN['MOD']['SEO']['Defaults']['Meta']);
			} else {//SetTo is location of new meta data
			}
		} else {
			self::$MetaArray = array();
		}
		return FALSE;
	}

	//Strip Tags, dont join words, and consolidate whitespace.
//Move to common static tools class, src=/_system/function/strip_clean_html_tags.php
	public static function strip_html_tags( $text,$keeptags='') {
//		return preg_replace('/\s\s+/',' ',strip_tags( $text,$keeptags));
		return preg_replace('/\s\s+/',' ',strip_tags( $text,$keeptags));
		$text = preg_replace(
array(
	// Remove invisible content
	'@<head[^>]*?>.*?</head>@siu',
	'@<style[^>]*?>.*?</style>@siu',
	'@<script[^>]*?.*?</script>@siu',
	'@<object[^>]*?.*?</object>@siu',
	'@<embed[^>]*?.*?</embed>@siu',
	'@<applet[^>]*?.*?</applet>@siu',
	'@<noframes[^>]*?.*?</noframes>@siu',
	'@<noscript[^>]*?.*?</noscript>@siu',
	'@<noembed[^>]*?.*?</noembed>@siu',
	// Add line breaks before and after blocks
	'@</?((address)|(blockquote)|(center)|(del))@iu',
	'@</?((div)|(h[1-9])|(ins)|(isindex)|(p)|(pre))@iu',
	'@</?((dir)|(dl)|(dt)|(dd)|(li)|(menu)|(ol)|(ul))@iu',
	'@</?((table)|(th)|(td)|(caption))@iu',
	'@</?((form)|(button)|(fieldset)|(legend)|(input))@iu',
	'@</?((label)|(select)|(optgroup)|(option)|(textarea))@iu',
	'@</?((frameset)|(frame)|(iframe))@iu',
	'@</?((br)|(hr))@iu',
),
array(
	' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ',
	"\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0",
	"\n\$0", "\n\$0", "\n\$0",
		),$text);
		$text = preg_replace('/(?:\<|\&lt\;)br(?:\s)(?:\/)?(?:\>|\&gt\;)/i',' ',$text);
//		return $text;
		if ($keeptags != '') {
			$stripped = strip_tags( $text,$keeptags);
		} else $stripped = strip_tags($text);
		$stripped = preg_replace('/\s\s+/',' ',$stripped);
		return $stripped;
	}

//	End the block management level and therefor run the callback.
	public static function compile() {
		global $_INTIN;


		self::$MetaTagsTxt = self::MetaArrayToTags(self::$MetaArray);
		$_INTIN['MOD']['CMS']['Blocks']['SEOMeta'] = self::$MetaTagsTxt;

		$_INTIN['MOD']['CMS']['Blocks']['SEOPageTitle'] = self::$PageTitle;
		$_INTIN['MOD']['CMS']['Blocks']['SEODescription'] = self::$PageDescription;
		if (!empty(self::$SupplementryContent)) {
			$_INTIN['MOD']['CMS']['Blocks']['SEOSupplementryContent'] = "<hr>".self::$SupplementryContent;
		}


		$NewKeywords = self::$Keywords;
		//Find Keywords in content areas. And Save ones that are not found.
		$UsableKeywords = array();
		$RemovedKeywords = array();
		$JustText = '';
		$JustBlock = '';
//		self::setPrivateVar('DeepKeywordSearch',1); //set deep keyword search.
		self::setPrivateVar('Debug',1); //set deep keyword search.

		//Deek (entire request) keyword search or fast search.
		if ((!empty(self::$SEOsearchBlockList))||(self::$DeepKeywordSearch == 1)){
			if (self::$DeepKeywordSearch == 0) {
				$SearchBlocks = explode(',',self::$SEOsearchBlockList);
			} else {
				$SearchBlocks = array_keys($_INTIN['MOD']['CMS']['Blocks']);
				$SearchBlocks = array_flip($SearchBlocks);
				unset($SearchBlocks['SEOKeywords']);
				unset($SearchBlocks['SEOMeta']);
				$SearchBlocks = array_flip($SearchBlocks);
				$_INTIN['MOD']['CMS']['Test'][''] = $SearchBlocks;
			}
			foreach ($SearchBlocks as $Index => $Block) {
//strip_html_tags will be moved to common tools.
				if (!empty($_INTIN['MOD']['CMS']['Blocks'][$Block])) $JustText .= "\r\n\t".self::strip_html_tags($_INTIN['MOD']['CMS']['Blocks'][$Block],"<img><a><b><u><strong>");
//				if (1) $JustText .= "\r\n\t".self::strip_html_tags($_INTIN['MOD']['CMS']['Blocks'][$Block],"<img><a><b><u><strong><table><tr></td><hr>");
//				if (!empty($_INTIN['MOD']['CMS']['Blocks'][$Block])) $JustBlock .= "\r\n\t".self::strip_html_tags($_INTIN['MOD']['CMS']['Blocks'][$Block],"<img><a><p><div><span><h1><h2><h3><table></tr></td><th><label><hr><center><br>");
			}
		}
		if (self::$Debug == 1) {
			$_INTIN['MOD']['SEO']['SEO Content Code'] = "<pre>".str_replace("<","&lt;", str_replace(">","&gt;",$JustText))."</pre>";
			$_INTIN['MOD']['SEO']['SEO Content'] = $JustText;
			$_INTIN['MOD']['SEO']['SEO Block'] = $JustBlock;
		}
		foreach ($NewKeywords as $Index => $Keyword) {
			$KeywordFound = 0;
//			$Keyword = trim($Keyword);
			if (stristr($_INTIN['MOD']['SEO']['SEO Content'],$Keyword) !== FALSE) {
				$UsableKeywords[] = $Keyword;
				$KeywordFound = 1;
			} else {
				//Missing from content.
				$_INTIN['MOD']['SEO']['MissingKeywords'][] = $Keyword;
			}
			if ($KeywordFound === 0) $RemovedKeywords[] = $Keyword;
		}
		$_INTIN['MOD']['SEO']['RemovedKeywords'] = $RemovedKeywords;
//		$RemovedKeywords = array_flip($RemovedKeywords);

		//Finalize Keyword List with manditory keywords
		$FinalKeywords = array_flip($UsableKeywords);
		if (!empty(self::$ForcedKeywords))
		foreach(self::$ForcedKeywords as $Index => $Keyword) {
			$Keyword = trim(strtolower($Keyword));
			$FinalKeywords[$Keyword] = $Index;
			$_INTIN['MOD']['SEO']['ForcedKeywords'][] = $Keyword;
		}
		//Cleanup Array Indexes and unflip
		$ArrayIndex = 0;
		$NewKeywords = array();//make it blank.
		foreach ($FinalKeywords as $Keyword => $Index) {
			$NewKeywords[$ArrayIndex] = $Keyword;
			$ArrayIndex++;
		}

		$_INTIN['MOD']['SEO']['Keywords'] = self::$NewKeywords = $NewKeywords;
		self::$KeywordsText = self::KeywordsArrToTxt( self::$NewKeywords );
		self::$Keywords = self::$NewKeywords;

		$_INTIN['MOD']['CMS']['Blocks']['SEOKeywords'] = self::$KeywordsText;
	}

	public static function __destructor(){
		self::compile();
	}
}
SEO::init();
?>