<?php
$sessionId = $_POST['sessionId'];
$serviceCode = $_POST['serviceCode'];
$phoneNumber = $_POST['phoneNumber'];
$text = $_POST['text'];

if($text == ""){
	$response = "CON Welcome. Select an option below \n";
	$response .= "1. Register \n";
	$response .= "2. Get baby name \n";
	
}else if ($text == "1") {
	$response = "CON Enter email address \n";

}else if (preg_match("/1[*][a-zA-Z0-9]+[*][a-zA-Z0-9]+/",$text)) {
	$exploded = explode("*",$text);
	$email = $exploded[1];
	$pin = $exploded[2];
	$response = "END Details are " . $email . " - " . $pin . "\n";

}else if (preg_match("/1[*][a-zA-Z0-9]+/",$text)) {
	$response = "CON Enter pin number \n";

}else if($text == "2"){
	$response = "CON Select an option below \n";
	$response .= "1. Male names \n";
	$response .= "2. Female names \n";

}else if($text == "2*1"){
	$response = "END Male names \n";
	$malenames = array("Steve", "Tom", "Andrew", "Greg", "John");
	for($i=0;$i<count($malenames);$i++){
		$response .= ($i + 1) . " " . $malenames[$i] . "\n";
	}
}else if($text == "2*2"){
	$response = "END Female names \n";
	$femalenames = array("Jane", "Racheal", "Anna", "Tokyo", "Nairobi");
	for($i=0;$i<count($femalenames);$i++){
		$response .= ($i + 1) . " " . $femalenames[$i] . "\n";
	}
}

header('Content-type: text/plain');
echo $response;	
?>

