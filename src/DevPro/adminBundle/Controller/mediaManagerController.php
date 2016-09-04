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
use FM\ElfinderBundle\Form\Type\ElFinderType;
use DevPro\adminBundle\Form\Type\MediaManagerType;
use FM\ElfinderBundle\Event\ElFinderEvents;
use FM\ElfinderBundle\Event\ElFinderPreExecutionEvent;
use FM\ElfinderBundle\Event\ElFinderPostExecutionEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;

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


class mediaManagerController extends Controller
{

    /**
     * @Route("/admin/mediamanager", name="admin_mediamanager")
     * @return Response
     */
    public function indexAction()
    {

        $form = $this->createForm(MediaManagerType::class);

        $html = $this->renderView(
            'admin/Media/index.html.twig', array(
                'title' => 'Media Manager',
                'form' => $form->createView(),
            )
        );

        return new Response($html);
    }

}