<?php
$servername = "pdb58.awardspace.net";
$database = "4202451_woverse";
$username = "4202451_woverse";
$password = "Advita@01";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}

// Escape user inputs for security
$fname = mysqli_real_escape_string($conn, $_REQUEST['fname']);
$email = mysqli_real_escape_string($conn, $_REQUEST['email']);
$whatsapp = mysqli_real_escape_string($conn, $_REQUEST['whatsapp']);
$havingPeriod = mysqli_real_escape_string($conn, $_REQUEST['havingPeriod']);
$ageCurrent = mysqli_real_escape_string($conn, $_REQUEST['ageCurrent']);
$agePerimenopause = mysqli_real_escape_string($conn, $_REQUEST['agePerimenopause']);
$survey = $_POST['survey'];
$surveyDate = date("Y/m/d");
$platform = 'insta';


$sql="INSERT INTO survey_input (fname, email,whatsapp, havingPeriod, ageCurrent, agePerimenopause, survey, surveydate ) VALUES ('$fname','$email','$whatsapp','$havingPeriod','$ageCurrent','$agePerimenopause','$survey','$surveyDate')";
if (mysqli_query($conn, $sql)) {
	// echo "New record created successfully";
	header('Location: surveythankyou.html');
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);

?>


