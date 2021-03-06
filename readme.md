# TP : WF3 Zoo

- [TP : WF3 Zoo](#tp--wf3-zoo)
  - [Exercice 1](#exercice-1)
  - [Exercice 2](#exercice-2)
  - [Exercice 3](#exercice-3)
  - [Exercice 4](#exercice-4)
  - [Exercice 5](#exercice-5)
  - [Exercice 6](#exercice-6)
  - [Exercice 7 : améliorer le INSERT en préparant la requête](#exercice-7--am%c3%a9liorer-le-insert-en-pr%c3%a9parant-la-requ%c3%aate)
    - [Requête simple (sans paramètres) :](#requ%c3%aate-simple-sans-param%c3%a8tres)
    - [Requête paramétrée :](#requ%c3%aate-param%c3%a9tr%c3%a9e)
  - [Exercice 8 : Créer une page d'édition d'un animal (UPDATE)](#exercice-8--cr%c3%a9er-une-page-d%c3%a9dition-dun-animal-update)
  - [Exercice 9 : Gérer le DELETE d'un animal](#exercice-9--g%c3%a9rer-le-delete-dun-animal)
  - [Exercice 10 : Authentification](#exercice-10--authentification)
    - [1. Créer la table `User`](#1-cr%c3%a9er-la-table-user)
    - [2. Créer un formulaire de création de compte](#2-cr%c3%a9er-un-formulaire-de-cr%c3%a9ation-de-compte)
    - [3. Créer un formulaire de connexion](#3-cr%c3%a9er-un-formulaire-de-connexion)
    - [4. Faire comprendre à notre application que l'utilisateur est dans un état `logué` afin de tester l'accès aux pages](#4-faire-comprendre-%c3%a0-notre-application-que-lutilisateur-est-dans-un-%c3%a9tat-logu%c3%a9-afin-de-tester-lacc%c3%a8s-aux-pages)
    - [5. Ajouter des liens de connexion](#5-ajouter-des-liens-de-connexion)
    - [6. Gérer la déconnexion](#6-g%c3%a9rer-la-d%c3%a9connexion)
  - [Pistes d'améliorations](#pistes-dam%c3%a9liorations)
    - [PDO : Afficher la requête qu'un prepare/execute a créé afin de la débuguer](#pdo--afficher-la-requ%c3%aate-quun-prepareexecute-a-cr%c3%a9%c3%a9-afin-de-la-d%c3%a9buguer)
    - [PDO : Afficher les erreurs dans PDO](#pdo--afficher-les-erreurs-dans-pdo)
    - [Gestion d'erreurs : Gérer les exceptions avec try/catch](#gestion-derreurs--g%c3%a9rer-les-exceptions-avec-trycatch)
    - [Authentification : Bloquer les pages d'ajout, modification, suppression](#authentification--bloquer-les-pages-dajout-modification-suppression)
    - [Authentification : Hasher les mots de passe](#authentification--hasher-les-mots-de-passe)
    - [Upload de fichiers](#upload-de-fichiers)
      - [1. Indiquer au formulaire d'accepter l'upload de fichiers](#1-indiquer-au-formulaire-daccepter-lupload-de-fichiers)
      - [2. Ajouter un champ `input:file`](#2-ajouter-un-champ-inputfile)
      - [3. Récupérer le fichier uploadé dans le fichier de traitement](#3-r%c3%a9cup%c3%a9rer-le-fichier-upload%c3%a9-dans-le-fichier-de-traitement)
      - [4. Effectuer les validations éventuelles (taille, format...)](#4-effectuer-les-validations-%c3%a9ventuelles-taille-format)
      - [5. Effectuer les traitements éventuels (renommer, resizer...)](#5-effectuer-les-traitements-%c3%a9ventuels-renommer-resizer)
      - [6. Déplacer le fichier de son emplacement temporaire à son emplacement final que l'on aura défini](#6-d%c3%a9placer-le-fichier-de-son-emplacement-temporaire-%c3%a0-son-emplacement-final-que-lon-aura-d%c3%a9fini)
      - [7. Enregistrer le nom du fichier en base de données avec l'élément auquel on rattache le fichier](#7-enregistrer-le-nom-du-fichier-en-base-de-donn%c3%a9es-avec-l%c3%a9l%c3%a9ment-auquel-on-rattache-le-fichier)

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

## Exercice 10 : Authentification

> Nous allons créer un mini système d'authentification afin de devoir se loguer pour accéder aux pages modifiantes (insert, update, delete). Le système fonctionnera ainsi :

1. Les pages `index.php` et `show.php` restent publiques
2. Les pages `create.php`, `add.php`, `update.php`, `edit.php`, `confirmDelete.php`, `delete.php` ne seront accessibles que si je suis connecté.

Il faut donc :

1. Créer une table `User`
1. Créer un formulaire de création de compte
2. Créer un formulaire de connexion
3. Faire comprendre à notre application que l'utilisateur est dans un état `logué` afin de tester l'accès aux pages.

### 1. Créer la table `User`

Créez la table suivante :

```
User
----
id INT PK AI
email VARCHAR(70)
password VARCHAR(150)
created_at DATETIME DEFAULT=CURRENT_TIMESTAMP
```

> *Note* : la valeur par défaut `CURRENT_TIMESTAMP` se renseigne lors de la création d'une table avec MySQL et se remplira automatiquement lors d'un `INSERT` avec la date actuelle.

### 2. Créer un formulaire de création de compte

Dans une page `signUp.php`, créez un formulaire de connexion permettant de renseigner les champs `email` et `password`. 

1. Le formulaire contiendra 3 champs: `email`, `password` et `confirmPassword`.
2. L'action du formulaire redirigera vers `signUpTraitement.php`.
3. Dans `signUpTraitement.php` : si les mots de passe sont identiques, insérez le nouvel utilisateur en récupérant les champs `email` et `password` puis affichez `Votre compte a bien été créé !`. Dans le cas contraire, affichez une erreur `Les mots de passe ne correspondent pas.`

### 3. Créer un formulaire de connexion

1. Dans une page `login.php`, créez un formulaire de connexion permettant de renseigner les champs `email` et `password`.
2. Dans une page `loginTraitement.php`, faites une requête `SELECT` qui ira chercher un utilisateur avec la clause `WHERE`, en cherchant **à la fois** dans le champ `email` et **à la fois** dans le champ `password`.
3. Si un utilisateur a été trouvé, affichez à la suite dans `loginTraitement.php` : `Vous êtes bien connecté !`. Sinon, affichez `Erreur d'authentification.`.

### 4. Faire comprendre à notre application que l'utilisateur est dans un état `logué` afin de tester l'accès aux pages

Pour cela, nous avons besoin de créer une variable qui soit accessible dans toute l'application et qui nous permette de savoir si l'utilisateur est logué ou non ! Pour ce faire, allons utiliser la supergloable `$_SESSION`.

Les variables de sessions sont des variables qui existent pour **chaque visiteur** et qui peuvent être **différentes** entre chaque visiteur. Ce sont des variables qui contiendront des informations propres à la visite : des données à retenir comme un panier, la dernière page visitée, les erreurs de formulaire ou... l'authentification !

Pour activer l'usage des sessions dans PHP, il faut avoir un `session_start()` au début de chaque fichier utilisant les sessions.

> **ATTENTION !!!** Il faut vraiment que ce soit vraiment tout, tout, tout au début !

Pour cela, créez le fichier suivant : `config.php` et mettez dedans :

```php
<?php

session_start();
```

Ensuite, dans tous les autres fichiers  de l'application, importez avec `require_once` le fichier `config.php`. Ça y est, les sessions sont activées !

Pour les tester, essayez le code suivant :

Dans `index.php`, n'importe où :

```php
$_SESSION['essai_session'] = "ça marche !";
```

Dans n'importe quel autre fichier, par exemple `add.php`, faites un `var_dump($_SESSION)`. La clé `essai_session` devrait apparaître.

> Les sessions sont donc un autre moyen de transmettre des données, cette-fois ci non pas de page en page mais à l'ensemble de l'application sans avoir à préciser à quelle page envoyer les données, là où `$_GET` et `$_POST` ne fonctionnent que de page à page.

Pour mettre pratique, modifiez `loginTraitement.php` et créez une variable de session contenant l'utilisateur :

```php
$user = $response->fetch(PDO::FETCH_ASSOC);
$_SESSION['user'] = $user;
```

Ensuite, dans la navbar: 

1. Testez si `$_SESSION['user']` existe
2. Si oui, affichez : `Bienvenue user@email.com !` 


### 5. Ajouter des liens de connexion

Sur le même principe, en fonction de si l'utilisateur est logué ou non, affichez les liens suivants :

1. Non connecté (`$_SESSION['user']` n'existe pas) :
   - "Connectez-vous" (vers `login.php`)
   - "Créer un compte" (vers `signUp.php`)

2 Connecté : (`$_SESSION['user']` existe) :
    - "Bienvenue, example@gmail.com !" (avec bien sûr l'email de l'utilisateur)
    - "Déconnexion" (un lien qui irait vers `logout.php`)

### 6. Gérer la déconnexion

Dans `logout.php` (n'oubliez pas d'importer `session_start()` dedans aussi), écrivez la ligne suivante :

```php
session_destroy();
```

Puis redirigez vers la page d'accueil. `session_destroy()` permet de... détruire la session ! Si tout se passe bien, les liens dans la navbar créés au point (4) ci-dessus, doivent s'afficher tels que l'utilisateur est déconnecté.

## Pistes d'améliorations

### PDO : Afficher la requête qu'un prepare/execute a créé afin de la débuguer

Une requête préparée est composée de deux éléments :
1. La requête composée de pseudo-variables
2. Le tableau de données remplaçant les pseudo-variables

Si on souhaite voir la requête effectivement lue par MySQL, on ne peut var_dump aucun de ces deux éléments ! En effet, le (1) est une pseudo-requête, le (2) n'est qu'une liste de valeurs.

On va utiliser une méthode dédiée au débug des requêtes :

```php
$statement->debugDumpParams();
```

Un `var_dump($statement->debugDumpParams());` devrait nous retourner quelque chose comme la string suivante :

```
SQL: [180] INSERT INTO Animal (espece, nom, taille, poids, date_de_naissance, pays_origine, sexe) VALUES (:espece, :nom, :taille, :poids, :date_de_naissance, :pays_origine, :sexe) Sent SQL: [178] INSERT INTO Animal (espece, nom, taille, poids, date_de_naissance, pays_origine, sexe) VALUES ('ijsdmfj', 'jljselfjlsm', '7689', '67989', '1991-03-23', 'sdjhfs', '0') Params: 7 Key: Name: [7] :espece paramno=-1 name=[7] ":espece" is_param=1 param_type=2 Key: Name: [4] :nom paramno=-1 name=[4] ":nom" is_param=1 param_type=2 Key: Name: [7] :taille paramno=-1 name=[7] ":taille" is_param=1 param_type=2 Key: Name: [6] :poids paramno=-1 name=[6] ":poids" is_param=1 param_type=2 Key: Name: [18] :date_de_naissance paramno=-1 name=[18] ":date_de_naissance" is_param=1 param_type=2 Key: Name: [13] :pays_origine paramno=-1 name=[13] ":pays_origine" is_param=1 param_type=2 Key: Name: [5] :sexe paramno=-1 name=[5] ":sexe" is_param=1 param_type=2
```

Bien qu'elle soit compliquée à lire, on peut isoler le texte après `Sent SQL:` jusqu'à `Params` qui contient la requête effectivement envoyée à MySQL :

```sql
INSERT INTO Animal (espece, nom, taille, poids, date_de_naissance, pays_origine, sexe) VALUES ('ijsdmfj', 'jljselfjlsm', '7689', '67989', '1991-03-23', 'sdjhfs', '0')
```

Et voilà ! Copiez cette requête trouvée dans MySQL Workbench afin de pouvoir l'éditer et la modifier dans l'éditeur Workbench pour pouvoir corriger les erreurs.

### PDO : Afficher les erreurs dans PDO

Nous allons faire en sorte que PDO nous affiche les erreurs MySQL directement dans les pages en PHP. Lors de la création de `$bdd`, on peut configurer PDO ainsi  :

```php
$bdd = new PDO('mysql:host=localhost;dbname=wf3zoo;charset=utf8;port=8889', 'root', 'root', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
```

En ajoutant cet array de paramètres à la fin, PDO nous affichera dorénavant les erreurs SQL d'une requête !


### Gestion d'erreurs : Gérer les exceptions avec try/catch

Gérer les erreurs d'un script va nous permettre de décider ce que l'on fait en cas d'erreur : afficher l'erreur sous une plus jolie forme, rediriger l'utilisateur... Par exemple, nous allons prendre les erreurs de PDO et les afficher dans un `echo` puis terminer le script.

Voici le code de base d'un try/catch :

```php
try {
    // code à exécuter
}
catch(Exception $e) {
    echo "Il ya eu une erreur : " . $e->getMessage(); // on affiche le message d'erreur
    die; // on arrête le script immédiatement
}
```

Le bloc `try/catch` ("essaie de faire ce code, sinon attrape l'erreur") nous permet d'avoir une gestion des erreurs qu'un bloc de code pourrait être ammené à emmettre. En l'occurrence, la classe PDO (rappel : `$bdd` est un objet de la classe `PDO`) renvoie des erreurs que nous pouvons attraper et gérer au besoin !


```php

try {
        
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
}
catch(Exception $e) {
    echo "Il ya eu une erreur : " . $e->getMessage();
    die;
}

```

Et voilà : plutôt qu'une erreur en orange avec XDebug, nous avons géré comment afficher l'erreur.


### Authentification : Bloquer les pages d'ajout, modification, suppression

Dans les pages correspondant aux actions de `INSERT`, `UPDATE`, `DELETE` (donc : `create.php`, `add.php`, `update.php`, `edit.php`, `confirmDelete.php`, `delete.php`), vous allez tester si l'utilisateur est connecté. Si ça n'est pas le cas, redirigez-le en page d'accueil :

```php
// Si $_SESSION['user'] n'existe PAS (attention au point d'exclamation)
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
}
```

### Authentification : Hasher les mots de passe

Pour le moment, nos mots de passe sont visibles en clair dans la base de données, ce qui est loin d'être une bonne chose ! Il suffit que notre base de données se fasse pirater d'une manière ou d'une autre (par des hackers venus de l'extérieur ou simplement des personnes ayant accès à la base de données) pour voir les mots de passes de tous nos utilisateurs dans la nature. Et ça n'arrive pas qu'aux autres ! Des grands noms comme Sony, Dropbox, Nintendo, Adobe ([une bonne liste ici](https://haveibeenpwned.com/PwnedWebsites)) se font hacker, personne n'est donc à l'abri. Par contre, on peut limiter les dégâts en protégeant les données sensibles comme les mots de passe.

> Vous pouvez vérifier si une de vos adresses e-mail se trouve dans des listes de comptes hackés sur le site [Have I Been Pwned](https://haveibeenpwned.com/).

Concrètement, l'idée est de hasher nos mots de passe, c'est à dire de les transformer grâce à un algorithme choisie en une chaîne de caractère indéchiffrable dans l'autre sens. Par exemple, avec SHA-2, [un algorithme à l'origine concu par la NSA](https://fr.wikipedia.org/wiki/SHA-2) :


Mot de passe | Hash en SHA 512
---------|----------
 `bonjour` | `3041edbcdd46190c0acc504ed195f8a90129efcab173a7b9ac4646b92d04cc80005acaa3554f4b1df839eacadc2491cb623bf3aa6f9eb44f6ea8ca005821d25d`
 `Bonjour` | `c447dff0d671f62ad580b255b64f7a8f6a30d1b828569cee08b7c861239f8d4856ef38a1166718b045a9713876336c1f623619f6a78fc891d48d0b98c703def3`
 `BONJOUR` | `c65afee89066dfe6d50ee8b9d4d95f6f26fe7a9395e5791cd15076a67d1725fb6f9fe30d8e27d1be1fc0c1cc3bf3b584a327443eaf330e3c05676520149f3683`

On remarque qu'en plus de n'avoir aucun moyen de repasser du mot de passe hashé au mot de passe d'origine, on ne peut pas non plus faire d'analyse de fréquence sur les mots de passe hashés (c'est à dire, comparer les récurrences afin de dire quelque chose comme "`8a90129e` correspond à la lettre A" ).

En pratique :

1. **Création de compte :** L'utilisateur va tapper son mot de passe comme habituellement. Par contre, à l'enregistrement, on passera le mot de passe dans `password_hash()` pour le INSERT.
2. **Login :** L'utilisateur va tapper son mot de passe comme habituellement. Par contre, à la lecture, on utilisera `password_verify()` qui comparera le mot de passe saisi et la version hashée.

Pour mettre en place cela :

1. Changez dans le `execute()` qui gère l'`INSERT INTO User`, la ligne "password" de la façon suivante :

    ```php
    "password" => password_hash($_POST["password"]),
    ```


2. Changez le `SELECT * FROM Users WHERE...` qui récupère le user de la façon suivante :

    ```sql
    SELECT * FROM User WHERE email = :email
    ```

    - En effet, nous n'allons chercher que par e-mail dorénavant.

    - Ensuite, vérifiez si l'utilisateur a saisi un bon mot de passe grâce à :

    ```php

    $user = $response->fetch(PDO::FETCH_ASSOC);

    if ( password_verify($_POST['user'], $user['password']) ) {
        // l'utilisateur est connecté
    } 
    ```

Et voilà !

### Upload de fichiers

Pour uploader un fichier, on va :
1. Indiquer au formulaire d'accepter l'upload de fichiers
2. Ajouter un champ `input:file`
3. Récupérer le fichier uploadé dans le fichier de traitement
4. Effectuer les validations éventuelles (taille, format...)
5. Effectuer les traitements éventuels (renommer, resizer...)
6. Déplacer le fichier de son emplacement temporaire à son emplacement final que l'on aura défini
7. Enregistrer le nom du fichier en base de données avec l'élément auquel on rattache le fichier

#### 1. Indiquer au formulaire d'accepter l'upload de fichiers

Modifiez le formulaire en rajoutant l'attribut `enctype` :

```html
<form action="" method="" enctype="multipart/form-data">
```

#### 2. Ajouter un champ `input:file`

```html
<input type="file" name="photo_animal">
```

#### 3. Récupérer le fichier uploadé dans le fichier de traitement

```php
// Les fichiers issus des champs input:file d'un formulaire avec enctype="multipart/form-data" se retrouvent dans $_FILES :

var_dump($_FILES);

// Notre fichier se retrouve dans :
$_FILES['photo_animal']
```

#### 4. Effectuer les validations éventuelles (taille, format...)

On peut avoir des informations sur le fichier grâce à :

```php
$photoAnimal = $_FILES['photo_animal'];

$tailleDuFichier = $photoAnimal['size']; //

$pathinfoData = pathinfo($photoAnimal);

$nomDuFichier = $pathinfoData['filename'];
$extensionDuFichier = $pathinfoData['extension'];
```

Grâce à ces informations-là, vous pouvez valider si l'extension est valide, si la taille est valide, si le nom de fichier est valide...

#### 5. Effectuer les traitements éventuels (renommer, resizer...)

Pour être certains d'avoir des noms de fichiers uniques, nous allons renommer nos fichiers de la façon suivante grâce à la fonction PHP `uniqid()` :

```
NOM_DU_FICHIER-ID_UNIQUE.EXTENSION
```

Ce qui transformerait `Simba.png` en `Simba-84d3fgj3d.png` :

```php
$photoAnimal = $_FILES['photo_animal']; // on récupère le fichier
$pathinfoData = pathinfo($photoAnimal); // on récupère les infos du chemin du fichier
$nomDuFichier = $pathinfoData['filename']; // on récupère le nom de fichier 
$extensionDuFichier = $pathinfoData['extension']; // on récupère l'extension du fichier
$nouveauNomDuFichier = $nomDuFichier . '-' . uniqid() . '.' . $extensionDuFichier; // on compose  le nouveau nom
```

#### 6. Déplacer le fichier de son emplacement temporaire à son emplacement final que l'on aura défini

Le fichier est pour le moment dans un emplacement temporaire (`$_FILES['photo_animal']['tmp_name']`). Déplaçons-le dans le dossier `uploads` de notre projet, et donnons-lui le nouveau nom :

```php
move_uploaded_file($photoAnimal['tmp_name'],  __DIR__  . '/uploads/' . $nouveauNomDuFichier );
```

> *Note* : La constante magique `__DIR__` permet d'avoir le chemin absolu vers le fichier qui est en train d'exécuter le script. C'est très utile pour gérer les chemins de fichiers en PHP et savoir où on en est !

#### 7. Enregistrer le nom du fichier en base de données avec l'élément auquel on rattache le fichier

- Modifiez votre base de données et ajoutez un champ `file VARCHAR(50)`.
- Modifiez l'`INSERT` d'origine et ajoutez le nouveau champ. Modifiez également le `execute()` :

```php
execute([
    //...
    'file' => $nouveauNomDeFichier,
])
```