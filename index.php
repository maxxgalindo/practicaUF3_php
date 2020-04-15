<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<style>
    *{
        border-color:#32383e;
        border-width: 2px;
        color:white;
        margin: 0px 5px;
    }

   body{

            background-color:#212529;
            margin: 10px;
            color:white;

     }

</style>
<body>

<?php
if(isset($_GET['error'])){
    switch ($_GET['error']) {
      case 'empty_fields':
        echo "<script>alert('Fill all fields')</script>";
        break;

      case 'already_exists':
        echo "<script>alert('This pokemon already exists')</script>";
        break;

      case 'query_error':
        echo "<script>alert('Invalid xpath query')</script>";
        break;

      default:
        echo "<script>alert('Something went wrong')</script>";
        break;
    }
}

if (isset($_POST['xpath'])) {
  $query = "SELECT id,xml FROM pokemon WHERE xmlexists('//pokemon[".$_POST['xpath']."]' PASSING BY REF xml);";
}else {
  $query = "SELECT id,xml FROM pokemon;";
}

include('list.php');

?>

<div style="width: 48%;float:left;">

<div style="margin-bottom:5px">
  <form class="form-inline my-2 my-lg-0" action="index.php" method="post">
    <input class="form-control mr-sm-2" type="search" placeholder="//pokemon[...] | eg.: attribute = value" name="xpath" aria-label="Search" style="width:85%">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" style="width:10%">Search</button>
  </form>
</div>

<table class="table table-hover table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Category</th>
    </tr>
  </thead>
  <tbody>

    <?php foreach($pokemons as $id => $pokemon):?>
    <tr onclick="loadData('<?php echo $pokemon->xpath('//name')[0];?>')">
      <th scope="row"><?php echo $id ?></th>
      <td><?php echo $pokemon->xpath('//name')[0];?></td>
      <td><?php echo $pokemon->xpath('//category')[0];?></td>
      <td><a href="action.php?delete=<?php echo $id; ?>" type="button" class="btn btn-danger"><img src="trash.png" style="width:1.5em;height:auto;"></a></td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>

</div>

<div style="width:48%;float:right;">
<form method="post" action="action.php">
<div class="form-group">
<label for="name">Name</label>
 <input id="name" type="text" class="form-control" name="name" value="<?php if(isset($_POST['name'])){ echo $_POST['name'];}?>" required/></br>
 </div>

 <div class="form-group">
 <label for="category">Category</label>
 <input id="category" type="text" class="form-control" name="category" value="<?php if(isset($_POST['category'])){ echo $_POST['category'];}?>"/></br>
 </div>

 <div class="form-group">
 <label for="height">Height</label>
 <input type="number" id="height" class="form-control" name="height" value="<?php if(isset($_POST['height'])){ echo $_POST['height'];}?>"/></br>
 </div>

 <div class="form-group">
 <label for="weight">Weight</label>
 <input type="number" id="weight" class="form-control" name="weight" value="<?php if(isset($_POST['weight'])){ echo $_POST['weight'];}?>"/></br>
 </div>

</br><h3>Type/s</h3> <?php if(isset($_POST['types'])){$types = $_POST['types'];}else{$types=[];}?>

<div class="form-check">
<input type="checkbox" id="water" class="form-check-input" name = "types[]" value="water" <?php if(in_array('water',$types)){echo "checked";}?>/>
<label class="form-check-label" for="water">Water</label>
</div>


<div class="form-check">
<input type="checkbox" id="fire" class="form-check-input" name = "types[]" value="fire" <?php if(in_array('fire',$types)){echo "checked";}?>/>
<label class="form-check-label" for="fire">Fire</label>
</div>


<div class="form-check">
<input type="checkbox" id="grass" class="form-check-input" name = "types[]" value="grass" <?php if(in_array('grass',$types)){echo "checked";}?>/>
<label class="form-check-label" for="grass">Grass</label>
</div>

<div class="form-check">
<input type="checkbox" id="normal" class="form-check-input" name = "types[]" value="normal" <?php if(in_array('normal',$types)){echo "checked";}?>/>
<label class="form-check-label" for="normal">Normal</label>
</div>


    </br><h3>Evolutions</h3>

    <div class="form-group">
 <label for="first">First</label>
 <input type="text" id="first" class="form-control" name="evo1" value="<?php if(isset($_POST['evo1'])){ echo $_POST['evo1'];}?>"/></br>
 </div>


 <div class="form-group">
 <label for="second">Second</label>
 <input type="text" id="second" class="form-control" name="evo2" value="<?php if(isset($_POST['evo2'])){ echo $_POST['evo2'];}?>"/></br>
 </div>


 <div class="form-group">
 <label for="third">Third</label>
 <input type="text" id="third" class="form-control" name="evo3" value="<?php if(isset($_POST['evo3'])){ echo $_POST['evo3'];}?>"/></br>
 </div>

 <h5>Creation Date: </h5><label><?php if(isset($_POST['date'])){ echo $_POST['date']; } ?></label><br/><br/>


    <input type="submit" class="btn btn-dark" name = "save" value ="SAVE"/>&nbsp;&nbsp;
    <input type="submit" class="btn btn-dark" name = "load" value="LOAD"/></br>

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
    function loadData(name){



        var form = document.createElement("form");
        form.setAttribute("method","post");
        form.setAttribute("action", "action.php");
        form.setAttribute("hidden","true");


        var input = document.createElement("input");
        input.setAttribute("type","text");
        input.setAttribute("name","name");
        input.setAttribute("value",name);

        var submit  = document.createElement("input");
        submit.setAttribute("id","form_submit");
        submit.setAttribute("type","submit");
        submit.setAttribute("name","load");
        submit.setAttribute("value","LOAD");

        form.appendChild(input);
        form.appendChild(submit);
        document.body.appendChild(form);
        document.getElementById("form_submit").click();

    }
</script>
</html>
