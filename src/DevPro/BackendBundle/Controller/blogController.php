<?php
namespace DevPro\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;




class blogController extends Controller
{
    /**
     * @Route("/admin/blog", name="backend_blog", options={"sitemap" = {"priority" = 0.7, "changefreq" = "daily" }})
     */
    public function indexAction()
    {
        /*
         * Neue Blog Artikel anlegen, bearbeiten, löschen
         * Übersicht aller Artikel
         * Datatables
         */

        $html = $this->container->get('templating')->render(
            'Backend/Blog/index.html.twig'
        );

        return new Response($html);
    }


}