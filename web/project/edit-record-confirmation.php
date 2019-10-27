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
    <h2>Record Updated Successfully</h2>
    <h3>Event Details:</h3>
    
<?php
$EventID = $_POST['EventID'];
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

echo $severityID_Prob;
$stmt = $db->prepare('UPDATE events 
                      SET severity_probable_id='.$severityID_Prob.'
                      WHERE event_id='.$EventID);

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

?>
</body>
</html>