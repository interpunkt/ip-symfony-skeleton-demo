<?php
namespace DevPro\adminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use DevPro\adminBundle\Form\Type\userType;
use DevPro\adminBundle\Entity\User;


class userController extends Controller
{
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
            sendEmailToNewUserWithLoginData($result);

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

    private function sendEmailToNewUserWithLoginData($user)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Hello Email')
            ->setFrom('send@example.com')
            ->setTo('recipient@example.com')
            ->setBody(
                $this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                    'admin/User/passwordNewUserSendMail.html.twig',
                    array('password' => $user->getPlainPassword())
                ),
                'text/html'
            );

        $this->get('mailer')->send($message);

        return true;
    }

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

    /**
     * @return bool
     */
    public function handleFormUploadNewUser($form, $request)
    {
        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted())
        {
            $data = $form->getData();

            // generate a new Password
            $password = uniqid();

            // get Usermanager
            $userManager = $this->container->get('fos_user.user_manager');
            $user = $userManager->createUser();
            $user->addRole('ROLE_ADMIN');
            $user->setEmail($data->getEmail());
            $user->setEnabled(true);
            $user->setPlainPassword($password);

            $userManager->createUser($user);

            return $user;
        }
    }


//////////////////////////////////////////////////////////////////////////
// Erweiterung UserController spezifisch
// Da eine Benutzerverwaltung in allen Projekten vorhanden ist befindet sich dieser teil im Core der Applikation.
//////////////////////////////////////////////////////////////////////////

    /**
     * @Route("/admin/user/password/resetrequest/{id}", name="admin_password_reset_request")
     */
    public function requestNewPassword($id)
    {
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->findUserBy(array(
           'id' => $id
        ));

        $user->setConfirmationToken(uniqid());
        $user->setPasswordRequestedAt(new \DateTime("now"));
        $userManager->updateUser($user);

        $this->sendEmailForNewPasswordRequest($user);

        return $this->redirectToRoute('admin_user');
    }

    private function sendEmailForNewPasswordRequest($user)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Hello Email')
            ->setFrom('send@example.com')
            ->setTo('recipient@example.com')
            ->setBody(
                $this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                    'admin/User/passwordResetSendMail.html.twig',
                    array('token' => $user->getConfirmationToken())
                ),
                'text/html'
            );

        $this->get('mailer')->send($message);
    }

    /**
     * @Route("/frontend/user/password/reset/{confirmationToken}", name="admin_password_reset_confirm")
     */
    public function passwordReset($confirmationToken)
    {
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->findUserByConfirmationToken($confirmationToken);

        if( ! $user)
        {
            $html = $this->renderView(
                ':Frontend/User:confirmPasswortReset.html.twig', array(
                    "success" => false
                )
            );

            return new Response($html);
        }

        $newPassword = uniqid();
        $user->setPlainPassword($newPassword);

        // Neues Passwort an User senden
        $message = \Swift_Message::newInstance()
            ->setSubject('Passwort Anforderung')
            ->setFrom('send@example.com')
            ->setTo('recipient@example.com')
            ->setBody(
                $this->renderView(
                    'admin/User/passwordResetSendMail.html.twig',
                    array('passwort' => $newPassword)
                ),
                'text/html'
            );

        $this->get('mailer')->send($message);

        $html = $this->renderView(
            ':Frontend/User:confirmPasswortReset.html.twig', array(
                "success" => true
            )
        );

        return new Response($html);
    }

}