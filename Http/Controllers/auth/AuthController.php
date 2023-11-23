<?php

namespace app\Http\Controllers\auth;

use app\Core\Request;
use app\Core\Validator;
use app\Core\ViewManager;

class AuthController
{
  private string $viewPath = 'auth/';
  private string $layout = 'guest';

  public function login()
  {
    return ViewManager::renderView($this->viewPath . 'login', $this->layout);
  }


  public function authenticate()
  {

  }
  public function logout()
  {
  }

  public function register()
  {
    return ViewManager::renderView($this->viewPath . 'register', $this->layout);
  }

  public function store(Request $request)
  {

    $fields = $request->getBody();
    $errors = Validator::validateRegistrationFields($fields);

    if (count($errors) > 0) {
      return ViewManager::renderView($this->viewPath . 'register', $this->layout, ['errors' => $errors]);
    }

    if (count($errors) <= 0) {
      return 'user created';
    }

    // $user = RegisterModel::create($fields);

    // if (!$user) {
    //   $errors['email'] = 'User already exist';
    // }

    return ViewManager::renderView($this->viewPath . 'register', $this->layout, ['message' => 'Successfully registered']);
  }
}