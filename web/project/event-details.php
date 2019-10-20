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
        <a class="active" href="new.php">Create New Record</a>
        <a class="active" href="search.php">Search</a>
    </div>
    <h2>Event Details</h2>
    <a href="search.php" class="button">Back</a>
<?php
    $sql = "select * from events WHERE event_id=:event_id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':event_id', $_GET['event_id'], PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);




    foreach ($rows as $row)
    {
        $dateOccurred = new DateTime($row['date_occurred']);
        $dateReported = new DateTime($row['date_reported']);
        $dateEntered = new DateTime($row['date_entered']); 

        echo '<p>';
        echo '<b>EventID:</b>  '. $row['event_id'].'<br>';
        echo '<b>Date Occurred:</b>  ' . $dateOccurred->format('M d, Y').'<br>';
        echo '<b>Date Reported:</b>  ' . $dateReported->format('M d, Y').'<br>';
        echo '<b>Date Entered:</b>  ' . $dateEntered->format('M d, Y').'<br>';
        //site
        $sql = "select site_label from sites right join events on sites.site_id = events.site_id WHERE event_id=:event_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':event_id', $_GET['event_id'], PDO::PARAM_INT);
        $stmt->execute();
        $sites = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($sites as $site)
        {
            echo '<b>Site:</b>  ' . $site['site_label'] .'<br>';
        }
        //department
        $sql = "select department_label from departments right join events on departments.department_id = events.department_id WHERE event_id=:event_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':event_id', $_GET['event_id'], PDO::PARAM_INT);
        $stmt->execute();
        $departments = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($departments as $department)
        {
            echo '<b>Department:</b>  ' . $department['department_label'] .'<br>';
        }
        //actual severity
        $sql = "select severity_label from severities right join events on severities.severity_id = events.severity_actual_id WHERE event_id=:event_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':event_id', $_GET['event_id'], PDO::PARAM_INT);
        $stmt->execute();
        $actualSeverities = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($actualSeverities as $actualSeverity)
        {
            echo '<b>Actual Severity:</b>  ' . $actualSeverity['severity_label'] .'<br>';
        }
        //probable severity
        $sql = "select severity_label from severities right join events on severities.severity_id = events.severity_probable_id WHERE event_id=:event_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':event_id', $_GET['event_id'], PDO::PARAM_INT);
        $stmt->execute();
        $probableSeverities = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($probableSeverities as $probableSeverity)
        {
            echo '<b>Probable Severity:</b>  ' . $probableSeverity['severity_label'] .'<br>';
        }

        //event status
        $sql = "select status_label from statuses right join events on statuses.status_id = events.event_status_id WHERE event_id=:event_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':event_id', $_GET['event_id'], PDO::PARAM_INT);
        $stmt->execute();
        $statuses = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($statuses as $status)
        {
            echo '<b>Event Status:</b>  ' . $status['status_label'] .'<br>';
        }
        //Temperature
        echo '<b>Temperature:</b>  ' . $row['temperature'].'<br>';

        //Temperature UOM
        $sql = "select temperature_uom_label from temperature_uoms right join events on temperature_uoms.temperature_uom_id = events.temperature_uom_id WHERE event_id=:event_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':event_id', $_GET['event_id'], PDO::PARAM_INT);
        $stmt->execute();
        $temperatureUOMs = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($temperatureUOMs as $temperatureUOM)
        {
            echo '<b>Temperature Unit of Measure:</b>  ' . $temperatureUOM['temperature_uom_label'] .'<br>';
        }

        //weather
        $sql = "select weather_label from weathers right join events on weathers.weather_id = events.weather_id WHERE event_id=:event_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':event_id', $_GET['event_id'], PDO::PARAM_INT);
        $stmt->execute();
        $weathers = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($weathers as $weather)
        {
            echo '<b>Weather Conditions:</b>  ' . $weather['weather_label'] .'<br>';
        }

        //lighting
        $sql = "select lighting_label from lightings right join events on lightings.lighting_id = events.lighting_id WHERE event_id=:event_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':event_id', $_GET['event_id'], PDO::PARAM_INT);
        $stmt->execute();
        $lightings = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($lightings as $lighting)
        {
            echo '<b>Probable Severity:</b>  ' . $lighting['lighting_label'] .'<br>';
        }

        echo '<b>Short Description:</b>  ' . $row['description_short'].'<br>';
        echo '<b>Detailed Description:</b>  ' . $row['description_long'].'<br>';
        echo '<b>Within Reporting Boundaries?:</b>  ' . var_export($row['reporting_boundary'], True);'<br>';
        echo '</p>';
    }


?>
 </body>
</html>