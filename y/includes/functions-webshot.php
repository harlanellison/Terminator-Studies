<?php


function web_shot($id, $url, $format)
{
	
	//$TERMINAT_URL = "http://24.5.79.111/url/?id=";
	$cuty = WEBSHOT_CUTYCAPT;
	$xv = WEBSHOT_XVFB; 
	//$xv=$cuty;
	$screenX = WEBSHOT_SCREEN_X;
	$screenY = WEBSHOT_SCREEN_Y;
	$colDepth = WEBSHOT_COLOR_DEPTH;
	$timeout = WEBSHOT_TIMEOUT * 1000;
	$ua = WEBSHOT_USER_AGENT;
	$jsOn = WEBSHOT_JAVASCRIPT_ON ? 'on' : 'off';
	$javaOn = WEBSHOT_JAVA_ON ? 'on' : 'off';
	$pluginsOn = WEBSHOT_PLUGINS_ON ? 'on' : 'off';
	if($format == 'html' || $format == 'png') $file = LOCAL_PATH . $format . "/". $id . "." . $format;
	else die('mozahfrackr');
	echo "****".$file."****";
	//$url = TERMINAT_URL . $id; //lil'url version
	//$url = yourls_get_keyword_longurl( $id ); //yourls version
	//echo "#".$url;die;
	$command = "$xv --server-args=\"-screen 0, {$screenX}x{$screenY}x{$colDepth}\" $cuty --max-wait=$timeout --user-agent=\"$ua\" --javascript=$jsOn --java=$javaOn --plugins=$pluginsOn --js-can-open-windows=off --url=\"$url\" --out-format=$format --out=".$file ;
	
	// put this at the top of the page -->

	$mtime = microtime();
	$mtime = explode(" ",$mtime);
	$mtime = $mtime[1] + $mtime[0];
	$starttime = $mtime;
   
	//exec($command,$out,$return);
	passthru($command,$return);
	// put this code at the bottom of the page -->

	$mtime = microtime();
	$mtime = explode(" ",$mtime);
	$mtime = $mtime[1] + $mtime[0];
	$endtime = $mtime;
	$totaltime = ($endtime - $starttime);
	//echo "<pre>".$command ."</pre><small>This " .$format. " shot was terminated in ".$totaltime." seconds</small></small><br>";
	if($return != 127)
		echo "[".$return."]<small>This " .$format. " shot was terminated in ".$totaltime." seconds</small></small><br>";
	else echo "SHIT! (".$format.")<hr/>";
//	print_r($out);
}

