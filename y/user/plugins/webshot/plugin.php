<?php
/*
Plugin Name: Webshot Plugin
Plugin URI: http://yourls.org/
Description: Add webshot rendering.test for terminator studies
Version: 0.1
Author: NF / 808
Author URI: http://terminat.org/
*/

/* Example of an action
 *
 * We're going to add an entry to the menu.
 *
 * The menu is drawn by function yourls_html_menu() in file includes/functions-html.php.
 * Right before the function outputs the closing </ul>, notice the following function call:
 * yourls_do_action( 'admin_menu' );
 * This function says: "hey, for your information, I've just done something called 'admin menu', thought I'd let you know..."
 *
 * We're going to hook into this action and add our menu entry
 */
yourls_add_action( 'post_add_new_link' , 'terminator_webshot' );
//yourls_add_action( 'admin_menu', 'ozh_sample_add_menu' );
/* This says: when YOURLS does action 'admin_menu', call function 'ozh_sample_add_menu'
 */

function terminator_webshot($args) {
	$url = $args[0];
	$id  = $args[1];
	web_shot($id, $url,"html");
	// sleep 
	sleep(2);
	web_shot($id,$url, "png");
	$fs = filesize("/png/".$id.".png");
	if( $fs < 4000)
	{
		echo $fs.' bytes';
		//echo"PB with <a href='"."/png/".$id.".png'>webshot</a>!";
	}
	else echo "OK!";
}
