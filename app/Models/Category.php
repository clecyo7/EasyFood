<?php

namespace App\Models;

use App\Tenant\Observer\TenantObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Tenant\Traits\TenantTrait;

class Category extends Model
{
    use TenantTrait;
    use HasFactory;


    protected $table = 'categories';
    protected $fillable = ['tenant_id', 'name', 'url', 'description'];

}
