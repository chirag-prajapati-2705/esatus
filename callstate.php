<?php
$servername = "localhost";
$username = "esatus_bdd_user";
$password = "zFan08*6-xyz1258@";
$dbname = "esatus";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$PAR = $_SERVER['argv'];
$REQTYPE = $PAR[1];
$SESID = $PAR[2];
$EXPERT = $PAR[3];
$CLIENT = $PAR[4];
$SERVICEID = $PAR[5];

if ($REQTYPE == "UPDATE") {
    $sql = "UPDATE callstate SET EXPERT = \"" . $EXPERT . "\", CLIENT = \"" . $CLIENT . "\" WHERE SESID = \"" . $SESID . "\"";
    if ($EXPERT == 'OKOK') {

        $query = "SELECT * FROM `callstate` WHERE SESID = \"" . $SESID . "\"";
        $service = $conn->query($query);
        $row = $service->fetch_array(MYSQLI_ASSOC);
        $query = $conn->query("UPDATE availabilities SET flag = '2', `date_update` = '" . date('Y-m-d') . "' WHERE service_id =1");
    }
    

    
}
if($REQTYPE == "INSERT")
{
	$sql = "INSERT INTO callstate (SESID, EXPERT, CLIENT, SERVICEID) VALUES(\"".$SESID."\", \"".$EXPERT."\", \"".$CLIENT."\", \"".$SERVICEID."\")";
}
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?> 
