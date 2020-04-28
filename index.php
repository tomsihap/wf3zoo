<?php
$bdd = new PDO('mysql:host=localhost;dbname=wf3zoo;charset=utf8;port=8889', 'root', 'root');
$request = "SELECT * FROM animal";
$response = $bdd->query($request);
$animaux = $response->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'partials/navbar.php' ?>

<main role="main">

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
                                        <a href="show.php?id=<?= $animal['id'] ?>" class="btn btn-sm btn-outline-secondary">Voir la fiche de l'animal</a>
                                    </div>
                                    <small class="text-muted">9 mins</small>
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