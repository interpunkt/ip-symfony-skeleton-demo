<?php
namespace DevPro\FrontendBundle\Twig;

use Intervention\Image\ImageManagerStatic as InterventionImage;

class ImageExtension extends \Twig_Extension
{
public function getFilters()
{
return array(
new \Twig_SimpleFilter('resize', array($this, 'resizeFilter')),
);
}

public function resizeFilter($image, $width, $height)
{
    $filenameAndPath = $this->getImageNameAndPath( $image );
    $thumbnail = $filenameAndPath['path'] . $width . '_x_' . $height . '_' . $filenameAndPath['filename'];

    if( is_file( $thumbnail ))
    {
        return $thumbnail;
    }

    $img = InterventionImage::make( $image );

    // prevent possible aspectRatio & upsizing
    $img->resize($width, $height, function ($constraint) {
        $constraint->aspectRatio();
        $constraint->upsize();
    });

    $img->save($thumbnail);


return $thumbnail;
}


    private function getImageNameAndPath( $image )
    {
        $fileName = basename( $image );
        return  [
            'filename' => $fileName,
            'path' => substr($image, 0, -strlen($fileName))
        ];
    }
}