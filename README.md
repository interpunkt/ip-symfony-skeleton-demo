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
Um Skeleton für ein neues Projekt zu benutzen wie folgt Vorgehen:

git clone --bare https://github.com/benblub/devpro_page
// Make a bare clone of the repository

cd old-repository.git

git push --mirror https://github.com/exampleuser/new-repository.git
// Mirror-push to the new repository

cd ..

rm -rf devpro_page.git
// Remove our temporary local repository

### Install

1. Clone Project Local with a --bare Clone
2. Run Composer & Bower to install Depencies
3. Install Assetic & run Assetic Dump
4. Write your Entities
5. Create Database & Tables via Console -> console Command "php app/console doctrine:schema:update --force"
6. Create a Admin User via Console -> console Command "php app/console fos:user:create USERNAME --super-admin"
7. Start local Server -> console Command "php app/console server:run"


### Use
localhost:8000 -> Main Frontend Site
localhost:8000/admin/ -> Your Backend/Dashboard (you will redirected to Login /login if not logged in)
localhost:8000/register/ -> register a new User (need to set a higher ROLE if he need access to the backend
localhost:8000/login/ -> Login Window
localhost:8000/_trans/ -> translationUI to set your translations