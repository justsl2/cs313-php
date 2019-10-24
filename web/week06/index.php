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
	<title>Scripture List</title>
</head>

<body>
<h1>Scripture Resources</h1>


<!--Insert Book-->
<form METHOD="POST" ACTION="allscriptures.php">
    Book: <input type="text" name="bookName">
    <br/>
<!--Insert Chapter-->
    Chapter: <input type="text" name="chapterNum">
    <br/>
<!--Insert Verse-->
    Verse: <input type="text" name="verseNum">
    <br/>
<!--Insert Content-->
    Content: <input type="textarea" name="content">
    <br/>
<!--Insert Topic Type-->
    Topic: 
    <br/>
<?php
    $stmt = $db->prepare('select * from topic');
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as $row)
    {
        $topic = $row['name'];
        $topicID = $row['id'];
        echo '<input type="checkbox" name="topics[]" value="'.$topicID.'">'.$topic;
        echo '<br>';
    }
?>
<input type="submit" value="Submit">
</form>
</body>
</html>