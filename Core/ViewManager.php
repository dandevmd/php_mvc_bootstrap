<?php

namespace app\Core;

class ViewManager
{

  static function renderView(string $path, string $layout = 'main', array $params = []): string
  {
    $instance = new ViewManager();
    $layout = $instance->setLayout($layout);
    $viewContent = $instance->replaceViewContent($path, $params);
    $newViewContent = str_replace('{{content}}', $viewContent, $layout);

    return $newViewContent;
  }



  private function replaceViewContent(string $view, array $params = []): string
  {
    ob_start();
    extract($params);
    require_once Application::$ROOT_DIR . "/views/$view.php";
    return ob_get_contents();
  }

  private function setLayout(string $layout): string
  {
    ob_start();
    require_once Application::$ROOT_DIR . "/views/layouts/$layout.php";
    return ob_get_contents();
  }
}