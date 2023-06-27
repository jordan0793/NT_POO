<?php
// NAMESPACE 

namespace App\Banque;

// EXP : a cause de l'introduction du namespace dans Compte.php, on est obliger de mettre un namespace ici aussi car sinon l'ordianteur ne reconnait pas de quelle classe on parle  

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
 * @param string $nom (hérité du parent) - Nom du titulaire
 * @param $montant (hérité du parent) - Montant du solde à l'ouverture 
 * @param $decouvert ( création de la propriété) +- découvert autorisé 
 * @param void
 */

 public function __construct(string $nom, float $montant, int $decouvert)
 {
    // On transfert les informations necessaires au constructeur de Compte 

    // EXP BALESE : syntaxe, pour eviter de tout réécrire, on ecrit :
    //   parent(classe abstraite Compte ) :: ( PDO ) __ construct ($nom, $montant = copié/collé paramètre de classe Compte)
    // ) 
    parent::__construct($nom, $montant);
    
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