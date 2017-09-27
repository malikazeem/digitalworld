<?php
<<<<<<< HEAD


  $link 				= mysqli_connect('localhost', 'root', '','digital_world');
  if (!$link) {
  die('Not connected : ' . mysqli_connect_error());
  }
  
 
=======

$link 				= mysql_connect('localhost', 'root', '');
	if (!$link) {
	    die('Not connected : ' . mysql_error());
	}
$db_selected 	= mysql_select_db('digital_word', $link);
	if (!$db_selected) {
	    die ('Can\'t use foo : ' . mysql_error());
	}


>>>>>>> 9645266330ff1c83b5ef512e20fb39c6d922c91d


?>
