<?php
namespace DevPro\adminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use DevPro\adminBundle\Form\Type\userType;
use DevPro\adminBundle\Entity\User;
use DevPro\adminBundle\DependencyInjection\PWGen;

class userController extends Controller
{
    /**
     * @Route(" /admin/user", name="admin_user")
     * @return RedirectResponse|Response
     */
     public function indexAction()
     {
        $data = $this->getDoctrine()->getRepository('DevProadminBundle:user')
            ->findBy(array(), array(
                'id' => 'DESC'
            ));

            $html = $this->renderView(
                'admin/user/index.html.twig', array(
                    'data' => $data,
                    'title' => 'user'
                )
            );

        return new Response($html);
     }

    /**
     * @Route("/admin/user/insert", name="admin_user_insert")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function insertAction(Request $request)
    {
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->createUser();
        //$user = new user();
        //$user->setPlainPassword(uniqid());

        $form = $this->createForm(new userType($this->get('service_container')), $user);

        $result = $this->handleFormUploadNewUser($form, $request, $user);

        if($result)
        {
            // send Email to user with Login Data
            $this->sendEmailToNewUserWithLoginData($result);

            $this->addFlash('success', 'Der neue Benutzer wurde erfolgreich angelegt, eine Email mit den Zugangsdaten wurde versendet!');

            return $this->redirectToRoute('admin_user');
        }

        $html = $this->renderView(
            'admin/user/insert.html.twig', array(
                'data' => $user,
                'form' => $form->createView()
            )
        );

        return new Response($html);
    }

    /**
    * @Route("/admin/user/update/{id}", name="admin_user_update")
    * @param Request $request
    * @param User $user
    * @param $id
    * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
    */
    public function updateAction(Request $request, User $user, $id)
    {
        $form = $this->createForm(new userType($this->get('service_container')), $user);

        $result = $this->handleFormUpload($form, $request);

        if($result)
        {
            $this->addFlash('success', 'Benutzer erfolgreich gespeichert');
            return $this->redirectToRoute('admin_user');
        }

        $html = $this->renderView(
            'admin/user/update.html.twig', array(
                "form" => $form->createView(),
                'id' => $id,
                'title' => 'Benutzer'
            )
        );

        return new Response($html);
    }

    /**
     * @Route("/admin/user/delete/{id}", name="admin_user_delete")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction($id, User $user)
    {
        if(!$user)
        {
           throw $this->createNotFoundException('user nicht gefunden, ID: ' . $id);
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        $this->addFlash('success', 'Benutzer wurde gelöscht');

        return $this->redirectToRoute('admin_user');
    }

    /**
     * @param Form $form
     * @param $request
     * @return bool
     */
    public function handleFormUpload(Form $form, $request)
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

    /**
     * @param Form $form
     * @param Request $request
     * @param User $user
     * @return array
     */
    public function handleFormUploadNewUser(Form $form, Request $request, User $user)
    {
        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted())
        {
            $userManager = $this->container->get('fos_user.user_manager');
            $data = $form->getData();

            // generate a new Password with PWGen, Password length 6
            $password = $this->generateNewPassword(6);

            // get Usermanager
            //$userManager = $this->container->get('fos_user.user_manager');
            //$user = $userManager->createUser();
            $user->addRole('ROLE_ADMIN');
            $user->setEmail($data->getEmail());
            $user->setEnabled(true);
            $user->setUsername(uniqid());
            $user->setPlainPassword($password);
            // $user->setSalt(base_convert(sha1(uniqid(mt_rand(), true)), 16, 36));

            $userManager->updateUser($user);
            $this->getDoctrine()->getManager()->flush();

            $userData = array(
                'email' => $data->getEmail(),
                'password' => $password
            );

            return $userData;
        }
    }


    //////////////////////////////////////////////////////////////////////////
    // Erweiterung UserController spezifisch
    // Da eine Benutzerverwaltung in allen Projekten vorhanden ist befindet sich dieser teil im Core der Applikation.
    //////////////////////////////////////////////////////////////////////////
    /**
     * @Route("/admin/user/password/resetrequest/{id}", name="admin_password_reset_request")
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function requestNewPassword(Request $request, $id)
    {
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->findUserBy(array(
           'id' => $id
        ));

        if( ! $user)
        {
            throw $this->createNotFoundException('User not found on Password Reset Request!');
        }

        $user->setConfirmationToken(uniqid());
        $user->setPasswordRequestedAt(new \DateTime("now"));
        $userManager->updateUser($user);

        $this->sendEmailForNewPasswordRequest($user);
        $request->getSession()->getFlashBag()->add('success', 'Passwort Request erfolgt!');


        return $this->redirectToRoute('admin_user');
    }

    /**
     * @param $user
     */
    private function sendEmailForNewPasswordRequest($user)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Passwort Anforderung')
            ->setFrom('webmaster@' . $_SERVER['SERVER_NAME'])
            ->setTo($user->getEmail())
            ->setBody(
                $this->renderView(
                    'admin/user/passwordResetSendMail.html.twig',
                    array('token' => $user->getConfirmationToken())
                ),
                'text/html'
            );

        $this->get('mailer')->send($message);
    }

    /**
     * @Route("/frontend/user/password/reset/{confirmationToken}", name="admin_password_reset_confirm")
     * @param $confirmationToken
     * @return Response
     */
    public function passwordReset($confirmationToken)
    {
        // Zeit prüfen ob Token noch nicht abgelaufen ist.

        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->findUserByConfirmationToken($confirmationToken);

        if( ! $user)
        {
            $html = $this->renderView(
                ':frontend/user:confirmPasswortReset.html.twig', array(
                    "success" => false
                )
            );

            return new Response($html);
        }

        $newPassword = $this->generateNewPassword(6);
        $user->setPlainPassword($newPassword);

        // Neues Passwort an user senden
        $message = \Swift_Message::newInstance()
            ->setSubject('Neues Passwort')
            ->setFrom('webmaster@' . $_SERVER['SERVER_NAME'])
            ->setTo($user->getEmail())
            ->setBody(
                $this->renderView(
                    'frontend/user/newPasswordSendMail.html.twig',
                    array('password' => $newPassword)
                ),
                'text/html'
            );

        $this->get('mailer')->send($message);

        // Passwort Token löschen

        $html = $this->renderView(
            'frontend/user/confirmPasswortReset.html.twig', array(
                "success" => true
            )
        );

        return new Response($html);
    }

    /**
     * @param $user
     * @return bool
     * Send a E-Mail withe the Login Data to the new user
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
                    'admin/user/passwordNewUserSendMail.html.twig',
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

    /**
     * @param $passwordLength
     * @return mixed
     * Genrate a New Password for New user or Password reset
     */
    private function generateNewPassword($passwordLength)
    {
        // generate a new Password with PWGen
        $passwordGenerator = new PWGen();
        $passwordGenerator->setLength(6);
        $password = $passwordGenerator->generate();

        return $password;
    }

    /**
     * @Route("/admin/user/profil", name="admin_user_profil")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function userProfilAction(Request $request)
    {
        $data = $this->getDoctrine()->getRepository('DevProadminBundle:user')
            ->find($this->getUser()->getId());

        $form = $this->createForm(profileType::class, $data);

        $result = $this->handleFormUpload($form, $request);

        if($result)
        {
            return $this->redirectToRoute('admin_user_profil');
        }

        $html = $this->renderView(
            'admin/user/profil.html.twig', array(
                'data' => $data,
                'title' => 'user_profil',
                'form' => $form->createView()
            )
        );

        return new Response($html);
    }

    /**
     * @Route("/admin/user/profil/changepassword", name="admin_user_profil_change_password")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function userProfilChangePasswordAction(Request $request)
    {
        $data = $this->getDoctrine()->getRepository('DevProadminBundle:user')
            ->find($this->getUser()->getId());

        $form = $this->createForm('fos_user_change_password', $data);

        //$form = $this->createForm(userProfilChangePasswordType::class, $data);

        $result = $this->handleFormUploadChangePassword($form, $request);

        if($result)
        {
            if($result === 'failed')
            {
                return $this->redirectToRoute('admin_user_profil_change_password');
            }
            return $this->redirectToRoute('admin_user_profil');
        }

        $html = $this->renderView(
            'admin/user/changePassword.html.twig', array(
                'data' => $data,
                'title' => 'user_profil',
                'form' => $form->createView()
            )
        );

        return new Response($html);
    }

    /**
     * @param Form $form
     * @param $request
     * @return bool
     */
    public function handleFormUploadChangePassword(Form $form, Request $request)
    {
        $form->handleRequest($request);
        if ($form->isValid() && $form->isSubmitted())
        {
            $data = $form->getData();

            $passwordLength = strlen($request->request->get('fos_user_change_password')['plainPassword']['first']);
            if($passwordLength < 6)
            {
                $request->getSession()
                    ->getFlashBag()
                    ->add('failed', 'Das neue Passwort muss mindesten 6 Zeichen lang sein!');

                return 'failed';
            }

            $userManager = $this->container->get('fos_user.user_manager');
            $userManager->updatePassword($data);

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('success', 'Das Passwort wurde erfolgreich geändert!');

            return true;
        }
    }


}