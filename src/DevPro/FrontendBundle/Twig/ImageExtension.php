<?php
namespace DevPro\FrontendBundle\Twig;

use Intervention\Image\ImageManagerStatic as InterventionImage;

/*
 * Added all http://image.intervention.io PHP image handling and manipulation Functions as Twig Filters
 *
 * @Author Benjamin Knecht <bk@inter-punkt.ch>
 */
class ImageExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter( 'resize', array( $this, 'resizeFilter' )),
            new \Twig_SimpleFilter( 'crop', array( $this, 'cropFilter' )),
            new \Twig_SimpleFilter( 'fit', array( $this, 'fitFilter' )),
        );
    }

    /*
     * resize an image as Twig Filter
     */
    public function resizeFilter( $image, $width, $height )
    {
        $filenameAndPath = $this->getImageNameAndPath( $image );
        $thumbnail = $filenameAndPath['path'] . $width . '_x_' . $height . '_' . $filenameAndPath['filename'];

        if( is_file( $thumbnail ))
        {
            return $thumbnail;
        }

        $img = InterventionImage::make( $image );
        $img->resize( $width, $height, function ( $constraint ) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $img->save( $thumbnail );

        return $thumbnail;
    }

    /*
     * Crop an image as Twig Filter
     */
    public function cropFilter( $image, $width, $height, $x, $y )
    {
        $filenameAndPath = $this->getImageNameAndPath( $image );
        $thumbnail = $filenameAndPath['path'] . 'w' . $width . '_h' . $height . '_x' . $x . '_y' . $y . '_' . $filenameAndPath['filename'];

        if( is_file( $thumbnail ))
        {
            return $thumbnail;
        }

        $img = Image::make( $image );
        $img->crop( $width, $height, $x, $y );
        $img->save( $thumbnail );

        return $thumbnail;
    }

    /*
     * Crop and resize combined as Twig Filter
     */
    public function fitFilter( $image, $width, $height )
    {
        $img = Image::make( $image );

        // add callback functionality to retain maximal original image size
        $img->fit( $width, $height, function ( $constraint ) {
            $constraint->upsize();
        });

        return $image;
    }

    private function getImageNameAndPath( $image )
    {
        $fileName = basename( $image );
        return  [
            'filename' => $fileName,
            'path' => substr( $image, 0, -strlen( $fileName ))
        ];
    }
}