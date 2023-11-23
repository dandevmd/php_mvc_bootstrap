<?php

namespace app\Http\Controllers;

use app\Core\Controller;
use app\Core\ViewManager;



class HomeController
{

  public function index()
  {
    return ViewManager::renderView('home');
  }
}