<?php
namespace App\Banque;

use App\Client\Compte as CompteClient;
/**
 * Compte avec taux d'intérêts
 */
class CompteEpargne extends Compte
{
    /**
     * Taux d'intérêt du compte 
     * @var int
     */
    private $taux_interets;

    // Creation des get et set mais création d'un constructeur permettant de définir dans cette méthode, le taux d'interet directement sans passer par le SET 

    /**
     * Constructeur du Compte Epargne
     *
     * @param CompteClient $compte Compte client du titulaire 
     * @param float $montant
     * @param integer $taux
     */
    public function __construct(CompteClient $compte, float $montant, int $taux)
    {
        // on transfère les valeur necessaires au constructeur parent 
        parent::__construct($compte, $montant);

        $this->taux_interets = $taux;
    }

    /**
     * Get taux d'intérêt du compte
     *
     * @return  int
     */ 
    public function getTauxInterets(): int
    {
        return $this->taux_interets;
    }

    /**
     * Set taux d'intérêt du compte
     *
     * @param  int  $taux_interets  Taux d'intérêt du compte
     *
     * @return  self
     */ 
    public function setTauxInterets(int $taux_interets): self
    {
        // Condition de taux positif strict 
        if($taux_interets >= 0)
        { 
        $this->taux_interets = $taux_interets;
        }
        return $this;
    }

    // Fonction d'utilisation du compte epargne 

    public function verserInterets()

    // pas d'info dans les parenthèses car cette fonction est interne a la classe CompteEpargne 
    {
        // Calcul du taux d'intérêt pour l'ajouter au solde du compte 
        $this->solde = $this->solde + ($this->solde * $this->taux_interets / 100 );
    }
}