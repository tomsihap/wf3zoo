<?php
require 'config/db.php';

$photo = $_FILES['image'];

$nomDuFichier = pathinfo($photo['name'])['filename'];
$extensionDuFichier = pathinfo($photo['name'])['extension'];
$nouveauNomDuFichier =  $nomDuFichier . '-' . uniqid() . '.' . $extensionDuFichier;

move_uploaded_file($photo['tmp_name'],  __DIR__  . '/uploads/' . $nouveauNomDuFichier );


$request = "INSERT INTO Animal (espece, nom, taille, poids, date_de_naissance, pays_origine, sexe, photo)
            VALUES (:espece, :nom, :taille, :poids, :date_de_naissance, :pays_origine, :sexe, :photo)";

$response = $bdd->prepare($request);

$response->execute([
    'espece'            => $_POST['espece'],
    'nom'               => $_POST['nom'],
    'taille'            => $_POST['taille'],
    'poids'             => $_POST['poids'],
    'date_de_naissance' => $_POST['date_de_naissance'],
    'pays_origine'      => $_POST['pays_origine'],
    'sexe'              => $_POST['sexe'],
    'photo'             => $nouveauNomDuFichier
]);

header('Location: index.php');