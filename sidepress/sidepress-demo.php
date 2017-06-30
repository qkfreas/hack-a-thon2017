<!DOCTYPE html>
<html>
<head>
<title>Sidepress demo</title>
<meta charset=UTF-8>
<link type="text/css" href="sidepress.css" rel="stylesheet">
</head>

<body bgcolor="#FFFFFF">

<h1>My website </h1>

<div class="sidepress">
<p>My news</p>
<?php
  // this variable will be used in the script
  $SIDEPRESS_PATH = "wp-content/plugins/sidepress";
  include("$SIDEPRESS_PATH/sidepress.php");
?>
</div>

<p>Demo of the Sidepress script and plugin for Wordpress</p>
<p>By Scriptol.com</p>
<p>Some content here...</p>
</body>
</html>
