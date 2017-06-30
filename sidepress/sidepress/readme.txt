=== Sidepress ===
Contributors: Denis Sureau
Site: http://www.scriptol.com/
Tags: static, page, news, blog, HTML, recent
Requires at least: 2.3
Tested up to: 4.2.3
Stable tag: 2.0

Administering panel for the Sidepress script that displays last news from Wordpress into a static HTML page.

== Description ==

Sidepress is a script to display a summary of news in a static HTML page on a regular site. It may be used
to a static page of Wordpress too.

The administering panel allows to define the property of the summary: number of entries, things to show or not, and so on.
This panel is integrated into the manager of Wordpress thanks to this plugin.

Sidepress is compatible with any other plugin for Wordpress and is not dependent upon versions. 

== Installation ==

1. Upload `sidepress` directory to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Place this code in your static HTML page:

       <?php 
           $SIDEPRESS_PATH = "path of the plugin";
           include("$SIDEPRESS_PATH/sidepress.php");
       ?>

Assign to the variable the full URL or relative path of the sidepress.php file. For example:

  "http://www.example.com/news/wp-content/plugins/sidepress"


== Screenshots ==

http://www.scriptol.com/wordpress/sidepress.png


