<?php

include "config.php";
include "auth.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/dashboard.css">

</head>
<body>

<section>
    <b>

        <input class="host" type="button" name="lname" data-toggle="modal" data-target="#exampleModal"
               value="HOST NEW MEETING">

        <form name="meet_create" action="create_meet.php" method="POST">

            <input placeholder="Meeting Title" type="text" name="meeting_title" class="host">
            <input placeholder="Team" type="text" name="team_name" class="host">
            <input placeholder="time" type="datetime-local" name="meeting_time" class="host">

            <input class="host" type="submit" name="create" value="Create">

        </form>

    </b>
    <hr>
    <table>
        <tr class="first" style="font-size: 20px;">
            <td class="head"><b>Meeting Title</b></td>
            <td class="head"><b>Team Name</b></td>
            <td class="head" style="height:30px"><b><span>⏰</span>Time</b></td>
            <td class="head actions"><b>Actions</b></td>
        </tr>
        <?php

        $reference = "Meetings";


        $data = $database->getReference($reference)->getValue();
        $i = 0;
        foreach ($data as $key => $data1) {
            $i++;

            ?>
            <tr class="row">
                <td><?php echo $data1['Meeeting_title']; ?></td>
                <td><?php echo $data1['Team']; ?></td>
                <td><span>⏰</span><?php echo $data1['Meeting_time']; ?></td>
                <td><a href="join.php?id=<?php echo $key; ?>" class="join button">Join</a>
                    <a href="delete.php?id=<?php echo $key; ?>" class="delete">Delete</button></td>
            </tr>
            <?php
        }

        ?>
    </table>
</section>

</body>
</html>