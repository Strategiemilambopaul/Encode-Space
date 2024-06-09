# Encode Space
**une meilleur expérience d'encodage et décodage des vos données...**

Ceci est un outil monté pour facilité le codage ainsi que le décodage de vos messages avec des algorithmes définis par vos matrices.

# Comment cela fonctionne 

* Vous devez d'abord choisir une matrice au départ de type carrée:
    - Remplir la matrice en ligne et en colonne comme l'indique le croquis ci-dessous.

orientation | Colonne 1 | Colonne 2 
------------:| :------------:| :---------
ligne 1 | Cellule a| Cellule b 
ligne 2 | Cellule c | Cellule d 

- Model de Remplissement

orientation | Colonne 1 | Colonne 2 
---:| :-:| :---
ligne 1 | 6| 4
ligne 2 | 4| 2 
        
**Après avoir défini votre matrice, c.à.d en remplissant les cases requisent :**
    - vous pouvez maintenant entrer un message dans le champ prevu pour le message.

* Après avoir insérer votre message, vous devez indiquez à l'outil la methode a faire : *
    - Encodage
    - Decodage
* Si toutes les étapes ont été respecté , votre message sera Encodé avec la matrice défini au départ.*

# Comment est structuré les fichiers

pour la structuration, on a adopté une hierarchié assez simple. C'est-à-dire on a que deux fichiers l'un contient le traitement et
l'autre contient une class *Cryptographie* qui contient à son tour deux méthodes:
 - Encode 
 - Decode
le fichier est utilisé selon les normes de la POO, afin d'intéragir avec ses méthodes et attributs.

# Comment maintenant décoder ce message ?
* le décodage ne possible qu'à la connaissance dela **_matrice_** avec laquelle le message a été coder. 
Elle est donc la clet qui nous traduit le message caché.



