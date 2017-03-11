#Imageupload & Cropping

## Require (default im Skeleton installiert)

1. Cropper 
2. intervention
3. Vichuploader

```
bower install cropper --save
composer require intervention/image
composer require vich/uploader-bundle
```

## Usage

Entities welche Bilder enthalten müssen wie folgt konfiguriert werden.

https://github.com/dustin10/VichUploaderBundle/blob/master/Resources/doc/usage.md

Für das Filesystem wird Gaufrette benutzt, hier muss nix weiter eingestellt werden.

## Twig

In Twig kann das Orginal Bild oder das gecroppte über variablen angesprochen werden. Die Vars sind 
in der config.yml an 2 Stellen hinterlegt.

```yaml
parameters:
    image_path: uploads/images/
    image_path_cropped: uploads/images/cropped/
```

```yaml
# Twig Configuration
twig:
    # ...
    globals:
        image_path: '/uploads/images/'
        image_path_cropped: '/uploads/images/cropped/'
```

```html
<img src="{{ asset(image_path_cropped~items.bildName) }}" alt="{{ bildName }}">
```

## Twig Filter Erweiterung intervention Image
Intervention Image is an open source PHP image handling and manipulation library. It provides an easier and expressive way to create, edit, and compose images and supports currently the two most common image processing libraries GD Library and Imagick.

http://image.intervention.io

### resize
width or height angeben. Aktuell eingestellt prevent upsize & aspectRatio.

Twig Filter: resize( $width, $height )
```html
  <img src="{{ asset('uploads/images/image.jpg'|resize(500, null)) }}">
```

Nutzung mit srcset
```html
  <img src="{{ asset('uploads/images/sandra.jpg') }}"
    srcset="
      {{ asset('uploads/images/sandra.jpg'|resize(200, null)) }} 200w,
      {{ asset('uploads/images/sandra.jpg'|resize(400, null)) }} 400w,
      {{ asset('uploads/images/sandra.jpg'|resize(600, null)) }} 600w
    ">
```

### fit - Crop and resize combined as Twig Filter

Twig Filter: fit( $width, $height )
```html
<img src="{{ asset('uploads/images/image.jpg'|fit(500, 500)) }}">
```

## Forms

Im Form Type den Vich Type verwenden.

```php
use Vich\UploaderBundle\Form\Type\VichImageType;

            ->add('bildDatei', VichImageType::class, array(
                'label' => 'Bild',
                'required' => false,
                'allow_delete'  => true, // not mandatory, default is true
                'download_link' => true, // not mandatory, default is true
            ))
```

## EventListener

In der Config.yml kann der Image Path für die zugeschnittenen Bilder angepasst werden, default ist der Path "/uploads/images/cropped" 
gesetzt. Der EventListener speichert das zugeschnittene Bild. Im Standard Controller müssen keine weiteren Einstellungen vorgenommen werden.

Pfad zum EventListener
```php
src/DevPro/adminBundle/EventListener/UploadedFileListener.php
```

## Cropper

Damit der Cropper im View nach Auswahl des Bildes angezeigt wird, nachfolgenden Code in das Twig File einfügen.

```javascript
{% block layoutScripts %}
    {{ parent() }}
    
    <script>
        $(document).ready(function () {
            function previewImage(input, imgOrigId, hiddenContainerId, isCrop) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    var imgOrig = $(imgOrigId);
                    reader.onload = function (e) {
                        imgOrig.attr('src', e.target.result);
                        if (isCrop) {
                            // Abstand zum Button muss vergrössert werden
                            $('.container').css('marginBottom', '30px');
                            // alter Cropper muss gelöscht werden, bevor neues Bild angezeigt werden kann
                            imgOrig.cropper('destroy');
                            imgOrig.cropper({
                                aspectRatio: 3 / 2,
                                crop: function (e) {
                                    $('#custom_folien_bildX').val(parseInt(e.x));
                                    $('#custom_folien_bildY').val(parseInt(e.y));
                                    $('#custom_folien_bildBreite').val(parseInt(e.width));
                                    $('#custom_folien_bildHoehe').val(parseInt(e.height));
                                },
                                preview: '.crop'
                            });
                        }
                    };
                    reader.readAsDataURL(input.files[0]);
                    $(hiddenContainerId).show();
                }
            }


            if($("#custom_folien_bildDatei_file").attr('src') === undefined)
            {
                $("#img-orig").attr("src", "{{ asset('uploads/images/placeholder.jpg') }}");
            }

            $("#custom_folien_bildDatei_file").change(function(){
                previewImage(this, '#img-orig', '.preview', true);
            });
        });
    </script>

{% endblock %}

{% block layoutCss %}
    {{ parent() }}

    <style>
        .preview{
            height: 300px;
            display: none;
            overflow: hidden;
        }
        .crop{
            height: 300px;
            overflow: hidden;
        }
        #img-orig {
            max-width: 100%;
        }
    </style>
{% endblock %}
```



