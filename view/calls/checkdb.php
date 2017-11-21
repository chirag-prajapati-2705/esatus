<?php
//session_start();
if(!isset($id))
$id = session_id();
//echo 'id', $id, '<br>';
	$oConnection		= mysql_connect("localhost", "esatus_bdd_user", "zFan08*6-xyz1258@");
	$oDatabase		= mysql_select_db("esatus");
	$zQuery			= "SELECT COUNT(*) FROM callstate where SESID = '.$id.' " ;
	$oResult		= mysql_query($zQuery);
	$toRows			= mysql_fetch_row($oResult);
	echo '= ', $toRows[0];

?>
