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
php bin/console user:create # Créer un User
php bin/console workshop:assign-rooms # Assigner une salle aux ateliers
php bin/console hash:students # Hasher tous les étudiant non hashés
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

