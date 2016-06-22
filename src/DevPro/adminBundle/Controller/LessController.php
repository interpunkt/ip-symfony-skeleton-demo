<?php
namespace DevPro\adminBundle\Controller;

use DevPro\adminBundle\Entity\Imageupload;
use DevPro\adminBundle\Entity\LessTypographie;
use DevPro\adminBundle\Entity\Settings;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use DevPro\adminBundle\Form\Type\LessTypographieType;


class LessController extends Controller
{

    /**
     * @Route("/admin/settings/less/typographie/edit/{id}", name="admin_settings_less_typographie_edit")
     */
    public function setLessTestAction(Request $request, $id)
    {
        $lessEntity = $this->getDoctrine()
            ->getRepository('DevProBackendBundle:LessTypographie')
            ->find($id);

        $form = $this->createForm(LessTypographieType::class, $lessEntity);

        $result = $this->handleFormUploadLess($form, $request, $lessEntity);

        if($result)
        {
            $html = $this->container->get('templating')->render(
                'Backend/Settings/typographie.html.twig',array(
                    "form" => $form->createView(),
                    "save" => true
                )
            );

            return new Response($html);
        }

        $html = $this->container->get('templating')->render(
            'Backend/Settings/typographie.html.twig',array(
                "form" => $form->createView()
            )
        );

        return new Response($html);
    }

    public function handleFormUploadLess($form, $request, $task)
    {
        $form->handleRequest($request);
        if ($form->isValid()) {

            $dataObject = $form->getData();

            $less = new \lessc();
            $lesscode = file_get_contents("assets/less/layout.less");
            $lesscode .= '@primary-color: '. $dataObject->getPrimaryColor() .';';
            $lesscode .= '@secondary-color: '. $dataObject->getSecondaryColor() .';';
            $lesscode .= '@highlight-success: '. $dataObject->getHighlightSuccess() .';';
            $lesscode .= '@font-family: '. $dataObject->getFontFamily() .';';
            $lesscode .= '@h1: '. $dataObject->getH1() .';';
            $lesscode .= '@h2: '. $dataObject->getH2() .';';
            $lesscode .= '@h3: '. $dataObject->getH3() .';';
            $lesscode .= '@font-size: '. $dataObject->getFontSize() .';';
            file_put_contents("assets/less/main.css", $less->compile($lesscode));

            $em = $this->getDoctrine()->getManager();
            $em->persist($dataObject);
            $em->flush();
            return true;
        }
    }
}