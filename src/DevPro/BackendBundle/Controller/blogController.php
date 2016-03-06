<?php
namespace DevPro\BackendBundle\Controller;

use DevPro\BackendBundle\Utils\DoctrineClass;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;




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
        $get_repository = new DoctrineClass($this->container, 'Blog');
        $repository = $get_repository->fetchAll();


        $html = $this->container->get('templating')->render(
            'Backend/Blog/index.html.twig', array(
                "data" => $repository
            )
        );

        return new Response($html);
    }


}