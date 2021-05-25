<?php

require_once __DIR__ . '/Players.php';

$players = new Players();

  if($_POST['action'] == 'json-xport'):
    $players->jsonExport();
  endif;

?>
