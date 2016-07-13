<?php
namespace DevPro\adminBundle\Controller;

use DevPro\adminBundle\Entity\userSettings;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use DevPro\adminBundle\Form\Type\userType;
use DevPro\adminBundle\Entity\User;
use DevPro\adminBundle\DependencyInjection\PWGen;
use DevPro\adminBundle\Form\Type\userProfilChangePasswordType;
use DevPro\adminBundle\Form\Type\userSettingsType;

class userSettingsController extends Controller
{
    /**
     * @Route("/admin/user/settings", name="admin_user_settings")
     * @return Response
     */
    public function userSettingsAction()
    {
        $data = $this->getDoctrine()->getRepository('DevProadminBundle:userSettings')
            ->findBy(array(), array(
                'id' => 'DESC'
            ));

        if( ! $data)
        {
            throw $this->createNotFoundException('Keine Datensätze gefunden!');
        }

        $html = $this->renderView(
            'admin/User/settings/index.html.twig', array(
                'data' => $data,
                'title' => 'user_settings'
            )
        );

        return new Response($html);
    }
    /**
     * @Route("/admin/user/settings/update/{id}", name="admin_user_settings_update")
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function updateAction(Request $request, userSettings $userSettings, $id)
    {

        $form = $this->createForm(userSettingsType::class, $userSettings);

        $result = $this->handleFormUpload($form, $request);

        if($result)
        {
            $this->addFlash('success', 'update erfolgreich!')
            return $this->redirectToRoute('admin_user');
        }

        $html = $this->renderView(
            'admin/User/settings/update.html.twig', array(
                "form" => $form->createView(),
                'id' => $id,
                'title' => 'Benutzer'
            )
        );

        return new Response($html);
    }

    /**
     * @Route("/admin/user/settings/delete/{id}", name="admin_user_settings_delete")
     * @param $id
     * @param userSettings $userSettings
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction($id, userSettings $userSettings)
    {
        if( ! $userSettings)
        {
            throw $this->createNotFoundException('Usersettings nicht gefunden, ID: ' . $id);
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($userSettings);
        $em->flush();

        return $this->redirectToRoute('admin_user');
    }

    /**
     * @param $form
     * @param $request
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
}