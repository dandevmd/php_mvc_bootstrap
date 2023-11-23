<?php

namespace app\Http\Controllers;

use app\Core\Request;
use app\Core\ViewManager;

class ContactController
{

  public function index()
  {
    return ViewManager::renderView('contact');
  }

  public function store(Request $request)
  {
    $request->getBody();

  }
}