## Docs

https://github.com/benblub/devpro_page/wiki

## Require

Gulp
Composer
Bower
Nodejs
PHP 5.4
MySQL

### Duplicate Repository
ip-symfony-skeleton in ein neues Repository auf Github pushen.

```
1. git clone --bare https://github.com/benblub/devpro_page
2. cd old-repository.git
3. git push --mirror https://github.com/exampleuser/new-repository.git
4. cd ..
5. rm -rf devpro_page.git
```

### Install

Installation vom neu angelegten Repository
```
1. git clone https://github.com/interpunkt/new-repositoy
2. bower install
3. composer install
4. Datenbank Name setzen in parameters_dev.yml
4.1 php app/console doctrine:database:create
5. php app/console doctrine:schema:update --force
6. Create a Admin User via Console -> console Command "php app/console fos:user:create USERNAME --super-admin"
7. Start local Server -> console Command "php app/console server:run"
```

### Use
localhost:8000 -> Frontend
localhost:8000/admin/ -> Backend/admin
localhost:8000/register/ -> register a new User (need to set a higher ROLE if he need access to the backend
localhost:8000/login/ -> Login Window
localhost:8000/_trans/ -> translationUI to set your translations