<?php
namespace DevPro\BackendBundle\Controller;

use DevPro\BackendBundle\Entity\Imageupload;
use DevPro\BackendBundle\Entity\Settings;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

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



            //var_dump($files_2);
            // generate random image name
            //$imageName = rand(1000000, 9999999);
            //$product->setImageName($imageName);
            //$product->setImageFile($file_image);

            $em = $this->getDoctrine()->getManager();
            $em->persist($Imageupload);
            $em->flush();
            //$files =  $request->files->all();
            //echo '<pre>';
            //var_dump($files['attachment']);
            //echo '</pre>';

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
            throw $this->createNotFoundException(
                'No product found for id '
            );
        }

        $path = $settings->getLogopath();
        return new Response('<img src="../assets/img/uploads/' . $path . '" alt="Logo">');

        //return $this->render(
        //    'Frontend/layout_backend.html.twig',
        //    array('settings_logo' => $settings)
        //);
    }
}