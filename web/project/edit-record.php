<?php
require "dbConnect.php";
$db = get_db();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Incident Management System</title>
        <link rel="stylesheet" type="text/css" href="mystyles.css">
        <script type="text/javascript" src="scripts.js"></script> 
    </head>

    <body>
    <h1>Incident Management System</h1>
    <div class="topnav">
        <a class="active" href="index.php">Home</a>
        <a class="active" href="new.php">Create New Event</a>
        <a class="active" href="search.php">Search</a>
    </div>
    <h2>Record Edit</h2>

    <?php
        $EventID = $_POST['EventID'];
        $InjuryID = $_POST['InjuryID'];
        $sql = "SELECT * FROM events WHERE event_id=". $EventID;
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $row = pg_fetch_assoc($stmt);
        echo $row['event_id'].'<br>';
        echo $row['description_short'].'<br>';
        echo $row['description_long'].'<br>';

    ?>


</body>
</html>