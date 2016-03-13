<?php
namespace DevPro\FrontendBundle\Controller;

use Proxies\__CG__\DevPro\BackendBundle\Entity\BlogSeo;
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
        $blog = $this->getDoctrine()
            ->getRepository('DevProBackendBundle:Blog')
            ->findAll();

        $seo = $this->getDoctrine()
            ->getRepository('DevProBackendBundle:BlogSeo')
            ->findAll();

        $html = $this->container->get('templating')->render(
            'Frontend/Blog/index.html.twig', array(
                "data" => $blog,
                "seotitel" => $seo[0]->getSeoTitel(),
                "seodescription" => $seo[0]->getSeoDescription()
            )
        );

        return new Response($html);
    }


}