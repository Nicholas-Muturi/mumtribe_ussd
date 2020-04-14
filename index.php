<?php
$sessionId = $_POST['sessionId'];
$serviceCode = $_POST['serviceCode'];
$phoneNumber = $_POST['phoneNumber'];
$text = $_POST['text'];

header('Content-type: text/plain');
$response = input_logic($text, $phoneNumber);
echo $response;


/* FUNCTIONS */
function input_logic($input, $phoneNumber){
	/**
	 * ORDER OF MENUS
	 * Menus with sub-menus will be first
	 * Root/Single menu options (1,2,3 e.t.c) will be last in arrangement
	 * All menus arranged in reverse order (submenus to root)
	 * Done this way to handle regex logic
	 */
	$phoneNumber = $phoneNumber;
	$response = "";

	if($input == ""){
		$response = "CON Welcome. Select an option below \n";
		$response .= "1. Register \n";
		$response .= "2. Get baby name \n";
		$response .= "3. Check for health professionals \n";
		$response .= "4. Daily health reminders \n";
		$response .= "5. Ovulation Calculator \n";
		$response .= "6. Due date calculator\n";
		$response .= "7. Get instant ambulance for delivery \n";
		$response .= "8. Checkout nearest health center \n";
		$response .= "98. More \n";
	}
	/* BACK NAVIGATION */
	else if(preg_match("/98$/", $input)){
		$response = "CON Select an option below \n";
		$response .= "9. Check maternity shops \n";
		$response .= "10. Book private birthing \n";
		$response .= "11. Subscribe daily tips\n";
		$response .= "00. Back Home \n";
	}
	else if(preg_match("/[*]00$/", $input)){
		$response = "CON Welcome. Select an option below \n";
		$response .= "1. Register \n";
		$response .= "2. Get baby name \n";
		$response .= "3. Check for health professionals \n";
		$response .= "4. Daily health reminders \n";
		$response .= "5. Ovulation Calculator \n";
		$response .= "6. Due date calculator\n";
		$response .= "7. Get instant ambulance for delivery \n";
		$response .= "8. Checkout nearest health center \n";
		$response .= "98. More \n";		
	}

	// Menu 1 Options
	else if(preg_match("/1[*][a-zA-Z0-9_.+]+@[a-zA-Z0-9]+.[a-zA-Z]+[*][a-zA-Z0-9]+[*][0-9]+$/",$input)){
		$exploded = explode("*",$input);
		$email = $exploded[count($exploded)-3];
		$pass = $exploded[count($exploded)-2];
		$age = $exploded[count($exploded)-1];
		$response = "END Email/Password/Age are " . $email . " / " . $pass . " / " . $age . "\n";
	}
	else if(preg_match("/1[*][a-zA-Z0-9_.+]+@[a-zA-Z0-9]+.[a-zA-Z]+[*][a-zA-Z0-9]+$/",$input)){
		$response = "CON Enter age \n";
	}
	else if(preg_match("/1[*][a-zA-Z0-9_.+]+@[a-zA-Z0-9]+.[a-zA-Z]+$/",$input)){
		$response = "CON Enter password \n";
	}

	//Menu 2 Options
	else if(preg_match("/2[*]2$/",$input)){
		$response = "END Female names \n";
		$femalenames = array("Jane", "Racheal", "Anna", "Tokyo", "Nairobi");
		for($i=0;$i<count($femalenames);$i++){
			$response .= ($i + 1) . " " . $femalenames[$i] . "\n";
		}
	}
	else if(preg_match("/2[*]1$/",$input)){
		$response = "END Male names \n";
		$malenames = array("Steve", "Tom", "Andrew", "Greg", "John");
		for($i=0;$i<count($malenames);$i++){
			$response .= ($i + 1) . " " . $malenames[$i] . "\n";
		}
	}

	//Menu 4 Options
	else if(preg_match("/4[*]2$/",$input)){
		$response = "END $phoneNumber is now unsubscribed to health reminders";		
	}
	else if(preg_match("/4[*]1$/",$input)){
		$response = "END $phoneNumber is now subscribed to health reminders";		
	}
	
	//Menu 5 Options
	else if(preg_match("/5[*][\d]+[\/][\d]+[\/][\d]{4}+$/",$input)){
		$exploded = explode("*",$input);
		$date_input = $exploded[count($exploded)-1];
		$exploded_date = explode("/",$date_input);
		$day =  $exploded_date[0];
		$month = $exploded_date[1];
		$year = $exploded_date[2];

		$response = "END Previous cycle:$day/$month/$year. -- Next cycle date: n/a";		
	}

	//Menu 6
	else if(preg_match("/6[*][\d]+[\/][\d]+[\/][\d]{4}+$/",$input)){
		$exploded = explode("*",$input);
		$date_input = $exploded[count($exploded)-1];
		$exploded_date = explode("/",$date_input);
		$day =  $exploded_date[0];
		$month = $exploded_date[1];
		$year = $exploded_date[2];
		$response = "END Previous date:$day/$month/$year. -- Estimated date: n/a";
	}

	//Menu 11 Options
	else if(preg_match("/11[*]2$/",$input)){
		$response = "END $phoneNumber is now unsubscribed to daily tips";
	}
	else if(preg_match("/11[*]1$/",$input)){
		$response = "END $phoneNumber is now subscribed to daily tips";
	}

	/* Root/Single menus */
	else if(preg_match("/11$/",$input)){
		$response = "CON 1. Subscribe \n";
		$response .= "2. Unsubscribe \n";
		$response .= "00. Back Home \n";
	}
	else if(preg_match("/10$/",$input)){
		$response = "END List of maternity shops\n";
	}
	else if(preg_match("/9$/",$input)){
		$response = "END List of maternity shops\n";
	}
	else if(preg_match("/8$/",$input)){
		$response = "END Checkout to nearest health center (not really sure what happens here)\n";
	}
	else if(preg_match("/7$/",$input)){
		$response = "END You shall be called by an emergency service shortly \n";
	}
	else if(preg_match("/6$/",$input)){
		$response = "CON Enter conception date in dd/mm/yyyy format \n";
	}
	else if(preg_match("/5$/",$input)){
		$response = "CON Enter the date of your last period in dd/mm/yyyy format \n";		
	}
	else if(preg_match("/4$/",$input)){
		$response = "CON 1. Subscribe \n";
		$response .= "2. Unsubscribe \n";
		$response .= "00. Back Home \n";
	}
	else if(preg_match("/3$/",$input)){
		$response = "END health professional list here";
	}
	else if(preg_match("/2$/",$input)){
		$response = "CON Select an option below \n";
		$response .= "1. Male names \n";
		$response .= "2. Female names \n";
		$response .= "00. Back Home \n";
	}
	else if(preg_match("/1$/",$input)){
		$response = "CON Enter email address \n";
	}
	else {
		$response = "END An error occured";
	}

	return $response;
}

?>

