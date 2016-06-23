<?php
namespace DevPro\adminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use DevPro\adminBundle\Form\Type\userType;


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
                    'admin/user/index.html.twig', array(
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

        $result = $this->handleFormUpload($form, $request);

        if($result)
        {
            return $this->redirectToRoute('admin_user');
        }

        $html = $this->renderView(
            'admin/user/insert.html.twig', array(
                'data' => $data,
                'form' => $form->createView()
            )
        );

        return new Response($html);
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
                    "form" => $form->createView()
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
}