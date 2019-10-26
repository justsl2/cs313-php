<?php
require "dbConnect.php";
$db = get_db();
$dateOccurred = $_POST['dateOccurred'];
$shortDescription = $_POST['shortDescription'];
$longDescription = $_POST['longDescription'];
$equipmentID = $_POST['equipmentID'];
echo $dateOccurred . '<br>';
echo $shortDescription . '<br>';
echo $equipmentID . '<br>';

$stmt = $db->prepare('INSERT INTO events (date_occurred, description_short, description_long, equipment_id) 
                      VALUES (:dateOccurred, :shortDescription, :longDescription, :equipmentID)');
$stmt->bindValue(':dateOccurred',$dateOccurred);
$stmt->bindValue(':shortDescription',$shortDescription); 
$stmt->bindValue(':longDescription',$longDescription); 
$stmt->bindValue(':equipmentID',$equipmentID); 

$stmt->execute();

$eventID = $db->lastInsertId("events_event_id_seq");
echo $eventID . '<br>'; 

    $stmt = $db->prepare('SELECT * FROM events WHERE event_id=:eventID');
    $stmt->bindValue(':eventID',$eventID);
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
        $sql = "select equipment_label from equipments right join events on equipments.equipment_id = events.equipment_id WHERE event_id=:eventID";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':eventID',$eventID);
        $stmt->execute();
        $equipment_labels = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($equipment_labels as $equipment_label)
        {
            echo '<b>Equipment Type:</b>  ' . $equipment_label['equipment_label'] .'<br>';
        }
		echo '</p>';
	}

?>
