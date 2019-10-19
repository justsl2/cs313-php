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
<h1>Scripture Resources</h1>

<form>
    Book: <input type="text" name="bookName">
    <br/>
    <input type="submit" value="Search">
</form>

<?php

// Search Scriptures from a Book

if (isset($_GET['bookName']))
{
    $stmt = $db->prepare('select * from Scripture WHERE book=:bookName');
    $stmt->bindValue(':bookName', $_GET['bookName'], PDO::PARAM_STR);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($rows as $row)
    {
        echo '<p>';
        echo '<a href="scripture-details.php?id=' . $row['id'] . '">';
        echo '<b>' . $row['book'] . ' ' . $row['chapter'] . ':' . $row['verse'] . '</b>';
        echo '</a>';
        echo '</p>';
    }
}
?>
</body>
</html>