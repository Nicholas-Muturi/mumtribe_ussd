<?php
$sessionId = $_POST['sessionId'];
$serviceCode = $_POST['serviceCode'];
$phoneNumber = $_POST['phoneNumber'];
$text = $_POST['text'];


function input_logic($input, $phoneNumber){

	// if(count($input)>1){
	// 	$previous_menu=explode("*",$input);
	// 	array_pop($previous_menu); 
	// }
	// else{
	// 	$previous_menu = "";
	// }

	$phoneNumber = $phoneNumber;
	$response = "";

	switch($input){
		case "":
			$response = "CON Welcome. Select an option below \n";
			$response .= "1. Register \n";
			$response .= "2. Get baby name \n";
			$response .= "3. Check for health professionals \n";
			$response .= "4. Daily health reminders \n";
			$response .= "5. Ovulation Calculator \n";
			$response .= "98. More \n";
		break;
		case preg_match("/98$/", $input):

		break;
		case preg_match("/[*]00$/", $input):
			$response = "CON Welcome. Select an option below \n";
			$response .= "1. Register \n";
			$response .= "2. Get baby name \n";
			$response .= "3. Check for health professionals \n";
			$response .= "4. Daily health reminders \n";
			$response .= "5. Ovulation Calculator \n";
			$response .= "98. More \n";
		break;

		//Menu 1
		case preg_match("/1$/",$input):
			$response = "CON Enter email address \n";
		break;
		case preg_match("/1[*][a-zA-Z0-9_.+]+@[a-zA-Z0-9]+.[a-zA-Z]+$/",$input):
			$response = "CON Enter password \n";
		break;
		case preg_match("/1[*][a-zA-Z0-9_.+]+@[a-zA-Z0-9]+.[a-zA-Z]+$[*][0-9]/",$input):
			$response = "CON Enter age \n";
		break;
		case preg_match("/1[*][a-zA-Z0-9_.+]+@[a-zA-Z0-9]+.[a-zA-Z]+[*][a-zA-Z0-9]+$/",$input):
			$exploded = explode("*",$input);
			$email = $exploded[count($exploded)-3];
			$pass = $exploded[count($exploded)-2];
			$age = $exploded[count($exploded)-1];
			$response = "END Email/Password/Age are " . $email . " / " . $pass . " / " . $age . "\n";

		break;
		//Menu 2
		case preg_match("/2$/",$input):
			$response = "CON Select an option below \n";
			$response .= "1. Male names \n";
			$response .= "2. Female names \n";
			$response .= "00. Back \n";
		break;
		case preg_match("/2[*]1$/",$input):
			$response = "END Male names \n";
			$malenames = array("Steve", "Tom", "Andrew", "Greg", "John");
			for($i=0;$i<count($malenames);$i++){
				$response .= ($i + 1) . " " . $malenames[$i] . "\n";
			}
		break;
		case preg_match("/2[*]2$/",$input):
			$response = "END Female names \n";
			$femalenames = array("Jane", "Racheal", "Anna", "Tokyo", "Nairobi");
			for($i=0;$i<count($femalenames);$i++){
				$response .= ($i + 1) . " " . $femalenames[$i] . "\n";
			}
		break;
		//Menu 3
		case preg_match("/3$/",$input):
			$response = "END health proffesional list here";
		break;
		
		//Menu 4
		case preg_match("/4$/",$input):
			$response = "CON 1. Subscribe \n";
			$response .= "2. Unsubscribed \n";
			$response .= "00. Back \n";

		break;
		case preg_match("/4[*]1$/",$input):
			$response = "END $phoneNumber is now subscribed to health reeminders";
		break;
		case preg_match("/4[*]2$/",$input):
			$response = "END $phoneNumber is now unsubscribed to health reminders";
		break;

		//Menu 5
		case preg_match("/5$/",$input):
			$response = "CON Enter the date of your last period (01-31) \n";
		break;
		case preg_match("/5[*][0-3][0-1]+$/",$input):
			$response = "CON Enter the month of your last period\n";
		break;
		case preg_match("/5[*][0-3][0-1][*][a-zA-Z]+$/",$input):
			$exploded = explode("*",$input);
			$day = $exploded[count($exploded)-2];
			$month = $exploded[count($exploded)-1];
			$year = date("Y");

			$response = "END Previous cycle:$day/$month/$year. -- Next cycle date: n/a";
		break;

		//Menu 6
		case preg_match("/6$/",$input):
			$response = "CON Enter conception date (01-31) \n";
		break;
		case preg_match("/6[*][0-3][0-1]+$/",$input):
			$response = "CON Enter the Enter conception month\n";
		break;
		case preg_match("/6[*][0-3][0-1][*][a-zA-Z]+$/",$input):
			$exploded = explode("*",$input);
			$day = $exploded[count($exploded)-2];
			$month = $exploded[count($exploded)-1];
			$year = date("Y");

			$response = "END Previous date:$day/$month/$year. -- Estimated date: n/a";
		break;

		//Menu 7
		case preg_match("/7$/",$input):
			$response = "END You shall be called by an emergency service shortly \n";
		break;

		//Menu 8
		case preg_match("/8$/",$input):
			$response = "END Checkout to nearest health center (not really sure what happens here)\n";
		break;

		//Menu 9
		case preg_match("/9$/",$input):
			$response = "END List of maternity shops\n";
		break;

		//Menu 10
		case preg_match("/10$/",$input):
			$response = "END List of maternity shops\n";
		break;

		//Menu 11
		case preg_match("/11$/",$input):
			$response = "CON 1. Subscribe \n";
			$response .= "2. Unsubscribed \n";
			$response .= "00. Back \n";

		break;
		case preg_match("/11[*]1$/",$input):
			$response = "END $phoneNumber is now subscribed to daily tips";
		break;
		case preg_match("/11[*]2$/",$input):
			$response = "END $phoneNumber is now unsubscribed to daily tips";
		break;

		default:
		return "END an error occured";
	}

	return $response;
}

header('Content-type: text/plain');
$response = input_logic($text, $phoneNumber);
echo $response;

?>

