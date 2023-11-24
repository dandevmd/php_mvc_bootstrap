<?php

namespace app\Core\Validation\Rule;

abstract class Rule
{
  protected $name;
  protected $errorMessage;

  public function __construct($name, $errorMessage)
  {
    $this->name = $name;
    $this->errorMessage = $errorMessage;
  }

  public abstract function validate($fieldValue): bool;

  public function getName()
  {
    return $this->name;
  }

  public function getErrorMessage()
  {
    return $this->errorMessage;
  }
}