<?php
namespace DevPro\adminBundle\Controller;

use DevPro\adminBundle\DependencyInjection\singleSorter;
use DevPro\adminBundle\Entity\blog;
use DevPro\adminBundle\Entity\BlogSeo;
use DevPro\adminBundle\Utils\DoctrineClass;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;
use DevPro\adminBundle\Form\Type\blogType;
use DevPro\adminBundle\Form\Type\BlogSeoType;

/*
 * Skeleton Überarbeitung
 * Arbeiten mit Doctrine erfolgt über neues naming, dabei verwendet wir selbe begrifflichkeiten wie wenn
 * wir einen SQL query performen.
 *
 * insert -> Datensatz in DB einfügen
 * update -> Datensatz in DB updaten
 * delete -> Datensatz in DB löschen
 * select -> Datensatz aus DB holen
 *
 * Nutzung der Live Templates, muss man sich selber anlegen.
 * action ->
 * render ->
 * insert
 * update
 * delete
 * select
 */


class blogController extends Controller
{
    
    /**
     * @Route("/admin/blog", name="admin_blog")
     */
     public function indexAction()
     {
        $data = $this->getDoctrine()->getRepository('DevProadminBundle:blog')
                ->findBy(array(), array(
                    'sort' => 'DESC'
                ));

                $html = $this->renderView(
                    'admin/blog/index.html.twig', array(
                        'data' => $data,
                        'title' => 'blog'
                    )
                );

                return new Response($html);
     }
    /**
     * @Route("/admin/blog/insert", name="admin_blog_insert")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
     public function insertAction(Request $request)
     {
        $data = new blog();
        $form = $this->createForm(blogType::class, $data);
        
        $result = $this->handleFormUpload($form, $request);
        
        if($result)
        {
            return $this->redirectToRoute('admin_blog');
        }
        
        $html = $this->renderView(
            'admin/blog/insert.html.twig', array(
                'data' => $data,
                'form' => $form->createView()
            )
        );
        
        return new Response($html);
     }

    /**
     * @Route("/admin/blog/update/{id}", name="admin_blog_update")
     * @param Request $request
     * @param Blog $blog
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
      public function updateAction(Request $request, blog $blog, $id)
      {
            $form = $this->createForm(blogType::class, $blog);

            $result = $this->handleFormUpload($form, $request);
            if($result)
            {
                return $this->redirectToRoute('admin_blog');
            }

            $html = $this->renderView(
                'admin/blog/update.html.twig', array(
                    "form" => $form->createView()
                )
            );

            return new Response($html);
        }

    /**
     * @Route("/admin/blog/delete/{id}", name="admin_blog_delete")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
       public function deleteAction($id)
       {
           $em = $this->getDoctrine()->getManager();
           $data = $em->getRepository('DevProadminBundle:blog')
                   ->find($id);

           $em->remove($data);
           $em->flush();

           return $this->redirectToRoute('admin_blog');
       }

    /**
     * @Route("/admin/blog/seo", name="backend_blog_seo")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @throws \Twig_Error
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
            'admin/Blog/seo.html.twig', array(
                "data" => '',
                "form" => $form->createView()
            )
        );

        return new Response($html);
    }

    /**
     * @param $form
     * @param $request
     * @return bool
     */
    public function handleFormUpload($form, $request)
        {
            $form->handleRequest($request);
            if ($form->isValid() && $form->isSubmitted())
            {
                $data = $form->getData();

                $em = $this->getDoctrine()->getManager();
                $em->persist($data);
                $em->flush();

                return true;
            }
        }








    //
    // Sorter old Stuff, Remove maybe

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

    public function getSetSort()
    {
        $blog = $this->getDoctrine()
            ->getRepository('DevProBackendBundle:Blog')
            ->findOneby([], ["id" => "DESC"]);

        $sort = $blog->getSort();

        return $sort;
    }
}