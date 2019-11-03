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
        $temperature = $row['temperature'];
        echo $temperature;
        echo '<form method="post" action="edit-record-confirmation.php">';
        echo '<b>Event ID: </b> <br/>'.$row['event_id'].'<br>';
        echo '<input type="hidden" name="EventID" value='.$row['event_id'].'>';
        echo '<b>Date Event Occurred: </b> <br/><input required type="date" name="dateOccurred" style="width:200px" value='.$row['date_occurred'].'><br>';
        echo '<b>Date Event Reported: </b> <br/><input required type="date" name="dateReported" style="width:200px" value='.$row['date_reported'].'><br>';
        echo '<b>Short Description: </b> <br/><textarea required name="shortDescription" rows="1" cols="70">'.$row['description_short'].'</textarea><br>';
        echo '<b>Detailed Description: </b> <br/><textarea required name="longDescription" rows="2" cols="70">'.$row['description_long'].'</textarea><br>';

        echo '<b>Actual Severity of Event: </b> <br/>';
        echo '<SELECT required name="severityID_Act" style="width:200px">';                    
                    $stmt = $db->prepare('SELECT * FROM severities WHERE severity_id='.$row['severity_actual_id']);
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {
                        $result = $subrow['severity_id'];                        
                    }
                    $stmt = $db->prepare('SELECT * FROM severities');
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {                        
                        $item = $subrow['severity_label'];
                        $itemID = $subrow['severity_id'];
                        if ($itemID == $result)
                        {
                            echo '<option value="'.$itemID.'" SELECTed>'.$item.'</option>';
                        }
                        else
                        {
                            echo '<option value="'.$itemID.'">'.$item.'</option>';
                        }
                    }
        echo '</SELECT>';
        echo '<br>';

        echo '<b>Probable Severity of Event: </b> <br/>';
        echo '<SELECT required name="severityID_Prob" style="width:200px">';
                    $stmt = $db->prepare('SELECT * FROM severities WHERE severity_id='.$row['severity_probable_id']);
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {
                        $result = $subrow['severity_id'];                        
                    }
                    $stmt = $db->prepare('SELECT * FROM severities');
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {                        
                        $item = $subrow['severity_label'];
                        $itemID = $subrow['severity_id'];
                        if ($itemID == $result)
                        {
                            echo '<option value="'.$itemID.'" SELECTed>'.$item.'</option>';
                        }
                        else
                        {
                            echo '<option value="'.$itemID.'">'.$item.'</option>';
                        }
                    }
        echo '</SELECT>';
        echo '<br>';

        echo '<b>Equipment Type: </b> <br/>';
        echo '<SELECT required name="equipmentID" style="width:200px">';
                    $stmt = $db->prepare('SELECT * FROM equipments WHERE equipment_id='.$row['equipment_id']);
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {
                        $result = $subrow['equipment_id'];                        
                    }
                    $stmt = $db->prepare('SELECT * FROM equipments');
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {                        
                        $item = $subrow['equipment_label'];
                        $itemID = $subrow['equipment_id'];
                        if ($itemID == $result)
                        {
                            echo '<option value="'.$itemID.'" SELECTed>'.$item.'</option>';
                        }
                        else
                        {
                            echo '<option value="'.$itemID.'">'.$item.'</option>';
                        }
                    }
        echo '</SELECT>';
        echo '<br>';

        echo '<b>Within Reporting Boundary?: </b> <br/>';
        echo '<SELECT required name="boundaryID" style="width:200px">';
                $stmt = $db->prepare('SELECT * FROM events WHERE event_id='.$row['event_id']);
                $stmt->execute();
                $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($subrows as $subrow)
                {
                    $result = $subrow['reporting_boundary'];                        
                }
                $stmt = $db->prepare('SELECT distinct reporting_boundary FROM events');
                $stmt->execute();
                $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($subrows as $subrow)
                {                        
                    $item = $subrow['reporting_boundary'];
                    if ($item == 1)
                    {
                        $item = "Yes";
                    }
                    else
                    {
                        $item = "No";
        }
                    $itemID = $subrow['reporting_boundary'];
                    if ($itemID == $result)
                    {
                        echo '<option value="'.$itemID.'" SELECTed>'.$item.'</option>';
                    }
                    else
                    {
                        echo '<option value="'.$itemID.'">'.$item.'</option>';
                    }
                } 

        echo '</SELECT>';
        echo '<br>';

        echo '<b>Site: </b> <br/>';
        echo '<SELECT required name="siteID" style="width:200px">';
                    $stmt = $db->prepare('SELECT * FROM sites WHERE site_id='.$row['site_id']);
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {
                        $result = $subrow['site_id'];                        
                    }
                    $stmt = $db->prepare('SELECT * FROM sites');
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {                        
                        $item = $subrow['site_label'];
                        $itemID = $subrow['site_id'];
                        if ($itemID == $result)
                        {
                            echo '<option value="'.$itemID.'" SELECTed>'.$item.'</option>';
                        }
                        else
                        {
                            echo '<option value="'.$itemID.'">'.$item.'</option>';
                        }
                    }
        echo '</SELECT>';
        echo '<br>';

        echo '<b>Department: </b> <br/>';
        echo '<SELECT required name="departmentID" style="width:200px">';
                    $stmt = $db->prepare('SELECT * FROM departments WHERE department_id='.$row['department_id']);
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {
                        $result = $subrow['department_id'];                        
                    }
                    $stmt = $db->prepare('SELECT * FROM departments');
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {                        
                        $item = $subrow['department_label'];
                        $itemID = $subrow['department_id'];
                        if ($itemID == $result)
                        {
                            echo '<option value="'.$itemID.'" SELECTed>'.$item.'</option>';
                        }
                        else
                        {
                            echo '<option value="'.$itemID.'">'.$item.'</option>';
                        }
                    }
        echo '</SELECT>';
        echo '<br>';
       
        echo '<b>Temperature: </b> <br/><input required type="number" name="temperature" style="width:200px" value='.$row['tempurature'].'><br>';

        echo '<b>Unit of Measure: </b> <br/>';
        echo '<SELECT required name="tempUOMID" style="width:200px">';
                    $stmt = $db->prepare('SELECT * FROM temperature_uoms WHERE temperature_uom_id='.$row['temperature_uom_id']);
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {
                        $result = $subrow['temperature_uom_id'];                        
                    }
                    $stmt = $db->prepare('SELECT * FROM temperature_uoms');
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {                        
                        $item = $subrow['temperature_uom_label'];
                        $itemID = $subrow['temperature_uom_id'];
                        if ($itemID == $result)
                        {
                            echo '<option value="'.$itemID.'" SELECTed>'.$item.'</option>';
                        }
                        else
                        {
                            echo '<option value="'.$itemID.'">'.$item.'</option>';
                        }
                    }
        echo '</SELECT>';
        echo '<br>';

        echo '<b>Weather Conditions: </b> <br/>';
        echo '<SELECT required name="weatherID" style="width:200px">';
                    $stmt = $db->prepare('SELECT * FROM weathers WHERE weather_id='.$row['weather_id']);
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {
                        $result = $subrow['weather_id'];                        
                    }
                    $stmt = $db->prepare('SELECT * FROM weathers');
                    $stmt->execute();
                    $subrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($subrows as $subrow)
                    {                        
                        $item = $subrow['weather_label'];
                        $itemID = $subrow['weather_id'];
                        if ($itemID == $result)
                        {
                            echo '<option value="'.$itemID.'" SELECTed>'.$item.'</option>';
                        }
                        else
                        {
                            echo '<option value="'.$itemID.'">'.$item.'</option>';
                        }
                    }
        echo '</SELECT>';
        echo '<br>';


        echo '<input type="submit" value="Submit Update" class="button">';
        echo '</form>';
        }

    ?>


</body>
</html>