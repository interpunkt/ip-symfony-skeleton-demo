<?php
namespace DevPro\BackendBundle\Controller;

use DevPro\BackendBundle\DependencyInjection\singleSorter;
use DevPro\BackendBundle\Entity\Blog;
use DevPro\BackendBundle\Entity\BlogSeo;
use DevPro\BackendBundle\Utils\DoctrineClass;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;
use DevPro\BackendBundle\Form\Type\BlogType;
use DevPro\BackendBundle\Form\Type\BlogSeoType;




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
        $blogdata = $this->getDoctrine()
            ->getRepository("DevProBackendBundle:Blog")
            ->findBy([], ['sort' => 'DESC']);

        $html = $this->container->get('templating')->render(
            'Backend/Blog/index.html.twig', array(
                "data" => $blogdata
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
        $form = $this->createForm(BlogType::class, $blog);

        $result = $this->handleFormUpload($form, $request, $blog, 'neu');

        if($result)
        {
            return $this->redirectToRoute('backend_blog');
        }

        $html = $this->container->get('templating')->render(
            'Backend/Blog/new.html.twig', array(
                "data" => '',
                "form" => $form->createView()
            )
        );

        return new Response($html);
    }

    /**
     * @Route("/admin/blog/edit/{id}", name="backend_blog_edit")
     */
    public function editAction(Request $request, $id)
    {
        $blog = $this->getDoctrine()
            ->getRepository('DevProBackendBundle:Blog')
            ->find($id);

        $form = $this->createForm(BlogType::class, $blog);

        $result = $this->handleFormUpload($form, $request, $blog, 'edit');
        if($result)
        {
            return $this->redirectToRoute('backend_blog');
        }

        $html = $this->container->get('templating')->render(
            'Backend/Blog/edit.html.twig', array(
                "form" => $form->createView()
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


    /**
     * @Route("/admin/blog/seo", name="backend_blog_seo")
     */
    public function seoAction(Request $request)
    {
        $blog = $this->getDoctrine()
            ->getRepository('DevProBackendBundle:BlogSeo')
            ->find(1);

        $form = $this->createForm(BlogSeoType::class, $blog);

        $result = $this->handleFormUpload($form, $request, $blog, 'edit');

        if($result)
        {
            return $this->redirectToRoute('backend_blog_seo');
        }

        $html = $this->container->get('templating')->render(
            'Backend/Blog/seo.html.twig', array(
                "data" => '',
                "form" => $form->createView()
            )
        );

        return new Response($html);
    }

    /**
     * @Route("/admin/blog/sortup/{id}", name="backend_blog_sortup")
     */
    public function sortupAction($id)
    {
        $data = $this->getDoctrine()
            ->getRepository('DevProBackendBundle:Blog')
            ->find($id);

        $sorter = new singleSorter($this->container, 'Blog', 'DevProBackendBundle');
        $sorter->setSort($data, 'sortup');
        $sorter->flushSort();

        return $this->redirectToRoute('backend_blog');
    }

    /**
     * @Route("/admin/blog/sortdown/{id}", name="backend_blog_sortdown")
     */
    public function sortdownAction($id)
    {
        $data = $this->getDoctrine()
            ->getRepository('DevProBackendBundle:Blog')
            ->find($id);

        $sorter = new singleSorter($this->container, 'Blog', 'DevProBackendBundle');
        $sorter->setSort($data, 'sortdown');
        $sorter->flushSort();

        return $this->redirectToRoute('backend_blog');
    }

    public function handleFormUpload($form, $request, $task, $action)
    {
        $form->handleRequest($request);
        if ($form->isValid()) {

            $dataObject = $form->getData();

            if($action == 'neu')
            {
                $sort = $this->getSetSort();
                $sort++;
                $dataObject->setSort($sort);
            }


            $em = $this->getDoctrine()->getManager();
            $em->persist($dataObject);
            $em->flush();
            return true;
        }
    }

    public function getSetSort()
    {
        $blog = $this->getDoctrine()
            ->getRepository('DevProBackendBundle:Blog')
            ->findOneby([], ["id" => "DESC"]);

        $sort = $blog->getSort();

        return $sort;
    }
}