<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    protected $fillable = [
      'fio',
      'email',
      'location',
      'description',
    ];
}
