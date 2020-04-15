<?php

require('db_conn.php');

$conn = openConn('pokedex');

$query = $conn->query("SELECT id, xml FROM pokemon;");
$result = $query->fetchAll(PDO::FETCH_ASSOC);

$pokemons = [];

foreach ($result as $pokemon_info) {
  $id = $pokemon_info['id']
  $xml = new SimpleXMLElement($pokemon_info['xml']);

  $pokemons[$id] = $xml;

}


?>
