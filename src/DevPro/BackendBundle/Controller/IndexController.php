<?php
namespace DevPro\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{

    /**
     * @Route("/admin/", name="admin_index")
     */
    public function indexAction()
    {
        $html = $this->container->get('templating')->render(
            'Backend/Index/index.html.twig'
        );

        return new Response($html);
    }
}