<?php

// VIDEO 5 AUTOLOAD ----------------------

use App\Autoloader;
// Ajouter le namespace de autoloader
use App\Client\Compte as CompteClient;
use App\Banque\{CompteCourant, CompteEpargne};

require_once 'classes/Autoloader.php';
//On élimine tous les reuire précédent , on écrit le require de Autoloader.php, et on apelle la fonction magique ici avec le selecteur de portée :: 
Autoloader::register();

$compte1 = new CompteCourant ('Benoit', 500, 200);



echo "<pre>";

var_dump($compte1);

echo "</pre>";

$client = new CompteClient('Doe ', 'John');

echo "<pre>";

var_dump($client);

echo "</pre>";


//-----VIDEO 4 NAMESPACE--------

// Raccourci du Namespace :
// EXP: chemin de Namespace parfois trop long, on utilisera les ALIAS 
// use App\Client\Compte as CompteClient;
// use App\Banque\{CompteCourant, CompteEpargne};
// autre écriture , entre accolade 


// use App\Banque\CompteCourant;
// use App\Banque\CompteEpargne;

// Namespace de base 
// use App\Client\Compte;

// require_once 'classes/Banque/Compte.php';
// require_once 'classes/Banque/CompteCourant.php';
// require_once 'classes/Banque/CompteEpargne.php';
// require_once 'classes/Client/Compte.php';

// Pas besoin de remettre le namespace dans l'index il est contenu dans Compte.php appeller par requiere 

// En revanche on l'appelle a la création d'un nouvel objet directement dans l'index

// $client = new App\Client\Compte;

// echo "<pre>";

// var_dump($client);

// echo "</pre>";

// Déclaration de l'alias, nouvelle syntaxe de l'instance (voir déclaration de l'alias en haut de l'index.php)

// $client = new CompteClient;

// echo "<pre>";

// var_dump($client);

// echo "</pre>";

// $compte1 = new CompteCourant ('Benoit', 500, 200);

// $compte1->setDecouvert(200);



// echo "<pre>";

// var_dump($compte1);

// echo "</pre>";

// $compte2 = new CompteEpargne ('Robert', 100, 10);

// echo "<pre>";

// var_dump($compte2);

// echo "</pre>";



// ----------------VIDEO 1 A 3 -------------
//-----VIDEO 3--------

// classe abstraite, necessité de Require
// require_once 'classes/Compte.php';
// require_once 'classes/CompteCourant.php';
// require_once 'classes/CompteEpargne.php';

// Compte Epargne 
// $compte1 = new CompteEpargne('Benoit', 200, 10);
// echo "<pre>";

// var_dump($compte1);

// echo "</pre>";

// $compte1->verserInterets();

// echo "<pre>";

// var_dump($compte1);

// echo "</pre>";

// $compte1->retirer(200);

// echo "<pre>";

// var_dump($compte1);

// echo "</pre>";

// CompteCourant , retirer ajouter de l'argent, taux d'intéret ----------
// On instancie CompteCourant 
// Erreur php principe d"héritage, il faut mettre les argument de la classe parent, regarder les paramètre de Compte
// Le compte courant NECESSITE un titulaire et un solde  
// Donc je précise un nom et un solde Benoit et 500

// $compte1 = new CompteCourant ('Benoit', 500, 200);

// $compte1->setDecouvert(200);
// EXP : Compte1  initiliser, dans classe private CompteCourant, utiliser méthode accesseur SET , paramètre $montant puis ensuite le SET est commenter car on a ajouter des paramètre , constructeur dans classe CompteCourant


// echo "<pre>";

// var_dump($compte1);

// echo "</pre>";

// On pourrait écrire direct dans l'initialistation du compte 
// $compte1 = new CompteCourant ('Benoit', 500, 200);




// Repectivement : titulaire, solde, découvert , mais risque de bug car normalement le new compte ne prend que 2 valeur, pas 3, NECESSITE d'ajouter constructeur a classe CompteCourant 

// Retirer de l'argent selon méthode CompteCourant retirer ():

// $compte1->retirer(200);
// echo "<pre>";

// var_dump($compte1);

// echo "</pre>";

// BUG: le $solde nous pose pb car l'ordinateur n'arrive pas a la chercher car le $this->solde de l'objet compte est contenu dans une classe PRIVATE Compte, la classe CompteCourant n'hérite pas de la fonction private. C'est la LIMITE de la fonction Private, c'est pour cela qu'on utilisera PROTECTED car la protected fera hérité les $this au autres classes. Pour ce faire on change les propriétés de la classe Compte, titulaire et montant deviennent protected

































//-----------VIDEO 1 et 2 , classes public, private ---

// Besoin de raccorder la page de méthode
// une méthode est une fonction d'un objet 
// require_once 'classes/Compte.php';

// $compte1 = new Compte ('Benoit', 300);
// EXP: Premiere modification de l'objet de base, Premiere Instance
// On instancie le compte
// $compte1->setSolde(500);
// ATTENTION ! ligne au dessus le setter, a  commentter pour l'intégration du taux d'intérêt récupérable par méthode sefl:: dans la classe, car le setter de solde détruit la déclaration du taux d'intérêt 
// echo $compte1->voirSolde();
// EXP: Mon $compte1 est une instance, c'est une modification de l'objet de base Compte 
// On écrit dans la propriété titulaire 



//EXP : j'instancie compte1 , je vais chercher dans la propriété titulaire de l'objet de base ( représenter par la flèche ) et je lui dit de mettre une chaine de caractère 'Benoit' car c'est ce que j'ai attribuer comme type a l'objet de base 

// On depose 100 
// Si dépot de valeur négative, la valeur du montant ne change pas car la condition if protège la méthode déposer 
// $compte1->deposer(100);
// $compte1->voirSolde();
// var_dump($compte1);
?>

<!-- <p></?=$compte1->voirSolde();?> </p>  -->
<?php
// $compte1->retirer(500);
// echo $compte1->voirSolde();
// en public echo du taux d'interêt 
// echo "Le taux d'intérêt du compte est : ". Compte::TAUX_INTERETS . "%";

// en privé , echo du taux d'intérêt 
// Mettre directement la formulation dans la classe, impossible de l'appeller dans l'index

//EXP : On a dit qu'on cherche le taux d'intérêt uniquemenbt par l'intermédiaire de la classe, ainsi on va chercher dans la classe Compte, du fichier Compte.php 
// var_dump($compte1);
?>
 <!-- <p></?=$compte1->voirSolde();?> </p>  -->

<?php

// echo $compte1->titulaire;
// déclaration impossible en private en écrira : 
// echo $compte1->getTitulaire();


// $compte1->setTitulaire('');
// echo $compte1->getTitulaire();
// var_dump($compte1);
// var_dump($compte1->setTitulaire('')) ;


// $compte2 = new Compte('Robert');
// $compte2-> solde = 382.25;
// var_dump($compte2);

