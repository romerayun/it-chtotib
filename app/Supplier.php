<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'title',
        'address',
        'inn',
        'ogrnip',
        'rs',
        'rs_name',
    ];

    public function invoices() {
        return $this->hasMany(Invoice::class);
    }
}
