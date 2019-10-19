<?php
    require "dbConnect.php";
    $db = get_db();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Incident Management System</title>
        <link rel="stylesheet" type="text/css" href="mystyles.css">
    </head>

    <body>
    <h1>Incident Management System</h1>
    <div class="topnav">
        <a class="active" href="index.php">Home</a>
        <a class="active" href="new.php">Create New Record</a>
        <a class="active" href="search.php">Search</a>
    </div>
    <h2>Event Details</h2>
 
<?php
    $stmt = $db->prepare('select * from events WHERE event_id=:event_id');
    $stmt->bindValue(':event_id', $_GET['event_id'], PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC); //another function that get only 1

    foreach ($rows as $row)
    {
        echo '<p>';
        echo '<b>' . $row['event_id'] . ' ' . $row['description_short'] . ':' . $row['description_long'] . '</b>';
        echo '</p>';
    }
?>
 </body>
</html>