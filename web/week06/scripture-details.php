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

<h1>Scripture Details</h1>


<?php

// Select ONE scripture with id=?
$stmt = $db->prepare('select * from Scripture WHERE id=:scriptureId');
$stmt->bindValue(':scriptureId', $_GET['id'], PDO::PARAM_INT);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC); //another function that get only 1

foreach ($rows as $row)
{
    echo '<p>';
    echo '<b>' . $row['book'] . ' ' . $row['chapter'] . ':' . $row['verse'] . '</b>';
    echo ' - "' . $row['content'] . '"';
    echo '</p>';
}
?>