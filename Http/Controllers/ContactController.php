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

  #[Route('/contact', HttpMethod::GET, 'auth')]
  public function index()
  {
    return parent::showView('contact');
  }

  #[Route('/contact', HttpMethod::POST, 'auth')]
  public function store(Request $request)
  {
    $request->getBody();

  }
}