# Sym4_formDynamqiue

### Symfony 4 :
Extrait de code permettant la génération dynamique de formulaire lié selon 2 méthodologies :
* avec JQuery (peu adaptée s'il y a beaucoup de données à traiter)
* avec des EventListener

Pour la méthode 2, je me suis inspiré de :
* cette vidéo  https://grafikart.fr/tutoriels/champs-imbriques-888 
* la doc symfony https://symfony.com/doc/current/form/dynamic_form_modification.html

** Attention ** ce dépot ne contient pas tout le projet

### Entity :
* Pays : id, nom (String)
* Ville : id, nom (String)
* Monument : id, nom (String)

Relations : PAYS (0,n) ----- (1,1) VILLE (0,n) ----- (1,1) MONUMENT
