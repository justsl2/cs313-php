<?php 
    $name = $_POST["name"]; 
?>
<html>

<head>
    <title>Teach Activity 3</title>
    <link rel="stylesheet" type="text/css" href="..\..\mainstyles.css">
</head>

<body>
<?php include '..\..\sidebar.php';?>
<div class="main">
    <h1>Your Info</h1>
    <p> Name:       <?php echo $_POST["name"]; ?> <br> 
        Email:      <?php echo "<a href=mailto:" . $_POST["email"].">".$_POST["email"]."</a>"; ?><br> 
        Major:      <?php echo $_POST["Major"]; ?> <br> 
        Comments:   <?php echo $_POST["comments"]; ?> <br> 
        You have visited: <br>
        <?php 
        $continents = $_POST["continents"];
        $count = count($continents);
        $contMap = ["na" => "North America",
                    "sa" => "South America",
                    "e" => "Europe",
                   "af" => "Africa",
                   "as" => "Asia",
                   "au" => "Australia",
                   "an" => "Antarctica"];
        
        for ($i=0; $i < $count; $i++){
            $key = $continents[$i];
           echo "$contMap[$key] <br>";
        }
        ?></p>

    </div>
</body>

</html>
