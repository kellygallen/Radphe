<?php @require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php'); eval(RadpheFallBackHook);
//TODO: Depreciated php methods move to mysqlI
class DBConn{
	public static $DefaultConnection=NULL;
	public static $LastInsertID=array();

	public static function connect($Profile='Defaults',$ConnIndex=0){
		global $_INTIN;
//		global &$_INTIN;	//Required for conn to exist after function cleanup?
		$_INTIN['DB']['Connections'][$ConnIndex] = mysql_connect($_INTIN['DB']['Profiles'][$Profile]['Host'],$_INTIN['DB']['Profiles'][$Profile]['User'],$_INTIN['DB']['Profiles'][$Profile]['Pass'],true);
		$_INTIN['DB']['Connections'][$Profile] = &$_INTIN['DB']['Connections'][$ConnIndex];
		mysql_select_db($_INTIN['DB']['Profiles'][$Profile]['Schema'],$_INTIN['DB']['Connections'][$ConnIndex]);
		return $_INTIN['DB']['Connections'][$ConnIndex];
	}

	public static function query($Name='Unnamed',$SQL,$Schema=NULL,$ReturnRawResult=0,$DBConn=NULL){
		global $_INTIN,$_QUERY;

		//Detect Multi Instances of the Name for this Query
		if (empty($_QUERY[$Name])) {
			$SubInstance = 0;
		} else $SubInstance = count($_QUERY[$Name]);

		//Detect Query Type and Restrict use to supported queries.
		if (preg_match("/(call|delete|do|handler|insert|replace|select|truncate|update|describe|explain|use|drop|create|alter|set|show|return)/i", substr($SQL, 0, 10),$QueryType)){
			$QueryType = strtolower($QueryType[1]);
			switch($QueryType){
				case 'delete':
				case 'insert':
				case 'select':
				case 'update':
				case 'use':
				case 'show':
					break;
				default:
					return FALSE;
					break;
			}
		} else return FALSE; //Unsupported Query Type
		$ResultMode = $QueryType;
		$_QUERY[$Name][$SubInstance]['STATEMENT'] = $QueryType;

		//Save Orig SQL
		$_QUERY[$Name][$SubInstance]['SQL']=$SQL;

		//Manage DB Connection
		if ($DBConn == NULL) {
			if (self::$DefaultConnection==NULL) {
				self::$DefaultConnection = self::connect();
			} else {
				$DBConn = self::$DefaultConnection;
			}
			$DBConn = self::$DefaultConnection;
		}
//		$_QUERY[$Name][$SubInstance]['CONNECTION']=serialize($DBConn);
		$_QUERY[$Name][$SubInstance]['CONNECTION']=$DBConn;

		//Manage DB Schema
		if ($Schema === NULL) {
			$Schema = $_INTIN['DB']['Profiles']['Defaults']['Schema'];
		}
		$_QUERY[$Name][$SubInstance]['USE'] = mysql_select_db($Schema,$DBConn);
		if ($_QUERY[$Name][$SubInstance]['USE']===TRUE) $_QUERY[$Name][$SubInstance]['USE'] = $Schema;

		//Run Query or record error message from mysql.
		$_QUERY[$Name][$SubInstance]['RESOURCE'] = mysql_query($SQL,$DBConn)
			or $_QUERY[$Name][$SubInstance]['ERROR'] = mysql_error();

		if (!empty($_QUERY[$Name][$SubInstance]['ERROR'])) $ResultMode = 'error';
		//ResultStructure Depends on Query Type
		switch($ResultMode){
			case 'insert':
				$LastInsertID = mysql_insert_id($DBConn);
				if (($LastInsertID != false)&&($LastInsertID!==@self::$LastInsertID[(int) $DBConn])) {
					self::$LastInsertID[(int)$DBConn]=$LastInsertID;
					$_QUERY[$Name][$SubInstance]['INSERT_ID'] = $LastInsertID;
				}
			case 'delete':
			case 'update':
				$_QUERY[$Name][$SubInstance]['Affected'] = mysql_affected_rows($DBConn);
				break;
			case 'select':
				//Get Pager Count
				$DBConnCount = self::connect('Defaults',1);
				mysql_select_db($Schema,$DBConnCount);
				$SCLCount = preg_replace('/(.*)(LIMIT[ ]+[0-9,]+){1}(.*)?(LIMIT){0}$/is', 'SELECT COUNT(*) as RowCounter FROM ('.'$1 $3'.') AS TableToCount', str_replace(';', '', $SQL));
				$_QUERY[$Name][$SubInstance]['PAGER']['RESOURCE'] = mysql_query($SCLCount,$DBConnCount)
					or $_QUERY[$Name][$SubInstance]['PAGER']['ERROR'] = mysql_error();
				if (empty($_QUERY[$Name][$SubInstance]['PAGER']['ERROR'])) {
					$RowCounter = mysql_fetch_assoc($_QUERY[$Name][$SubInstance]['PAGER']['RESOURCE']);
					$_QUERY[$Name][$SubInstance]['PAGER']['TOTAL'] = @$RowCounter['RowCounter'];
					mysql_free_result($_QUERY[$Name][$SubInstance]['PAGER']['RESOURCE']);
				} else {
					$_QUERY[$Name][$SubInstance]['PAGER']['TOTAL'] = FALSE;
				}
				$_QUERY[$Name][$SubInstance]['CountSQL']=$SCLCount;
				mysql_close($DBConnCount);

				//Build Result
				if ($ReturnRawResult==1) {
					$_QUERY[$Name][$SubInstance]['RESULT'] = &$_QUERY[$Name][$SubInstance]['RESOURCE'];
				} else {
					while($Row = mysql_fetch_assoc($_QUERY[$Name][$SubInstance]['RESOURCE'])){
						$_QUERY[$Name][$SubInstance]['RESULT'][] = $Row;
					}
					if(!isset($_QUERY[$Name][$SubInstance]['RESULT'])){//return 0 rec
						$_QUERY[$Name][$SubInstance]['TOTAL'] = 0;
					} else {
						$_QUERY[$Name][$SubInstance]['TOTAL'] = count($_QUERY[$Name][$SubInstance]['RESULT']);
					}
					mysql_free_result($_QUERY[$Name][$SubInstance]['RESOURCE']);
				}
				$_QUERY[$Name][$SubInstance]['NAME'] = $Name;
				$_QUERY[$Name][$SubInstance]['INSTANCE'] = $SubInstance;
				return $_QUERY[$Name][$SubInstance];
				break;
			case 'use':
			case 'show':
				break;
			case 'error':
				$_QUERY[$Name][$SubInstance]['INSERT_ID'] = FALSE;
				$_QUERY[$Name][$SubInstance]['Affected'] = FALSE;
				$_QUERY[$Name][$SubInstance]['PAGER'] = FALSE;
				$_QUERY[$Name][$SubInstance]['RESOURCE'] = FALSE;
				$_QUERY[$Name][$SubInstance]['RESULT'] = FALSE;
				$_QUERY[$Name][$SubInstance]['TOTAL'] = FALSE;
				$_QUERY[$Name][$SubInstance]['NAME'] = $Name;
				$_QUERY[$Name][$SubInstance]['INSTANCE'] = $SubInstance;
				break;
			default:
//				return $_QUERY[$Name][$SubInstance];
				break;
		}
		$_QUERY[$Name][$SubInstance]['INFO'] = mysql_info($DBConn);
		$_QUERY[$Name][$SubInstance]['STAT'] = mysql_stat($DBConn);

		if ($_QUERY[$Name][$SubInstance]['RESOURCE']===TRUE){//Happens for Insets, Updates, Deletes
				$_QUERY[$Name][$SubInstance]['RESULT'] = TRUE;
		} elseif ($_QUERY[$Name][$SubInstance]['RESOURCE']===FALSE) {//Happens for Errors
			$_QUERY[$Name][$SubInstance]['RESULT'] = FALSE;
		} else {
		}

		//Return DB work.
//		return $_QUERY[$Name][$SubInstance];
		return $_QUERY[$Name][$SubInstance];
	}
}
?>