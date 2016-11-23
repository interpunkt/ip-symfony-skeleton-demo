<?php
namespace DevPro\adminBundle\Controller;

use DevPro\adminBundle\Entity\Imageupload;
use DevPro\adminBundle\Entity\Less;
use DevPro\adminBundle\Entity\Settings;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use DevPro\adminBundle\Form\Type\LessType;


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
                'admin/settings/setless.html.twig',array(
                    "form" => $form->createView(),
                    "save" => true
                )
            );

            return new Response($html);
        }

        $html = $this->container->get('templating')->render(
            'admin/seo/index.html.twig',
            array(
                'user' => $user,
                'form' => $form->createView(),
            )
        );

        return new Response($html);
    }
}