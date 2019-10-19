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
    <h2>Search</h2>
    <form>
        Event ID: <input type="number" name="eventID">
        <input type="submit" value="Search Event ID" class="button">
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
            $date = date_create('2000-01-01');
            echo date_format($date, 'Y-m-d H:i:s');
            echo '<p>';
            echo '<b>EventID:</b>  ';
            echo '<a href="event-details.php?event_id=' . $row['event_id'] . '">'. $row['event_id'].'</a><br>';
            echo '<b>Date Occurred:</b>  ' . $row['date_occurred'].'<br>';
            echo '<b>Date Occurred:</b>  ' . $row['description_short'].'<br>';
            echo '<b>Within Reporting Boundaries?:</b>  ' . var_export($row['reporting_boundary'], True);'<br>';
            echo '</p>';
        }
    }
    ?>
    <br>
    <!--
    <form>
        Record Status: <input type="text" name="eventID">
        <input type="submit" value="Search Record Status" class="button">
    </form>

    <?php
    
     
    if (isset($_GET['eventID']))
    {
        $stmt = $db->prepare('select * from events WHERE event_id=:eventID');
        $stmt->bindValue(':eventID', $_GET['eventID'], PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($rows as $row)
        {
            echo '<p>';
            echo '<b>EventID:</b>  ';
            echo '<a href="event-details.php?event_id=' . $row['event_id'] . '">'. $row['event_id'].'</a>';
            echo '</p>';
        }
    }
    ?>
    -->
    </body>
</html>