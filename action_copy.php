<?php
  require('db_conn.php');

  if (isset($_POST['save'])) {
    if (!isset($_POST['category']) ||
      !isset($_POST['height']) ||
      !isset($_POST['weight']) ||
      !isset($_POST['types']) ||
      !isset($_POST['evo1']) ||
      !isset($_POST['evo2']) ||
      !isset($_POST['evo3'])
    ) {
      header('Location: index.php?error=empty_fields');
      die();
    }

    $conn = openConn('pokedex');

    $query = $conn->query("SELECT xmlexists('//pokemon[./name=\"".$_POST['name']."\"]' PASSING BY REF xml) as existing FROM pokemon;");
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $pokemon) {
      if ($pokemon['existing']) {
        header('Location: index.php?error=already_exists');
        die();
      }
    }

    $dom = new DOMDocument();

    $pokemon = $dom->createElement('pokemon');

    $pokemon->appendChild($dom->createElement('name',$_POST['name']));
    $pokemon->appendChild($dom->createElement('category',$_POST['category']));
    $pokemon->appendChild($dom->createElement('height',$_POST['height']));
    $pokemon->appendChild($dom->createElement('weight',$_POST['weight']));

    $types = $dom->createElement('types');
    $attributeType = $dom->createAttribute('type');
    $attributeType->value = 'array';
    $types->appendChild($attributeType);
    foreach ($_POST['types'] as $type) {
      $types->appendChild($dom->createElement('value',$type));
    }
    $pokemon->appendChild($types);

    $evolution = $dom->createElement('evolutions');
    $evolution->appendChild($dom->createElement('first',$_POST['evo1']));
    $evolution->appendChild($dom->createElement('second',$_POST['evo2']));
    $evolution->appendChild($dom->createElement('third',$_POST['evo3']));

    $pokemon->appendChild($evolution);

    $dom->appendChild($pokemon);

    $stm = $conn->prepare('INSERT INTO pokemon (xml) VALUES (:xml)');
    $stm->execute(array(':xml'=>$dom->saveXML()));

    // closeConn($conn);

    header('Location: index.php');
    die();

  }elseif (isset($_POST['load'])) {

    $conn = openConn('pokedex');

    $query = $conn->query("SELECT xml FROM pokemon WHERE xmlexists('//pokemon[./name=\"".$_POST['name']."\"]' PASSING BY REF xml);");
    $result = $query->fetch(PDO::FETCH_ASSOC)['xml'];

    $xml = new SimpleXMLElement($result);
    echo '<form name="fr" action="index.php" method="POST">';
    echo '<input type="text" name="name" value="'.$xml->xpath('//name')[0].'"/>';
    echo '<input type="text" name="category" value="'.$xml->xpath('//category')[0].'"/>';
    echo '<input type="number" name="height" value="'.$xml->xpath('//height')[0].'"/>';
    echo '<input type="number" name="weight" value="'.$xml->xpath('//weight')[0].'"/>';
    foreach ($xml->xpath('//types/value') as $type) {
      echo '<input type="text" name="types[]" value="'.$type.'"/>';
    }
    echo '<input type="text" name="evo1" value="'.$xml->xpath('//evolutions/first')[0].'"/>';
    echo '<input type="text" name="evo2" value="'.$xml->xpath('//evolutions/second')[0].'"/>';
    echo '<input type="text" name="evo3" value="'.$xml->xpath('//evolutions/third')[0].'"/>';
    echo '</form>';
    echo '<script type="text/javascript">document.fr.submit();</script>';
  }
?>
