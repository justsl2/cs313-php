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
    <a href="search.php" class="button">Back</a>
<?php
    $stmt = $db->prepare('select * from events WHERE event_id=:event_id');
    $stmt->bindValue(':event_id', $_GET['event_id'], PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($rows as $row)
    {
        $dateOccurred = new DateTime($row['date_occurred']);
        echo '<p>';
        echo '<b>EventID:</b>  ';
        echo '<a href="event-details.php?event_id=' . $row['event_id'] . '">'. $row['event_id'].'</a><br>';
        echo '<b>Date Occurred:</b>  ' . $dateOccurred->format('M d, Y').'<br>';
        echo '<b>Date Occurred:</b>  ' . $row['description_short'].'<br>';
        echo '<b>Within Reporting Boundaries?:</b>  ' . var_export($row['reporting_boundary'], True);'<br>';
        echo '</p>';
    }
?>
 </body>
</html>