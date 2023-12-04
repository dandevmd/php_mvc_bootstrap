<?php

namespace app\Core\Enum;


enum HttpMethod
{
  case GET;
  case POST;
  case PUT;
  case PATCH;
  case DELETE;
}