<?php
 if (!class_exists('dBugM')) {
	class dBugM {
		var $xmlDepth=array();
		var $xmlCData;
		var $xmlSData;
		var $xmlDData;
		var $xmlCount=0;
		var $xmlAttrib;
		var $xmlName;
		var $arrType=array("array","object","resource","boolean","NULL");
		var $bInitialized = false;
		var $bCollapsed = false;
		var $arrHistory = array();
		public function __construct($var,$forceType="",$bCollapsed=true) {
			if(!defined('BDBUGINIT')) {
				define("BDBUGINIT", TRUE);
				$this->initJSandCSS();
			}
			$arrAccept=array("array","object","xml");
			$this->bCollapsed = $bCollapsed;
			if(in_array($forceType,$arrAccept))
				$this->{"varIs".ucfirst($forceType)}($var);
			else
				$this->checkType($var);
		}
		function getVariableName() {
			$arrBacktrace = debug_backtrace();
			$arrInclude = array("include","include_once","require","require_once");
			for($i=count($arrBacktrace)-1; $i>=0; $i--) {
				$arrCurrent = $arrBacktrace[$i];
				if(array_key_exists("function", $arrCurrent) &&
					(in_array($arrCurrent["function"], $arrInclude) || (0 != strcasecmp($arrCurrent["function"], "dbug"))))
					continue;
				$arrFile = $arrCurrent;
				break;
			}
			if(isset($arrFile)) {
				$arrLines = file($arrFile["file"]);
				$code = $arrLines[($arrFile["line"]-1)];
				preg_match('/\bnew dBug\s*\(\s*(.+)\s*\);/i', $code, $arrMatches);
				return @$arrMatches[1];
			}
			return "";
		}
		function makeTableHeader($type,$header,$colspan=2) {
			if(!$this->bInitialized) {
				$header = $this->getVariableName() . " (" . $header . ")";
				$this->bInitialized = true;
			}
			$str_i = ($this->bCollapsed) ? "style=\"font-style:italic\" " : "";

			echo "<table cellspacing=2 cellpadding=3 class=\"dBug_".$type."\">
					<tr>
						<td ".$str_i."class=\"dBug_".$type."Header\" colspan=".$colspan." onClick='dBug_toggleTable(this);'>".$header."</td>
					</tr>";
		}
		function makeTDHeader($type,$header) {
			$str_d = ($this->bCollapsed) ? " style=\"display:none\"" : "";
			echo "<tr".$str_d.">
					<td valign=\"top\" onClick='dBug_toggleRow(this);' class=\"dBug_".$type."Key\">".$header."</td>
					<td>";
		}
		function closeTDRow() {
			return "</td></tr>\n";
		}
		function  error($type) {
			$error="Error: Variable cannot be a";
			if(in_array(substr($type,0,1),array("a","e","i","o","u","x")))
				$error.="n";
			return ($error." ".$type." type");
		}
		function checkType($var) {
			switch(gettype($var)) {
				case "resource":
					$this->varIsResource($var);
					break;
				case "object":
					$this->varIsObject($var);
					break;
				case "array":
					$this->varIsArray($var);
					break;
				case "NULL":
					$this->varIsNULL();
					break;
				case "boolean":
					$this->varIsBoolean($var);
					break;
				default:
					$var=($var=="") ? "[empty string]" : $var;
					echo "<table cellspacing=0><tr>\n<td><code><pre>"./*htmlspecialchars($var)*/$var."</pre></code></td>\n</tr>\n</table>\n";
					break;
			}
		}
		function varIsNULL() {
			echo "NULL";
		}
		function varIsBoolean($var) {
			$var=($var==1) ? "TRUE" : "FALSE";
			echo $var;
		}
		function varIsArray($var) {
			if (!empty($var_ser)) {
				$var_ser = serialize($var);
			} else {
				$var_ser=null;
			}
			array_push($this->arrHistory, $var_ser);
			$this->makeTableHeader("array","array");
			if(is_array($var)) {
				foreach($var as $key=>$value) {
					$this->makeTDHeader("array",$key);
					if(is_array($value)) {
						if (!empty($value['GLOBALS'])) {
							$var_ser = serialize('Globals');
							$value = "*GLOBALS*RECURSION*";
						} else {
							try {
								$var_ser = serialize($value);
								if(in_array($var_ser, $this->arrHistory, TRUE))
									$value = "*Array*RECURSION*";
							} catch (Exception $e) {
								$var_ser = '*CLOSURE*ERROR*';
								$valueS=array();
								$ClosureInstance=0;
								foreach ($value as $subvalue) {
									$ClosureInstance++;
									echo "<h3>*CLOSURE*Array*Instances* $ClosureInstance:";
									if (!is_string($subvalue)&&!is_bool($subvalue)) echo key($subvalue).'</h3>';
									$this->checkType($subvalue);
								}
							}
						}
					}
					if(in_array(gettype($value),$this->arrType))
						$this->checkType($value);
					else {
						$value=(@trim($value)=="") ? "[empty string]" : $value;
						echo '<code><pre>'./*htmlspecialchars($value)*/$value.'</pre></code>';
					}
					echo $this->closeTDRow();
				}
			}
			else echo "<tr><td>".$this->error("array").$this->closeTDRow();
			array_pop($this->arrHistory);
			echo "</table>";
		}
		function varIsObject($var) {
			try {
				$var_ser = serialize($var);
				array_push($this->arrHistory, $var_ser);
			} catch (Exception $e) {
				$var_ser = '*CLOSURE*ERROR*';
				$valueS=array();
				$ClosureInstance=0;
				foreach ($var as $subvalue) {
					$ClosureInstance++;
					echo "<h3>*CLOSURE*Array*Instances* $ClosureInstance:";
					if (!is_string($subvalue)&&!is_bool($subvalue)) echo key($subvalue).'</h3>';
					$this->checkType($subvalue);
				}
//				error_log($value.':'.$e,0);
			}
			$this->makeTableHeader("object","object");
			if(is_object($var)) {
				$arrObjVars=get_object_vars($var);
				foreach($arrObjVars as $key=>$value) {
					$value=(!is_object($value) && !is_array($value) && trim($value)=="") ? "[empty string]" : $value;
					$this->makeTDHeader("object",$key);
					if(is_object($value)||is_array($value)) {
						$var_ser = serialize($value);
						if(in_array($var_ser, $this->arrHistory, TRUE)) {
							$value = (is_object($value)) ? "*Object*RECURSION* -> $".get_class($value) : "*RECURSION*";
						}
					}
					if(in_array(gettype($value),$this->arrType))
						$this->checkType($value);
					else echo $value;
					echo $this->closeTDRow();
				}
				$arrObjMethods=get_class_methods(get_class($var));
				foreach($arrObjMethods as $key=>$value) {
					$this->makeTDHeader("object",$value);
					echo "[function]".$this->closeTDRow();
				}
			}
			else echo "<tr><td>".$this->error("object").$this->closeTDRow();
			array_pop($this->arrHistory);
			echo "</table>";
		}
		function varIsResource($var) {
			$this->makeTableHeader("resourceC","resource",1);
			echo "<tr>\n<td>\n";
			switch(get_resource_type($var)) {
				case "fbsql result":
				case "mssql result":
				case "msql query":
				case "pgsql result":
				case "sybase-db result":
				case "sybase-ct result":
				case "mysql result":
					$db=current(explode(" ",get_resource_type($var)));
					$this->varIsDBResource($var,$db);
					break;
				case "gd":
					$this->varIsGDResource($var);
					break;
				case "xml":
					$this->varIsXmlResource($var);
					break;
				default:
					echo get_resource_type($var).$this->closeTDRow();
					break;
			}
			echo $this->closeTDRow()."</table>\n";
		}
		function varIsDBResource($var,$db="mysql") {
			if($db == "pgsql")
				$db = "pg";
			if($db == "sybase-db" || $db == "sybase-ct")
				$db = "sybase";
			$arrFields = array("name","type","flags");
			$numrows=call_user_func($db."_num_rows",$var);
			$numfields=call_user_func($db."_num_fields",$var);
			$this->makeTableHeader("resource",$db." result",$numfields+1);
			echo "<tr><td class=\"dBug_resourceKey\">&nbsp;</td>";
			for($i=0;$i<$numfields;$i++) {
				$field_header = "";
				for($j=0; $j<count($arrFields); $j++) {
					$db_func = $db."_field_".$arrFields[$j];
					if(function_exists($db_func)) {
						$fheader = call_user_func($db_func, $var, $i). " ";
						if($j==0)
							$field_name = $fheader;
						else
							$field_header .= $fheader;
					}
				}
				$field[$i]=call_user_func($db."_fetch_field",$var,$i);
				echo "<td class=\"dBug_resourceKey\" title=\"".$field_header."\">".$field_name."</td>";
			}
			echo "</tr>";
			for($i=0;$i<$numrows;$i++) {
				$row=call_user_func($db."_fetch_array",$var,constant(strtoupper($db)."_ASSOC"));
				echo "<tr>\n";
				echo "<td class=\"dBug_resourceKey\">".($i+1)."</td>";
				for($k=0;$k<$numfields;$k++) {
					$tempField=$field[$k]->name;
					$fieldrow=$row[($field[$k]->name)];
					$fieldrow=($fieldrow=="") ? "[empty string]" : $fieldrow;
					echo "<td>".$fieldrow."</td>\n";
				}
				echo "</tr>\n";
			}
			echo "</table>";
			if($numrows>0)
				call_user_func($db."_data_seek",$var,0);
		}
		function varIsGDResource($var) {
			$this->makeTableHeader("resource","gd",2);
			$this->makeTDHeader("resource","Width");
			echo imagesx($var).$this->closeTDRow();
			$this->makeTDHeader("resource","Height");
			echo imagesy($var).$this->closeTDRow();
			$this->makeTDHeader("resource","Colors");
			echo imagecolorstotal($var).$this->closeTDRow();
			echo "</table>";
		}
		function varIsXml($var) {
			$this->varIsXmlResource($var);
		}
		function varIsXmlResource($var) {
			$xml_parser=xml_parser_create();
			xml_parser_set_option($xml_parser,XML_OPTION_CASE_FOLDING,0);
			xml_set_element_handler($xml_parser,array(&$this,"xmlStartElement"),array(&$this,"xmlEndElement"));
			xml_set_character_data_handler($xml_parser,array(&$this,"xmlCharacterData"));
			xml_set_default_handler($xml_parser,array(&$this,"xmlDefaultHandler"));
			$this->makeTableHeader("xml","xml document",2);
			$this->makeTDHeader("xml","xmlRoot");
			$bFile=(!($fp=@fopen($var,"r"))) ? false : true;
			if($bFile) {
				while($data=str_replace("\n","",fread($fp,4096)))
					$this->xmlParse($xml_parser,$data,feof($fp));
			} else {
				if(!is_string($var)) {
					echo $this->error("xml").$this->closeTDRow()."</table>\n";
					return;
				}
				$data=$var;
				$this->xmlParse($xml_parser,$data,1);
			}
			echo $this->closeTDRow()."</table>\n";
		}
		function xmlParse($xml_parser,$data,$bFinal) {
			if (!xml_parse($xml_parser,$data,$bFinal)) {
					die(sprintf("XML error: %s at line %d\n",
								xml_error_string(xml_get_error_code($xml_parser)),
								xml_get_current_line_number($xml_parser)));
			}
		}
		function xmlStartElement($parser,$name,$attribs) {
			$this->xmlAttrib[$this->xmlCount]=$attribs;
			$this->xmlName[$this->xmlCount]=$name;
			$this->xmlSData[$this->xmlCount]='$this->makeTableHeader("xml","xml element",2);';
			$this->xmlSData[$this->xmlCount].='$this->makeTDHeader("xml","xmlName");';
			$this->xmlSData[$this->xmlCount].='echo "<strong>'.$this->xmlName[$this->xmlCount].'</strong>".$this->closeTDRow();';
			$this->xmlSData[$this->xmlCount].='$this->makeTDHeader("xml","xmlAttributes");';
			if(count($attribs)>0)
				$this->xmlSData[$this->xmlCount].='$this->varIsArray($this->xmlAttrib['.$this->xmlCount.']);';
			else
				$this->xmlSData[$this->xmlCount].='echo "&nbsp;";';
			$this->xmlSData[$this->xmlCount].='echo $this->closeTDRow();';
			$this->xmlCount++;
		}
		function xmlEndElement($parser,$name) {
			for($i=0;$i<$this->xmlCount;$i++) {
				eval($this->xmlSData[$i]);
				$this->makeTDHeader("xml","xmlText");
				echo (!empty($this->xmlCData[$i])) ? $this->xmlCData[$i] : "&nbsp;";
				echo $this->closeTDRow();
				$this->makeTDHeader("xml","xmlComment");
				echo (!empty($this->xmlDData[$i])) ? $this->xmlDData[$i] : "&nbsp;";
				echo $this->closeTDRow();
				$this->makeTDHeader("xml","xmlChildren");
				unset($this->xmlCData[$i],$this->xmlDData[$i]);
			}
			echo $this->closeTDRow();
			echo "</table>";
			$this->xmlCount=0;
		}
		function xmlCharacterData($parser,$data) {
			$count=$this->xmlCount-1;
			if(!empty($this->xmlCData[$count]))
				$this->xmlCData[$count].=$data;
			else
				$this->xmlCData[$count]=$data;
		}
		function xmlDefaultHandler($parser,$data) {
			$data=str_replace(array("&lt;!--","--&gt;"),"",htmlspecialchars($data));
			$count=$this->xmlCount-1;
			if(!empty($this->xmlDData[$count]))
				$this->xmlDData[$count].=$data;
			else
				$this->xmlDData[$count]=$data;
		}
		function initJSandCSS() {
			if( class_exists('CMS_Blocks')&&(1)) {
				if (!CMS_Blocks::$Rendered) {
			CMS_Blocks::startAppendBlock('PageHead');
?>
<link rel="stylesheet" href="/css/dBug.css" type="text/css" media="screen" charset="utf-8" />
<script type='text/javascript' src='/js/dBug.js'></script>
<?php
			CMS_Blocks::endAppendBlock();
				} else {
?>
<link rel="stylesheet" href="/css/dBug.css" type="text/css" media="screen" charset="utf-8" />
<script type='text/javascript' src='/js/dBug.js'></script>
<?php
				}
			} else {
				if(1){
?>
<style>
<?php include ($_SERVER['DOCUMENT_ROOT'].'/_system/mod/_00_DumpTHAT/_Resources/css/dBug.css'); ?>
</style>
<script>
<?php include ($_SERVER['DOCUMENT_ROOT'].'/_system/mod/_00_DumpTHAT/_Resources/js/dBug.js'); ?>
</script>
<?php
				} else {
?>
<link rel="stylesheet" href="/css/dBug.css" type="text/css" media="screen" charset="utf-8" />
<script type='text/javascript' src='/js/dBug.js'></script>
<?php
								
				}
					
			}
		}
	}
	}
	if (!class_exists('dBug'))
		if (class_exists('dBugM')) {
			class dBug extends dBugM {
				protected static $title = 'sub';
				var $bInitialized = false;
				var $bCollapsed = false;
				var $arrHistory = array();
				public function __construct($var,$forceType="",$bCollapsed=false) {
					if(!defined('BDBUGINIT')) {
						define("BDBUGINIT", TRUE);
						$this->initJSandCSS();
					}
					$arrAccept=array("array","object","xml");
					$this->bCollapsed = $bCollapsed;
					if(in_array($forceType,$arrAccept))
						$this->{"varIs".ucfirst($forceType)}($var);
					else
						$this->checkType($var);
				}
		}
}
?>