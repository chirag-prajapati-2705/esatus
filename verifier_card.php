<?php

$url = "https://preprod-ppps.paybox.com/PPPS.php";

$params = array(
    'VERSION' => '00104',
    'DATEQ' => date('dmYHis'),
    'TYPE' => '00051',
    'NUMQUESTION' => str_pad(2607, 10, "0", STR_PAD_LEFT),
    'SITE' => '1101352',
    'RANG' => '001',
    'CLE' => 'luguwPBf',
    'MONTANT' => '500', // 50.00 €
    'DEVISE' => '978',
    'REFERENCE' => 'Test',
    'REFABONNE' => 'ddeletrez@icloud.com',
    'PORTEUR' => 'CMdMpcrLLXC',
    'DATEVAL' => '0316',
    'CVV' => '175',
    'ACTIVITE' => '027'
);

// Création de la requête POST
$post = '';
foreach ($params as $k => $v) {
    $post .= $k . '=' . $v . '&';
}
$post = substr($post, 0, -1);

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
if (preg_match('`^https://`i', $url)) {
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
}
curl_setopt($curl, CURLOPT_HEADER, 0);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $post);

// Execution de la requête POST
$data = curl_exec($curl);

$tmp = explode('&', $data);
$response = new stdClass();
foreach ($tmp as $value) {
    $vars = explode('=', $value);
    $vars[0] = strtolower($vars[0]);
    $response->$vars[0] = $vars[1];
}

if (isset($response->codereponse) && $response->codereponse == '00000') {echo 'ok';}
 else {
echo $response->codereponse;    
}
?>