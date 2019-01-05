# Biocare

## Obtenir une copie du projet

### Pré-requis

PHP avec pour version 7.2 au minimum

### Obtenir une copie du projet

Pour obtenir une copie du projet il faut faire la commande suivante :

    git clone https://github.com/Remy93130/biocare

### Installation

#### Définir les variables d'environnements
Afin de configurer la base de donnée il faut définir les variables d'environnements.
Pour cela créer le fichier .env à la racine du projet.
Pour le contenu de ce fichier, copier-coller  le contenu du fichier .env.dist et modifier la variable DATABASE_URL en remplaçant db_user par votre nom d'utilisateur, db_password par le mot de passe et db_name par le nom de la base de données.

#### Installer la base de données

Pour installer la base de données, faite la commande suivante :

    php bin/console doctrine:database:create

Ensuite pour migrer les données il faut faire la commande suivante :

    php bin/console doctrine:migration:migrate

Enfin pour récupérer le jeu de données, charger les fixtures avec la commande :

    php bin/console doctrine:fixtures:load
