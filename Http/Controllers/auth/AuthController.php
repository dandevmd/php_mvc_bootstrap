<?php

namespace app\Http\Controllers\auth;

use dandevmd\mvccore\Request;
use app\Database\Models\Auth;
use app\Database\Models\User;
use app\Http\Controllers\SiteController;
use dandevmd\mvccore\Validation\Validator\Validators\LoginValidator;
use dandevmd\mvccore\Validation\Validator\Validators\RegisterValidator;

class AuthController extends SiteController
{
  private string $viewPath = 'auth/';
  private string $layout = 'guest';

  public function login()
  {
    return parent::showView($this->viewPath . 'login', $this->layout);
  }


  public function attempt(Request $request)
  {
    $fields = $request->getBody();
    $errors = LoginValidator::validateLoginFields($fields);

    if (count($errors) > 0) {
      return parent::showView($this->viewPath . 'login', $this->layout, ['errors' => $errors, 'fields' => $fields]);
    }

    $authUser = new Auth($fields);

    if (!$authUser->auth()) {
      return parent::showView($this->viewPath . 'login', $this->layout, ['message' => 'Invalid credentials', 'fields' => $fields, 'end' => 'bad']);
    }

    return parent::showView($this->viewPath . 'login', $this->layout, ['message' => 'Successfully logged in', 'end' => 'good']);
  }
  public function logout()
  {

    Auth::logout();
    return parent::showView($this->viewPath . 'login', $this->layout, ['message' => 'Successfully logged out', 'end' => 'good']);
  }

  public function register()
  {
    return parent::showView($this->viewPath . 'register', $this->layout);
  }

  public function store(Request $request)
  {
    $fields = $request->getBody();
    $errors = RegisterValidator::validateRegisterFields($fields);

    if (count($errors) > 0) {
      return parent::showView($this->viewPath . 'register', $this->layout, ['errors' => $errors, 'fields' => $fields]);
    }

    $newUser = new User($fields);

    if (!$newUser->save()) {
      return parent::showView($this->viewPath . 'register', $this->layout, ['message' => 'User already exists', 'fields' => $fields, 'end' => 'bad']);
    }

    return parent::showView($this->viewPath . 'register', $this->layout, ['message' => 'Successfully registered', 'end' => 'good']);
  }
}