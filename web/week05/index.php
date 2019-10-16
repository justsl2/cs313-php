<?php $radio = array("Computer Science", "Web Design and Development", "Computer Information Technology", "Computer Engineering"); 
try
{
  $dbUrl = getenv('DATABASE_URL');

  $dbOpts = parse_url($dbUrl);

  $dbHost = $dbOpts["host"];
  $dbPort = $dbOpts["port"];
  $dbUser = $dbOpts["user"];
  $dbPassword = $dbOpts["pass"];
  $dbName = ltrim($dbOpts["path"],'/');

  $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $ex)
{
  echo 'Error!: ' . $ex->getMessage();
  die();
}
?>

<html>

<head>
    <title>Teach Activity 3</title>
    <link rel="stylesheet" type="text/css" href="..\..\mainstyles.css">
</head>

<body>
<?php include '..\sidebar.php';?>
<div class="main">
    <form action="submit.php" method="post">
        <input type="text" name="name" placeholder="Name:"><br>
        <input type="text" name="email" placeholder="Email:"><br>
        <?php 
        
        $count = count($radio);
        
        for ($i=0; $i < $count; $i++){
            echo "<input type='radio' name='Major' value='$radio[$i]'> $radio[$i]<br>";
        }
        ?>

        <textarea name="comments" placeholder="Comments"></textarea><br>        

        <input type="checkbox" name="continents[]" value="na"> North America<br>
        <input type="checkbox" name="continents[]" value="sa"> South America<br>
        <input type="checkbox" name="continents[]" value="e" > Europe<br>
        <input type="checkbox" name="continents[]" value="af"> Africa<br>
        <input type="checkbox" name="continents[]" value="as"> Asia<br>
        <input type="checkbox" name="continents[]" value="au" > Australia<br>
        <input type="checkbox" name="continents[]" value="an" > Antarctica<br>
        
        <input type="submit">
    </form>

    </div>
</body>

</html>
