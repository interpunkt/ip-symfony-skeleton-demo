# devpro_page

This is new Page for DevPro. Created with Symfony and it contains a Frontend and a Backend Bundle.

<h3>Install</h3>

1. Clone Project Local<br>
2. Run Composer to install Depencys<br>
3. Install Assetic<br>
4. Create a Database called "devpro"<br>
5. Create Database Tables -> console Command "php app/console doctrine:schema:update --force"<br>
6. create a Admin User -> console Command "php app/console fos:user:create USERNAME --super-admin"<br>
7. Start local Server -> console Command "php app/console server:run"


<h3>Use</h3>
localhost:8000 -> Main Frontend Site<br>
localhost:8000/admin/ -> Your Backend/Dashboard (you will redirected to Login /login if not logged in)<br>
localhost:8000/register/ -> register a new User (need to set a higher ROLE if he need access to the backend<br>

Language Manager (in progress)