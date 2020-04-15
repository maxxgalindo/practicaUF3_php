<?php

function openConn($db)
{
  $server = 'localhost';
  $userName = 'postgres';
  $password = 'postgres';

  try{
    $conn = new PDO('pgsql:host='.$server.';dbname='.$db, $userName, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return($conn);
  }catch(PDOException $e){
    return(false);
  }
}

function closeConn($conn){
  $conn->close();
}

?>
