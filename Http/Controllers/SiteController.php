<?php

namespace app\Http\Controllers;

use dandevmd\mvccore\ViewManager;

class SiteController
{
    public function showView(string $path = '', string $layout = 'main', array $params = []): string
    {
        return ViewManager::renderView($path, $layout, $params);
    }
}