<?php
 // Compte avec un C majuscule car c'est ici que sera creer la première classe
namespace App\Banque;

use App\Client\Compte as CompteClient;

// NAMESPACE et ALIAS 
// EXP: configurer un namespace n'empéche pas tous les conflits alors on détermine un alias dans ce fichier pour être certain de sa récupération dans l'index

// PB: cela affecte les autres classes des autres fichier , il va falloir changer l'appell des classes en configurant un namespace en haut de fichier de chaque classe concernée - CompteCourant.php 

// namespace App\Banque;

/**
 * Objet Compte bancaire
 */
abstract class Compte

// ABSTRACT désigne le parent, obligation de mettre abstract pour que la classe soit le PARENT 
{
    // Propriétés : on va déclarer un titulaire et un solde , ce sont les propriétés

    // private $titulaire;

   


    // Propriétés en Private : rend inacessible l'appelle de la propriété de l'exterieur il va falloir mettre en place des accesseurs dans l'objet

    /**
     * titulaire du compte 
     * @var string
     */

     // VIDEO 5 : injection et dependances 
    // changement, on déclare la propriété titulaire non plus en string mais on l'a fait dépendre de CompteClient 
    private CompteClient $titulaire;

    /**
     * titulaire du compte 
     * @var CompteClient
     */
    //NB: Benoit a changer ClientCompte par CompteClient car il voulait

   /**
     * solde du compte 
     * @var float (decimale)
     */
    protected $solde;

    

// Ce que l'on vient de creer est un objet de base, l'instance viendra modifier l'objet de base pour l'utiliser , creer une version de l'objet utilisé sous la forme de variable , on n'aura donc différente instance de l'objet 

// Changement de Private a Protected pour faire fonctionner le système d'héritage, pour pouvoir utiliser les $this dans les classes héritières, on veut pouvoir retirer de l'argent par l'intermédiaure de ClasseCourant méthode retirer ()
// -------------------CONSTANTES----------------------------
// Valeur qui ne change pas, en majuscule, undercascore case pour plusieur mots , convention 
// Cette propriété constante est spécial , elle n'est pas visible dans l'objet, donc n'apparait pas dans le var_dump de l'objet, on y accède par l'intermédiaire de la classe elle même, syntaxe : le double deux point, voir index

// Modification video 2: classe abstraite, inutilisable , on utilisera d'autre classe pour appeller la classe abstraite, principe d'héritage. On déclarera classe compte épargne et classe compte courant qu'on utilisera directment , la classe compte devient la classe abstraite/mère

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
public function __construct(string $nom, float $montant = 100)
{
  // On attribut le nom a la propriété titulaire de l'instance créée

  // EXP : l'instance de l'objet, donc cet objet spécifique que l'on va modifier est connu sous le nom $this
  // on reprend la propriété de la classe ( titulaire) , on le met dans construct, on lui attribu avec $this la valeur du $nom)

  $this-> titulaire = $nom;

  //On attribut le montant a la propriété solde 

  $this->solde = $montant;

  // Si on veux integrer le taux d'intérêt 

  // $this->solde = $montant + ($montant * self::TAUX_INTERETS/100);

  //OU...

  // $this->solde = $montant + ($montant * Compte::TAUX_INTERETS/100);

  //EXP : self est le terme générique pour désigner la classe dans laquelle on se trouve, ici c'est Compte, dans Compte:: va chercher TAUX_INTERET, c'est une constante récupérable par self(classe)::(opérateur de résolution de portée).

  //on enleve la constante taux interêt , car on l'a rajoute a compte épargne 

 
}
// -----------ACCESSEURS ---------------------------

//------------GET PRENDRE---------------------------
/**
 * Getter de titulaire - retourne la valeur du titulaire du compte 
 *
 * @return string
 */
public function getTitulaire(): string
{
  return $this->titulaire;
}

// EXP : On sait que cet accesseur va chercher la propriété titulaire et que cela retournera une chaine de caractères
// Attention pas d'espace entre getTitulaire(): string

//----------- SET DEFINIR --------------------------
/**
 * Modifie le nom du titulaire et retourne l'objet
 *
 * @param string $nom
 * @return Compte Compte bancaire
 */
public function setTitulaire(string $nom): self
{
  if($nom != "") 
  { 
  $this->titulaire = $nom;
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
// l'echo affiche l'information directement, return retourne , quand on met du html et que on intégre une méthode dedans on utilise return 

/**
 * Methode qui retire de l'argent 
 *
 * @param float $retirerArgent
 * @return void
 */




  public function retirer(float $retirerArgent)

// Verifier que le montant ne soit pas négatif ( on ne retire pas -100, on retire 100) et que le montant du retrait doit être inférieur au solde 
{
    if ($retirerArgent >0 && $this->solde >= $retirerArgent )
    {
      $this->solde -= $retirerArgent;

    }else{
      echo "Montant invalide ou solde insuffisant";
    }
  }
//    echo $this->decouvert();
// }



// private function decouvert()
// {
//   if ($this ->solde < 0)
//   {
//     return "Vous êtes a découvert";
//   }
//   else{
//     return "Vous n'êtes pas à découvert";
//   }
// }

// on enleve le découvert car on va déclarer classe compte courant 
}