<?php
require "dbConnect.php";
$db = get_db();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Incident Management System</title>
        <link rel="stylesheet" type="text/css" href="mystyles.css">
        <script type="text/javascript" src="scripts.js"></script> 
    </head>

    <body>
    <h1>Incident Management System</h1>
    <div class="topnav">
        <a class="active" href="index.php">Home</a>
        <a class="active" href="new.php">Create New Event</a>
        <a class="active" href="search.php">Search</a>
    </div>
    <h2>Record Edit</h2>

    <?php
        $EditEventID = $_POST['EditEventID'];
        $EditInjuryID = $_POST['EditInjuryID'];
        echo $EditEventID.'<br>';
        echo $EditInjuryID.'<br>';    
    ?>
    <form method="post" action="edit-record-confirmation.php">
   
   <h3>Event Details:</h3>
   <b>Event ID: </b> <br/>
   <input required type="date" name="dateOccurred" style="width:200px" value = $EditEventID><br/>    

   <b>Date Event Occurred: </b> <br/>
   <input required type="date" name="dateOccurred" style="width:200px"><br/>    

   <b>Date Event Reported: </b> <br/>
   <input required type="date" name="dateReported" style="width:200px"><br/>
   
   <b>Short Description: </b> <br/>
   ​<textarea required name="shortDescription" rows="1" cols="70"></textarea><br/>

   <b>Detailed Description: </b> <br/>
   <textarea required name="longDescription" rows="2" cols="70"></textarea><br/>
</body>
</html>