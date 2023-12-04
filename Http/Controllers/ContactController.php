<?php

namespace app\Http\Controllers;

use app\Core\Request;
use app\Core\Attributes\GET;
use app\Core\Attributes\POST;
use app\Core\Enum\HttpMethod;
use app\Core\Attributes\Route;
use app\Http\Controllers\SiteController;

class ContactController extends SiteController
{

  #[GET('/contact', 'auth')]
  public function index()
  {
    return parent::showView('contact');
  }

  #[POST('/contact', 'auth')]
  public function store(Request $request)
  {
    $request->getBody();

  }
}