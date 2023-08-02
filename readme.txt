-créer une entity Voiture. (php bin/console make:entity Voiture)
elle aura comme propriété : 
    marque (string)
    modele (string)
    prix (integer)
    description (text)
    (Attention sa n'a pas changé la bdd, make:migration => pour créer un nouveau fichier de version, doctrine:migrations:migrate pour mettre à jour la bdd)
    
-créer un nouveau controller VoitureController
-créer une méthode et une route pour afficher une nouvelle page qui affichera un titre:
"Les voitures"
mettre un lien dans la navbar pour accéder a cette page.

-créer le formulaire d'ajout de voiture (php bin/console make:form VoitureType)
-créer une méthode et une route pour afficher une nouvelle page qui affichera le formulaire d'ajout de voiture.(VoitureController)
-mettre le lien dans la barre de navigation
-afficher sur la page créer hier toute les voitures de la bdd

