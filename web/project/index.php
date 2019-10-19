<?php
/**********************************************************
* File: viewScriptures.php
* Author: Br. Burton
* 
* Description: This file shows an example of how to query a
*   PostgreSQL database from PHP.
***********************************************************/

require "dbConnect.php";
$db = get_db();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Incident Management System</title>
</head>

<body>
<h1>Incident Management System</h1>

<form>
    EVENT ID: <input type="number" name="eventID">
    <br/>
    <input type="submit" value="Search">
</form>

<?php

// Search Event ID from Events

if (isset($_GET['eventID']))
{
    $stmt = $db->prepare('select * from events WHERE event_id=:eventID');
    $stmt->bindValue(':eventID', $_GET['eventID'], PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($rows as $row)
    {
        echo '<p>';
        echo '<a href="event-details.php?event_id=' . $row['event_id'] . '">';
        echo '<b>' . $row['event_id'] . ' ' . $row['date_occurred'] . ' - ' . $row['description_short'] . '</b>';
        echo '</a>';
        echo '</p>';
    }
}
?>
</body>
</html>