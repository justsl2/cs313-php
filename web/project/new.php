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
        <textarea name="short_description"></textarea>
        <br>
        <input type="submit" class="button" value="Create Short Description">
    Equipment:
        <select name="equipment">
            <?php 
            $sql = mysqli_query($connection, "SELECT equipment_label FROM equipments");
            while ($row = $sql->fetch_assoc()){
            echo "<option value=".$row['equipment_label'].">" . $row['equipment_label'] . "</option>";
            }
            ?>
        </select>

        Car:
        <select>
            <option value="volvo">Volvo</option>
            <option value="saab">Saab</option>
            <option value="opel">Opel</option>
            <option value="audi">Audi</option>
        </select>
    </form>
    </body>
</html>