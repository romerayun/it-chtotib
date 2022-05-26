<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{

    protected $fillable = [
        'number_invoice',
        'supplier_id',
        'date_invoice',
        'price',
    ];

    public function getDateInvoice() {
        return Carbon::parse($this->date_invoice)->format('d.m.Y'); ;
    }


    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }

    public function objects() {
        return $this->belongsToMany(Material::class, 'invoice_object', 'invoice_id');
    }
}
