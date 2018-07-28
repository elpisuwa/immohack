<?php
// Reads the variables sent via POST from our gateway
$sessionId   = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text        = $_POST["text"];
$uid = "12345";
$name = "henry";
$date  = "12/12/16";
$no = "2";
$phone = "08080808080";
$mom = "ada";
$emergency = "07070707070";
if ( $text == "" ) {
	 // This is the first request. Note how we start the response with CON
	 $response  = "CON Enter UID \n";
	 // $response .= "1. Register Child \n";
	 // $response .= "2. Administer Vaccine";
   //$uid .= $text;
	
}else if ( $text == "$uid" ) {
  // Business logic for first level response
  $response = "CON Select an option\n";
  $response .= "1. Register Child \n";
  $response .= "2. Administer Vaccine";
  
}else if($text == "$uid*1") {
 
  // Business logic for first level response
  // This is a terminal request. Note how we start the response with END
  $response = "CON Enter name";
 $array = explode('*', $text);
 $childs_name=array_pop((array_slice($array, -1, 1)));
}else if($text == "$uid*1*$name") {
 
  // This is a second level response where the user selected 1 in the first instance
  
  // This is a terminal request. Note how we start the response with END
  //$response = "END Your account number is $accountNumber";
  $response = "CON Enter DOB DD/MM/YY";
 
}else if ( $text == "12345*1*$name*$date" ) {
  
	 // This is a second level response where the user selected 1 in the first instance
	 $balance  = "NGN 10,000";
	 // This is a terminal request. Note how we start the response with END
	 $response = "CON Number in the family";
}
}else if ( $text == "12345*1*$name*$date*$no" ) {
  
	 // This is a second level response where the user selected 1 in the first instance
	 $balance  = "NGN 10,000";
	 // This is a terminal request. Note how we start the response with END
	 $response = "CON Enter Parents Phone No";
}
else if ( $text == "12345*1*$name*$date*$no*phone" ) {
  
	 // This is a second level response where the user selected 1 in the first instance
	 $balance  = "NGN 10,000";
	 // This is a terminal request. Note how we start the response with END
	 $response = "CON Name of Mother";
}
else if ( $text == "12345*1*$name*$date*$no*$phone*$mom" ) {
  
	 // This is a second level response where the user selected 1 in the first instance
	 $balance  = "NGN 10,000";
	 // This is a terminal request. Note how we start the response with END
	 $response = "CON Enter Emergency No";
}
else if ( $text == "12345*1*$name*$date*$no*$phone*$mom*$emergency" ) {
  
	 // This is a second level response where the user selected 1 in the first instance
	 $balance  = "NGN 10,000";
	 // This is a terminal request. Note how we start the response with END
// 	 $response = "CON Enter Emergency No";
	$response = "END The record was saved succesfully";
}


// Print the response onto the page so that our gateway can read it
header('Content-type: text/plain');
echo $response;
// DONE!!!
?>
