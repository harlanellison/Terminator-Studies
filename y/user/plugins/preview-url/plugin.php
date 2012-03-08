<?php
/*
Plugin Name: Preview URL
Plugin URI: http://yourls.org/
Description: Preview URLs before you're redirected there
Version: 1.0
Author: Ozh
Author URI: http://ozh.org/
*/

// EDIT THIS

// Character to add to a short URL to trigger the preview interruption
define( 'OZH_PREVIEW_CHAR'	, '&' );
define( 'BJB_PREVIEW_PNG' 	, '~' );
define( 'BJB_PREVIEW_REDIR' , '!' );
// DO NO EDIT FURTHER

// Handle failed loader request and check if there's a ~
yourls_add_action( 'loader_failed', 'ozh_preview_loader_failed' );
function ozh_preview_loader_failed( $args ) {
        $request = $args[0];
        $pattern = yourls_make_regexp_pattern( yourls_get_shorturl_charset() );
        
        if( preg_match( "@^([$pattern]+)".OZH_PREVIEW_CHAR."(.*)$@", $request, $matches ) ) {
                $keyword = isset( $matches[1] ) ? $matches[1] : '';
                $keyword = yourls_sanitize_keyword( $keyword );
               // print_r($matches);die;
                list($w, $h) = split('x', $matches[2]);
                BJB_preview_thumb( $keyword ,$w,$h);
                die();
        }
        
        if( preg_match( "@^([$pattern]+)".BJB_PREVIEW_PNG."$@"	, $request, $matches ) ) {
                $keyword   = isset( $matches[1] ) ? $matches[1] : '';
                $keyword = yourls_sanitize_keyword( $keyword );
                BJB_preview_PNG( $keyword );
                die();
        }
        if( preg_match( "@^([$pattern]+)".BJB_PREVIEW_REDIR."$@", $request, $matches ) ) {
                $keyword   = isset( $matches[1] ) ? $matches[1] : '';
                $keyword = yourls_sanitize_keyword( $keyword );
                BJB_preview_REDIR( $keyword );
        }
}

// Show the preview screen for a short URL

function BJB_preview_REDIR( $keyword ) {
	
	// Get URL and page title
	$longurl = $args[0];
	$url = "/html/". $keyword . ".html";
	
	$pagetitle = yourls_get_keyword_title( $ozh_toolbar['keyword'] );

	// Update title if it hasn't been stored yet
	if( $pagetitle == '' ) {
		$pagetitle = yourls_get_remote_title( $url );
		yourls_edit_link_title( $ozh_toolbar['keyword'], $pagetitle );
	}
	$_pagetitle = htmlentities( yourls_get_remote_title( $url ) );
	
	$www = YOURLS_SITE;
	$ver = YOURLS_VERSION;
	$md5 = md5( $url );
	$sql = yourls_get_num_queries();

	// When was the link created (in days)
	$diff = abs( time() - strtotime( yourls_get_keyword_timestamp( $ozh_toolbar['keyword'] ) ) );
	$days = floor( $diff / (60*60*24) );
	if( $days == 0 ) {
		$created = 'today';
	} else {
		$created = $days.' '.yourls_plural( 'day', $days).' ago';
	}
	
	// How many hits on the page
	$hits = 1 + yourls_get_keyword_clicks( $ozh_toolbar['keyword'] );
	$hits = $hits.' '.yourls_plural( 'view', $hits);
	
	// Plugin URL (no URL is hardcoded)
	$pluginurl = YOURLS_PLUGINURL . '/'.yourls_plugin_basename( dirname(__FILE__) );

	// All set. Draw the toolbar itself.
	echo <<<PAGE
<html>
<head>
	<title>$pagetitle &mdash; YOURLS</title>
	<link rel="icon" type="image/gif" href="$www/images/favicon.gif" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="chrome=1" />
	<meta name="generator" content="YOURLS v$ver" />
	<meta name="ROBOTS" content="NOINDEX, FOLLOW" />
	<link rel="stylesheet" href="$pluginurl/css/toolbar.css" type="text/css" media="all" />
</head>
<body>
<div id="yourls-bar">
	<div id="yourls-about">
		Short link powered by <a href="http://yourls.org/">YOURLS</a> and created $created. $hits.
		<!-- $sql queries -->
	</div>
	
	<div id="yourls-delicious">
	<img src="http://static.delicious.com/img/delicious.small.gif" height="10" width="10" alt="Delicious" />
	<a id="yourls-delicious-link" title="Bookmark on delicious" href="http://delicious.com/save" onclick="window.open('http://delicious.com/save?v=5&noui&jump=close&url='+encodeURIComponent(location.href)+'&title='+encodeURIComponent(document.title), 'delicious','toolbar=no,width=550,height=550'); return false;"> Bookmark on Delicious</a>
	</div>

	<script type="text/javascript" id="topsy_global_settings">
	var topsy_theme = "light-blue";
	var topsy_nick = " ";
	var topsy_style = "small";
	var topsy_order = "count,retweet,badge";
	</script>
	<div id="yourls-topsy" class="topsy_widget_data">
		<!--{
		        "url": "$www/{$ozh_toolbar['keyword']}",
		        "title": "$_pagetitle",
		}-->
	</div>
	
	<div id="yourls-selfclose">
		<a id="yourls-once" href="$url" title="Close this toolbar">close</a>
		<a id="yourls-always" href="$url" title="Never show me this toolbar again">close</a>
		
	</div>
</div>

<iframe id="yourls-frame" frameborder="0" noresize="noresize" src="$url" name="yourlsFrame"></iframe>
<script type="text/javascript" src="$pluginurl/js/toolbar.js"></script>
<!--script type="text/javascript" src="http://cdn.topsy.com/topsy.js?init=topsyWidgetCreator"></script-->
<!--script type="text/javascript" src="http://feeds.delicious.com/v2/json/urlinfo/$md5?callback=yourls_get_books"></script-->
</body>
</html>
PAGE;
	
	// Don't forget to die, to interrupt the flow of normal events (ie redirecting to long URL)
	die();
}
	
function BJB_preview_thumb( $keyword,$w,$h ) {
	
        $title = yourls_get_keyword_title( $keyword );
        $url   = yourls_get_keyword_longurl( $keyword );
        $base  = YOURLS_SITE;
        $char  = OZH_PREVIEW_CHAR;
        //$thumb  = WEBSHOT_URL;
        $urlpng = TERMINAT_SERV."thumb.php?&a=tl&w=".$w."&h=".$h."&src=". TERMINAT_SERV ."png/". $keyword.".png";
        $urlpng ="/thumb.php?&a=tl&w=".$w."&h=".$h."&src=". TERMINAT_SERV ."png/". $keyword.".png";
        header('Content-Type: image/png');
        //header('Content-Disposition: inline; filename="$urlpng"');
		header('Location: '.$urlpng);

}

function BJB_preview_PNG( $keyword ) {
        require_once( YOURLS_INC.'/functions-html.php' );
        
        yourls_html_head( 'preview', 'PNG preview' );
        yourls_html_logo();

        $title = yourls_get_keyword_title( $keyword );
        $url   = yourls_get_keyword_longurl( $keyword );
        $base  = YOURLS_SITE;
        $char  = OZH_PREVIEW_CHAR;
        $thumb  = WEBSHOT_URL;
        
        echo <<<HTML
        <h2>        $title</h2>
        <p>You requested the short URL <strong><a href="$base/$keyword">$base/$keyword</a></strong></p>
       <img src="/png/$keyword.png">
        <ul>
        <li>Long URL: <strong><a href="$base/$keyword">$url</a></strong></li>
        <li>Page title: <strong>$title</strong></li>
        </ul>
        <p>If you still want to visit this link, please <strong><a href="$base/$keyword">click here</a></strong>.</p>
        
        <p>Thank you for using our shortening service.</p>
HTML;
        
        yourls_html_footer();
}
function ozh_preview_show( $keyword ) {
        require_once( YOURLS_INC.'/functions-html.php' );
        
        yourls_html_head( 'preview', 'Short URL preview' );
        yourls_html_logo();

        $title = yourls_get_keyword_title( $keyword );
        $url   = yourls_get_keyword_longurl( $keyword );
        $base  = YOURLS_SITE;
        $char  = OZH_PREVIEW_CHAR;
        $thumb  = WEBSHOT_URL;
        
        echo <<<HTML
        <h2>Link Preview</h2>
        <p>You requested the short URL <strong><a href="$base/$keyword">$base/$keyword</a></strong></p>
        <p>This short URL points to:</p>
        <a href="/png/$keyword.png"><img src="$thumb$keyword.png"></a>
        <ul>
        <li>Long URL: <strong><a href="$base/$keyword">$url</a></strong></li>
        <li>Page title: <strong>$title</strong></li>
        </ul>
        <p>If you still want to visit this link, please <strong><a href="$base/$keyword">click here</a></strong>.</p>
        
        <p>Thank you for using our shortening service.</p>
HTML;
        
        yourls_html_footer();
}
