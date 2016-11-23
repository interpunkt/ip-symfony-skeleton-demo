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
    public function homepageAction(Request $request)
    {
        $em    = $this->get('doctrine.orm.entity_manager');
        $dql   = 'SELECT a FROM DevProadminBundle:blog a ORDER BY a.sort DESC' ;
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );


        $blog = $this->getDoctrine()
            ->getRepository('DevProadminBundle:blog')
            ->findAll();

        $seo = $this->getDoctrine()
            ->getRepository('DevProadminBundle:BlogSeo')
            ->findAll();

        $html = $this->container->get('templating')->render(
            'frontend/blog/index.html.twig', array(
                "data" => $blog,
                "seotitel" => $seo[0]->getSeoTitel(),
                "seodescription" => $seo[0]->getSeoDescription(),
                'pagination' => $pagination
            )
        );

        return new Response($html);
    }


}