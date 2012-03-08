<?php

function filterBadWords($str){

 // words to filter
 $badwords=array( "[naughty word removed]", "[naughty word removed]", "[no swearing please]", "[oops]", "[oops]", "[naughty word removed]", "[oops]", "[oops]" );

 // replace filtered words with
 $replacements=array( "[naughty word removed]", "[how wude!]", "[no swearing please]" );

 for($i=0;$i < sizeof($badwords);$i++){
  srand((double)microtime()*1000000); 
  $rand_key = (rand()%sizeof($replacements));
  $str=eregi_replace($badwords[$i], $replacements[$rand_key], $str);
 }
 return $str;
}


/** RSS READER **/
//get the q parameter from URL
$q=$_GET["q"];

//find out which feed was selected
if($q=="Google")
  {
  $xml=("http://news.google.com/news?ned=us&topic=h&output=rss");
  }
elseif($q=="MSNBC")
  {
  $xml=("http://rss.msnbc.msn.com/id/3032091/device/rss/rss.xml");
  }

$xmlDoc = new DOMDocument();
$xmlDoc->load($xml);

//get elements from "<channel>"
$channel=$xmlDoc->getElementsByTagName('channel')->item(0);
$channel_title = $channel->getElementsByTagName('title')
->item(0)->childNodes->item(0)->nodeValue;
$channel_link = $channel->getElementsByTagName('link')
->item(0)->childNodes->item(0)->nodeValue;
$channel_desc = $channel->getElementsByTagName('description')
->item(0)->childNodes->item(0)->nodeValue;

//output elements from "<channel>"
echo("<p><a href='" . $channel_link
  . "'>" . $channel_title . "</a>");
echo("<br />");
echo($channel_desc . "</p>");

//get and output "<item>" elements
$x=$xmlDoc->getElementsByTagName('item');
for ($i=0; $i<=2; $i++)
  {
  $item_title=$x->item($i)->getElementsByTagName('title')
  ->item(0)->childNodes->item(0)->nodeValue;
  $item_link=$x->item($i)->getElementsByTagName('link')
  ->item(0)->childNodes->item(0)->nodeValue;
  $item_desc=$x->item($i)->getElementsByTagName('description')
  ->item(0)->childNodes->item(0)->nodeValue;

  echo ("<p><a href='" . $item_link
  . "'>" . $item_title . "</a>");
  echo ("<br />");
  echo ($item_desc . "</p>");
  }
?> 
