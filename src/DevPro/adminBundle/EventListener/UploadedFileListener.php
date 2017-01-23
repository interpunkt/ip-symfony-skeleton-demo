<?php
namespace DevPro\adminBundle\EventListener;

use Vich\UploaderBundle\Event\Event;
use Intervention\Image\ImageManagerStatic as InterventionImage;
use Symfony\Component\DependencyInjection\ContainerInterface;

class UploadedFileListener
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function onPostUpload(Event $event)
    {
        $uploadedFile = $event->getObject();

        $croppedImagePath = $this->container->getParameter('image_path_cropped');

        $img = InterventionImage::make($uploadedFile->getBildDatei()->getPathname());
        $img->crop($uploadedFile->getBildBreite(), $uploadedFile->getBildHoehe(), $uploadedFile->getBildX(), $uploadedFile->getBildY());
        $img->save($croppedImagePath . $uploadedFile->getBildName());

    }

}