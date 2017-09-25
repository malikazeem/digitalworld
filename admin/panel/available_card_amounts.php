<?php
include("db_con2.php");	
	if(!$db) {	
		echo 'Could not connect to the database.';
	} else {	
		if(isset($_POST['queryString'])) {
			$queryString 		= $db->real_escape_string($_POST['queryString']);
			$parameter_array 	= explode(":", $queryString);
			$company_name		= $parameter_array[0];
			$card_type			= $parameter_array[1];			
				if (strlen($queryString) > 0) {	
					$query = $db->query("SELECT amount FROM cards_collection WHERE type = '$card_type' AND company = '$company_name' AND status = '0'");
						if ($query) {					
							while ($result = $query ->fetch_object()) {
			         			echo $amount = $result->amount.", ";								
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