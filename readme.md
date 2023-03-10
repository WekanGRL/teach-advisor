README

composer create-project symfony/skeleton edt

composer require symfony/orm-pack
composer require --dev symfony/maker-bundle

composer require symfony/form
composer require symfony/validator
composer require symfony/twig-bundle
composer require sensio/framework-extra-bundle

composer require easycorp/easyadmin-bundle

composer require symfony/security-bundle


--- PHP.ini ---
Activer extension=php_intl

--- Points d'entrée API ---

  - http://localhost:8000/api/room/       | GET        | Request code : 200 | récupère toutes les salles
  - http://localhost:8000/api/lesson      | GET        | Request code : 200 | récupère tous les cours
  - http://localhost:8000/api/lesson      | GET / POST | Request code : 200 | récupère tout les cours dans une intervalle donnée

--- Librairie ---

  - vue-cal
 
--- Choix technique ---
 
  Utilisation de vue-cal pour rendre plus facile l'affichage et la gestion de matiere 
 
--- Asserts ---

  - NotNull / NotBlank en fonction du contexte 
  
  - Pour la classe lesson :
    - la matière doit faire 1h30 (Non fonctionnel)
    - la matière doit commencer entre 8h et 11h ou 14h et 17h
    - la fin d'un cours et forcément aprés un début
    - le type d'un cour est forcément sois Tutorial / Praticum / Lecture / Exam
    - la matière choisis doit etre une matière qu'enseigne le professeur
  - Pour la classe Review :
    - Un etudiant ne peux noter qu'une fois un professeur
  - Pour la classe Room :
    - Le numero de salle peut etre soit "Amphiteheatre" ou sous le forma "R.NNN"
  - Pour la classe Subject :
    - il ne peut exister qu''une même reference de matière
    - La reference doit etre sous le format "XX000"
  - Pour la classe Teacher :
    - le nom doit avoir 2 caractères au minimum et 25 au maximum
    - le prenom doit avoir 2 caractères au minimum et 25 au maximum
    - l'email doit respecter le format email symfony et ne doit pas dépasser 50 caractère
  - Pour la classe User :
    - Il ne peut exister qu'un même email à la fois

--- Fonctionnalités supplémentaires ---
- Ajout d'un système de login avec trois niveaux : prof, étudiant, admin
- Etudiants peuvent créer leurs comptes
- Ajout d'un dashboard pour les professeurs (vide pour l'admin)
- Emploi du temps affichant tous les cours de la semaine (non accessible par le prof)
- On peut noter les cours du prof en cliquant sur le cours dans l'emploi du temps

--- informations complémentaires ---

Jeu de données fourni avec l'architecture de la bdd
Les identifiants des comptes sont:
- Professeur Ibes MONGABURE : email : ibes.mongabure@gmail.com, mot de passe : ibes
- Professeur Xavier GODART : email : xgodart@gmail.com, mot de passe : xavier
- Etudiant : email : etudiant@etud.fr, mot de passe: etud
- Admin : email: admin, mot de passe: admin

Il n'y a pas de validations sur l'email de l'étudiant lors de l'envoi d'une note au professeur pour vérifier qu'il soit enregistré dans la base.
