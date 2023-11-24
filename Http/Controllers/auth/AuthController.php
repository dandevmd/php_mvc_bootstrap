<?php

namespace app\Http\Controllers\auth;

use app\Core\Request;
use app\Core\Validator;
use app\Database\Models\User;
use app\Http\Controllers\SiteController;

class AuthController extends SiteController
{
  private string $viewPath = 'auth/';
  private string $layout = 'guest';

  public function login()
  {
    return parent::showView($this->viewPath . 'login', $this->layout);
  }


  public function authenticate()
  {

  }
  public function logout()
  {
  }

  public function register()
  {
    return parent::showView($this->viewPath . 'register', $this->layout);
  }

  public function store(Request $request)
  {
    $fields = $request->getBody();
    $errors = Validator::validateRegistrationFields($fields);

    if (count($errors) > 0) {
      return parent::showView($this->viewPath . 'register', $this->layout, ['errors' => $errors]);
    }

    $newUser = new User($fields);

    if (!$newUser->save()) {
      return parent::showView($this->viewPath . 'register', $this->layout, ['message' => 'User already exists']);
    }

    return parent::showView($this->viewPath . 'register', $this->layout, ['message' => 'Successfully registered']);
  }
}