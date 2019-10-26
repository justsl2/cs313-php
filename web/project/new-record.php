<?php
require "dbConnect.php";
$db = get_db();
$dateOccurred = $_POST['dateOccurred'];
$shortDescription = $_POST['shortDescription'];
$equipmentID = $_POST['equipmentID'];
echo $dateOccurred;

$stmt = $db->prepare('INSERT INTO events (date_occurred, description_short, equipment_id) VALUES (:dateOccurred, :shortDescription, :equipmentID)');
$stmt->bindValue(':dateOccurred',$dateOccurred); 
$stmt->bindValue(':shortDescription',$shortDescription); 
$stmt->bindValue(':equipmentID',$equipmentID); 
$stmt->execute();

    $stmt = $db->prepare('SELECT event_id, date_occurred, description_short, equipment_id from events');
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
        echo '<p>';
        echo 'Event ID = ' . $row['event_id'] . '<br>';
        echo 'Date Event Occurred = ' . $row['date_occurred'] . '<br>';
        //echo 'Short Description = ' . $row['description_short'] . '<br> ';
        //echo 'Equipment ID = '. $row['equipment_id'] . '<br> ';
		echo '</p>';
	}

?>
