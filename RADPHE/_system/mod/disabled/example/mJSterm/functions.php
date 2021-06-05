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
    $StartPart = time();
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
	    	$diff=$end-$Start;
	    	while(
	    			($diff < $timeout)
	    			) {
	    				$end = time();
	    				$MEthod='curl';
	    				$ch = curl_init('http://10.200.100.20/No_Sleep_Makes_NGINX_Posing_As_Apache_To_Do_Weird_Things');
	    				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    				curl_setopt($ch, CURLOPT_VERBOSE, 0);
	    				curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);//maybe+1
	    				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	    				$response = curl_exec($ch);
	    				if ($response === false) {
	    					$info = curl_getinfo($ch);
	    					if ($info['http_code'] === 0) {
	    					}
	    				}
	    				$diff=$end-$Start;
	    				continue;
	    			}
	    }
	    if ((0)&&($MEthodToggle / 5  == 4)) {//BURN IT UP ================================= 0 = not.
	        //This one gets cpu hot. so dont do it. have a server with real sleep.
	        //microtime is slower. fix use it explode by space and make its time boundery use the unix ts plus the mtime for the measure. if a resonable delay was made allow it to recall it self.
	        $MEthod='time';
	        $end = time();
	        $diff=$end-$Start;
	        while(
	            ($diff < $timeout)
	            ) {
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
	    		$dbtimestart = value($row);
	    	}
	    	mysql_close($linkSlow);
	    	$end = time();
	    	$diff=$end-$Start;
	    	while(
	    			($diff < $timeout)
	    			) {
	    				$linkSlow = @mysql_connect("localhost","mod_mJSterm","","radphe");
	    				if (!$linkSlow) $linkSlow = @mysql_connect($_INTIN['DB']['Profiles']['Pro']['Host'],$_INTIN['DB']['Profiles']['Pro']['User'],$_INTIN['DB']['Profiles']['Pro']['Pass'],$_INTIN['DB']['Profiles']['Pro']['Schema']);
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