<?php
require "dbConnect.php";
$db = get_db();
$shortDescription = $_POST['shortDescription'];
$equipmentID = $_POST['equipmentID'];
 echo '$equipmentID = '.$equipmentID;

$stmt = $db->prepare('INSERT INTO events (description_short, equipment_id) VALUES (:shortDescription, :equipmentID)');
$stmt->bindValue(':shortDescription',$shortDescription); 
$stmt->bindValue(':equipmentID',$equipmentID); 
$stmt->execute();

    $stmt = $db->prepare('SELECT event_id, description_short, equipment_id from events');
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		echo '<p>';
		echo '<strong>Event ID = ' . $row['event_id'] . '<br> Short Description = ' . $row['description_short'] . '<br> Equipment ID = ';
		echo $row['equipment_id'] . '</strong>';
		echo '<br />';
		echo '</p>';
	}

?>
