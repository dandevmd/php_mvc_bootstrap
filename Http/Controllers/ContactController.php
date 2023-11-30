<?php

namespace app\Http\Controllers;

use dandevmd\mvccore\Request;
use app\Http\Controllers\SiteController;

class ContactController extends SiteController
{

  public function index()
  {
    return parent::showView('contact');
  }

  public function store(Request $request)
  {
    $request->getBody();

  }
}