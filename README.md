# devpro_page

This is new Page for DevPro. Created with Symfony and it contains a Frontend and a Backend Bundle with some features.

<h3>Features</h3>
<ul>
    <li>NewsletterManager</li>
    <li>Frontend/Backend Bundle</li>
    <li>FOSUSERBundle (Login/logout/register, protected area)</li>
    <li>JMS Translation Bundle and UI</li>
    <li>JMS Routing  Bundle </li>
</ul>


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
localhost:8000/login/ -> Login Window<br>
localhost:8000/_trans/ -> translationUI to set your translations

<h3>Require</h3>
<ul>
    <li>Composer</li>
    <li>Nodejs</li>
    <li>PHP 5.3</li>
    <li>MySQL</li>
</ul>

<h3>Google Settings</h3>
<p>Meta Titel und Beschreibung können in den verschiedenen Seiten im Backend gesetzt werden</p>
<p>Zeichenzähler für neue Seo Elemente einbinden:</p>
<p>File: assets/js/charCounter.js</p>
<p>ID des Elements unten einbinden und Parameter setzen.</p>

Beispiel:

<pre>
    $('#second_textfield').characterCounter({
            maximumCharacters: 20,
            chopText: true
        });
</pre>


<h3>Tinymce</h3>

Um den Tinymce zu aktivieren bei einem textarea Feld einfach Class "tinymce" mitgeben."


<h3>Frontend Paginator</h3>

Set Number of Displayed Items in Controller


<h3>Newsletter Manager</h3>

USE example in Controller:
<pre>
   $htmlbody = '<p>Hello World</p>';
   $from = 'devmaster@foorbar.com';
   $recipient = array("foo@bar.com", "geil@richtiggeil.com");

   $mailer = $this->get('app.mailer');
   $mailer->sendmail($htmlbody, $from, $recipient);
</pre>


to USE the Newsletter Manager define in the Backend the Newsletter, add recipents and use the Send Function.
Configuration via Backend.