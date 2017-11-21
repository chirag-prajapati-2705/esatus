<?php
try {
    $dbh = new PDO('mysql:host=localhost;dbname=esatus;','esatus_bdd_user','QCuN30g0O2WGYOZ');
    $expert = $dbh->query('SELECT * FROM `services` WHERE `category_id` = 8 AND `validated` = 1');
    
    $i = 0;
    foreach  ($expert as $row) {
        $array_id[$i] = $row['id'];
        $i++;
    }
    
    $id1 = rand(0,$i);
    
    $existe = $dbh->query('SELECT * from calls where service_id='.$array_id[$id1].' and statut = 200');
    if(!$existe)
    {
        $stmt = $dbh->prepare("UPDATE `esatus`.`calls` SET `service_id` = '.$array_id[$id1].' WHERE `calls`.`id` = 495");
        $stmt->execute();
    }
    
    $id2 = rand(0,$i);
    while (in_array($n, array($array_id[$id1]))) {
        $id2 = rand(0,$i); 
    }
    
    $existe = $dbh->query('SELECT * from calls where service_id='.$array_id[$id2].' and statut = 200');
    if(!$existe)
    {
        $stmt = $dbh->prepare("UPDATE `esatus`.`calls` SET `service_id` = '.$array_id[$id2].' WHERE `calls`.`id` = 496");
        $stmt->execute();
    }
    
    $id3 = rand(0,$i);
    while (in_array($n, array($array_id[$id1], $array_id[$id2]))) {
        $id3 = rand(0,$i); 
    }
   
    $existe = $dbh->query('SELECT * from calls where service_id='.$array_id[$id3].' and statut = 200');
    if(!$existe)
    {
        $stmt = $dbh->prepare("UPDATE `esatus`.`calls` SET `service_id` = '.$array_id[$id3].' WHERE `calls`.`id` = 497");
        $stmt->execute();
    }
    
    $id4 = rand(0,$i);
    while (in_array($n, array($array_id[$id1], $array_id[$id2], $array_id[$id3]))) {
        $id4 = rand(0,$i); 
    }
    
    $existe = $dbh->query('SELECT * from calls where service_id='.$array_id[$id4].' and statut = 200');
    if(!$existe)
    {
        $stmt = $dbh->prepare("UPDATE `esatus`.`calls` SET `service_id` = '.$array_id[$id4].' WHERE `calls`.`id` = 498");
        $stmt->execute();
    }
    
    $id5 = rand(0,$i);
    while (in_array($n, array($array_id[$id1], $array_id[$id2], $array_id[$id3], $array_id[$id4]))) {
        $id5 = rand(0,$i); 
    }
    
    $existe = $dbh->query('SELECT * from calls where service_id='.$id5.' and statut = 200');
    if(!$existe)
    {
        $stmt = $dbh->prepare("UPDATE `esatus`.`calls` SET `service_id` = '.$id5.' WHERE `calls`.`id` = 499");
        $stmt->execute();
    }
    
    $id6 = rand(0,$i);
    while (in_array($n, array($array_id[$id1], $array_id[$id2], $array_id[$id3], $array_id[$id4], $array_id[$id5]))) {
        $id6 = rand(0,$i); 
    }
    
    $existe = $dbh->query('SELECT * from calls where service_id='.$array_id[$id6].' and statut = 200');
    if(!$existe)
    {
        $stmt = $dbh->prepare("UPDATE `esatus`.`calls` SET `service_id` = '.$array_id[$id6].' WHERE `calls`.`id` = 500");
        $stmt->execute();
    }
    
    $id7 = rand(0,$i);
    while (in_array($n, array($array_id[$id1], $array_id[$id2], $array_id[$id3], $array_id[$id4], $array_id[$id5], $array_id[$id6]))) {
        $id7 = rand(0,$i); 
    }
    
    $existe = $dbh->query('SELECT * from calls where service_id='.$array_id[$id7].' and statut = 200');
    if(!$existe)
    {
        $stmt = $dbh->prepare("UPDATE `esatus`.`calls` SET `service_id` = '.$array_id[$id7].' WHERE `calls`.`id` = 501");
        $stmt->execute();
    }
    
    $id8 = rand(0,$i);
    while (in_array($n, array($array_id[$id1], $array_id[$id2], $array_id[$id3], $array_id[$id4], $array_id[$id5], $array_id[$id6], $array_id[$id7]))) {
        $id8 = rand(0,$i); 
    }
    
    $existe = $dbh->query('SELECT * from calls where service_id='.$array_id[$id8].' and statut = 200');
    if(!$existe)
    {
        $stmt = $dbh->prepare("UPDATE `esatus`.`calls` SET `service_id` = '.$array_id[$id8].' WHERE `calls`.`id` = 502");
        $stmt->execute();
    }
    
    $id9 = rand(0,$i);
    while (in_array($n, array($array_id[$id1], $array_id[$id2], $array_id[$id3], $array_id[$id4], $array_id[$id5], $array_id[$id6], $array_id[$id7], $array_id[$id8]))) {
        $id9 = rand(0,$i); 
    }
    
    $existe = $dbh->query('SELECT * from calls where service_id='.$array_id[$id9].' and statut = 200');
    if(!$existe)
    {
        $stmt = $dbh->prepare("UPDATE `esatus`.`calls` SET `service_id` = '.$array_id[$id9].' WHERE `calls`.`id` = 503");
        $stmt->execute();
    }
    
    $id10 = rand(0,$i);
    while (in_array($n, array($array_id[$id1], $array_id[$id2], $array_id[$id3], $array_id[$id4], $array_id[$id5], $array_id[$id6], $array_id[$id7], $array_id[$id8], $array_id[$id9]))) {
        $id10 = rand(0,$i); 
    }
    
    $existe = $dbh->query('SELECT * from calls where service_id='.$array_id[$id10].' and statut = 200');
    if(!$existe)
    {
        $stmt = $dbh->prepare("UPDATE `esatus`.`calls` SET `service_id` = '.$array_id[$id10].' WHERE `calls`.`id` = 504");
        $stmt->execute();
    }
    
    $id11 = rand(0,$i);
    while (in_array($n, array($array_id[$id1], $array_id[$id2], $array_id[$id3], $array_id[$id4], $array_id[$id5], $array_id[$id6], $array_id[$id7], $array_id[$id8], $array_id[$id9], $array_id[$id10]))) {
        $id11 = rand(0,$i); 
    }
    
    $existe = $dbh->query('SELECT * from calls where service_id='.$array_id[$id11].' and statut = 200');
    if(!$existe)
    {
        $stmt = $dbh->prepare("UPDATE `esatus`.`calls` SET `service_id` = '.$array_id[$id11].' WHERE `calls`.`id` = 505");
        $stmt->execute();
    }
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
?>

test