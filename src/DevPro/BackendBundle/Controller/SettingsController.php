<?php
namespace DevPro\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class SettingsController extends Controller
{

    /**
     * @Route("/admin/settings", name="admin_settings")
     */
    public function indexAction()
    {
        $user = $this->getUser();

        $html = $this->container->get('templating')->render(
            'Backend/Settings/index.html.twig',
            array(
                'user' => $user
            )
        );

        return new Response($html);
    }
}