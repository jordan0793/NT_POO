<?php
// namespace App\Model;
use App\Autoloader;
use App\Models\AnnoncesModel;





require_once 'Autoloader.php';
Autoloader::register();

// $model = new AnnoncesModel;

// Methode UPDATE -----------------------

$model = new AnnoncesModel;

$donnees = [
    'titre' => 'annonce créee',
    'description' => 'description de l\'annonce créee',
    'actif' => (int)0
];


$annonce = $model->hydrate($donnees);
// D'abord on utilise la méthode d'hydration 
$model->update(2, $annonce);

echo "<pre>";

var_dump($annonce);

echo "</pre>";








// Methode Create Normal ------------------------------
// $model = new AnnoncesModel;

// $annonce = $model
// ->setTitre('Publicité')
// ->setDescription('Annonce publicitaire')
// ->setActif(1);
// cette déclaration n'est possible que parce que chaque setter retourne l'objet 

// $model->create($annonce);

// echo "<pre>";

// var_dump($annonce);

// echo "</pre>";

// Création par Hydratation----------------------- 
// $model = new AnnoncesModel;


// $donnees = [
//     'titre' => 'Annonce hydratée',
//     'description' => 'Description de l\'annonce hydratée',
//     'actif' => 1
// ];

// $annonce = $model->hydrate($donnees);
// $model->create($annonce);

// echo "<pre>";

// var_dump($annonce);

// echo "</pre>";


// Methode Read : Recherche ---------------------
// Méthode FindAll ---------------------

// echo "<pre>";

// var_dump($model);

// echo "</pre>";


// var_dump($model->findAll()); 
 

// Methode FindBy -----------------------------
// $annonces = $model->findBy(['actif' => 1]);


// echo "<pre>";

// var_dump($annonces);

// echo "</pre>";

// Methode Find avec l'id ----------------------

$annonces2 = $model->find(2);

echo "<pre>";

var_dump($annonces2);

 echo "</pre>";





