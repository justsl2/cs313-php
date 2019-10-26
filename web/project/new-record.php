<?php
require "dbConnect.php";
$db = get_db();
$dateOccurred = $_POST['dateOccurred'];
$shortDescription = $_POST['shortDescription'];
$equipmentID = $_POST['equipmentID'];
echo $dateOccurred . '<br>';
echo $shortDescription . '<br>';
echo $equipmentID . '<br>';

$stmt = $db->prepare('INSERT INTO events (date_occurred, description_short, equipment_id) 
                      VALUES (:dateOccurred, :shortDescription, :equipmentID)');
$stmt->bindValue(':dateOccurred',$dateOccurred);
$stmt->bindValue(':shortDescription',$shortDescription); 
$stmt->bindValue(':equipmentID',$equipmentID); 

$stmt->execute();

$eventID = $db->lastInsertId("events_event_id_seq");
echo $eventID . '<br>'; 

    $stmt = $db->prepare('SELECT * from events');
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
        $dateOccurred = new DateTime($row['date_occurred']);
        $dateReported = new DateTime($row['date_reported']);
        $dateEntered = new DateTime($row['date_entered']); 

        echo '<p>';
        echo '<b>EventID:</b>  '. $row['event_id'].'<br>';
        echo '<b>Date Occurred:</b>  ' . $dateOccurred->format('M d, Y').'<br>';
        echo '<b>Short Description:</b>  ' . $row['description_short'].'<br>';
        echo '<b>Detailed Description:</b>  ' . $row['description_long'].'<br>';
		echo '</p>';
	}

?>
