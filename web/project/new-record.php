<?php
require "dbConnect.php";
$db = get_db();
$shortDescription = $_POST['shortDescription'];
$equipmentID = $_POST['equipmentID'];


$stmt = $db->prepare('INSERT INTO events (description_short, equipment_id) VALUES (:shortDescription, :equipmentID)');
$stmt->bindValue(':shortDescription',$shortDescription); 
$stmt->bindValue(':equipmentID',$equipmentID); 
$stmt->execute();

    $stmt = $db->prepare('SELECT event_id, description_short, equipment_id from events');
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		echo '<p>';
		echo '<strong>' . $row['event_id'] . ' ' . $row['description_short'] . ':';
		echo $row['equipment_id'] . '</strong>';
		echo '<br />';
		echo '</p>';
	}

?>
