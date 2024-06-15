<?php
session_start();
include 'helpers/const.php';

$url = AUTH_URL . '/accesstoken?grant_type=client_credentials';

$data = array(
    'client_id' => CLIENT_ID,
    'client_secret' => SECRET_ID
);

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/x-www-form-urlencoded'
));

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}

curl_close($ch);

$res = json_decode($response);

$_SESSION['organization_name'] = $res->organization_name;
$_SESSION['access_token'] = $res->access_token;
$_SESSION['application_name'] = $res->application_name;
