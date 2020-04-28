# TP : WF3 Zoo

## Exercice 1

Faire le découpage du template en "partials" qui seront inclus dans les pages `index.php` et `show.php` grâce à `include()`. Le découpage sera le suivant :

- `navbar.php` : barre de navigation
- `jumbotron.php` : section avec la classe `jumbotron`
- `footer.php` : balise footer

## Exercice 2

Créer la base de données du projet : `wf3zoo` et la table suivante. Remplir la table créée avec cinq entrées.

```
ANIMAL
------
id                  PK INT AI
espece              VARCHAR(150)
nom                 VARCHAR(70)
taille              INT()
poids               INT()
date_de_naissance   DATETIME
pays_origine        VARCHAR(50)
sexe                TINYINT
```

## Exercice 3

- Récupérer les données de la table `Animal` et les afficher dans la page d'accueil.
- Faire un lien vers la page `show.php` en passant en paramètre GET la clé `id` et en valeur l'`id` de l'animal.

> Documentation : [Cards Bootstrap](https://getbootstrap.com/docs/4.4/components/card/)

```php
<?php
$bdd = new PDO('mysql:host=localhost;dbname=NOMDELABDD;charset=utf8;port=3306', 'loginBdd', 'passwordBdd');
$request = "SELECT * FROM movies";
$response = $bdd->query($request);
$movies = $response->fetchAll(PDO::FETCH_ASSOC);
?>

// ...

<?php foreach ($movies as $movie) : ?>
    <h1><?= $movie['title'] ?></h1>
<?php endforeach ?>
```

## Exercice 4

- Dans `show.php`, en utilisant une requête SQL **adaptée** pour récupérer l'animal choisi, affichez les données de l'animal.

```php
// Quand on récupère 1 seul élément en BDD, on utilise plutôt :
$movie = $response->fetch(PDO::FETCH_ASSOC);
```

## Exercice 5

- Créez les fichiers suivants :
- `add.php` (il contiendra le formulaire de création d'un animal)
- `create.php` (il contiendra le traitement du formulaire)

Créez un formulaire dans `add.php` contenant les champs nécessaires à la création d'un animal. Ce formulaire aura la méthode `POST` et l'action `create.php` : 

```php
<form method="post" action="create.php">
    // ...
    <input class="btn btn-primary" type="submit" value="Créer un animal">
</form>
```

> *Note* : n'oubliez pas les attributs `name` dans les balises `input`, `textarea` ou `select` !

## Exercice 6

Dans `create.php` :
- Récupérez les données en POST et composez la requête dans `$request` permettant d'enregistrer un nouvel animal.
- Exécutez la avec `$bdd->query($request)`.
- Ensuite, redirigez l'utilisateur vers la page `index.php` grâce à la ligne suivante: 
 
```php
header('Location: index.php');
```