<?php

$pdo = new PDO('mysql:host=mysql51-97.bdb;dbname=esatussql;charset=UTF8', 'esatussql', 'CbJmEeQO');

$check = $pdo->prepare("INSERT INTO  `esatussql`.`calls2` (
`id` ,
`call_id` ,
`session_id` ,
`user_id` ,
`service_id` ,
`status` ,
`start` ,
`end` ,
`cost` ,
`payment`
)
VALUES (NULL ,  '".$_GET['call_id']."',  '',  '',  '',  '',  '".$_GET['call_start_date']."',  '".$_GET['call_end_date']."',  '',  '');"); // removed limit 1
$check->execute();
$data = $check->fetchAll();

?ogog sdvsdvsdv