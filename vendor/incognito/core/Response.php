<?php

namespace dandevmd\mvccore;

class Response
{

  public function setStatusCode(int $code): void
  {
    http_response_code($code);
  }

  public function redirect(string $path): void
  {
    header('Location: ' . $path);
  }

  public function json(array $data): void
  {
    header('Content-Type: application/json');
    echo json_encode($data);
  }


}