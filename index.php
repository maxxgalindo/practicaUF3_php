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
    Name: <input type="text" name="name" value="<?php if(isset($_POST['name'])){ echo $_POST['name'];}?>" required/></br>
    Category: <input type="text" name="category" value="<?php if(isset($_POST['category'])){ echo $_POST['category'];}?>"/></br>
   Height: <input type="number"name="height" value="<?php if(isset($_POST['height'])){ echo $_POST['height'];}?>"/></br>
    Weight: <input type="number"name="weight" value="<?php if(isset($_POST['weight'])){ echo $_POST['wight'];}?>"/></br>
    <h3>Type/s</h3></br> <?php if(isset($_POST['types'])){$types = $_POST['types'];}else{$types=[];}?>
    Water<input type="checkbox" name = "types[]" value="water" <?php if(in_array('water',$types)){echo "checked";}?>/></br>
    Fire<input type="checkbox" name = "types[]" value="fire" <?php if(in_array('fire',$types)){echo "checked";}?>/></br>
    Grass<input type="checkbox" name = "types[]" value="grass" <?php if(in_array('grass',$types)){echo "checked";}?>/></br>
    Normal<input type="checkbox" name = "types[]" value="normal" <?php if(in_array('normal',$types)){echo "checked";}?>/></br>
    <h3>Evolutions</h3></br>
    First: <input type="text" name = "evo1" value = "<?php if(isset($_POST['evo1'])){echo $_POST['evo1'];}?>"/></br>
    Second: <input type="text" name = "evo2" value = "<?php if(isset($_POST['evo2'])){echo $_POST['evo2'];}?>"/></br>
    Third: <input type="text" name = "evo3" value = "<?php if(isset($_POST['evo3'])){echo $_POST['evo3'];}?>"/></br>
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
