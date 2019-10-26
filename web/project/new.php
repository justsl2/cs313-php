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
        <a class="active" href="new.php">Create New Event</a>
        <a class="active" href="search.php">Search</a>
    </div>
    <h2>New</h2>
    <form method="post" action="new-record.php">
    Date Event Occurred: 
    <input type="date" name="dateOccurred"><br/>
    
    Short Description: 
    <input type="text" rows="2" cols="100" name="shortDescription"><br/>

    Detailed Description: 
    <input type="text" rows="4" cols="100" name="longDescription"><br/>

    Equipment: 
        <select required name="equipmentID">
        <option value="" selected disabled hidden></option>
        <?php
            $stmt = $db->prepare('select * from equipments');
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row)
            {
                $equipment = $row['equipment_label'];
                $equipmentID = $row['equipment_id'];
                echo '<option value="'.$equipmentID.'">'.$equipment.'</option>';
                echo '<br>';
            }
        ?>
        </select>


    <input type="submit" value="Submit">
    </form>
    </body>
</html>