<?php
// NAMESPACE 

namespace App\Banque;
 
use App\Client\Compte as CompteClient;

/**
 * Compte bancaire (hérite de la classe abstraite Compte )
 */
class CompteCourant extends Compte

// EXP : le mot extends, veut dire étend la classe abstraite , principe d'héritage 

// EXP 2 : // Le compte courant NECESSITE un titulaire et un solde, prinipe d'héritage lié a EXTENDS 
{
    // Private donc accesseur ( VOIR GET et SET )
    private $decouvert;

/**
 *  CONSTRUCTEUR de CompteCourant
 * @param CompteClient $compte Compte client du titulaire
 * @param $montant (hérité du parent) - Montant du solde à l'ouverture 
 * @param $decouvert ( création de la propriété) +- découvert autorisé 
 * @param void
 */

 // Changement des paramètres, car les paramètre du Parent ont été modifié , donc necessité d'inbtegrer les paramètre CompteClient, Dand le constructeur on a vu que les paramètre été mis en dur ( string $nom et string $prenom) la on le met selon technique d'IDDependance, la classe et la variable, CompteClient $compte)

 public function __construct(CompteClient $compte, float $montant, int $decouvert)
 {
    // On transfert les informations necessaires au constructeur de Compte 

    // Changement due a l'injection de dépendance, dans le construct paramètres et dans la déclaration de l'utilisation du parent via l'opérateur de séléction 
    parent::__construct($compte, $montant);
    
    $this->decouvert = $decouvert;
 }


    //----- ACCESSEURS------------------------
    public function getDecouvert():int
    // l'accesseur/fonction  retourne un integer 
    {
        return $this->decouvert;
    }
    public function setDecouvert(int $montant): self
    // Le montant du constructeur de Compte
    {
       if($montant>=0) {
        $this->decouvert = $montant;
        //EXP : Si le montant du découvert supérieur a 0, le le découvert prend la valeur du montant 
       }
       return $this;
       // afficher l'info
    }

    public function retirer(float $montant)
    { 
    // Réecriture de la méthode retirer de l'argent dans la méthode CompteCourant  

    // On vérifie que le découvert permet le retrait
    if($montant > 0 && $this->solde - $montant >= -$this->decouvert) 
    {
       $this->solde -= $montant;
       // 
    }else{
        echo "Solde insuffisant";
    }
}
}