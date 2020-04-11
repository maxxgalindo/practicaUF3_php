<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
if(isset($_GET['error'])){
    echo $_GET['error'];
}

?>

<form method="post" action="action.php">
    Name: <input type="text" name="name" required/></br>
    Category: <input type="text" name="category"/></br>
   Height: <input type="number"name="height"/></br>
    Weight: <input type="number"name="weight"/></br>
    <h3>Type/s</h3></br>
    Water<input type="checkbox" name = "types[]" value="water"/></br>
    Fire<input type="checkbox" name = "types[]" value="fire"/></br>
    Grass<input type="checkbox" name = "types[]" value="grass"/></br>
    Normal<input type="checkbox" name = "types[]" value="normal"/></br>
    <h3>Evolutions</h3></br>
    First: <input type="text" name = "evo1"/></br>
    Second: <input type="text" name = "evo2"/></br>
    Third: <input type="text" name = "evo3"/></br>
    <input type="submit" name = "save" value ="SAVE"/></br>
    <input type="submit" name = "load" value="LOAD"/></br>

</form>  

<?php



//TESTING CHECKBOX
if(isset($_POST['submit']) && !empty($_POST['types'])) {
    foreach($_POST['types'] as $check) {
            echo $check."<br>"; //echoes the value set in the HTML form for each checked checkbox.
                         //so, if I were to check 1, 3, and 5 it would echo value 1, value 3, value 5.
                         //in your case, it would echo whatever $row['Report ID'] is equivalent to.
    }
}


?>
    
</body>
</html>