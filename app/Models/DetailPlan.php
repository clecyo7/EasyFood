<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPlan extends Model
{
    use HasFactory;

    protected $table = 'details_plan';

    protected $fillable = ['name', 'plan_id'];


    public function Plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
