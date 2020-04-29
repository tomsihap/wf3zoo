<?php

require 'config/db.php';

$request = "UPDATE Animal
            SET espece = :espece, nom = :nom, taille = :taille, poids = :poids, date_de_naissance = :date_de_naissance, pays_origine = :pays_origine, sexe = :sexe
            WHERE id = :id";

$response = $bdd->prepare($request);

$response->execute([
    'espece'            => $_POST['espece'],
    'nom'               => $_POST['nom'],
    'taille'            => $_POST['taille'],
    'poids'             => $_POST['poids'],
    'date_de_naissance' => $_POST['date_de_naissance'],
    'pays_origine'      => $_POST['pays_origine'],
    'sexe'              => $_POST['sexe'],
    'id'                => $_POST['id']
]);