<?php
/*
$link 				= mysql_connect('localhost', 'root', '');
	if (!$link) {
	    die('Not connected : ' . mysql_error());
	}
$db_selected 	= mysql_select_db('digital_word', $link);
	if (!$db_selected) {
	    die ('Can\'t use foo : ' . mysql_error());
	}
*/

$link 				= mysql_connect('digittransfer-2001520.mysql.crystone.se', '2001520_pb41178', 'Abcd786786');
	if (!$link) {
	    die('Not connected : ' . mysql_error());
	}
$db_selected 	= mysql_select_db('2001520-digittransfer', $link);
	if (!$db_selected) {
	    die ('Can\'t use foo : ' . mysql_error());
	}  

?>
