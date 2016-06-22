<?php
namespace DevPro\adminBundle\Controller;

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
        $user = $this->getUser();

        $html = $this->container->get('templating')->render(
            'admin/Index/index.html.twig',
            array(
                'user' => $user
            )
        );

        return new Response($html);
    }
}