<?php

namespace imageslider;

class Module extends \luya\base\Module
{
    public $isCoreModule = false;

    public $useAppLayoutPath = false;

    public $controllerUseModuleViewPath = true;

    public $password = false;

    public static function t($message, array $params = [])
    {
        return \luya\Module::t('imageslider', $message, $params);
    }

    public $assets = [
        'imageslider\assets\Main',
    ];
}
