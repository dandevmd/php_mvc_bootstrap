<?php

namespace app\Http\Controllers\auth;

use app\Core\Request;
use app\Core\AppMailer;
use app\Core\Attributes\GET;
use app\Core\Attributes\POST;
use app\Core\Enum\HttpMethod;
use app\Database\Models\Auth;
use app\Database\Models\User;
use app\Core\Attributes\Route;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use app\Http\Controllers\SiteController;
use Symfony\Component\Mailer\Transport\Smtp\SmtpTransport;
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

    $authUser = new Auth($fields);

    if (!$authUser->auth()) {
      return parent::showView($this->viewPath . 'login', $this->layout, ['message' => 'Invalid credentials', 'fields' => $fields, 'end' => 'bad']);
    }

    $text = <<<BODY
    Welcome, we are glad to see you again!
    BODY;

    (new AppMailer('Welcome back!', $text, $authUser->fields['email']))->sendEmail();
    // $message = (new Email())->subject('Welcome back!')
    //   ->from('lCqzQ@example.com')
    //   ->to($authUser->fields['email'])
    //   ->text($text);

    // $transport = Transport::fromDsn('smtp://localhost:1025');

    // $mailer = new Mailer($transport);

    // $mailer->send($message);



    return parent::showView($this->viewPath . 'login', $this->layout, ['message' => 'Successfully logged in', 'end' => 'good']);
  }

  #[GET('/logout', 'auth')]
  public function logout()
  {

    Auth::logout();
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

    $newUser = new User($fields);

    if (!$newUser->save()) {
      return parent::showView($this->viewPath . 'register', $this->layout, ['message' => 'User already exists', 'fields' => $fields, 'end' => 'bad']);
    }

    return parent::showView($this->viewPath . 'register', $this->layout, ['message' => 'Successfully registered', 'end' => 'good']);
  }
}