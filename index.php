<?php
// Reads the variables sent via POST from our gateway
$sessionId   = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text        = $_POST["text"];
if ( $text == "" ) {
	 // This is the first request. Note how we start the response with CON
	 $response  = "CON Enter UID \n";
	 // $response .= "1. Register Child \n";
	 // $response .= "2. Administer Vaccine";
   $uid= $text;
	
}else if ( !$text == "" ) {
  // Business logic for first level response
  $response = "CON Select an option\n";
  $response .= "1. Register Child \n";
  $response .= "2. Administer Vaccine";
  
}else if($text == "12345*1") {
 
  // Business logic for first level response
  // This is a terminal request. Note how we start the response with END
  $response = "CON Enter name";
 
}else if($text == "12345*1*henry") {
 
  // This is a second level response where the user selected 1 in the first instance
  $date  = "12/12/16";
  // This is a terminal request. Note how we start the response with END
  //$response = "END Your account number is $accountNumber";
  $response = "CON Enter DOB DD/MM/YY";
 
}else if ( $text == "12345*1*henry*$date" ) {
  
	 // This is a second level response where the user selected 1 in the first instance
	 $balance  = "NGN 10,000";
	 // This is a terminal request. Note how we start the response with END
	 $response = "CON Number in the family";
}
// Print the response onto the page so that our gateway can read it
header('Content-type: text/plain');
echo $response;
// DONE!!!
?>
