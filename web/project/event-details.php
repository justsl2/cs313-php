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
    $sql = "select * from events WHERE event_id=:event_id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':event_id', $_GET['event_id'], PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);




    foreach ($rows as $row)
    {
        $dateOccurred = new DateTime($row['date_occurred']);
        $dateReported = new DateTime($row['date_reported']);
        $dateEntered = new DateTime($row['date_entered']); 

        echo '<p>';
        echo '<b>EventID:</b>  ';
        echo '<a href="event-details.php?event_id=' . $row['event_id'] . '">'. $row['event_id'].'</a><br>';
        echo '<b>Date Occurred:</b>  ' . $dateOccurred->format('M d, Y').'<br>';
        echo '<b>Date Reported:</b>  ' . $dateReported->format('M d, Y').'<br>';
        echo '<b>Date Entered:</b>  ' . $dateEntered->format('M d, Y').'<br>';
        $sql = "select site_label from sites right join events on sites.site_id = events.site_id WHERE event_id=:event_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':event_id', $_GET['event_id'], PDO::PARAM_INT);
        $stmt->execute();
        $sites = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($sites as $site)
        {
            echo '<b>Site:</b>  ' . $site['site_label'] .'<br>';
        }
        $sql = "select department_label from departments right join events on departments.site_id = events.site_id WHERE event_id=:event_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':event_id', $_GET['event_id'], PDO::PARAM_INT);
        $stmt->execute();
        $departments = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        foreach ($departments as $department)
        {
            echo '<b>Department:</b>  ' . $department['department_label'] .'<br>';
        }
        echo '<b>Short Description:</b>  ' . $row['description_short'].'<br>';
        echo '<b>Detailed Description:</b>  ' . $row['description_long'].'<br>';
        echo '<b>Within Reporting Boundaries?:</b>  ' . var_export($row['reporting_boundary'], True);'<br>';
        echo '</p>';
    }


?>
 </body>
</html>