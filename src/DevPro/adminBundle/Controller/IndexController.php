<?php
namespace DevPro\adminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class IndexController extends Controller
{

    /**
     * @Route("/admin/", name="admin_index")
     */
    public function indexAction()
    {
        $user = $this->getUser();

        $html = $this->container->get('templating')->render(
            'admin/Index/index.html.twig',
            array(
                'user' => $user
            )
        );

        return new Response($html);
    }

    /**
     * @Route("admin/index/gridsave", name="admin_index_grid_save")
     * @Method({"POST"})
     */
    public function saveGridAction(Request $request)
    {
        $customId  = $request->request->get('id', null); // json-string
        $x = $request->request->get('x', null);
        $y = $request->request->get('y', null);
        $width = $request->request->get('width', null);
        $height = $request->request->get('height', null);
        $content = $request->request->get('content', null);

        $response = new JsonResponse();
        $response->setData(array(
            'x' => $x,
            'y' => $y,
            'width' => $width,
            'height' => $height,
            'content' => $content
        ));
        return $response;
    }
}