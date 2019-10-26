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
    <h2>New</h2>
    <form method="post" action="new-record.php">
   
    Date Event Occurred: 
    <input required type="date" name="dateOccurred"><br/>
    
    Short Description: 
    <input required type="text" rows="2" cols="100" name="shortDescription"><br/>

    Detailed Description: 
    <input required type="text" rows="4" cols="100" name="longDescription"><br/>

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
                echo '<br>';
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
                echo '<br>';
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
                echo '<br>';
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
                echo '<br>';
            }
        ?>
        </select>
        <br/>
    
    <input type="submit" value="Submit">
    </form>
    </body>
</html>