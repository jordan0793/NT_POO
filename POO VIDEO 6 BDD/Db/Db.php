<?php
namespace App\Db;

// Même avec ce namespace , PDO n'est pas chargé 

// On importe PDO, et on lève les exceptions si existantes
use PDO;
use PDOException;

class Db extends PDO 
{
    // Design Pattern Singleton 
    // Instance unique de la classe , propriété private , elle n'est instancié que dans ce fichier
    //Methode Statique : accessible que depuis la méthode du selecteur :: 
    
    private static $instance;

    // Information de connexion 

    private const DBHOST = 'localhost';
    private const DBUSER = 'root';
    private const DBPASS = 'root';
    private const DBNAME = 'demo_poo';

    private function  __construct()
    { 
        // DSN de connexion (Data Source Name)
        $_dsn = 'mysql:dbname='. self::DBNAME . ';host' . self::DBHOST;

        // use PDOexeption nous permet de mettre directement le try: essaye de te connecter sinon attrappe les erreures 
        try {
        // On appelle le constructeur de la classe PDO pour se connecter 
        // EXP : on définit le dsn en lui passant le nom et l'hebergeur dans la variable $_dsn ensuite on passe l'utilisateur et le mot de passe 

        // Ensuite on fait setattribute, qui va permettre de récupérer et d'afficher les erreures comme on veut que cela soit paramétrer 
        parent::__construct($_dsn, self::DBUSER, self::DBPASS);
        $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
        //$this désigne le selecteur qui va chercher dans l'objet PDO, on lui dit d'initialiser la recherche en UTF8 : Universal Character Set Transformation Format, mode de compatibilité de codage commun a notre zone (Anglais , européen, américain)

        $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        //Mode d'apparition des données , le tableau associatif (une colonne => valeur) preference perso de Benoit 

        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //Parramétrage des erreurs, on les passe en mode exeption, on déclenche une exception dés lors qu'il y a un problème 


        } catch (PDOException $erreur){
            die($erreur->getMessage());
            // EXP :attrappe les erreur grace a PDOexeption que nous avons mis en use, place les dans la variable erreur, la variable erreur devra nous retourner un message d'erreur 
        }

        
    }
    // Création d'une méthode qui va permettre d'obtenir l'instance , cette méthode qui sera statique, donc utilisation :: , va vérifier si il y a déja une instance si yen a pas , il va l'a creer , si il y en a une on va l'a retourné 
    //déclaré en public car il faudra que l'on puisse y avoir accés de l'extérieur
    //getInstance : récupère l'instance unique de notre classe  

    public static function getInstance():self
    //retourne soit PDO, Db ou self , on a le choix

    {
        // Si la récupération dans classe DB de la variable $instance , est que cette variable est strictement nulle (type et valeur nulles)
        if(self::$instance === null) {
            self::$instance = new self();
            // faire un new self, donc un new Db, self = Db
        }
        return self::$instance;
        //Quoi qu'il arrive , si l'instance existe ou pas , on retourne l'instance créer ou déja existante 
    }
    // FIN du DESIGN PATTERN SINGLETON : on a un constructeur privé  que l'on ne peut pas instancier ET une méthode statique getInstance qui va permettre de générer une instance si'elle n'existe pas ou de récupérer l'instance si elle existe déja.
    //Ce qui permet de n'avoir qu'une seule possibilité au niveau de l'instance 
    
    
}