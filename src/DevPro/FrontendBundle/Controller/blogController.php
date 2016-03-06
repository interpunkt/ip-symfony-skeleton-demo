<?php
namespace DevPro\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;




class blogController extends Controller
{
    /**
     * @Route("/blog", name="frontend_blog", options={"sitemap" = {"priority" = 0.7, "changefreq" = "daily" }})
     */
    public function homepageAction()
    {
        $html = $this->container->get('templating')->render(
            'Frontend/Blog/index.html.twig'
        );

        return new Response($html);
    }


}