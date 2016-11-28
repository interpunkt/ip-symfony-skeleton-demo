## Inhaltsverzeichnis
* [Allgemein](#allgemein)
* [Funktionen Übersicht](#funktionen-übersicht)
* [Routen](#routen)
* [Benutzerrollen](#benutzerrollen)
* [Template Rendern](#template-rendern)
* [Benutzer erfassen](#benutzer-erfassen)
* [Benutzer bearbeiten](#benutzer-bearbeiten)
* [Benutzer löschen](#benutzer-löschen)
* [Passwort ändern](#passwort ändern)
* [Emails](#emails)
* [FormType](#formtype)
* [Entity] (#entity)
* [Responses](#responses)
* [Passwortlänge festlegen](#passwortlänge-festlegen)
* [Email Absender Betreff Inhalt festlegen](#email-absender-betreff-inhalt-festlegen)
* [Token Livetime festlegen](#token-livetime-festlegen)


#Allgemein

Ist Bestandteil vom Core. Im Backend kann der Administrator neue Benutzer erfassen, editieren und löschen.


Der Controller befindet sich im [UserController.php](https://github.com/benblub/devpro_page/blob/master/src/DevPro/adminBundle/Controller/userController.php)


Die Templates im Ordner [User](https://github.com/benblub/devpro_page/tree/master/app/Resources/views/admin/User)


Der FormType im [UserType.php](https://github.com/benblub/devpro_page/blob/master/src/DevPro/adminBundle/Form/Type/userType.php)


Die Entity im [User.php](https://github.com/benblub/devpro_page/blob/master/src/DevPro/adminBundle/Entity/User.php)

#Funktionen Übersicht
* indexAction
* insertAction
* updateAction
* deleteAction
* handleFormUpload
* handleFormUploadNewUser
* requestNewPassword($id)
* sendEmailForNewPasswordRequest($user)
* passwordReset($confirmationToken)
* sendEmailToNewUserWithLoginData($user)
* generateNewPassword($passwordLength)

#Views Übersicht
* index.html.twig
* insert.html.twig
* update.html.twig
* changePassword.html.twig
* passwordConfirmEmail.html.twig
* passwordNewUserSendMail.html.twig
* passwordResetSendMail.html.twig
* profil.html.twig

#Routen
* @Route("/admin/user", name="admin_user")
* @Route("/admin/user/insert", name="admin_user_insert")
* @Route("/admin/user/update/{id}", name="admin_user_update")
* @Route("/admin/user/delete/{id}", name="admin_user_delete")
* @Route("/admin/user/password/resetrequest/{id}", name="admin_password_reset_request")
* @Route("/frontend/user/password/reset/{confirmationToken}", name="admin_password_reset_confirm")

#Benutzerrollen
* Interpunkt, Role: "ROLE_SUPER_ADMIN"
* Administrator, Role: "ROLE_ADMIN"

```
access_control:
        - { path: ^/login$, role: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/register, role: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/resetting, role: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/admin/, role: ROLE_ADMIN }
        - { path: ^/admin/interpunkt/, role: ROLE_SUPER_ADMIN }
```

#Template Rendern
####  UserController::IndexAction

Rendern des "index.html.twig" Templates, welches sich die Tabelle aller Benutzer befindet und von der DB durch Doctrine via der Variabel "$data" an das Template weiter gegeben wird.

Beispielcode:
```
    /**
     * @Route("/admin/user", name="admin_user")
     */
     public function indexAction()
     {
        $data = $this->getDoctrine()->getRepository('DevProadminBundle:user')
                ->findBy(array(), array(
                    'id' => 'DESC'
                ));
                $html = $this->renderView(
                    'admin/User/index.html.twig', array(
                        'data' => $data,
                        'title' => 'user'
                    )
                );
                return new Response($html);
     }
```

####  /User/index.html.twig

Durch "{% for items in data %}" die Daten der Benutzer von der DB in die Tabelle iterieren 

Beispielcode:
```
                         <tbody>
                            {% for items in data %}
                                <tr>
                                    <td>{{ items.id }}</td>
                                    <td>{{ items.email }}</td>
                                    <td>
                                        <a href="{{ path('admin_'~title~'_update', {'id' : items.id }) }}" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                        <a href="{{ path('admin_'~title~'_delete', { 'id' : items.id }) }}" class="btn btn-default"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                                    </td>
                                </tr>
                            {% endfor %}
                            </tbody>
```



#Benutzer erfassen

E-Mail an den neuen Benutzer mit seinen Zugangsdaten wird versendet. Login erfolgt über E-Mail Adresse und Passwort. Die Zeichenlänge des Passworts ist konfigurierbar (siehe generatePassword)

#### UserController::insertAction

Eine default Action für die das LiveTemplate "insertAction" verwendet werden kann. Die Funktion nimmt Daten aus dem Formular entgegen und fügt Sie in die Datenbank ein. Anschliessend wird der E-Mail Versand ausgelöst. Absender und Betreff können aktuell nicht im Backend konfiguriert werden. Dies sollte noch angepasst werden.

Beispielcode:
```
    /**
     * @Route("/admin/user/insert", name="admin_user_insert")
     */
     public function insertAction(Request $request)
     {
        $data = new user();
        $form = $this->createForm(userType::class, $data);
        $result = $this->handleFormUploadNewUser($form, $request);
        if($result)
        {
            // send Email to User with Login Data
            $this->sendEmailToNewUserWithLoginData($result);
            return $this->redirectToRoute('admin_user');
        }
        $html = $this->renderView(
            'admin/User/insert.html.twig', array(
                'data' => $data,
                'form' => $form->createView()
            )
        );
        return new Response($html);
     }
```

#### UserController::handleFormUploadNewUser

Eine Action, welche von der default Action "handleFormUpload" abgeleitet wurde und wegen dem FosUserBundle spezifiziert wurde.

Beispielcode:
```
/**
     * @return bool
     */
    public function handleFormUploadNewUser($form, $request)
    {
        $form->handleRequest($request);
        if ($form->isValid() && $form->isSubmitted())
        {
            $data = $form->getData();
            // generate a new Password with PWGen, Password length 6
            $password = $this->generateNewPassword(6);
            // get Usermanager
            $userManager = $this->container->get('fos_user.user_manager');
            $user = $userManager->createUser();
            $user->addRole('ROLE_ADMIN');
            $user->setEmail($data->getEmail());
            $user->setEnabled(true);
            $user->setUsername(uniqid());
            $user->setPlainPassword($password);
            $userData = array(
                'email' => $data->getEmail(),
                'password' => $password
            );
            $userManager->updateUser($user);
            return $userData;
        }
    }
```

####  /User/insert.html.twig

Das Template, welches ein neuer User eingetragen wird. Durch "{{ form_start(form) }}" wird der Head des Formulars bestummen durch das Formtyping. Durch "{{ form_widget(form) }}" werden vom FormType definierten "Input-Felder" generiert. Durch "{{ form_end(form) }}" wird das Formular-Tag geschlossen.

Beispielcode:
```
{% block content %}

    <!-- Main content -->
    <section class="content">

        <!-- Your Page Content Here -->
        {{ form_start(form) }}
        {{ form_widget(form) }}
            <input type="submit" value="speichern" class="btn btn-default">
        {{ form_end(form) }}

    </section><!-- /.content -->


{% endblock %}
```


#### UserController::sendEmailToNewUserWithLoginData

Funktion, welche das Senden der Benutzer Daten vorbereitet und in der Funktion "UserController::insertAction" verwendet wird mit entsprechendem Parameter des Benutzers, welcher erfasst wird.

Beispielcode:
```
      /**
     * @param $user
     * @return bool
     * Send a E-Mail withe the Login Data to the new User
     */
    private function sendEmailToNewUserWithLoginData($user)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Ihre Zugangsdaten auf ' . $_SERVER['SERVER_NAME'])
            ->setFrom('webmaster@' . $_SERVER['SERVER_NAME'])
            ->setTo($user['email'])
            ->setBody(
                $this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                    'admin/User/passwordNewUserSendMail.html.twig',
                    array(
                        'password' => $user['password'],
                        'email' => $user['email'],
                        'url' => $_SERVER['SERVER_NAME'] . '/login'
                    )
                ),
                'text/html'
            );
        $this->get('mailer')->send($message);
        return true;
    }
```

#### UserController::generateNewPassword

Funktion welche die Passwörter generiert. Man kann je nachdem die Länge des zufälligen Passwortes bestimmen durch "setLength()".

Beispielcode:
```
/**
     * @param $passwordLength
     * @return mixed
     * Genrate a New Password for New User or Password reset
     */
    private function generateNewPassword($passwordLength)
    {
        $passwordGenerator = new PWGen();
        $passwordGenerator->setLength(6);
        $password = $passwordGenerator->generate();

        return $password;
    }
```

Dokumentation PW Generator

https://code.google.com/archive/p/pwgen-php/

#Benutzer bearbeiten
#### UserController::updateAction

Eine default Action für die das LiveTemplate "updateAction" verwendet werden kann. Die Funktion nimmt Daten aus dem Formular entgegen, welche bearbeitet wurden. Hat in der URL die ID des Formulars als GET-Request (@Route("/admin/user/update/{id}",...). Dieser wird in der Funktion als "$id-Parameter" zugeschprochen und wird für Doctrine verwendet für das herauslesen des entsprechenden Records, welches bearbeitet werden soll.


Beispielcode:
```
     /**
      * @Route("/admin/user/update/{id}", name="admin_user_update")
      */
      public function updateAction(Request $request, $id)
      {
        $data = $this->getDoctrine()
                ->getRepository('DevProadminBundle:user')
                ->find($id);
            $form = $this->createForm(userType::class, $data);
            $result = $this->handleFormUpload($form, $request);
            if($result)
            {
                return $this->redirectToRoute('admin_user');
            }
            $html = $this->renderView(
                'admin/User/update.html.twig', array(
                    "form" => $form->createView(),
                    'id' => $id,
                    'title' => 'Benutzer'
                )
            );
            return new Response($html);
        }
```

####  /User/update.html.twig

Das Template, welches ein neuer User eingetragen wird. Durch "{{ form_start(form) }}" wird der Head des Formulars bestummen durch das Formtyping. Durch "{{ form_widget(form) }}" werden vom FormType definierten "Input-Felder" generiert. Durch "{{ form_end(form) }}" wird das Formular-Tag geschlossen.
Der "Lösch-Button" ruft ein Modal auf, welches als Html ab dem Kommentar "{# Modal Window #} <!-- Trigger the modal with a button --> ..." schon gescripted wurde. Man kann beliebig viele Modale definieren / scripten. Durch "data-target="#myModal" beim Button kann man durch den Attribut beim spezifischem Html-Tag sein Modal aufrufen, in diesem Fall ->  "div id="myModal" class="modal fade" ... "


Beispielcode:
```
{% block content %}

    <!-- Main content -->
    <section class="content">

        <!-- Your Page Content Here -->
        {{ form_start(form) }}
        {{ form_widget(form) }}
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> löschen</button>
                <input type="submit" value="speichern" class="btn btn-default">
            </div>
            {{ form_end(form) }}

        <br><br>
        <h3>Passwort Request</h3>
        <p>Neues Passwort für den Benutzer anfordern, E-Mail wird versendet.</p>
        <a class="btn btn-default" href="{{ path('admin_password_reset_request', { 'id' : id }) }}">Passwort Request</a>

    </section><!-- /.content -->


    {# Modal Window #}
    <!-- Trigger the modal with a button -->


    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Benutzer löschen</h4>
                </div>
                <div class="modal-body">
                    <p>Benutzer löschen bestätigen</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="{{ path('admin_user_delete', { 'id' : id }) }}" class="btn btn-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> löschen</a>
                </div>
            </div>

        </div>
    </div>

{% endblock %}
```

#Benutzer löschen
#### UserController::deleteAction

Eine default Action für die das LiveTemplate "deleteAction" verwendet werden kann. Hat in der URL die ID des Formulars als GET-Request (@Route("/admin/user/delete/{id}",...). Dieser wird in der Funktion als "$id-Parameter" zugeschprochen und wird für Doctrine verwendet für das herauslesen des entsprechenden Records, welches gelöscht werden soll.

Beispielcode:
```
      /**
       * @Route("/admin/user/delete/{id}", name="admin_user_delete")
       */
       public function deleteAction($id)
       {
           $em = $this->getDoctrine()->getManager();
           $data = $em->getRepository('DevProadminBundle:user')
                   ->find($id);
           $em->remove($data);
           $em->flush();
           return $this->redirectToRoute('admin_user');
       }
```

### FormUpload



#### UserController::handleFormUpload

Eine default Action für die das LiveTemplate "handleFormUpload" verwendet werden kann. Diese Funktion wird bei den default Actionen "updateAction" und "insertAction" verwendet / initialisiert. Diese Funktion hat das Formular und die Post-Request-Daten als Parameter. Sobald das Formular valide ist, können die Daten entsprechend in der DB eingetragen werden oder bearbeitet werden. 

Anmerkung:
Je nach Zusätzen kann oder muss der "handleFormUpload" verändert werden oder extra angepasst wie bei "handleFormUploadNewUser". Er dient nur als default.

Beispielcode:
```
   /**
     * @return bool
     */
    public function handleFormUpload($form, $request)
        {
            $form->handleRequest($request);
            if ($form->isValid() && $form->isSubmitted())
            {
                $data = $form->getData();
                $em = $this->getDoctrine()->getManager();
                $em->persist($data);
                $em->flush();
                return true;
            }
        }

```

# Passwort ändern
####  /User/changePassword.html.twig

View welches das PW Change rendert

Beispielcode:
```
<!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-sm-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Passwort ändern</h3>
                        <p>Das neue Passwort muss mindestens 6 Zeichen enthalten.</p>
                    </div><!-- /.box-header -->
                    <div class="box-body">

                        {{ form_start(form) }}
                        {{ form_widget(form) }}
                            <input type="submit" value="speichern" class="btn btn-default">
                        {{ form_end(form) }}

                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>

    </section><!-- /.content -->
```

#Emails
* Neue Benutzer bekommen eine E-Mail mit Ihren Zugangsdaten
* Passwort Request, Ein Token mit Livetime wird genriert und der Benutzer bekommt eine Email mit einem Link um ein neues Passwort anzufordern.
* Neues Passwort, nach dem erfolgreichen Passwort Request bekommt der Benutzer sein neues Passwort per E-Mail zugesendet. Das Passwort wird zufällig generiert, die Länge der Zeichenkette ist Konfigurierbar.

#FormType

Für das spezifizieren des Formulars für das Bearbeiten oder neu Erfassen eines Users. Hier werden die "Form-Widgets" spezifiziert.

Beispielcode:
```
class userType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
             ->add('email', EmailType::class, array(
                             'label' => 'E-Mail',
                             'required' => true
                         ))
             ->add('dp_surname', TextType::class, array(
                             'label' => 'Vorname',
                             'required' => true
                         ))
             ->add('dp_name', TextType::class, array(
                            'label' => 'Name',
                            'required' => true
                        ))
            ->add('username', HiddenType::class, array(
                            'data' => uniqid(),
                        ))
        ;
    }
}
```

#Entity

Die Entity stellt das Model im MVC-Chargon dar. In Symfony durch Doctrine unterstütz es das ORM.
Die Entity besteht aus Constanten am Anfang, welche durch die Annotation die Werte bestimmt, welche so auch in der DB für die Tabellen Spalten übernommen werden. Danach setzt man die Getter und Setters für die späteren Doctrine-Befehle. Getters für das holen der Daten von der DB spetzifisch der Spalten und Setters für das Einfügen oder Bearbeiten der Records spezifisch der Spalte.

Beispielcode:
```
/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 * @UniqueEntity("email")
 * @UniqueEntity("username")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $dp_surname;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Mindestens {{ limit }} Zeichen länge!",
     *      maxMessage = "Maximal {{ limit }} Zeichen länge!"
     * )
     */
    protected $dp_name;
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Email(
     *     message = "Bitte eine gültige E-Mail Adresse eingeben",
     * )
     */
    protected $email;
    
    /**
     * Set dp_surname
     *
     * @param string $dpSurname
     * @return User
     */
    public function setDpSurname($dpSurname)
    {
        $this->dp_surname = $dpSurname;
        return $this;
    }
    /**
     * Get dp_surname
     *
     * @return string 
     */
    public function getDpSurname()
    {
        return $this->dp_surname;
    }
    /**
     * Set dp_name
     *
     * @param string $dpName
     * @return User
     */
    public function setDpName($dpName)
    {
        $this->dp_name = $dpName;
        return $this;
    }
    /**
     * Get dp_name
     *
     * @return string 
     */
    public function getDpName()
    {
        return $this->dp_name;
    }
}
```

# Responses

#### /User/passwordNewUserSendMail.html.twig

Nachdem man einen User erfasst hat, kommt diese Meldung / Response.

Beispielcode
```
<p>Es wurde ein Benutzer Konto erstellt. Sie können sich mit den nachfolgenden Daten einloggen.</p>
<p>Benutzer: {{ email }}</p>
<p>Passwort: {{ password }}</p>
<a href="http://{{ url }}">Zum Login</a>
```

#### /User/passwordResetSendMail.html.twig

Diese Meldung kommt, wenn man PW zurücksetzt.

Beispielcode:
```
<p>Sie haben ein neues Passwort angefordert. Bitte bestätigen Sie den Link um Ihr Passwort zurück zu setzen.</p>
<a href="{{ path('admin_password_reset_confirm', { 'confirmationToken' : token }) }}">Neues Passwort anfordern</a>
```

#### /User/passwordConfirmEmail.html.twig

Nachdem man ein neues Passwort erhalten hat, bekommt man diese Meldung.

Beispielcode:
```
<p>Ihr neues Passwort lautet: {{ password }}</p>
```

#Passwortlänge festlegen

Beispielcode:
```
<?php $foo 
```

#Email Absender Betreff Inhalt festlegen

Beispielcode:
```
<?php $foo
```

#Token Livetime festlegen

Beispielcode:
```
<?php $foo
```