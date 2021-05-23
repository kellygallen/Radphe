<?php
@require_once($_SERVER['DOCUMENT_ROOT'].'/_system/_SiteEngine.php');//Fallback Hook.

function is_func_enabled($func) {
    $disabled = explode(',', ini_get('disable_functions'));
    foreach ($disabled as $disableFunction) {
        $is_disabled[] = trim($disableFunction);
    }
    if ((in_array($func,$is_disabled))&&(function_exists($func))) {
        return false;
    } else {
        return true;
    }
    return false;
}
function skippy_sleep($timeout=1) {
    $Start = time();
//    $StartPart = explode('.',$Start);
    $StartPart = time();
//    $finishStart=$StartPart[0]+$timeout;
//    $finishStart=$finishStart.'.'.$StartPart[1];
//    $finishStart=$Start+$timeout;
    $finishStart=$Start+$timeout;
    $MethodCount=0;
    $MEthodToggle=0;
    $quit=0;
	while ($quit) {
	    $MEthod=false;
	    $MethodCount++;
	    $MEthodToggle++;
	    if ((1)&&($MEthodToggle / 5 == 1)/* &&(is_func_enabled('sleep')) */) {
	        $MEthod='sleep';
	        @sleep($timeout);
	    }
	    if ((1)&&($MEthodToggle / 5 == 2)/* &&(is_func_enabled('usleep'))**/) {
	        $MEthod='usleep';
	        @usleep(1000000*$timeout);
	    }
	    if ((1)&&($MEthodToggle / 5 == 3) &&(is_func_enabled('curl_exec'))) {
	    	$MEthod='time';
	    	$end = time();
	    	//		$diff=round($end,2)-round($Start,2);
	    	$diff=$end-$Start;
	    	//		die('sleepy:'.$end.'-'.$Start.'='.$diff.'>?'.$timeout.' But the fiish is '.$finishStart);
	    	//		if( floatval( (string) $a ) < floatval( (string) $b) ) { //do something }
	    	//		$diff=bcsub($end, $Start, 4); //nobcmath
	    	while(
	    			($diff < $timeout)
	    			) {
	    				//			error_log('sleepy:'.$end.'-'.$Start.'='.$diff.'>?'.$timeout.' But the fiish is '.$finishStart,0);
	    				$end = time();

	    				$MEthod='curl';
	    				$ch = curl_init('http://10.200.100.20/No_Sleep_Makes_NGINX_Posing_As_Apache_To_Do_Weird_Things');
	    				//localhost or a site that putposly never flushes output and keeps a iniated but null connection open for atleast a few seconds. or just a slow to respond site like my wordpress.
	    				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    				curl_setopt($ch, CURLOPT_VERBOSE, 0);
	    				curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);//maybe+1
	    				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	    				$response = curl_exec($ch);
	    				if ($response === false) {
	    					$info = curl_getinfo($ch);
	    					if ($info['http_code'] === 0) {
	    						// timeouth=
	    					}
	    				}
	    				$diff=$end-$Start;
	    				continue;
	    			}
	    }
	    if ((0)&&($MEthodToggle / 5  == 4)) {//BURN IT UP ================================= 0 = not.
	        //This one gets cpu hot.
	        //microtime is slower. fix use it explode by space and make its time boundery use the unix ts plus the mtime for the measure. if a resonable delay was made allow it to recall it self.
	        //		$MEthod='microtime';
	        $MEthod='time';
	        $end = time();
	        //		$diff=round($end,2)-round($Start,2);
	        $diff=$end-$Start;
	        //		die('sleepy:'.$end.'-'.$Start.'='.$diff.'>?'.$timeout.' But the fiish is '.$finishStart);
	        //		if( floatval( (string) $a ) < floatval( (string) $b) ) { //do something }
	        //		$diff=bcsub($end, $Start, 4); //nobcmath
	        while(
	            ($diff < $timeout)
	            ) {
	                //			error_log('sleepy:'.$end.'-'.$Start.'='.$diff.'>?'.$timeout.' But the fiish is '.$finishStart,0);
	                $end = time();
	                $diff=$end-$Start;
	                continue;
	            }
	    }
	    if ((1)&&($MEthodToggle / 5 == 0)) {
	    	//mysql not mysqli
	    	$MEthod='time';
	    	$dbtimenow=0;
	    	$dbtimestart=0;

	    	$linkSlow = @mysql_connect("localhost","mod_mJSterm","","radphe");
	    	if (!$linkSlow) $linkSlow = @mysql_connect($_INTIN['DB']['Profiles']['Pro']['Host'],$_INTIN['DB']['Profiles']['Pro']['User'],$_INTIN['DB']['Profiles']['Pro']['Pass'],$_INTIN['DB']['Profiles']['Pro']['Schema']);
	    	$result = mysql_query("select concat(mod(unix_timestamp(now(6)),1),'00 ',unix_timestamp());",$linkSlow);
	    	while ($row = mysql_fetch_assoc($result)) {
	//todo
	//work with microtime. here and there.
	    		$dbtimestart = value($row);
	    	}
	    	mysql_close($linkSlow);
	    	$end = time();
	    	//		$diff=round($end,2)-round($Start,2);
	    	$diff=$end-$Start;
	    	//		die('sleepy:'.$end.'-'.$Start.'='.$diff.'>?'.$timeout.' But the fiish is '.$finishStart);
	    	//		if( floatval( (string) $a ) < floatval( (string) $b) ) { //do something }
	    	//		$diff=bcsub($end, $Start, 4); //nobcmath
	    	while(
	    			($diff < $timeout)
	    			) {
	    				//			error_log('sleepy:'.$end.'-'.$Start.'='.$diff.'>?'.$timeout.' But the fiish is '.$finishStart,0);
	    				$linkSlow = @mysql_connect("localhost","mod_mJSterm","","radphe");
	    				if (!$linkSlow) $linkSlow = @mysql_connect($_INTIN['DB']['Profiles']['Pro']['Host'],$_INTIN['DB']['Profiles']['Pro']['User'],$_INTIN['DB']['Profiles']['Pro']['Pass'],$_INTIN['DB']['Profiles']['Pro']['Schema']);
	    				//query db for time. compare to real time. micro time and if php7 hwtime to detect and time timing issues.
	    				//but for now disconeect and reconnect should do it to lag some considerable microtime.
	    				//select concat(mod(unix_timestamp(now(6)),1),'00 ',unix_timestamp());
	    				$result = mysql_query("select concat(mod(unix_timestamp(now(6)),1),'00 ',unix_timestamp());",$linkSlow);
	    				while ($row = mysql_fetch_assoc($result)) {
	    					$dbtimenow = value($row);
	    				}
	    				mysql_close($linkSlow);
	    				$end = time();
	    				$diff=$end-$Start;
	    				continue;
	    			}
	    }
	    if (0) {//fail.
	        return array('ME'=>false);
	    }
	    if ($finishStart<=time()) {
	    	$quit=1;
//	    	return array('Begin'=>$Start,'End'=>$end,'ME'=>$MEthod,'Diff'=>$diff);
	    }

	    $end = time();
	    //	while (($end-$Start)<$timeout) skippy_sleep(1);
	    $diff=$end-$Start;
	    return array('Begin'=>$Start,'End'=>$end,'ME'=>$MEthod,'Diff'=>$diff);
	}

}
?>