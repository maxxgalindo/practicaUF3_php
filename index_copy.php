<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<style media="screen">
  *{

  }
  body {
    background-color:
  }
</style>

<body>

<?php
if(isset($_GET['error'])){
    echo $_GET['error'];
}

include('list.php');

?>

<div style="width:50%;float:left;">
   <table class="table table-hover table-dark">
     <thead>
       <tr>
         <th scope="col">#</th>
         <th scope="col">NAME</th>
         <th scope="col">CATEGORY</th>
       </tr>
     </thead>
     <tbody>
       <?php foreach ($pokemons as $id => $pokemon): ?>
       <tr onclick="loadData(<?php echo $pokemon->xpath('//name')[0]; ?>)">
         <th scope="row"><?php $id ?></th>
         <td><?php echo $pokemon->xpath('//name')[0]; ?></td>
         <td><?php echo $pokemon->xpath('//category')[0]; ?></td>
       </tr>
    <?php endforeach; ?>
     </tbody>
   </table>
</div>

<div id="right" style="width:50%;float:right;">
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
</div>

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

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
function loadData(name) {
   var form = document.createElement("form");
   form.setAttribute("method", "post");
   form.setAttribute("action", "action.php");
   form.setAttribute("hidden", true);

   var input = document.createElement("input");
   input.setAttribute("type", "text");
   input.setAttribute("name", "name");
   input.setAttribute("value", name);

   var submit = document.createElement("input");
   submit.setAttribute("id", "form_submit");
   submit.setAttribute("type", "submit");
   submit.setAttribute("name", "load");
   submit.setAttribute("value", "LOAD");

   form.appendChild(input);
   form.appendChild(submit);
   document.body.appendChild(form);
   document.getElementById("form_submit").click();
}
</script>


</html>
