<?php
namespace DevPro\BackendBundle\Controller;

use DevPro\BackendBundle\DependencyInjection\singleSorter;
use DevPro\BackendBundle\Utils\DoctrineClass;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;
use DevPro\BackendBundle\Entity\Newsletter;;
use DevPro\BackendBundle\Form\Type\NewsletterType;
use DevPro\BackendBundle\Newsletter\NewsletterManager;
use DevPro\BackendBundle\Entity\NewsletterEmpfaenger;
use DevPro\BackendBundle\Form\Type\NewsletterPersonenType;




class NewsletterPersonenController extends Controller
{

    /**
     * @Route("/admin/newsletter/personen", name="backend_newsletter_personen")
     */
    public function indexAction()
    {

        $data = $this->getDoctrine()
            ->getRepository("DevProBackendBundle:NewsletterEmpfaenger")
            ->findBy([], ['nachname' => 'ASC']);

        $html = $this->container->get('templating')->render(
            'Backend/Newsletter/Personen/index.html.twig', array(
                "data" => $data
            )
        );

        return new Response($html);
    }


    /**
     * @Route("/admin/newsletter/personen/new", name="backend_newsletter_personen_new")
     */
    public function newAction(Request $request)
    {
        $data = new NewsletterEmpfaenger();
        $form = $this->createForm(NewsletterPersonenType::class, $data);

        $result = $this->handleFormUpload($form, $request, $data, 'neu');

        if($result)
        {
            return $this->redirectToRoute('backend_newsletter_personen');
        }

        $html = $this->container->get('templating')->render(
            'Backend/Newsletter/Personen/new.html.twig', array(
                "data" => '',
                "form" => $form->createView()
            )
        );

        return new Response($html);
    }

    /**
     * @Route("/admin/newslettter/personen/edit/{id}", name="backend_newsletter_personen_edit")
     */
    public function editAction(Request $request, $id)
    {
        $data = $this->getDoctrine()
            ->getRepository('DevProBackendBundle:NewsletterEmpfaenger')
            ->find($id);

        $form = $this->createForm(NewsletterType::class, $data);

        $result = $this->handleFormUpload($form, $request, $data, 'edit');
        if($result)
        {
            return $this->redirectToRoute('backend_newsletter_personen');
        }

        $html = $this->container->get('templating')->render(
            'Backend/Newsletter/Personen/edit.html.twig', array(
                "form" => $form->createView()
            )
        );

        return new Response($html);
    }


    /**
     * @Route("/admin/newsletter/personen/delete/{id}", name="backend_newsletter_personen_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $data = $em
            ->getRepository('DevProBackendBundle:NewsletterEmpfaenger')
            ->find($id);

        $em->remove($data);
        $em->flush();

        return $this->redirectToRoute('backend_newsletter_personen');
    }



    public function handleFormUpload($form, $request, $task, $action)
    {
        $form->handleRequest($request);
        if ($form->isValid()) {

            $dataObject = $form->getData();


            $em = $this->getDoctrine()->getManager();
            $em->persist($dataObject);
            $em->flush();
            return true;
        }
    }


}