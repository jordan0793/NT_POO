<?php
 // Compte avec un C majuscule car c'est ici que sera creer la première classe
namespace App\Banque;

use App\Client\Compte as CompteClient;


/**
 * Objet Compte bancaire
 */
abstract class Compte

// ABSTRACT désigne le parent, obligation de mettre abstract pour que la classe soit le PARENT 
{
   // Changement Video 5: on fait dépendre la propriété titulaire de CompteClient 
/**
     * titulaire du compte 
     * @var CompteClient
     */
  

     // VIDEO 5 : injection et dependances 
    // changement, on déclare la propriété titulaire non plus en string mais on l'a fait dépendre de CompteClient 

    //EXP : Maintenant quand on va instancier la classe abstraite Compte, il va falloir lui passer en paramèrtre un CompteClient 

    private CompteClient $titulaire;

    
    //NB: Benoit a changer ClientCompte par CompteClient car il voulait

   /**
     * solde du compte 
     * @var float (decimale)
     */
    protected $solde;

    

private const TAUX_INTERETS = 5;

// Récupérable avec méthode self::


//-------------------------------------------------------------------
// Créaction d'une méthode d'Instance: Le CONSTRUCTEUR / LE MODEL D'INSTANCE


/**
 * -----------------Constructeur du compte bancaire -----------------
 *
 * @param string $nom Nom tu titulaire
 *  @param float $montant solde titulaire
 */
// fonction magique php d'ou les underscores, c'est le constructeur de notre objet
public function __construct(string $nom, string $prenom, float $montant = 100)
{
  // EXP: Subtilité , Pour changer les paramètre et y intégrer les paramètre de CompteClient, Benoit y inclu les paramètre de la création du Compte Client en dur dans le constructeur de la classe abstraite , le string nom et string prenom ! 

// Ancienne formulation : 
  // $this-> titulaire = $nom;

  //Nouvelle formulation du constructeur de titulaire ( CompteClient) 
  $this-> titulaire = new CompteClient($nom, $prenom);



  $this->solde = $montant;

}
// -----------ACCESSEURS ---------------------------

//------------GET PRENDRE---------------------------
// Changement des accesseur , ne retourne plus des string mais des CompteClient 
/**
 * Getter de titulaire - retourne la valeur du titulaire du compte 
 *
 * @return CompteClient
 */
public function getTitulaire(): CompteClient
{
  return $this->titulaire;
}


//----------- SET DEFINIR --------------------------
/**
 * Modifie le nom du titulaire et retourne l'objet
 *
 * @param CompteClient
 * @return Compte Compte bancaire
 */
public function setTitulaire(CompteClient $compte): self
// Meme dans le SET ce n'est pas $nom et $prenom en paramètre , mais directement CompteClient 
{

  // Transformation de la condition de chaine de caractère, si $compte existe alors ce titulaire prendra la valeur de $compte 
  if(isset ($compte)) 
  { 
  $this->titulaire = $compte;
}
return $this;
}

//EXP : on définit en paramètre ce que va retourner la fonction, une chaine de caractères , elle retournera ce qu'elle envoie : self, pas besoin de spécifier dans $this car elle est déja paramétrée 

/**
 * Getter de solde - retourne la propriété solde du titulaire
 *
 * @return float solde du compte 
 */
public function getSolde(): float
{

  return $this->solde;
}
/**
 * Setter de solde - modifie le solde du compte
 *
 * @param float $montant du solde
 * @return Compte Compte bancaire 
 */
public function setSolde(float $montant): self
{
  if ($montant >= 0) {
    $this->solde = $montant;
  }
  return $this;

}

// EXP : particularité , pour définir le solde, celui ci ne peut pas être négatif, donc condition ajoutée 


//-----------FIN ACCESSEURS---------------------------------


//-------------------METHODES--------------------------------
// Creation d'une méthode dans la méthode : ajouter du Pognon 
/**
 * Méthode Déposer de l'argent 
 *
 * @param float $depotArgent montant déposé
 * @return void
 */
public function deposer(float $depotArgent)
{
  // On vérifie que le depot est positif 
  if ($depotArgent > 0)
  {
    $this->solde += $depotArgent;
  }
}
/**
 * Methode qui retourne une chaine de caractère affichant le solde 
 *
 * @return string
 */
public function voirSolde()
{
  return "Le solde du compte est de $this->solde euros";
}


/**
 * Methode qui retire de l'argent 
 *
 * @param float $retirerArgent
 * @return void
 */




  public function retirer(float $retirerArgent)

{
    if ($retirerArgent >0 && $this->solde >= $retirerArgent )
    {
      $this->solde -= $retirerArgent;

    }else{
      echo "Montant invalide ou solde insuffisant";
    }
  }

  // GROS CHANGEMENT: va falloir modifier CompteCOurant, CompteEpargne 
}