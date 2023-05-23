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
?>