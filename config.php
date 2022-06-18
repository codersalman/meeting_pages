<?php

require __DIR__ . '/vendor/autoload.php';


use Kreait\Firebase\Factory;

$factory = (new Factory())
    ->withServiceAccount('interns-prabhavati-ds-firebase-adminsdk-lqzh7-3c1029f35d.json') // Add the service_accounts.json
    ->withDatabaseUri('https://interns-prabhavati-ds-default-rtdb.firebaseio.com/meeting_interns/');

$database = $factory->createDatabase();
$auth = $factory->createAuth();
date_default_timezone_set("Asia/Calcutta");

session_start();
error_reporting(E_ERROR | E_PARSE);
