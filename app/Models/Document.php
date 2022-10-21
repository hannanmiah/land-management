<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use HasFactory, HasUlids, SoftDeletes;

    protected $guarded = [];

    public function plots()
    {
        return $this->hasMany(Plot::class);
    }

    public function bought()
    {
        return $this->hasOne(BoughtLand::class);
    }

    public function getRemainingAttribute()
    {
        return (double)$this->amount - $this->plots->where('status', 'sold')->sum('amount');
    }
}
