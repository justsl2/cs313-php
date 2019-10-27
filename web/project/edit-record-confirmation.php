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


$sql = "UPDATE public.events SET severity_probable_id=".$severityID_Prob." WHERE event_id=".$EventID;
echo $sql;
$stmt = $db->prepare($sql);

$stmt->execute();

?>

</body>
</html>