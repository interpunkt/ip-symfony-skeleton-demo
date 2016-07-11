<?php
namespace DevPro\adminBundle\Controller;

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
     */
    public function userSettingsAction(Request $request)
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
     */
    public function updateAction(Request $request, $id)
    {
        $data = $this->getDoctrine()
            ->getRepository('DevProadminBundle:userSettings')
            ->find($id);

        $form = $this->createForm(userSettingsType::class, $data);

        $result = $this->handleFormUpload($form, $request);
        if($result)
        {
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
}