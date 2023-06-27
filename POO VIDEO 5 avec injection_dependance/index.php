<?php

// VIDEO 5 INJECTION ET DEPENDANCES ----------------------

// On fait dépendre la création d'une classe a partir d'une autre 

use App\Autoloader;
// Ajouter le namespace de autoloader
use App\Client\Compte as CompteClient;
use App\Banque\{CompteCourant, CompteEpargne};

require_once 'classes/Autoloader.php';
//On élimine tous les reuire précédent , on écrit le require de Autoloader.php, et on apelle la fonction magique ici avec le selecteur de portée :: 
Autoloader::register();

// A ce stade on a pas fait d'injection de dépendance, on  a simplement modifié les paramètre de TOUTES les classes qui dépendent du PARENT, simplement pour associé l'existence d'un titualire avec le CompteClient, la Maintenance et LOURSE donc on va voir a présent la méthode d'INJECTION DE DEPENDANCE pour pallier a ce pb de Maintenance 

// Pour ce faire on fera appel a un PATRON DE CONCEPTION : DESIGN PATTERN, la bonne pratique d'écriture d'injection de dépendance , qui va plutot que de dire qu'on instancie une classe a l'intérieur du constructeur d'une autre classe ( ce qu'on vient de faire ) au niveau du constructeur, au lieu de remettre les paramètre en dur on met en paramètre la classe ( CompteClient ) suivie d'une nouvelle variable comme on veut ($compte). Au lieu de remettre ($nom et $prenom)dans le constructeur.


// Stade Injection de Dependance ----------------

// On vient de changer les constructeur du parent Compte, puis on a fait la même chose pour CompteCourant et CiompteEpargne car il dépendent tous deux du Banque\Compte. Ainsi on ne pourra pas déclarer en index un CompteCourant ou CompteEpargne en dur , nous seront obliger d'instancier un CompteClient en premier 

$client = new CompteClient ('Doe', 'John', 'Strasbourg');
echo "<pre>";

var_dump($client);

echo "</pre>";

// On reprend la variable de CompteClient , pour le mettre dans compteEpargne

$compteEpargne = new CompteEpargne($client, 500, 10);

echo "<pre>";

var_dump($compteEpargne);

echo "</pre>";

// l'injection de dépendance est un Design Pattern parmis d'autre, l'injection d'une classe dans le constructeur d'une autre 

// Suite - La base de donnée 




