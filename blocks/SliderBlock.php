<?php

namespace imageslider\blocks;

use imageslider\Module;

class SliderBlock extends \cmsadmin\base\Block
{
    public $module = 'imageslider';

    public $cacheEnabled = true;

    public $assets = [
        'imageslider\assets\Main',
    ];

    public function name()
    {
        return 'Image Slider';
    }

    public function icon()
    {
        return 'image';
    }

    public function config()
    {
        return [
            'vars' => [
                ['var' => 'imageArrays', 'label' => 'Images', 'type' => 'zaa-image-array-upload'],
            ],
        ];
    }

    public function getFiles()
    {
        $fileEntries = $this->getVarValue('imageArrays');
        $files = [];

        if (!empty($fileEntries)) {
            foreach ($fileEntries as $fileEntry) {
                if (array_key_exists('imageId', $fileEntry)) {
                    $files[] = [
                        'meta' => $fileEntry,
                        'file' => \Yii::$app->storage->getImage($fileEntry['imageId']),
                    ];
                }
            }
        }

        return $files;
    }

    public function extraVars()
    {
        return [
            'fileList' => $this->getFiles(),
        ];
    }

    public function renderFrontend(\Twig_Environment $twig)
    {
        return parent::renderFrontend($twig);
    }

    public function twigFrontend()
    {
        return '
        <ul class="image-slider rslides">
        {% for item in extras.fileList %}
            <li><img src="{{ item.file.source }}"></li>
        {% endfor %}
        </ul>';
    }

    public function twigAdmin()
    {
        return '{% if vars.imageArrays is empty %}<span class="block__empty-text">' . 'empty' . '</span>{% else %}
            {{vars.imageArrays|length}} images in slider
        {% endif %}';
    }
}
