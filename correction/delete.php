<?php

require_once 'config/db.php';

$request = 'DELETE FROM Animal WHERE id = :id';

$response = $bdd->prepare($request);

$response->execute([
    'id' => $_GET['id']
]);

header('Location: index.php');