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
    <h2>Record Deletion Confirmation</h2>
    <?php
        $DeleteEventID = $_POST['DeleteEventID'];
        $DeleteInjuryID = $_POST['DeleteInjuryID'];
        

        $sql = "DELETE FROM injuries WHERE injury_id=".$DeleteInjuryID;
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $sql = "DELETE FROM events WHERE event_id=".$DeleteEventID;
        $stmt = $db->prepare($sql);
        $stmt->execute();
        echo 'Event Record '.$DeleteEventID.' deleted successfully.<br>';
    
    ?>
</body>
</html>