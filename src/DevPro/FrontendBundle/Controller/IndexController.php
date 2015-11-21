<?php
namespace DevPro\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;




class IndexController extends Controller
{
    /**
     * @Route("/", name="index" options={"sitemap" = true})
     */
    public function homepageAction()
    {
        $html = $this->container->get('templating')->render(
            'Frontend/Index/index.html.twig'
        );

        return new Response($html);
    }


}
