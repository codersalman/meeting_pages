<?php

include "config.php";

$participent_name = $_POST['participent_name'];
$meeting_id = $_POST['meeting_id'];
$meeting_title = $_POST['meeting_name'];
$timestamp = date("d-m-Y H:i:s");

if (isset($_POST['meeting_id'])) {


    $meetData = [
        'Participants_name' => $_POST['participent_name'],
        'Join Time' => $timestamp

    ];

    $succes = $database->getReference('Participents/' . $meeting_title . '/')->push($meetData);

}

if (isset($participent_name)) {

    include "components/meet_page.php";

} else {

    echo "BAD Request";
    header('Location:index.php');


}

?>
