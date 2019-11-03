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
        $severity_actual_id = $row['severity_actual_id'];
        echo '<form method="post" action="edit-record-confirmation.php">';
        echo '<b>Event ID: </b> <br/>'.$row['event_id'].'<br>';
        echo '<input type="hidden" name="EventID" value='.$row['event_id'].'>';
        echo '<b>Date Event Occurred: </b> <br/><input required type="date" name="dateOccurred" style="width:200px" value='.$row['date_occurred'].'><br>';
        echo '<b>Date Event Reported: </b> <br/><input required type="date" name="dateReported" style="width:200px" value='.$row['date_reported'].'><br>';
        echo '<b>Short Description: </b> <br/><textarea required name="shortDescription" rows="1" cols="70">'.$row['description_short'].'</textarea><br>';
        echo '<b>Detailed Description: </b> <br/><textarea required name="longDescription" rows="2" cols="70">'.$row['description_long'].'</textarea><br>';

        echo '<b>Actual Severity of Event: </b> <br/>';
        echo '<select required name="severityID_Act" style="width:200px">';
                    // $stmt = $db->prepare('select * from severities WHERE severity_id='.$row['severity_actual_id']);
                    // $stmt->execute();
                    // $sevs = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    // foreach ($sevs as $sev)
                    // {
                    //     $item = $sev['severity_label'];
                    //     $itemID = $sev['severity_id'];
                    //     echo '<option value="'.$itemID.'" selected>'.$item.'</option>';
                    // }
                    // $stmt = $db->prepare('select * from severities');
                    // $stmt->execute();
                    // $sevs = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    // foreach ($sevs as $sev)
                    // {
                    //     $item = $sev['severity_label'];
                    //     $itemID = $sev['severity_id'];
                    //     echo '<option value="'.$itemID.'">'.$item.'</option>';
                    // }
                    
                    $stmt = $db->prepare('select * from severities WHERE severity_id='.$row['severity_actual_id']);
                    $stmt->execute();
                    $sevs = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($sevs as $sev)
                    {
                        $result = $sev['severity_id'];                        
                    }
                    $stmt = $db->prepare('select * from severities');
                    $stmt->execute();
                    $sevs = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($sevs as $sev)
                    {
                        
                        $item = $sev['severity_label'];
                        $itemID = $sev['severity_id'];
                        if ($itemID == 2)
                        {
                            echo '<option value="'.$itemID.'" selected>'.$item.'</option>';
                        }
                        else
                        {
                            echo '<option value="'.$itemID.'">'.$item.'</option>';
                        }

                    }
        echo '</select>';
        echo '<br>';

        echo '<b>Probable Severity of Event: </b> <br/>';
        echo '<select required name="severityID_Prob" style="width:200px">';
                    $stmt = $db->prepare('select * from severities WHERE severity_id='.$row['severity_probable_id']);
                    $stmt->execute();
                    $sevs = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($sevs as $sev)
                    {
                        $item = $sev['severity_label'];
                        $itemID = $sev['severity_id'];
                        echo '<option value="'.$itemID.'" selected>'.$item.'</option>';
                    }
                    $stmt = $db->prepare('select * from severities');
                    $stmt->execute();
                    $sevs = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($sevs as $sev)
                    {
                        $item = $sev['severity_label'];
                        $itemID = $sev['severity_id'];
                        echo '<option value="'.$itemID.'" >'.$item.'</option>';
                           
                    }
        echo '</select>';
        echo '<br>';

        echo '<b>Equipment Type: </b> <br/>';
        echo '<select required name="equipmentID" style="width:200px">';
                    $stmt = $db->prepare('select * from equipments WHERE equipment_id='.$row['equipment_id']);
                    $stmt->execute();
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($rows as $row)
                    {
                        $item = $row['equipment_label'];
                        $itemID = $row['equipment_id'];
                        echo '<option value="'.$itemID.'" selected>'.$item.'</option>';
                    }
                    $stmt = $db->prepare('select * from equipments');
                    $stmt->execute();
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($rows as $row)
                    {
                        $item = $row['equipment_label'];
                        $itemID = $row['equipment_id'];
                        echo '<option value="'.$itemID.'">'.$item.'</option>';
                    }
        echo '</select>';
        echo '<br>';

        echo '<b>Within Reporting Boundary?: </b> <br/>';
        echo '<select required name="boundaryID" style="width:200px">';
        echo '<option value="1" selected>Yes</option>';
        echo '<option value="0">No</option>';                  
        echo '</select>';
        echo '<br>';

       
        echo '<input type="submit" value="Submit Update" class="button">';
        echo '</form>';
        }

    ?>


</body>
</html>