<?php
require "dbConnect.php";
$db = get_db();
$shortDescription = $_POST['shortDescription'];
$equipment = $_POST['equipment'];


$stmt = $db->prepare('INSERT INTO events (description_short, equipment) VALUES (:shortDescription, :equipment)');
$stmt->bindValue(':shortDescription',$shortDescription); 
$stmt->bindValue(':equipment',$equipment); 
$stmt->execute();

$eventID = $db->lastInsertId("events_event_id_seq");

    $stmt = $db->prepare('SELECT event_id, description_short, equipment from events');
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		echo '<p>';
		echo '<strong>' . $row['event_id'] . ' ' . $row['description_short'] . ':';
		echo $row['equipment'] . '</strong>';
		echo '<br />';
		echo '</p>';
	}

?>
