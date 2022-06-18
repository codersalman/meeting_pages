<?php

include "config.php";

$meeting_id = $_GET['id'];
$name = $_GET['meeting'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>#screen 2-Meeting Page Admin Login</title>
    <link rel="stylesheet" href="assets/join.css">
</head>
<body>
<section>
    <h2><span>&#129300;</span> May I know your Name?</h2>
    <form action="meet_page.php" method="POST">
        <h4>&#129299;You Wanna <span class="join">JOIN</span> in?</h4>
        <p>Your Name</p>
        <input type="hidden" name="meeting_name" value="<?php echo $name; ?>">

        <input type="hidden" name="meeting_id" value="<?php echo $meeting_id; ?>">
        <input type="text" name="participent_name" placeholder="Enter Your Name">
        <button type="submit">JOIN NOW</button>
    </form>
</section>
</body>
</html>