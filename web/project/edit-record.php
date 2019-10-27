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
        //echo $EventID.'<br>';
        $sql = "SELECT * FROM events WHERE event_id=". $EventID;
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($rows as $row)
        {  
        echo "<form name='update' action='edit-record-confirmation.php' method='POST' >";
        echo '<b>Event ID: </b> <br/>'.$row['event_id'].'<br>';
        echo '<b>Date Event Occurred: </b> <br/><input required type="date" name="dateOccurred" style="width:200px" value='.$row['date_occurred'].'><br>';
        echo '<b>Date Event Reported: </b> <br/><input required type="date" name="dateReported" style="width:200px" value='.$row['date_reported'].'><br>';
        echo '<b>Short Description: </b> <br/><textarea required name="shortDescription" rows="1" cols="70">'.$row['description_short'].'</textarea><br>';
        echo '<b>Detailed Description: </b> <br/><textarea required name="longDescription" rows="2" cols="70">'.$row['description_long'].'</textarea><br>';

        echo '<b>Actual Severity of Event: </b> <br/>';
        echo '<select required name="severityID_Act" style="width:200px">';
        echo '<option value="'.$row['severity_actual_id'].'" selected></option>';
                    $stmt = $db->prepare('select * from severities');
                    $stmt->execute();
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($rows as $row)
                    {
                        $severity = $row['severity_label'];
                        $severityID = $row['severity_id'];
                        
                        echo '<option value="'.$severityID.'"selected>'.$severity.'</option>';
                    }
        
        echo '       </select>';
        echo '<br>';
        }

    ?>


</body>
</html>