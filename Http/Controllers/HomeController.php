<?php

namespace app\Http\Controllers;

use app\Core\Attributes\GET;
use app\Core\Attributes\Route;
use app\Core\Enum\HttpMethod;
use app\Http\Controllers\SiteController;



class HomeController extends SiteController
{
  #[GET('/', )]
  public function index()
  {
    return parent::showView('home');
  }
}