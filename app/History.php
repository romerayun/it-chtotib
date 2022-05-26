<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = [
      'user_id',
      'object_id',
      'status_id',
      'comment',
      'location_id',
      'location_object',
    ];

    //
    public function getDate() {
        return Carbon::parse($this->created_at)->format('Дата: d.m.Y');
    }
    public function getTime() {
        return Carbon::parse($this->created_at)->format('Время: H:i');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function locObj() {
        return $this->hasOne(Material::class, 'id', 'location_object');
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function objects() {
        return $this->belongsTo(Material::class);
    }

    public function location() {
        return $this->belongsTo(Location::class);
    }


}
