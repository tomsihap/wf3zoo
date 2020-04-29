<?php
require 'config/db.php';

$request = "INSERT INTO Animal (espece, nom, taille, poids, date_de_naissance, pays_origine, sexe)
            VALUES (:espece, :nom, :taille, :poids, :date_de_naissance, :pays_origine, :sexe)";

$response = $bdd->prepare($request);

$response->execute([
    'espece'            => $_POST['espece'],
    'nom'               => $_POST['nom'],
    'taille'            => $_POST['taille'],
    'poids'             => $_POST['poids'],
    'date_de_naissance' => $_POST['date_de_naissance'],
    'pays_origine'      => $_POST['pays_origine'],
    'sexe'              => $_POST['sexe'],
]);

//header('Location: index.php');
