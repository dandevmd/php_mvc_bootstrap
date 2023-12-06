<?php

namespace app\Database\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
  const UPDATED_AT = null;
  protected $fillable = [
    'name',
    'email',
    'password',
  ];

}