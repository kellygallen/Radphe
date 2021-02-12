<?php
@require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php');//Fallback Hook.
/*
mixed getpidinfo(mixed pid [, string system_ps_command_options])
this function gets PID-info from system ps command and return it in useful assoc-array,
or return false and trigger warning if PID doesn't exists
$pidifo=getpidinfo(12345);
print_r($pidifo);
Array
(
   [USER] => user
   [PID] => 12345
   [%CPU] => 0.0
   [%MEM] => 0.0
   [VSZ] => 1720
   [RSS] => 8
   [TT] => ??
   [STAT] => Is
   [STARTED] => 6:00PM
   [TIME] => 0:00.01
   [COMMAND] => php someproces.php > logfile
)
*/
//////////////////////////////////////////////
function getpidinfo($pid=NULL, $ps_opt="aux"){
	if($pid==NULL) {
		$pid = @getmypid();
	}
  $ps=@shell_exec("ps -".$ps_opt."p ".$pid);
  $ps=explode("\n", $ps);
//  $pidinfo[] = $ps;
  
  if(count($ps)<2){
     if (!empty($pid)) //trigger_error("PID ".$pid." doesn't exists", E_USER_WARNING);
     return false;
  }
  foreach($ps as $key=>$val){
     $ps[$key]=explode(" ", @preg_replace("/ +/i", " ", trim($ps[$key])));
  }
  foreach($ps[0] as $key=>$val){
     $pidinfo[$val] = $ps[1][$key];
     unset($ps[1][$key]);
  }
  
  if(is_array($ps[1])){
     $pidinfo[$val].=" ".implode(" ", $ps[1]);
  }
  return $pidinfo;
}

function IsFloatEqual($x,$y,$precision=0.0000001) {
	if (($x+$precision >= $y)&&($x-$precision <= $y)){
		return array(true,true);
	} elseif (($x+$precision >= $y)) {
		return array(true,false);
	} elseif (($x-$precision <= $y)) {
		return array(false,true);
	}
	return NULL;
}
function mini_bench_to($arg_t, $arg_ra=false,$Start=NULL,$End=NULL,$Min=4) {
	if ($Start == NULL) {
		reset($arg_t);
		current($arg_t);
		$Start = key($arg_t);
	}
	if ($End == NULL) {
		end($arg_t);
		$End = key($arg_t);
		reset($arg_t);
	}
	$COUNTABLE=0;
	$LineScriptA = '<sub>';
	$LineScriptB = '</sub>';
	$tttime=round(($arg_t[$End]-$arg_t[$Start])*1000,4);
	if ($arg_ra) $ar_aff['total_time']=$tttime;
	else $aff=$LineScriptA."EXECUTION&nbsp;TIME:&nbsp;<b>".round($tttime,3)."</b>&nbsp;ms".$LineScriptB;
	$prv_cle=$Start;
	$prv_val=$arg_t[$Start];
	$Modulus = 0;
	foreach ($arg_t as $cle=>$val){
		if ($cle == $Start) $COUNTABLE = 1;
		if(
			($COUNTABLE)&& //In Start to End Range
			($cle!=$Start)&& //Part of the jogging for code, leave alone
			(
				(strtoupper($cle) == $cle)||//Is Group Level (all caps) for public reporting
				($arg_ra==true)//always if returning array
			)
		){
//			if ((($cle!=$End))||($arg_ra==true)) {
				$Modulus++;
				if ($Modulus%2==1) {
					$LineScriptA = '<sup>';
					$LineScriptB = '</sup>';
				} else {
					$LineScriptA = '<sub>';
					$LineScriptB = '</sub>';
				}
				$prcnt_t_old_er = @$prcnt_t_old;
				$prcnt_t_old = @$prcnt_t;
				$prcnt_t=round(((round(($val-$prv_val)*1000,4)/$tttime)*100),1);
//				$test = var_export(IsFloatEqual($prcnt_t,2+0.01),true);
				if ((IsFloatEqual($prcnt_t,$Min,0.000001)==array(true,false))&&($arg_ra!=true)) {
					if ($arg_ra) $ar_aff[$prv_cle.'&nbsp;-&nbsp;>&nbsp;'.$cle]=$prcnt_t;
					@$aff.='&ybsp;'.$LineScriptA.$prv_cle.'&nbsp;'.'-&nbsp;>&nbsp;'.$cle.'&nbsp;:&nbsp;'.$prcnt_t.'%'.$LineScriptB;
//	//			if (!$arg_ra)$aff.="<br>";
					$prv_val=$val;
					$prv_cle=$cle;
				} elseif ((IsFloatEqual($prcnt_t,$Min,0.000001)==array(false,true))&&($arg_ra!=true)) {
					$prcnt_t_old=$prcnt_t_old_er;
					$prcnt_t = $prcnt_t_old;
					$Modulus--;
				} else {
					if ($arg_ra) $ar_aff[$prv_cle.'&nbsp;-&nbsp;>&nbsp;'.$cle]=$prcnt_t;
					@$aff.='&ybsp;'.$LineScriptA.$prv_cle.'&nbsp;'.'-&nbsp;>&nbsp;'.$cle.'&nbsp;:&nbsp;'.$prcnt_t.'%'.$LineScriptB;
//	//			if (!$arg_ra)$aff.="<br>";
					$prv_val=$val;
					$prv_cle=$cle;
				}
//			}
		}
		if ($cle == $End) $COUNTABLE = 0;
	}
	if ($arg_ra) return $ar_aff;
	return str_replace('&ybsp;',' ',str_replace(' ','&nbsp;',$aff));//$aff;
}
function bench($Name=""){
	global $_INTIN;
//quick dirty patch.
	if (!empty($_INTIN['Init']['Stats']['Time'])) {
		$CheckPointCount = count($_INTIN['Init']['Stats']['Time']);
	} else { //unintended fork in logic.
		$CheckPointCount = false;
	}
	if (!empty($Name)) {
		$_INTIN['Init']['Stats']['Time'][$Name] = microtime(true);
		$_INTIN['Init']['Stats']['Memory'][$Name]['usage'] = memory_get_usage(TRUE);
		$_INTIN['Init']['Stats']['Memory'][$Name]['peak'] = memory_get_peak_usage(TRUE);
		$_INTIN['Init']['Stats']['Process'][$Name] = getpidinfo(NULL,"u");
	} else {
		$_INTIN['Init']['Stats']['Time'][$CheckPointCount] = microtime(true);
		$_INTIN['Init']['Stats']['Memory'][$CheckPointCount]['usage'] = memory_get_usage(TRUE);
		$_INTIN['Init']['Stats']['Memory'][$CheckPointCount]['peak'] = memory_get_peak_usage(TRUE);
		$_INTIN['Init']['Stats']['Process'][$CheckPointCount] = getpidinfo();
	}
}
bench('BEGIN');
?>