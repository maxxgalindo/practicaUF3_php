<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      if (isset($_GET['error'])) {
        echo $_GET['error'];
      }
     ?>
    <form action="action.php" method="post">
      Name: <input type="text" name="name" required/><br/>
      Category: <input type="text" name="category"/><br/>
      Height: <input type="number" name="height"/><br/>
      Weight: <input type="number" name="weight"/><br/>
      <h3>Types:</h3><br/>
      Normal: <input type="checkbox" name="types[]" value="normal"/><br/>
      Water: <input type="checkbox" name="types[]" value="fire"/><br/>
      Fire: <input type="checkbox" name="types[]" value="water"/><br/>
      Grass: <input type="checkbox" name="types[]" value="grass"/><br/>
      <h3>Evolutions:</h3><br/>
      First: <input type="text" name="evo1"/><br/>
      Second: <input type="text" name="evo2"/><br/>
      Third: <input type="text" name="evo3"/><br/>
      <input type="submit" name="save" value="SAVE"/>
      <input type="submit" name="load" value="LOAD"/>
    </form>
  </body>
</html>
