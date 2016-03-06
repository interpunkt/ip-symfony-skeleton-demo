<?php
namespace DevPro\BackendBundle\Controller;

use DevPro\BackendBundle\Entity\Blog;
use DevPro\BackendBundle\Utils\DoctrineClass;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;




class blogController extends Controller
{
    /**
     * @Route("/admin/blog", name="backend_blog")
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


    /**
     * @Route("/admin/blog/new", name="backend_blog_new")
     */
    public function newAction(Request $request)
    {
        $blog = new Blog();
        $form = $this->createForm();

        $html = $this->container->get('templating')->render(
            'Backend/Blog/new.html.twig', array(
                "data" => ''
            )
        );

        return new Response($html);
    }

    /**
     * @Route("/admin/blog/edit", name="backend_blog_edit")
     */
    public function editAction()
    {
        $html = $this->container->get('templating')->render(
            'Backend/Blog/edit.html.twig', array(
                "data" => ''
            )
        );

        return new Response($html);
    }

    /**
     * @Route("/admin/blog/delete", name="backend_blog_delete")
     */
    public function deleteAction()
    {

    }
}