<?php
namespace App\Models;

use App\Db\Db;


class Model extends Db
// La classe Model sert a creer l'interaction avec la base de donnée, c'est ici que nos requêtes seront écrite 
{
    // en protected pour avoir acces a ces propriété depuis les classes héritées du Model

    // Table de la base de données
    protected $table;

    // Instance privée de Db
    private $db;

    
    // Création du CRUD ---------

    //----------- R pour Read : Lire --------------
    //Methode 1 READ pour récupérer toute les informations 

    public function findAll()
    
    {
        $query = $this->runQuery('SELECT * FROM ' . $this->table);
        return $query->fetchAll();
        
        

        //EXP: pour lire dans ma BDD, méthode trouveTout, dans la $query  : selectionner tout de protected table qui étend la classe Db
        //fetchAll, montre tout ce que contient $query

        // EXP +++ : selectionne tout de table, qui est une protected descendante de classe Db, JE L'ENVOIE a méthode de préparation/Execution (runQuery), dans ce cas je n'envoie qu'un seul attribut (protected $table), je tombe alors dans le else car existe des attributs, et il retournera la requête, ensuite regarde au dessu , on remonte encore, toutes ces données dont envoyées dans $query , et on dit a $query de faire FetchAll, donc affiche toute les tables de la requête. On a accés a la liste totale des données de la table car SELECT * FROM
    }

    // Methode 2 READ : pour récupérer des informations détaillées 

    public function findBy(array $criteres)
    {
      
        // Utilisation de champs et valeur pour le déclarer en tant que tel dans l'index 
        $champs = [];
        $valeurs = [];

     
        
        foreach ($criteres as $champ => $valeur) {
          // On cherche a faire SELECT * FROM annonces WHERE actif = ? 
          //bindvalue ( 1,valeur)

          // Etape 1 : gérer le actif = ?, on va faire dans le tableau champs , on va push le nom de notre champs = ?; on va avoir dans un tableau la liste des différents champs avec un = ? derriere, ensuite il fait les valeurs = $valeur

          // EXP : pour chaque critères, tel que 

            // On push dans les tableaux 
            $champs[] = "$champ = ?";
            $valeurs[] = "$valeur";
        }
        // echo "<pre>";

        // var_dump($champs);

        // echo "</pre>";
        // echo "<pre>";

        // var_dump($valeurs);

        // echo "</pre>";


        // On transforme le tableau champs en une chaine de caractère pour cette fon ction , ainsi chaque chalmp ( titre, description etc ... ) que la fonction récupére va être trnasformé en string avec implode 
        

        
        $liste_champs = implode(' AND ', $champs);

        var_dump($liste_champs);

        // Execute la requête 
        return $this->runQuery('SELECT * FROM ' . $this->table . ' WHERE ' . $liste_champs, $valeurs)->fetchAll();

        

        
    }
    
    // Méthode 3 READ par l'id direct 

    public function find(int $id)
    {
        return $this->runQuery("SELECT * FROM {$this->table} WHERE id = $id")->fetch();
    }
    
    
    
    
    
    // Methode runQuery, Méthode de préparation et exécution de requête SQL
    
    public function runQuery(string $sql, array $attributs = null)
    // Php mis a jour, il faut mettre public RunQuery au lieu de protected query 
    //EXP : paramètre : variable sql définit en string et tableau attribut définit par défaut a null , a cas ou on ne veut rien lui faire passer 

    {
        // On instancie Db 
        // Db est une classe en Singleton, donc soit on l'instancie pour la première fois , soit elle est déja instancié donc on va récupérer son Id d'instance 

        //On récupère l'instance de Db
        $this->db = Db::getInstance();

        // On vérifie si on a des attributs 
        // soit c'est un tableau soit ya rien

        if($attributs !== null)
        {
            echo ' il ya des attributs';
            // Si le tableau attributs contient quelque chose 
            // Requête préparée 
            $query = $this->db->prepare($sql);
            // Requête préparé en allant chercher dans l'objet Db, car Model étend Db, on cherche le private $db et on lui fait préparé la requête SQL

            $query->execute($attributs);
            // Puis execute la requête SQL

            return $query;
            //Retourne la requête
            // Cela permettra de faire Fetch et FetchAll si besoin car la requête sera retourner et donc on pourra aller chercher dedans 
        }else {
            echo'il n\'ya aucun attribut';
            //Si le tableau ne contient rien, retourne la requête 
            //Requête simple
            

            return $this->db->query($sql);

            
          
            // On pourra aussi dans ce cas utiliser le Fetch

            //EXP: la variable $sql prendra l'ensemble de la requête avec ?, et le tableau attributs sera aussi long que le nombre de ? présents
        }
    }
    
    // ---------------Methode Create--------------
    // Pour faire cette Méthode il va falloir modifier le AnnonceModel.php car c'est ce fichiers qui contient la table "annonces" dans laquelle on va chercher (1:03:23)

    public function create(Model $model)
    {

         $champs = [];
         $inter = [];
         // Récupére les points d'interrogations 
         $valeurs = [];
 
         foreach ($model as $champ => $valeur) {
            if($valeur != null && $champ != 'db' && $champ != 'table')
            // On vire db et table qui sert a rien 
            // valeur différent de null car n'apparaitra que les setter que l'on a écrit en index si on prend les chalmps il prend les champs de la BDD
            {
               
            // Sauf qu'on a l'apparition d'élément en trop : id, titre, description, created_at, actif, table, db?, ?, ?, ?, ?, ?, ? donc on met une condition 
            
            // INSERT INTO annonces (titre, description, actif) VALUES (?, ?, ?)
             $champs[] = $champ;
             $inter[] = "?";
             //Ajoute les point interrogation 
             $valeurs[] = $valeur;
                
            }
        }
        $liste_champs = implode(', ', $champs);
        $liste_inter = implode(', ', $inter);
        //Met des virgules a chaque fois entre variables

        echo $liste_champs;

        // Execute requête 
        return $this->runQuery('INSERT INTO '. $this->table.' ('. $liste_champs.') VALUES('.$liste_inter.')', $valeurs); 
      
    }
        // Create par Hydratation 
        //méthode qui vérifie dans Model est ce qu'il y a un setter pour la propriété qu'on lui donne si oui il execute l'hydrate 
        
        public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            // on récupère le nom du setter correspondant a la clée 
            // pour titre ->setTitre
            // On concatène + ucfirst par convention 
            $setter = 'set'.ucfirst($key);
            //on vérifie si le setter existe 
            // if méthode setter existe (au dessus)
            if(method_exists($this, $setter)){
                // on appelle le setter 
                $this->$setter($value);
                // ecriture étrange car on place une variable aprés le $this, mais c pareil a 'set'.ucfirst($key)
                if ($key >=0) {

                    $this->$setter($value);
                }
            }
        }
        return $this;
    }

    // Methode Update--------------------
    // on reprend le create méthode 
    public function update(int $id, Model $model)
    // On va cherche l'id a modifier donc déclaration d'un int en paramètre
    {

         $champs = [];
        // suppression des points d'interrogations
         $valeurs = [];
        // On boucle pour chercher dans le tableau 
         foreach ($model as $champ => $valeur) {
            // UPDATE annonces SET titre = ?, description =?, actif = ? WHERE id = ?
            if($valeur !== null && $champ != 'db' && $champ != 'table')

            // Bien mettre deux == a la valeur car c'est pour cela que quand on met 0 en apdate ou create il metter null dans la bdd , approfondir 
            
            {
             $champs[] = "$champ = ?";
             // On veut avoir les lignes avec champ = ?
             $valeurs[] = $valeur;
            }
        }
        $valeurs[] = $id;
        // la valeur prendra l'id qu'on lui indiquera et le pushera dans le tableau pour effectuer la recherche 
        $liste_champs = implode(', ', $champs);
        //Met des virgules a chaque fois entre variables

        echo $liste_champs;

        // Execute requête 
        return $this->runQuery('UPDATE '.$this->table.' SET '. $liste_champs.' WHERE id = ?', $valeurs); 
      
    }
}
    




