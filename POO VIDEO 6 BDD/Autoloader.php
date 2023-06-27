<?php
// L'Autoloader sera utiliser pour limiter le nombre de require , il est placé a la RACINE de l'appli, déclaration du namespace

namespace App;
class Autoloader

// Fonction magique : spl_autoload_register
// Permet de mettre en place une détection automatique des NEW ( instanciation de classe en index) et si on instance une classe qui n'est pas connue, cette fonction intervient et execute une méthode ( ici que l'on appellera Autoload), Ainsi si on tombe sur une classe que l'on ne connait pas , cette méthode intervient.
{
    static function register()
    //EXP: fonction statique , les méthode statiques vont être accessibles sans avoir besoins d'instancier la classe, a savoir le register je vais pouvoir l'appeller en appellant le ::
    // Ce qui permet de faire une ligne au lieu d'écrire en index :
    // $autoload = new Autoloader;
    // $autoload->register();

    //EXP 2 : dans cette méthode magique, on va y mettre un tableau en argument, a l'intérieur de ce tableau on déclare__CLASS__ qui prend la classe dans laquelle on se trouve, et on lance une fonction qui s'apelle 'autoload'

    // EXP3: cette méthode register, sera la pour lancer le spl autoload register, une fois qu'on lui fait charger un new count Epargne, CompteCourant etc... elle va lancer une méthode autoload que l'on va écrire : static fonction autoload()
    {
        spl_autoload_register([
            __CLASS__,
            'autoload'
            // 'autoload' de ici = le autoload de static function en dessous 
        ]);

    }
    static function autoload($class)
    // le $class correspond au __CLASS__ déclarer au dessous, c'est la classe qui va être renvoyée 
    {
        //On recupére dans la classe la totalité du namespace de la classe concernée 

        // GROS CHANGEMENT: transformation du chemin App\Client\Client en enlevant le App puis en transformant le \ en / normal

        // 1 ere étape : On retire App\
        // utilisation de la constante magique __NAMESPACE__, magie c'est App qui apparait

        // On utilise st replace , argument 1 : la chaine de caractère a chercher  (search) 
        // argument 2 : ce par quoi on remplace ( chaine vide )
        // argument 3 : l'objet dans lequel on va aller chercher ces infos

        // SYNTAXE (le namespace fonction magique , ajouter avec concaténation l'antislash , . '\\' deux antislash car on echappe l'antislash qui arrive juste aprés le APP, donc pour ne pas cofondre avec un chemin, on l'échappe en le transformant en string) on le remplace par rien '', et on lui dit que c'est $class qui récupérera cette nouvelle syntaxe 
        
        // echo $class; ( le chemin en entier)

       $class = str_replace(__NAMESPACE__ . '\\', '', $class);
    //    echo $class;
       // FIN ETAPE 1 : supprimer App/
       

       //ETAPE 2 : \ devient / 
       // O0n tient toujours compte du double \\ pour string 
        $class = str_replace('\\', '/', $class);
    //    echo $class;
       
        // echo __DIR__ . '/' . $class . '.php';
        // require_once __DIR__ . '/' . $class . '.php';


        //Constante magique DIR : le dossier dans lequel se trouve l'Autoloader auquel on va concaténer un slash , auquel on va concaténer ce qui nous reste dans $class, auquel on va concaténer .php
        //A ce stade on a : Banque/CompteCourantC:\MAMP\htdocs\NT_POO\POO\classes/Banque/CompteCourant.php
         // qui constitu tous le chemin, mais on le transforme en requiere once pour qu'il aille chercher dans tous le chemin 

         //---- NE PAS FAIRE DE REQUIRE SI FICHIER N'EXISTE PAS -----

         // on peut se tromper de nom de classe dans l'index, si cela arrive nous mettons en place un protection

         // On verifie que le fichier existe 
         $fichier = __DIR__ . '/' . $class . '.php';
         if(file_exists($fichier))
         {
             require_once $fichier;
         }

    }
    
    // EXP 4: A partir de ce moment, en Index, on déclare un new compteCourant, mais PB, la supression du require CompteCourant fait que l'ordinateur ne reconnait plus cette classe, alors notre méthode intervient et place le chemin parcouru pour arriver a cette classe avant le message d'erreur . Ici c'est : App\Banque\CompteCourant, ce chemin est récupérer dans la variable $class, nous en avons fait un echo pour l'instant

        
    
}