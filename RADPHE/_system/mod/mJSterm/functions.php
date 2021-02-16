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
    $StartPart = explode('.',$Start);
    $finishStart=$StartPart[0]+$timeout;
    $finishStart=$finishStart.'.'.$StartPart[1];
    $finishStart=$Start+$timeout;

    $MEthod=false;
    if ((0)&&(is_func_enabled('sleep'))) {
        $MEthod='sleep';
        @sleep($timeout);
    } elseif ((0)&&(is_func_enabled('usleep'))) {
        $MEthod='usleep';
        @usleep(1000000*$timeout);
    } elseif ((1)&&(is_func_enabled('curl_exec'))) {
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
    } elseif (0) {//BURN IT UP ================================= 0 = not.
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
                //			$diff=round($end,2)-round($Start,2);
                $diff=$end-$Start;
                continue;
            }
    } elseif (1) {
    	//mysql not mysqli
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
    				//			$diff=round($end,2)-round($Start,2);
    				$diff=$end-$Start;
    				$linkSlow = @mysql_connect("localhost","mod_mJSterm","","radphe");
    				if (!$linkSlow) $linkSlow = @mysql_connect($_INTIN['DB']['Profiles']['Pro']['Host'],$_INTIN['DB']['Profiles']['Pro']['User'],$_INTIN['DB']['Profiles']['Pro']['Pass'],$_INTIN['DB']['Profiles']['Pro']['Schema']);
    				//query db for time. compare to real time. micro time and if php7 hwtime to detect and time timing issues.
    				//but for now disconeect and reconnect should do it to lag some considerable microtime.
    				mysql_close($$linkSlow);
    				continue;
    			}
    } else {//fail.
        return array('ME'=>false);
    }
    $end = time();
    //	while (($end-$Start)<$timeout) skippy_sleep(1);
    $diff=$end-$Start;
    return array('Begin'=>$Start,'End'=>$end,'ME'=>$MEthod,'Diff'=>$diff);
}
?>