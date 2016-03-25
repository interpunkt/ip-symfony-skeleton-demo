<?php
namespace DevPro\FrontendBundle\Controller;

use DevPro\BackendBundle\DependencyInjection\singleSorter;
use DevPro\BackendBundle\Entity\Blog;
use DevPro\BackendBundle\Entity\BlogSeo;
use DevPro\BackendBundle\Utils\DoctrineClass;
use DevPro\FrontendBundle\Entity\Kontaktformular;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;
use DevPro\FrontendBundle\Form\Type\KontaktformularType;
use DevPro\BackendBundle\Form\Type\BlogSeoType;




class KontaktformularController extends Controller
{
    /**
     * @Route("/kontaktformular/testsend", name="frontend_kontaktformular")
     */
    public function indexAction()
    {

        $htmlbody = '<p>Hello World</p>';
        $mailer = $this->get('app.mailer');
        $mailer->sendmail('ryan@foobar.net', $htmlbody);

        /*$result = $this->handleFormUpload($form, $request, $data, 'neu');

        if($result)
        {
            return $this->redirectToRoute('backend_blog');
        }
*/
        $html = $this->container->get('templating')->render(
            'Frontend/Kontakt/kontaktformular.html.twig', array(
                "data" => ''
            )
        );

        return new Response('<body>hello world</body>');
    }


    // send Mail wenn Form Valid
    public function handleFormUpload($form, $request, $task, $action)
    {
        $form->handleRequest($request);
        if ($form->isValid()) {

            $mailer = $this->get('app.mailer');
            $mailer->send('ryan@foobar.net');

            return true;
        }
    }

}