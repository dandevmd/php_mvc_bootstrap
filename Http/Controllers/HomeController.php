<?php

namespace app\Http\Controllers;

use app\Http\Controllers\SiteController;



class HomeController extends SiteController
{

  public function index()
  {
    return parent::showView('home');
  }
}