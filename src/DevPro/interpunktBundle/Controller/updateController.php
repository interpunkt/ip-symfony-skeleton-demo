<?php
namespace DevPro\interpunktBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use DevPro\interpunktBundle\Entity\update;
use ZipArchive;

class updateController extends Controller
{
    private $token = 'uAjL8swUx3FsHtF';

    /**
     * @Route("/admin/interpunkt/update", name="admin_update")
     */
     public function indexAction()
     {

         $id = 1;
        $data = $this->getDoctrine()->getRepository('DevProinterpunktBundle:update')
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

    //
    // Update install Routine

    /**
     * @Route("/admin/interpunkt/update/install", name="admin_update_install")
     */
    public function installAction()
    {
        // Save Zip File in tmp
        $version = $this->getCurrentVersion();

        $check = file_get_contents('http://updateskeleton.interpunkt-test.ch/?dp_token=' . $this->token . '&dp_version=' . $version);
        $json = json_decode($check);

        $file = file_get_contents('http://' . $json->updateUrl);

        $version++;
        $fileDir = 'assets/updates/' . $version . '.zip';

        file_put_contents('assets/updates/' . $version . '.zip', $file);

        $this->unzip($fileDir);

        // Update DB set New Version in DB
        $this->updateDatabaseVersion($version);

        // Response Update success
        return $this->redirectToRoute('admin_update_install_success', array('version' => $version));

    }

    /**
     * @Route("/admin/interpunkt/update/install/success", name="admin_update_install_success")
     */
    public function updateInstallSuccessAction(Request $request)
    {
        $version = $request->query->get('version');
        $html = $this->renderView('admin/update/installed.html.twig', array(
            'title' => 'update',
            'version' => $version
        ));

        return new Response($html);
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

    protected function unzip($file)
    {
        $rootDir = $this->get('kernel')->getRootDir() . '/../';

        $zip = new ZipArchive;
        if ($zip->open($file) === TRUE) {
            $zip->extractTo($rootDir);
            $zip->close();
            echo 'ok';
        } else {
            echo 'Fehler';
        }
    }

    protected function updateDatabaseVersion($version)
    {
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('DevProadminBundle:update')
            ->find(1);

        if ( ! $data)
        {
            throw $this->createNotFoundException('Update Entity, kein Datensatz mit ID 1 gefunden!');
        }

        $data->setVersion($version);

        $em->persist($data);
        $em->flush();
    }
}