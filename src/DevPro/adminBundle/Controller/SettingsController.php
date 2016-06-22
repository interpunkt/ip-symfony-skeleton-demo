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


class SettingsController extends Controller
{

    /**
     * @Route("/admin/settings", name="admin_settings")
     */
    public function indexAction(Request $request)
    {
        $user = $this->getUser();

        $form = $this->uploadLogo();

        $this->handleFormUpload($form, $request);


        $html = $this->container->get('templating')->render(
            'Backend/Settings/index.html.twig',
            array(
                'user' => $user,
                'form' => $form->createView(),
            )
        );

        return new Response($html);
    }


    // Logo upload
    public function uploadLogo()
    {
        $form = $this->createFormBuilder()
            ->add('attachment', 'file', array(
                    'label' => 'Logo hochladen',
                    'required' => false,
                    'label_attr' => array(
                        'class' => 'fileupload'
                    ),
                    'attr' => array(
                        'class' => 'fileupload'
                    )
                )
            )
            ->add('save', 'submit', array(
                'label' => 'Logo upload',
                'attr' => array(
                    'class' => 'button button--success article_save_btn'
                )
            ))
            ->getForm();

        return $form;
    }

    // hand logo Post Request
    public function handleFormUpload($form, $request)
    {
        $form->handleRequest($request);
        if ($form->isValid()) {
            // perform some action, such as saving the task to the database
            $data = $this->get('request')->request->get('form');
            $Imageupload = new Imageupload();


            // get uploaded pic
            $files = $request->files->get('form');
            if (isset($files['attachment'])) {
                $file_image = $files['attachment'];
                $Imageupload->setImageFile($file_image);

            }


            $em = $this->getDoctrine()->getManager();
            $em->persist($Imageupload);
            $em->flush();

            $settings = $this->getDoctrine()
                ->getRepository('DevProBackendBundle:Settings')
                ->find(1);

            $settings->setLogopath($Imageupload->getImageName());

            $em = $this->getDoctrine()->getManager();
            $em->persist($settings);
            $em->flush();

            return $this->redirect('/admin/settings');
        }
    }

    /**
     * @Route("/admin/logo", name="admin_logo")
     */
    public function getlogoAction()
    {
         $settings = $this->getDoctrine()
            ->getRepository('DevProBackendBundle:Settings')
            ->find(1);

        if (!$settings) {
            return new Response('placeholder.jpg');
        }

        $path = $settings->getLogopath();
        return new Response($path);

        //return $this->render(
        //    'Frontend/layout_backend.html.twig',
        //    array('settings_logo' => $settings)
        //);
    }

    /**
     * @Route("/admin/settings/less/edit/{id}", name="admin_settings_less_edit")
     */
    public function setLessTestAction(Request $request, $id)
    {


        $html = $this->container->get('templating')->render(
            'Backend/Settings/setless.html.twig',array(
                "form" => $form->createView()
            )
        );

        return new Response($html);
    }

    /**
     * @Route("/admin/less", name="admin_setless")
     */
    public function setLessAction()
    {
        $less = new \lessc();

        $less->setVariables(array(
            "color" => "green",
            "base" => "960px"
        ));

        $lesscode = file_get_contents("assets/less/layout.less");
        $lesscode .= "@color: #000055;";

        file_put_contents("assets/less/main.css", $less->compile($lesscode));

        return new Response('<p class="magic">compiled, foo</p>');
    }

    public function handleFormUploadLess($form, $request, $task)
    {
        $form->handleRequest($request);
        if ($form->isValid()) {

            $dataObject = $form->getData();

            $less = new \lessc();
            $lesscode = file_get_contents("assets/less/layout.less");
            $lesscode .= '@primary-color: '. $dataObject->getPrimaryColor() .' !important;';
            $lesscode .= '@secondary-color: '. $dataObject->getSecondaryColor() .';';
            $lesscode .= '@text-color: '. $dataObject->getTextColor() .';';
            $lesscode .= '@text-color-class: '. $dataObject->getTextColorClass() .';';
            $lesscode .= '@highlight-success: '. $dataObject->getHighlightSuccess() .';';
            $lesscode .= '@h1: '. $dataObject->getHighlightSuccess() .';';
            file_put_contents("assets/less/main.css", $less->compile($lesscode));

            $em = $this->getDoctrine()->getManager();
            $em->persist($dataObject);
            $em->flush();
            return true;
        }
    }
}