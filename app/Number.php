<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Number extends Model
{
  public $rules = [
    'number' => 'required|unique:numbers|min:6|max:6',
    'msg' => 'required|min:1'
  ];
}
