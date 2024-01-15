# Forum
- Maxime CHOSTAK
- Antoine FALGIGLIO
- Mateo CARCIU
- Paul NIGGLI
## Installation
```shell
composer install
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate # ou :  php bin/console doc:sch:up -f   
php bin/console doctrine:fixtures:load          # Peut prendre un peu de temps avec le hashage des mots de passe
```

## Commandes
```shell
php bin/console app:AutoAssign # La commande d’assignation : On remplit les salles avec les ateliers jusqu’à finir l’attribution
php bin/console app:encrypt-data # La commande de hash : Hash les utilisateur en utilisant md5
```

## Utilisateurs
- Admin
  - email : admin
  - mot de passe : password
- Lycee
  - email : lycee@test.com
  - mot de passe : password
- Lyceen
  - email : test1@com
  - mot de passe : password

