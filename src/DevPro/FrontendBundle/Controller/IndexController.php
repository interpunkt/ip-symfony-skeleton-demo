<?php
namespace DevPro\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;




class IndexController extends Controller
{
    /**
     * @Route("/", name="index", options={"sitemap" = {"priority" = 0.7, "changefreq" = "weekly" }})
     */
    public function homepageAction()
    {
        $html = $this->container->get('templating')->render(
            'Frontend/Index/index.html.twig'
        );

        return new Response($html);
    }


}
