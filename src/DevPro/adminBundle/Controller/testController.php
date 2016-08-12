<?php

namespace DevPro\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class kraneController extends Controller
{
    /**
     * @Route("/krane", name="frontend_krane")
     */
    public function indexAction()
    {
        $html = $this->renderView(
            'frontend/krane/index.html.twig', array(
            )
        );

        return new Response($html);
    }

    /**
     * @Route("/krane/pneukrane", name="frontend_krane_pneukrane")
     */
    public function pneukraneAction()
    { 
      $html = $this->renderView(
        'frontend/krane/detail_pneukrane.html.twig', array(
        )
      );
      
      return new Response($html);
      }

    /**
     * @Route("/krane/raupenkrane", name="frontend_krane_raupenkrane")
     */
    public function raupenkraneAction()
    { 
       $html = $this->renderView(
        'frontend/krane/detail_raupenkrane.html.twig', array(
        )
       );
       
       return new Response($html);
       }

    /**
     * @Route("/krane/minikrane", name="frontend_krane_minikrane")
     */
    public function minikraneAction()
    { 
        $html = $this->renderView(
        'frontend/krane/detail_minikrane.html.twig', array(
        )
        );
        
        return new Response($html);
        }

    /**
     * @Route("/krane/spezialtransporte", name="frontend_krane_spezialtransporte")
     */
    public function spezialtransporteAction()
    { 
        $html = $this->renderView(
        'frontend/krane/detail_spezialtransporte.html.twig', array(
        )
        );
        
        return new Response($html);
        }

    /**
     * @Route("/krane/engineering", name="frontend_krane_engineering")
     */
    public function engineeringAction()
    { 
        $html = $this->renderView(
        'frontend/krane/detail_engineering.html.twig', array(
        )
        );
        
        return new Response($html);
        }
}