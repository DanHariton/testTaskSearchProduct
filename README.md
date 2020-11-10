# test task
test task to BOOTIQ (Symfony)

# Installation 

* **clone**
* composer install 
* npm i
* cp .env .env.local
* set database: DATABASE_URL=sqlite:///%kernel.project_dir%/var/data.db
* php bin/console doctrine:database:create
* php bin/console doctrine:schema:update --dump-sql --force

# Pull procedure

### Just

* run ```sh pull.sh```

### OR
* **pull**
* composer install 
* npm i
* php bin/console doctrine:schema:update --dump-sql --force

# Dev

* For dev server run: 
    * cd public
    * php -S 127.0.0.1:8080
* Database stored in /var/data.db

