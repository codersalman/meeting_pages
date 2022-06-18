<?php
include "config.php";

$meeting_title = $_POST['meeting_title'];
$team_name = $_POST['team_name'];
$meeting_time = $_POST['meeting_time'];

if (isset($_POST['create'])) {


    $meetData = [
        'Meeeting_title' => $meeting_title,
        'Team' => $team_name,
        'Meeting_time' => $meeting_time,

    ];


    $succes = $database->getReference('Meetings')->update($meetData);

    if (isset($succes)) {

        echo "Success";
        header('Location:dashboard.php');

    }


} else {

    echo "Sorry Brother, Somthing Went Wrong";
}
