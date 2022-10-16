<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SoldLand extends Model
{
    use HasFactory, HasUlids, SoftDeletes;

    protected $guarded = [];

    public function plot()
    {
        return $this->belongsTo(Plot::class);
    }
}
