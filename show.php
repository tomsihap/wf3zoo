<?php
$bdd = new PDO('mysql:host=localhost;dbname=wf3zoo;charset=utf8;port=8889', 'root', 'root');
$request = "SELECT * FROM animal";
$response = $bdd->query($request);
$animal = $response->fetch(PDO::FETCH_ASSOC);
?>

<?php include 'partials/navbar.php' ?>

<main role="main">

    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <p class="card-text"><?= $animal['nom'] ?> de l'espèce <?= $animal['espece'] ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                </div>
                                <small class="text-muted">9 mins</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<?php include 'partials/footer.php' ?>