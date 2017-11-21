<?php

Class Originate {

    function launchCALL() {
        $servername = "localhost";
        $username = "esatus_bdd_user";
        $password = "zFan08*6-xyz1258@";
        $dbname = "esatus";
        $url = "https://ppps.paybox.com/PPPS.php";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $PAR = $_SERVER['argv'];
        $duration = $PAR[1];
        $mailexpert = $PAR[2];
        $numfrom = $PAR[3];
        $numto = $PAR[4];
        $sid = $PAR[5];
        $userid = $PAR[6];
        $serviceid = $PAR[7];

        $oSocket = fsockopen("127.0.0.1", 5038, $errno, $errstr, 20);
        stream_set_blocking($oSocket, 1);
        if (!$oSocket) {
            //echo "$errstr ($errno)<br>\n";
            die();
        } else {
            fputs($oSocket, "Action: login\r\n");
            fputs($oSocket, "Events: on\r\n");
            fputs($oSocket, "Username: esaami\r\n");
            fputs($oSocket, "Secret: 1nd3tec4ble\r\n\r\n");
            sleep(3);
            fputs($oSocket, "Action: Originate\r\n");
            //fputs($oSocket, "Channel: SIP/avecOVH28/00261348435354\r\n");
            //fputs($oSocket, "Channel: SIP/avecOVH28/00261341249433\r\n");
            //fputs($oSocket, "Channel: SIP/avecOVH28/00261327463383\r\n");
            //fputs($oSocket, "Channel: SIP/avecOVH28/00261345055257\r\n");
            //fputs($oSocket, "Channel: SIP/avecOVH28/00261329287853\r\n");
            fputs($oSocket, "Channel: SIP/avecOVH28/" . $numto . "\r\n");
            fputs($oSocket, "ActionID: " . $sid . "\r\n");
            //fputs($oSocket, "Channel: SIP/2050\r\n");
            fputs($oSocket, "Context: clicktocall\r\n");
            //fputs($oSocket, "Exten: 900261345055257\r\n");
            //fputs($oSocket, "Exten: 92000\r\n");
            //fputs($oSocket, "Variable: var1=".$duration."000,var2=".$mailexpert->email.",var3=".$numfrom.",var4=".$numto.",var5=".session_id()."\r\n");
            fputs($oSocket, "Variable: var1=" . $duration . "000,var2=" . $mailexpert . ",var3=" . $numfrom . ",var4=" . $numto . ",var5=" . $sid . ",var6=" . $userid . ",var7=" . $serviceid . "\r\n");
            fputs($oSocket, "Exten: 9" . $numfrom . "\r\n");
            //fputs($oSocket, "Exten: 900261341677984\r\n");
            //fputs($oSocket, "Exten: 900261330986090\r\n");
            //fputs($oSocket, "Exten: 900261345055257\r\n");
            //fputs($oSocket, "Exten: 900261327463383\r\n");
            //fputs($oSocket, "Exten: 900261320518915\r\n");
            fputs($oSocket, "Priority: 1\r\n");
            fputs($oSocket, "CallerID: 0972411028\r\n");
            //fputs($oSocket, "ActionID: 0972411028\r\n");
            fputs($oSocket, "Timeout: 30000\r\n\r\n");

            sleep(5);
        }
    }
}

$SendThis = new Originate();
$SendThis->launchCALL();
?>
