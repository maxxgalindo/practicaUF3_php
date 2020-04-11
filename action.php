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
    // $dom->save('test.xml');

    $conn = openConn('pokedex');

    $stm = $conn->prepare('INSERT INTO pokemon (xml) VALUES (:xml)');
    $stm->execute(array(':xml'=>$dom->saveXML()));

    // closeConn($conn);

  }elseif (isset($_POST['load'])) {
    // code...
  }
?>
