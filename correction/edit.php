<?php
$bdd = new PDO('mysql:host=localhost;dbname=wf3zoo;charset=utf8;port=8889', 'root', 'root');
$request = "SELECT * FROM animal WHERE id = :id";
$response = $bdd->prepare($request);
$response->execute([
    'id' => $_GET['id']
]);
$animal = $response->fetch(PDO::FETCH_ASSOC);
?>

<?php include 'partials/navbar.php' ?>

<main role="main">

    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row">
                <div class="col-md-12">

                    <form action="add.php" method="post" enctype="multipart/form-data">

                        <input type="hidden" name="id" value="<?= $animal['id'] ?>">

                        <div class="form-group">
                            <label for="">Espece</label>
                            <input name="espece" value="<?= $animal['espece'] ?>" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Nom</label>
                            <input name="nom" value="<?= $animal['nom'] ?>" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Taille</label>
                            <input name="taille" value="<?= $animal['taille'] ?>" type="number" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Poids</label>
                            <input name="poids" value="<?= $animal['poids'] ?>" type="number" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Date de naissance</label>
                            <input name="date_de_naissance" value="<?= date('Y-m-d', strtotime($animal['date_de_naissance'])) ?>" type="date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Pays d'origine</label>
                            <input name="pays_origine" value="<?= $animal['pays_origine'] ?>" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Sexe</label>
                            <select name="sexe" class="form-control">
                                <option value="0" <?= ($animal['sexe'] == 0 ? 'selected' : '') ?>>Femelle</option>
                                <option value="1" <?= ($animal['sexe'] == 1 ? 'selected' : '') ?>>Male</option>
                                <option value="2" <?= ($animal['sexe'] == 2 ? 'selected' : '') ?>>Indéfini</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Ajouter une image</label>
                            <input name="image" type="file" class="form-control">
                        </div>

                        <input type="submit" class="btn btn-primary" value="Créer l'animal">

                    </form>
                </div>
            </div>
        </div>

</main>

<?php include 'partials/footer.php' ?>