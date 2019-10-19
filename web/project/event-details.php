<?php
/**********************************************************
* File: viewScriptures.php
* 
***********************************************************/

require "dbConnect.php";
$db = get_db();

?>

<h1>Event Details</h1>


<?php

$stmt = $db->prepare('select * from events WHERE event_id=:eventID');
$stmt->bindValue(':eventID', $_GET['eventID'], PDO::PARAM_INT);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC); //another function that get only 1

foreach ($rows as $row)
{
    echo '<p>';
    echo '<b>' . $row['event_id'] . ' ' . $row['description_short'] . ':' . $row['description_long'] . '</b>';
    echo '</p>';
}
?>