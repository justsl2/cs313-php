<?php
    require "dbConnect.php";
    $db = get_db();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Incident Management System</title>
        <link rel="stylesheet" type="text/css" href="mystyles.css">
    </head>

    <body>
    <h1>Incident Management System</h1>
    <div class="topnav">
        <a class="active" href="index.php">Home</a>
        <a class="active" href="new.php">Create New Event</a>
        <a class="active" href="search.php">Search</a>
    </div>
    <h2>New Event Record</h2>
    <form method="post" action="new-record.php">
   
    <h3>Event Details:</h3>
    Date Event Occurred: 
    <input required type="date" name="dateOccurred"><br/>
    
    Short Description: 
    <input required type="textarea" rows="2" cols="100" name="shortDescription"><br/>

    Detailed Description: 
    <input required type="textarea" rows="4" cols="100" name="longDescription"><br/>

    Site: 
        <select required name="siteID">
        <option value="" selected disabled hidden></option>
        <?php
            $stmt = $db->prepare('select * from sites');
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row)
            {
                $site = $row['site_label'];
                $siteID = $row['site_id'];
                echo '<option value="'.$siteID.'">'.$site.'</option>';
            }
        ?>
        </select>
        <br/>
    Department: 
        <select required name="departmentID">
        <option value="" selected disabled hidden></option>
        <?php
            $stmt = $db->prepare('select * from departments');
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row)
            {
                $department = $row['department_label'];
                $departmentID = $row['department_id'];
                echo '<option value="'.$departmentID.'">'.$department.'</option>';
            }
        ?>
        </select>
        <br/>
    Actual Severity of Event: 
        <select required name="severityID_Act">
        <option value="" selected disabled hidden></option>
        <?php
            $stmt = $db->prepare('select * from severities');
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row)
            {
                $severity = $row['severity_label'];
                $severityID = $row['severity_id'];
                echo '<option value="'.$severityID.'">'.$severity.'</option>';
            }
        ?>
        </select>
        <br/>
    Probable Severity of Event: 
        <select required name="severityID_Prob">
        <option value="" selected disabled hidden></option>
        <?php
            $stmt = $db->prepare('select * from severities');
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row)
            {
                $severity = $row['severity_label'];
                $severityID = $row['severity_id'];
                echo '<option value="'.$severityID.'">'.$severity.'</option>';
            }
        ?>
        </select>
        <br/>
    Temperature: 
    <input required type="number" rows="4" cols="100" name="temperature"><br/>
    Unit of Measure: 
        <select required name="tempUOMID">
        <option value="" selected disabled hidden></option>
        <?php
            $stmt = $db->prepare('select * from temperature_uoms');
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row)
            {
                $temperature = $row['temperature_uom_label'];
                $temperatureID = $row['temperature_uom_id'];
                echo '<option value="'.$temperatureID.'">'.$temperature.'</option>';
            }
        ?>
        </select>
        <br/>
    Weather Conditions: 
        <select required name="weatherID">
        <option value="" selected disabled hidden></option>
        <?php
            $stmt = $db->prepare('select * from weathers');
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row)
            {
                $weather = $row['weather_label'];
                $weatherID = $row['weather_id'];
                echo '<option value="'.$weatherID.'">'.$weather.'</option>';
            }
        ?>
        </select>
        <br/>
    Lighting Conditions: 
        <select required name="lightingID">
        <option value="" selected disabled hidden></option>
        <?php
            $stmt = $db->prepare('select * from lightings');
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row)
            {
                $lighting = $row['lighting_label'];
                $lightingID = $row['lighting_id'];
                echo '<option value="'.$lightingID.'">'.$lighting.'</option>';
            }
        ?>
        </select>
        <br/>
    Type of Activity At Time of Event: 
        <select required name="activityID">
        <option value="" selected disabled hidden></option>
        <?php
            $stmt = $db->prepare('select * from activity_types');
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row)
            {
                $activity = $row['activity_type_label'];
                $activityID = $row['activity_type_id'];
                echo '<option value="'.$activityID.'">'.$activity.'</option>';
            }
        ?>
        </select>
        <br/>
    <!--Entered By Hidden-->
        <input type="hidden" name="enteredID" value="1">
    Reported By: 
        <select required name="reportedID">
        <option value="" selected disabled hidden></option>
        <?php
            $stmt = $db->prepare('select * from users');
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row)
            {
                $user = $row['user_name_last'].', '. $row['user_name_first'];
                $userID = $row['user_id'];
                echo '<option value="'.$userID.'">'.$user.'</option>';
            }
        ?>
        </select>
        <br/>

    Equipment: 
        <select required name="equipmentID">
        <option value="" selected disabled hidden></option>
        <?php
            $stmt = $db->prepare('select * from equipments');
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row)
            {
                $equipment = $row['equipment_label'];
                $equipmentID = $row['equipment_id'];
                echo '<option value="'.$equipmentID.'">'.$equipment.'</option>';
            }
        ?>
        </select>
        <br/>
    
    <input type="submit" value="Submit">
    </form>
    </body>
</html>