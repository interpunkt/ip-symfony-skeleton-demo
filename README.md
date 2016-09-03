# Skeleton

Build with Symfony Framework

## Docs

https://github.com/benblub/devpro_page/wiki

## Require

Gulp
Composer
Bower
Nodejs
PHP 5.4
MySQL

## Features

NewsletterManager
Frontend/Backend Bundle
FOSUSERBundle (Login/logout/register, protected area)
JMS Translation Bundle and UI
JMS Routing  Bundle
#### File manager / Media Manager

![Preview](https://raw.githubusercontent.com/benblub/devpro_page/master/web/assets/github/mediaManager.png)


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


### Google Settings
Meta Titel und Beschreibung können in den verschiedenen Seiten im Backend gesetzt werden
Zeichenzähler für neue Seo Elemente einbinden:
File: assets/js/charCounter.js
ID des Elements unten einbinden und Parameter setzen.

Beispiel:

```
    $('#second_textfield').characterCounter({
            maximumCharacters: 20,
            chopText: true
        });
```


### Tinymce

Um den Tinymce zu aktivieren bei einem textarea Feld einfach Class "tinymce" mitgeben."


### Frontend Paginator

Set Number of Displayed Items in Controller


### Newsletter Manager

USE example in Controller:
First add: use DevPro\BackendBundle\Newsletter\NewsletterManager;

// body, from, recipent has to get from DB ..
<pre>
   $htmlbody = '<p>Hello World</p>';
   $from = 'devmaster@foorbar.com';
   $recipient = array("foo@bar.com", "geil@richtiggeil.com");

   $mailer = $this->get('app.mailer');
   $mailer->sendmail($htmlbody, $from, $recipient);
</pre>


to USE the Newsletter Manager define in the Backend the Newsletter, add recipents and use the Send Function.
Configuration via Backend.

NewsletterPersonenController.php

Hier hat man eine Übersicht der Empfänger für den Newsletter. Es können neue Personen hinzu gefügt werden und
Personen können entfernt werden. Eine Person besteht aus "Vorname, Nachname, Anrede, Email Adresse."

## Globals

Um Daten Global auf verschiedenen Seiten zur Verfügung zu stellen wird die Globals.php im DepencyInjection Folder genutzt.
Hier Funktionen definieren die ein Return Value haben welches dann in Twig global verfügbar ist.

In der Config.yml (Beispiel)
```
globals:
            mailnotification: '@app.notification'
```

## Error Pages

Die error Pages sind zu finden in Resource/TwigBundle/views/Exeption.

## ToDo Backend
- Variable `user` global freigeben

## ToDo Frontend
- TinyMCE
  - Übersetzung 
  - content__css > File mitgeben
