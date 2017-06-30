<?php
/*
Plugin Name: Sidepress
Plugin URI: http://www.scriptol.com/wordpress/sidepress.php
Description: Administering panel for the sidepress script that allows to display a summary of your news into a static HTML web page.
Version: 2.0
Author: Denis Sureau
Author URI: http://www.scriptol.com/wordpress/
*/

$path = "../wp-content/plugins/";

function sidepress_admin_menu() 
{
  if (function_exists ( 'add_options_page' )){
   add_options_page ( 'Sidepress', 'Sidepress', 'manage_options', "$path/sidepress/sidepress-form.php");
  }	
}

add_action('admin_menu', 'sidepress_admin_menu');

?>
