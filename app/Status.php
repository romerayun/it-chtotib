<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{

    protected $fillable = ['name','color'];

    public function objects() {
        return $this->hasMany(Material::class);
    }

    public function histories() {
        return $this->hasMany(History::class);
    }
}
