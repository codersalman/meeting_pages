<?php
include "config.php";

$meeting_id = $_GET['id'];


if (isset($_GET['id'])) {


    $database->getReference('Meetings')->remove($meeting_id);
    echo "deleted";
    header('dashboard.php');


} else {

    echo "Sorry";
    header('Location:dashboard.php');

}