<?php
// Reads the variables sent via POST from our gateway
$sessionId   = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text        = $_POST["text"];
$uid = "12345";
$name = "henry";
$dob  = "12/12/16";
$child_position = "2";
$phone = "08080808080";
$mother = "ada";
$emergency = "07070707070";
$child1="chisom";
$child2="adaku";
if ( $text == "" || $text == "1") {
   // This is the first request. Note how we start the response with CON
   $response  = "CON Enter UID \n";
   // $response .= "1. Register Child \n";
   // $response .= "2. Administer Vaccine";
   //$uid .= $text;
  
}else if ( $text == "$uid" ) {
  // Business logic for first level response
  $response = "CON Enter Mother's Phone Number\n";
  
}
else if ( $text == "$uid*$phone" || $text == "$uid*$phone*1*2" ) {
  // Business logic for first level response
  $response = "CON Select an option\n";
  $response .= "1. $child1 \n";
  $response .= "2. $child2 \n";
  $response .= "3. Add a Child";
  $text = "$uid*$phone";
  
}else if($text == "$uid*$phone*1") {
 
 //choose 1st child
  $response = "END Chisom has completed her immunization\n";
 // $response .= "2. Back";
}

else if($text == "$uid*$phone*2") {
 
  //choose second child
  $response = "CON Adaku is due for immunization\n";
  $response .= "1. Administer Immunization";
  $response .= "2. Exit";
 $array = explode('*', $text);
 $childs_name=array_pop((array_slice($array, -1, 1)));
}
else if($text == "$uid*$phone*2*1") {
 
  //choose to administer Immunization to Second Child
  $response = "END Confirm Immunization\n";
  $response .= "1. Yes \n";
  $response .= "2. Exit";

}
else if($text == "$uid*$phone*2*1*1") {
 
  //cONFIRM IMMUNIZATION
  $response = "END Immunization record updated\n";
}
else if($text == "$uid*$phone*3") {
 
 //add child name
  $response = "CON Enter Childs name\n";
  //$response .= "2. Back";
}
else if($text == "$uid*$phone*3*$name") {
 
  //add dob
  $response = "CON Enter DOB DD/MM/YY";
 
}else if ( $text == "$uid*$phone*3*$name*$dob" ) {
  
   //enter child position
   $response = "CON Number in the family";
}
else if ( $text == "$uid*$phone*3*$name*$dob*$child_position" ) {
 // echo $text;
   //enter parent no
   $response = "CON Enter Mother's name";  
}
// else if ( $text == "$uid*$phone*3*$name*$dob*$child_position*$phone" ) {
  
//    //add phone number
//    $response = "CON Name of Mother";
// }
else if ( $text == "$uid*$phone*3*$name*$dob*$child_position*$mother" ) {
  
   //Add Emergency
   $response = "CON Enter Emergency No";
}
else if ( $text == "$uid*$phone*3*$name*$dob*$child_position*$mother*$emergency" ) {
  
   //child has be
   $response = "CON The record was saved succesfully /n";
  $response .= "1. Perform Immunization /n";
  $response .= "2. Exit";
  ?>
  <script type="text/javascript">
    let registration = <?php echo $text ?>;
    let registration_array = str.split("*");
console.log(registration_array);

function register(){
  fetch('https://16e1ec59.ngrok.io', {
  method: 'post',
  headers: {
    'Accept': 'application/json, text/plain, */*',
    'Content-Type': 'application/json'
  },
  body: JSON.stringify({OfficerID: registration_array[0] , DateOfBirth: registration_array[4], EmergencyNumber: registration_array[7], ParentNumber: registration_array[1],ParentName: registration_array[6] , ChildName: registration_array[3]})
}).then(res=>res.json())
  .then(res => console.log(res));
}
register();
  </script>

  <?php
}

else if ( $text == "$uid*$phone*3*$name*$dob*$child_position*$mother*$emergency*1" ) {
  
   //child has be
  $response = "CON Confirm Immunization /n";
  $response .= "1. Confirm /n";
  $response .= "2. Exit /n";
 // $text="";


}
else if ( $text == "$uid*$phone*3*$name*$dob*$child_position*$mother*$emergency*1*1" ) {
  
   //child has be
  $response = "END Remember: Immunization Recorded Successfully";
  
}

 echo $registration_array;

// Print the response onto the page so that our gateway can read it
header('Content-type: text/plain');
echo $response;
echo $text;
echo $registration_array;
// DONE!!!


// $url = 'https://9342ab1e.ngrok.io';
// $data = array('OfficeID' => $name, 'DateOfBirth' => $dob,'EmergencyNumber' => $emergency, 'Name' => $name, 'ParentNumber'=> $phone);

// // use key 'http' even if you send the request to https://...
// $options = array(
//     'http' => array(
//         'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
//         'method'  => 'POST',
//         'content' => http_build_query($data)
//     )
// );
// $context  = stream_context_create($options);
// $result = file_get_contents($url, false, $context);
// if ($result === FALSE) { /* Handle error */ }

// var_dump($result);
?>
