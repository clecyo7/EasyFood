<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    use TenantTrait;

    protected $table = 'tables';
    protected $fillable = ['identify', 'description'];

    public function products()
    {
        return $this->belongsToMany(Products::class);
    }
}
