<?php

	if (isset( $_POST ))
		$posted = &$_POST ;			
	else
		$posted = &$HTTP_POST_VARS ;  
	
  $nfile = fopen("sidepress.ini", "w");
  if($nfile != false)
  {
	 fwrite($nfile, "SIDEPRESS_SIZE=".$posted["number"]."\n");
	 fwrite($nfile, "SIDEPRESS_TITLE=".$posted["title"]."\n");
	 fwrite($nfile, "SIDEPRESS_DATE=".$posted["date"]."\n");
	 fwrite($nfile, "SIDEPRESS_DESC=".$posted["desc"]."\n");
	 fwrite($nfile, "SIDEPRESS_DESCSIZE=".$posted["descsize"]."\n");         	 
	 fclose($nfile);
  }	

?>
