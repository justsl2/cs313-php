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
        echo '<b>Short Description:</b>  ' . $row['description_short'].'<br>';
        echo '<b>Detailed Description:</b>  ' . $row['description_long'].'<br>';


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
            echo '<b>Lighting:</b>  ' . $lighting['lighting_label'] .'<br>';
        }

        //Operation Type
        $sql = "select operation_type_label from operation_types right join events on operation_types.operation_type_id = events.operation_type_id WHERE event_id=:event_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':event_id', $_GET['event_id'], PDO::PARAM_INT);
        $stmt->execute();
        $operationtypes = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($operationtypes as $operationtype)
        {
            echo '<b>Type of Operation At Time of Event:</b>  ' . $operationtype['operation_type_label'] .'<br>';
        }
        //Activity Type
        $sql = "select activity_type_label from activity_types right join events on activity_types.activity_type_id = events.activity_type_id WHERE event_id=:event_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':event_id', $_GET['event_id'], PDO::PARAM_INT);
        $stmt->execute();
        $activityTypes = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($activityTypes as $activityType)
        {
            echo '<b>Type of Activity At Time of Event:</b>  ' . $activityType['activity_type_label'] .'<br>';
        }
        //Entered By
        $sql = "select user_name, user_name_first, user_name_last from users right join events on users.user_id = events.entered_by_id  WHERE event_id=:event_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':event_id', $_GET['event_id'], PDO::PARAM_INT);
        $stmt->execute();
        $enteredBys = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($enteredBys as $enteredBy)
        {
            echo '<b>Entered By:</b>  ' . $enteredBy['user_name_first'] . ' ' . $enteredBy['user_name_last'] . ' (' . $enteredBy['user_name'] .')<br>';
        }
        //Reported By
        $sql = "select user_name, user_name_first, user_name_last from users right join events on users.user_id = events.reported_by_id  WHERE event_id=:event_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':event_id', $_GET['event_id'], PDO::PARAM_INT);
        $stmt->execute();
        $reportedBys = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($reportedBys as $reportedBy)
        {
            echo '<b>Reported By:</b>  ' . $reportedBy['user_name_first'] . ' ' . $reportedBy['user_name_last'] . ' (' . $reportedBy['user_name'] .')<br>';
        }
        //QA QC'd By
        $sql = "select user_name, user_name_first, user_name_last from users right join events on users.user_id = events.qa_qc_by_id  WHERE event_id=:event_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':event_id', $_GET['event_id'], PDO::PARAM_INT);
        $stmt->execute();
        $qa_qcBys = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($qa_qcBys as $qa_qcBy)
        {
            echo '<b>QA/QC By:</b>  ' . $qa_qcBy['user_name_first'] . ' ' . $qa_qcBy['user_name_last'] . ' (' . $qa_qcBy['user_name'] .')<br>';
        }
        //Equipment Type
        $sql = "select equipment_label from equipments right join events on equipments.equipment_id = events.equipment_id WHERE event_id=:event_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':event_id', $_GET['event_id'], PDO::PARAM_INT);
        $stmt->execute();
        $equipment_labels = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($equipment_labels as $equipment_label)
        {
            echo '<b>Equipment Type:</b>  ' . $equipment_label['equipment_label'] .'<br>';
        }


        echo '<b>Date Reported:</b>  ' . $dateReported->format('M d, Y').'<br>';
        echo '<b>Date Entered:</b>  ' . $dateEntered->format('M d, Y').'<br>';
        echo '<b>Within Reporting Boundaries?:</b>  ' . var_export($row['reporting_boundary'], True) . '<br>';

        //Consequence Type
        $sql = "select consequence_type_label from consequence_types right join events on consequence_types.consequence_type_id = events.consequence_type_id WHERE event_id=:event_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':event_id', $_GET['event_id'], PDO::PARAM_INT);
        $stmt->execute();
        $consequence_types = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($consequence_types as $consequence_type)
        {
            echo '<b>Consequence Type:</b>  ' . $consequence_type['consequence_type_label'] .'<br>';
        }

        //Injuries
        $sql = "select * from injuries LEFT join events on injuries.event_id = events.event_id WHERE events.event_id=:event_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':event_id', $_GET['event_id'], PDO::PARAM_INT);
        $stmt->execute();
        $injuries = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($injuries as $injury)
        {
            echo '<b>Injury ID:</b>  ' . $injury['injury_id'] .'<br>';
            echo '<b>Injury Description:</b>  ' . $injury['injury_description'] .'<br>';
            echo '<b>Work Related?:</b>  ' . var_export($injury['work_related'], True) . '<br>';
                //Medical Classifications
                $sql = "select medical_classification_label from medical_classifications LEFT join injuries on medical_classifications.medical_classification_id = injuries.medical_classification_id WHERE injuries.injury_id=". $injury['injury_id'];
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $medical_classifications = $stmt->fetchAll(PDO::FETCH_ASSOC);    
                foreach ($medical_classifications as $medical_classification)
                {
                    echo '<b>Medical Classification:</b>  ' . $medical_classification['medical_classification_label'] .'<br>';
                }
                //Medical Classifications
                $sql = "select injured_ill_personnel_type_label from personnel_types LEFT join injuries on personnel_types.personnel_type_id = injuries.personnel_type_id  WHERE injuries.injury_id=". $injury['injury_id'];
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $personnel_types = $stmt->fetchAll(PDO::FETCH_ASSOC);    
                foreach ($personnel_types as $personnel_type)
                {
                    echo '<b>Injured/Ill Personnel Type:</b>  ' . $personnel_type['injured_ill_personnel_type_label'] .'<br>';
                }
        }
        echo '</p>';
    }

?>
 </body>
</html>