<?php
session_start();
include 'helpers/const.php';

$token = $_SESSION['access_token'];

$nik = '7209061211900001';
$data = practioner_by_nik($token, $nik);
$practioner = json_decode($data, TRUE);

$ihs = $practioner['entry'][0]['resource']['id'];

function practioner_by_nik(String $token, String $nik): String
{
    $url = BASE_URL . "/Practitioner?identifier=https://fhir.kemkes.go.id/id/nik|$nik";

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: Bearer " . $token
    ));

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        $res = curl_error($ch);
    } else {
        $res = $response;
    }

    curl_close($ch);

    return $res;
}
