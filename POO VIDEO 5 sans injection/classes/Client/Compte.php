<?php
// -----Création du NAMESPACE ----------------

// Lors de l'hebergement du site, le namespace va servir a contourner le problème de classe de même nom dans les fichiers de l'application

// App est la racine du dossier qui contient toute nos classes 

// pour le namespace on utilise les antislash ALT GR + 8 pour faire le chemin

// Le namespace évitera ainsi les conflit entre classes du même nom déclarée dans des fichiers différents

namespace App\Client;


// Création d'une nouvelle classe compte dans ce fichier

class Compte

// On a déplacer les fichiers de travail dans le dossier Banque , il faudra remettre les bons chemin de require 

{
    private $nom;

    private $prenom;

    // VIDEO 5 INJECTIONS ET DEPENDANCES
    // On va faire intéragir les classes entre elles, de manière a ce que un titulaire soit aussi un client 

    public function __construct(string $nom, string $prenom)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
    }
}