<?php
namespace DevPro\adminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use DevPro\adminBundle\Entity\update;

class updateController extends Controller
{
    private $token = 'uAjL8swUx3FsHtF';

    /**
     * @Route("/admin/update", name="admin_update")
     */
     public function indexAction()
     {

         $id = 1;
        $data = $this->getDoctrine()->getRepository('DevProadminBundle:update')
                ->find($id);

         if( ! $data)
         {
             throw $this->createNotFoundException('keine Daten gefunden');
         }

         $jsonResponse = $this->updateCheck($data);

                $html = $this->renderView(
                    'admin/update/index.html.twig', array(
                        'data' => $jsonResponse,
                        'title' => 'update'
                    )
                );

                return new Response($html);
     }

    protected function updateCheck($version)
    {
        $versionNew = $version->getVersion();
        $check = file_get_contents('http://updateskeleton.interpunkt-test.ch/?dp_token=' . $this->token . '&dp_version=' . $versionNew);
        $json = json_decode($check);

            return $json;

    }

    /**
     * @Route("/admin/update/install", name="admin_update_install")
     */
    public function installAction()
    {
        // Save Zip File in tmp
        $version = $this->getCurrentVersion();

        $check = file_get_contents('http://updateskeleton.interpunkt-test.ch/?dp_token=' . $this->token . '&dp_version=' . $version);
        $json = json_decode($check);

        $file = file_get_contents('http://' . $json->updateUrl);

        file_put_contents('assets/updates/' . $version . '.zip', $file);



    }

    protected function getCurrentVersion()
    {
        $data = $this->getDoctrine()->getRepository('DevProadminBundle:update')
            ->find(1);

        if( ! $data)
        {
            throw $this->createNotFoundException('keine Daten gefunden');
        }

        return $data->getVersion();
    }

}