<?php

namespace dandevmd\mvccore;

class Session
{

  public function __construct()
  {

    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }

  }

  public function set($key, $value)
  {
    $_SESSION[$key] = $value;
  }

  public function get($key)
  {
    if (isset($_SESSION[$key])) {
      return $_SESSION[$key];
    }
  }

  public function delete($key)
  {
    if (isset($_SESSION[$key])) {
      unset($_SESSION[$key]);
    }
  }

  public function deleteAll()
  {
    session_unset();
    session_destroy();
  }
}