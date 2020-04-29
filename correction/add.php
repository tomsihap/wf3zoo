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

                        <form action="create.php" method="post" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="">Espece</label>
                                <input name="espece" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Nom</label>
                                <input name="nom" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Taille</label>
                                <input name="taille" type="number" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Poids</label>
                                <input name="poids" type="number" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Date de naissance</label>
                                <input name="date_de_naissance" type="date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Pays d'origine</label>
                                <input name="pays_origine" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Sexe</label>
                                <select name="sexe" class="form-control">
                                    <option value="0">Femelle</option>
                                    <option value="1">Male</option>
                                    <option value="2">Indéfini</option>
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