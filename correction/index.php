<?php
require 'config/db.php';

$request = "SELECT * FROM animal";
$response = $bdd->query($request);
$animaux = $response->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'partials/navbar.php' ?>

<main role="main">

    <div id="alertFirstVisit" class="alert alert-success" style="display:none">
        Bonjour, bienvenue sur ce site pour la première fois !
    </div>

    <div id="alertHasVisited" class="alert alert-warning" style="display:none">
        Bonjour, vous êtes de retour sur le site !

        <button id="btnCancelVisit" class="btn btn-sm btn-danger">Ne pas se souvenir de moi !</button>
    </div>

    <?php include 'partials/jumbotron.php' ?>

    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row">

                <?php foreach ($animaux as $animal) : ?>

                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <div class="card-body">

                                <h5 class="card-title"><?= $animal['nom'] ?></h5>

                                <p class="card-text">

                                    <dl>
                                        <dt>Espèce</dt>
                                        <dd><?= $animal['espece'] ?> (sexe: <?= $animal['sexe'] ?>)</dd>

                                        <dt>Morphologie</dt>
                                        <dd>

                                            <ul>
                                                <li><strong>Poids</strong>: <?= $animal['poids'] ?></li>
                                                <li><strong>taille</strong>: <?= $animal['taille'] ?></li>
                                            </ul>
                                        </dd>
                                        <dt>Origine</dt>
                                        <dd>
                                            <li>Né le <?= $animal['date_de_naissance'] ?></li>
                                            <li><strong>Pays de naissance</strong>: <?= $animal['pays_origine'] ?></li>
                                    </dl>

                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="show.php?id=<?= $animal['id'] ?>" class="btn btn-sm btn-primary">Voir</a>
                                        <a href="edit.php?id=<?= $animal['id'] ?>" class="btn btn-sm btn-outline-warning">Éditer</a>
                                        <button class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#deleteModal-<?= $animal['id'] ?>">Supprimer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="deleteModal-<?= $animal['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    Êtes-vous sûr de vouloir supprimer <?= $animal['nom'] ?> ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                                    <a href="delete.php?id=<?= $animal['id'] ?>" type="button" class="btn btn-danger">Oui</a>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>

            </div>

        </div>
    </div>

</main>

<?php include 'partials/footer.php' ?>


<script>
    document.getElementById('btnCancelVisit').addEventListener('click', function() {
        localStorage.setItem('hasVisited', false);
        document.location.reload();
    });


    if (localStorage.getItem('hasVisited') === 'true') {
        document.getElementById('alertHasVisited').style = 'display: block';
    } else {
        document.getElementById('alertFirstVisit').style = 'display: block';
        localStorage.setItem('hasVisited', true);
    }
</script>