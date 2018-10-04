<?php $radio = array("Computer Science", "Web Design and Development", "Computer Information Technology", "Computer Engineering"); ?>

<html>

<head>
    <title>Teach Activity 3</title>


</head>

<body>

    <form action="ta03submit.php" method="post">
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


</body>

</html>
