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

## Exercice 7 : améliorer le INSERT en préparant la requête

En utilisant `query()`, on se rend compte que concaténer sa requête avec les paramètres POST est très contraignant ! La requête devient lourde à écrire et est quasiment impossible à maintenir.

Vous allez plutôt utiliser une requête *préparée* pour effectuer l'INSERT. Les requêtes préparées ont deux avantages :
1. Elles permettent une requête bien plus lisible et naturelle plutôt qu'en utilisant la concaténation
2. Elles permettent d'*échapper* nos paramètres, c'est à dire de supprimer les caractères spéciaux afin d'éviter que l'utilisateur ne saisisse de requêtes SQL (hein, quoi ? Mon animal ne peut pas s'appeler `Simba'); DROP TABLE Animal; --` [peut être](https://xkcd.com/327/) ? )

Voici le format :

### Requête simple (sans paramètres) :

```php
$request = "SELECT * FROM movies";
$response = $bdd->prepare($request);
$response->execute();

$movies = $response->fetchAll(PDO::FETCH_ASSOC);
```

### Requête paramétrée :

```php
$request = "SELECT * FROM movies WHERE id = :id";
$response = $bdd->prepare($request);
$response->execute([
    'id' => $_GET['id']
]);

$movies = $response->fetchAll(PDO::FETCH_ASSOC);
```

On déchiffre ça :

```php

/**
 * Dans ma requête, au lieu de concaténer $_GET['id'], je met une "pseudo-variable" nommée :id.
 * Je peux mettre autant de pseudo-variables que je veux.
 * Je peux les nommer comme je le souhaite, (:id, ou encore :idMovieChoisi...)
 */
$request = "SELECT * FROM movies WHERE id = :id";

/**
 * Comme ma requête telle qu'elle n'est maintenant plus vraiment valable en MySQL
 * (à cause des pseudo-variables), je n'exécute plus avec query() mais je prépare mon $bdd
 * à exécuter la requête.
 * 
 * Ça permet à $bdd de s'attendre à recevoir de vraies variables pour remplacer les pseudo-variables.
 */
$response = $bdd->prepare($request);

/**
 * On remplace donc effectivement les pseudo-variables par les vraies variables !
 */
$response->execute([
    'id' => $_GET['id'],
    'pseudo_variable' => $variable_a_inserer
]);
```

## Exercice 8 : Créer une page d'édition d'un animal (UPDATE)

1. Créer une page `edit.php`
2. Dans `index.php`, créer un lien vers `edit.php` en passant la clé `id` contenant en valeur le champ `ID` de l'animal (exactement comme pour `show.php`)
3. Dans `edit.php`, copiez-collez le formulaire de `add.php`
4. Préremplissez le formulaire avec les données de l'animal récupérées comme vous le faites dans `show.php`. 

> *Note* - Pour préremplir des champs d'un formulaire HTML :

- Préremplir un champ `input` de formulaire avec l'attribut `value` :
```html
<input id="editFormNom" type="text" class="form-control" value="Donnée préremplie">
```

- Présélectionner un champ `select` de formulaire avec l'attribut `selected` :

```html
<select name="" id="" class="form-control">
    <option value="">France</option>
    <option value="" selected>Allemagne</option>
</select>
```

- Précocher un champ `input:checkbox` ou `input:radio` de formulaire avec l'attribut `checked` :

```html
<label for="checkbox1">Checkbox 1</label>
<input type="checkbox" name="test" id="checkbox1">

<label for="checkbox">Checkbox 2</label>
<input type="checkbox" name="test" id="checkbox" checked>
```

5. Traitez le formulaire dans un nouveau fichier `update.php` en utilisant une requête préparée.

## Exercice 9 : Gérer le DELETE d'un animal

1. Créer une page `confirmDelete.php`
2. Dans `index.php`, créer un lien vers `confirmDelete.php` en passant la clé `id` contenant en valeur le champ `ID` de l'animal (exactement comme pour `show.php`)
3. Dans `confirmDelete.php`, récupérez les données de l'animal choisi et ajoutez un texte de confirmation de suppression de l'animal qui doit afficher :

    ```
    Êtes-vous sûr de vouloir supprimer l'animal *NomDeLanimal* de l'espèce *EspèceDeLanimal* ?

    Oui / Non (boutons)
    ```

4. Lien sur le bouton "Non" : redirection vers la page d'accueil
5. Lien sur le bouton "Oui" : redirection vers une page `delete.php` en passant la clé `id` contenant en valeur le champ `ID` de l'animal
6. Dans `delete.php`, traiter la suppression de l'animal
