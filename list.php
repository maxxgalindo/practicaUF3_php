<?php

require('db_conn.php');

$conn = openConn('pokedex');

try {
  $stm = $conn->query($query);
  $result = $stm->fetchAll(PDO::FETCH_ASSOC);
  $pokemons = [];
} catch (\Exception $e) {
  header("Location: index.php?error=query_error");
  die();
}

foreach($result as $pokemon_info){
$id = $pokemon_info['id'];
$xml = new SimpleXMLElement($pokemon_info['xml']);


$pokemons[$id] = $xml;

}


?>
