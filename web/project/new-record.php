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
    <h2>Record Entered Successfully</h2>
    <h3>Event Details:</h3>
<?php
$dateOccurred = $_POST['dateOccurred'];
$dateReported = $_POST['dateReported'];
$shortDescription = $_POST['shortDescription'];
$shortDescription = htmlspecialchars($shortDescription);
$longDescription = $_POST['longDescription'];
$longDescription = htmlspecialchars($longDescription);
$siteID = $_POST['siteID'];
$departmentID = $_POST['departmentID'];
$severityID_Act = $_POST['severityID_Act'];
$severityID_Prob = $_POST['severityID_Prob'];
$temperature = $_POST['temperature'];
$tempUOMID = $_POST['tempUOMID'];
$weatherID = $_POST['weatherID'];
$lightingID = $_POST['lightingID'];
$operationID = $_POST['operationID'];
$activityID = $_POST['activityID'];
$enteredID = $_POST['enteredID'];
$reportedID = $_POST['reportedID'];
$qaqcID = $_POST['qaqcID'];
$equipmentID = $_POST['equipmentID'];
$boundaryID = $_POST['boundaryID'];
$consequenceID = $_POST['consequenceID'];

//echo $departmentID . '<br>'; 

$stmt = $db->prepare('INSERT INTO events (date_occurred, date_reported, description_short, description_long, site_id, department_id, 
                                          severity_actual_id, severity_probable_id, temperature, temperature_uom_id, 
                                          weather_id, lighting_id, operation_type_id, activity_type_id, entered_by_id, reported_by_id, 
                                          qa_qc_by_id, equipment_id, reporting_boundary, consequence_type_id) 
                      VALUES (:dateOccurred, :dateReported, :shortDescription, :longDescription, :siteID, :departmentID, 
                              :severityID_Act, :severityID_Prob, :temperature, :tempUOMID, 
                              :weatherID, :lightingID, :operationID, :activityID, :enteredID, :reportedID, 
                              :qaqcID, :equipmentID, :boundaryID, :consequenceID)');

$stmt->bindValue(':dateOccurred',$dateOccurred);
$stmt->bindValue(':dateReported',$dateReported);
$stmt->bindValue(':shortDescription',$shortDescription); 
$stmt->bindValue(':longDescription',$longDescription); 
$stmt->bindValue(':siteID',$siteID); 
$stmt->bindValue(':departmentID',$departmentID); 
$stmt->bindValue(':severityID_Act',$severityID_Act);
$stmt->bindValue(':severityID_Prob',$severityID_Prob);
$stmt->bindValue(':temperature',$temperature);
$stmt->bindValue(':tempUOMID',$tempUOMID);
$stmt->bindValue(':weatherID',$weatherID);
$stmt->bindValue(':lightingID',$lightingID);
$stmt->bindValue(':operationID',$operationID);
$stmt->bindValue(':activityID',$activityID);
$stmt->bindValue(':enteredID',$enteredID);
$stmt->bindValue(':reportedID',$reportedID);
$stmt->bindValue(':qaqcID',$qaqcID);
$stmt->bindValue(':equipmentID',$equipmentID); 
$stmt->bindValue(':boundaryID',$boundaryID); 
$stmt->bindValue(':consequenceID',$consequenceID); 

$stmt->execute();

$eventID = $db->lastInsertId("events_event_id_seq");
//echo $eventID . '<br>'; 

    $stmt = $db->prepare('SELECT * FROM events WHERE event_id=:eventID');
    $stmt->bindValue(':eventID',$eventID);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
        $dateOccurred = new DateTime($row['date_occurred']);
        $dateReported = new DateTime($row['date_reported']);
        $dateEntered = new DateTime($row['date_entered']); 

        echo '<p>';
        echo '<b>Event ID:</b>  '. $row['event_id'].'<br>';
        echo '<b>Date Event Occurred:</b>  ' . $dateOccurred->format('M d, Y').'<br>';
        echo '<b>Date Event Reported:</b>  ' . $dateReported->format('M d, Y').'<br>';
        echo '<b>Date Event Entered:</b>  ' . $dateEntered->format('M d, Y').'<br>';
        echo '<b>Short Description:</b>  ' . $row['description_short'].'<br>';
        echo '<b>Detailed Description:</b>  ' . $row['description_long'].'<br>';
        //actual severity
        $sql = "select severity_label from severities join events on severities.severity_id = events.severity_actual_id WHERE event_id=:eventID";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':eventID',$eventID);
        $stmt->execute();
        $actualSeverities = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($actualSeverities as $actualSeverity)
        {
            echo '<b>Actual Severity:</b>  ' . $actualSeverity['severity_label'] .'<br>';
        }
        //probable severity
        $sql = "select severity_label from severities join events on severities.severity_id = events.severity_probable_id WHERE event_id=:eventID";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':eventID',$eventID);
        $stmt->execute();
        $probableSeverities = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($probableSeverities as $probableSeverity)
        {
            echo '<b>Probable Severity:</b>  ' . $probableSeverity['severity_label'] .'<br>';
        }
        //Equipment Type
        $sql = "select equipment_label from equipments join events on equipments.equipment_id = events.equipment_id WHERE event_id=:eventID";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':eventID',$eventID);
        $stmt->execute();
        $equipment_labels = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($equipment_labels as $equipment_label)
        {
            echo '<b>Equipment Type:</b>  ' . $equipment_label['equipment_label'] .'<br>';
        }
        //Reporting Boundary
        echo '<b>Within Reporting Boundary?:</b>  ' . var_export($row['reporting_boundary'], True) . '<br>';
        
        //Organizational Details
        echo '<h3>Organization Details:</h3>';         
        //site
        $sql = "select site_label from sites join events on sites.site_id = events.site_id WHERE event_id=:eventID";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':eventID',$eventID);
        $stmt->execute();
        $sites = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($sites as $site)
        {
            echo '<b>Site:</b>  ' . $site['site_label'] .'<br>';
        }
        //department
        $sql = "select department_label from departments join events on departments.department_id = events.department_id WHERE event_id=:eventID";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':eventID',$eventID);
        $stmt->execute();
        $departments = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($departments as $department)
        {
            echo '<b>Department:</b>  ' . $department['department_label'] .'<br>';
        }
        
        //event status
        //$sql = "select status_label from statuses join events on statuses.status_id = events.event_status_id WHERE event_id=:eventID";
        //$stmt = $db->prepare($sql);
        //$stmt->bindValue(':eventID',$eventID);
        //$stmt->execute();
        //$statuses = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        //foreach ($statuses as $status)
        //{
        //    echo '<b>Event Status:</b>  ' . $status['status_label'] .'<br>';
        //}

        //Weather/Lighting Details
        echo '<h3>Weather/Lighting Details:</h3>'; 
        //Temperature
        echo '<b>Temperature:</b>  ' . $row['temperature'].'° ';
        //Temperature UOM
        $sql = "select temperature_uom_label from temperature_uoms join events on temperature_uoms.temperature_uom_id = events.temperature_uom_id WHERE event_id=:eventID";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':eventID',$eventID);
        $stmt->execute();
        $temperatureUOMs = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($temperatureUOMs as $temperatureUOM)
        {
            echo $temperatureUOM['temperature_uom_label'] .'<br>';
        }
        //weather
        $sql = "select weather_label from weathers join events on weathers.weather_id = events.weather_id WHERE event_id=:eventID";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':eventID',$eventID);
        $stmt->execute();
        $weathers = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($weathers as $weather)
        {
            echo '<b>Weather Conditions:</b>  ' . $weather['weather_label'] .'<br>';
        }
        //lighting
        $sql = "select lighting_label from lightings join events on lightings.lighting_id = events.lighting_id WHERE event_id=:eventID";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':eventID',$eventID);
        $stmt->execute();
        $lightings = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($lightings as $lighting)
        {
            echo '<b>Lighting:</b>  ' . $lighting['lighting_label'] .'<br>';
        }

        //Operation/Activity Type Details
        echo '<h3>Operation/Activity Type Details:</h3>'; 
        //Operation Type
        $sql = "select operation_type_label from operation_types join events on operation_types.operation_type_id = events.operation_type_id WHERE event_id=:eventID";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':eventID',$eventID);
        $stmt->execute();
        $operationtypes = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($operationtypes as $operationtype)
        {
            echo '<b>Type of Operation At Time of Event:</b>  ' . $operationtype['operation_type_label'] .'<br>';
        }
        //Activity Type
        $sql = "select activity_type_label from activity_types join events on activity_types.activity_type_id = events.activity_type_id WHERE event_id=:eventID";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':eventID',$eventID);
        $stmt->execute();
        $activityTypes = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($activityTypes as $activityType)
        {
            echo '<b>Type of Activity At Time of Event:</b>  ' . $activityType['activity_type_label'] .'<br>';
        }

        //Responsibility Details
        echo '<h3>Responsibility Details:</h3>'; 
        //Entered By
        $sql = "select user_name, user_name_first, user_name_last from users join events on users.user_id = events.entered_by_id  WHERE event_id=:eventID";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':eventID',$eventID);
        $stmt->execute();
        $enteredBys = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($enteredBys as $enteredBy)
        {
            echo '<b>Entered By:</b>  ' . $enteredBy['user_name_first'] . ' ' . $enteredBy['user_name_last'] . ' (' . $enteredBy['user_name'] .')<br>';
        }
        //Reported By
        $sql = "select user_name, user_name_first, user_name_last from users join events on users.user_id = events.reported_by_id  WHERE event_id=:eventID";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':eventID',$eventID);
        $stmt->execute();
        $reportedBys = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($reportedBys as $reportedBy)
        {
            echo '<b>Reported By:</b>  ' . $reportedBy['user_name_first'] . ' ' . $reportedBy['user_name_last'] . ' (' . $reportedBy['user_name'] .')<br>';
        }
        //QA QC'd By
        $sql = "select user_name, user_name_first, user_name_last from users join events on users.user_id = events.qa_qc_by_id  WHERE event_id=:eventID";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':eventID',$eventID);
        $stmt->execute();
        $qa_qcBys = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($qa_qcBys as $qa_qcBy)
        {
            echo '<b>QA/QC By:</b>  ' . $qa_qcBy['user_name_first'] . ' ' . $qa_qcBy['user_name_last'] . ' (' . $qa_qcBy['user_name'] .')<br>';
        }        
    }

    $injuryDescription = $_POST['injuryDescription'];
    $injstmt = $db->prepare('INSERT INTO injuries (event_id, injury_description) 
                        VALUES ('.$eventID.', :injuryDescription)');
    $injstmt->bindValue(':injuryDescription',$injuryDescription);
    $injstmt->execute();

    $injuryID = $db->lastInsertId("injuries_injury_id_seq");
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
        }

?>
 </body>
</html>