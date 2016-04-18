<?php
namespace DevPro\BackendBundle\Controller;

use DevPro\BackendBundle\Entity\Imageupload;
use DevPro\BackendBundle\Entity\Less;
use DevPro\BackendBundle\Entity\Settings;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use DevPro\BackendBundle\Form\Type\LessType;


class SeoController extends Controller
{

    /**
     * @Route("/admin/seo", name="admin_seo")
     */
    public function indexAction(Request $request)
    {

        $lessEntity = $this->getDoctrine()
            ->getRepository('DevProBackendBundle:Less')
            ->find(1);

        $form = $this->createForm(LessType::class, $lessEntity);

        $result = $this->handleFormUploadLess($form, $request, $lessEntity);

        if($result)
        {
            $html = $this->container->get('templating')->render(
                'Backend/Settings/setless.html.twig',array(
                    "form" => $form->createView(),
                    "save" => true
                )
            );

            return new Response($html);
        }

        $html = $this->container->get('templating')->render(
            'Backend/Seo/index.html.twig',
            array(
                'user' => $user,
                'form' => $form->createView(),
            )
        );

        return new Response($html);
    }
}