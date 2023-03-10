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

--- informations complémentaire ---

Jeux de donnée fournie avec l'architecture de la bdd
