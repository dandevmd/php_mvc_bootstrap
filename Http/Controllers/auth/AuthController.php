<?php

namespace app\Http\Controllers\auth;

use app\Core\Request;
use app\Core\Application;
use app\Core\Attributes\GET;
use app\Core\Attributes\POST;
use app\Database\Models\User;
use app\Http\Controllers\SiteController;
use app\Core\Validation\Validator\Validators\LoginValidator;
use app\Core\Validation\Validator\Validators\RegisterValidator;

class AuthController extends SiteController
{
  private string $viewPath = 'auth/';
  private string $layout = 'guest';

  #[GET('/login', 'guest')]
  public function login()
  {
    return parent::showView($this->viewPath . 'login', $this->layout);
  }

  #[POST('/attempt', 'guest')]
  public function attempt(Request $request)
  {
    $fields = $request->getBody();
    $errors = LoginValidator::validateLoginFields($fields);

    if (count($errors) > 0) {
      return parent::showView($this->viewPath . 'login', $this->layout, ['errors' => $errors, 'fields' => $fields]);
    }

    $user = (new User)->where('email', $fields['email'])->first();


    if (!$user || $user->email !== $fields['email'] || !password_verify($fields['password'], $user->password)) {
      return parent::showView($this->viewPath . 'login', $this->layout, ['message' => 'Invalid credentials', 'fields' => $fields, 'end' => 'bad']);
    }

    Application::resolveContainer('app\Core\Session')->set('user', ['id' => $user['id'], 'name' => $user['name']]);
    return parent::showView($this->viewPath . 'login', $this->layout, ['message' => 'Successfully logged in', 'end' => 'good']);
  }

  #[GET('/logout', 'auth')]
  public function logout()
  {

    Application::resolveContainer('app\Core\Session')->delete('user');
    return parent::showView($this->viewPath . 'login', $this->layout, ['message' => 'Successfully logged out', 'end' => 'good']);
  }

  #[GET('/register', 'guest')]
  public function register()
  {
    return parent::showView($this->viewPath . 'register', $this->layout);
  }

  #[POST('/register', 'guest')]
  public function store(Request $request)
  {
    $fields = $request->getBody();
    $errors = RegisterValidator::validateRegisterFields($fields);

    if (count($errors) > 0) {
      return parent::showView($this->viewPath . 'register', $this->layout, ['errors' => $errors, 'fields' => $fields]);
    }

    $user = new User;
    if ($user->where('email', $fields['email'])->first()) {
      return parent::showView($this->viewPath . 'register', $this->layout, ['message' => 'User already exists', 'fields' => $fields, 'end' => 'bad']);
    }

    unset($fields['password_confirmation']);
    $fields['password'] = password_hash($fields['password'], PASSWORD_DEFAULT);

    $user->fill($fields);


    if (!$user->save()) {
      return parent::showView($this->viewPath . 'register', $this->layout, ['message' => 'User already exists', 'fields' => $fields, 'end' => 'bad']);
    }

    return parent::showView($this->viewPath . 'register', $this->layout, ['message' => 'Successfully registered', 'end' => 'good']);
  }
}