<?php
include("db_con2.php");
	if(!$db) {	
		echo 'Could not connect to the database.';
	} else {	
		if(isset($_POST['queryString'])) {				
			$queryString = $db->real_escape_string($_POST['queryString']);			
			if(strlen($queryString) >0) {
				$query = $db->query("SELECT * FROM users WHERE id = '$queryString'");
					if ($query) {				
						while ($result = $query ->fetch_object()) {
		         			echo $parameter = $result->id."|".$result->first_name."|".$result->last_name."|".$result->phone1."|".$result->address."|".$result->city."|".$result->country;
		         		}
						
				} else {
					echo 'OOPS we had a problem :(';
				}
			} else {
				// do nothing
			}
		} else {
			echo 'There should be no direct access to this script!';
		}
	}
?>