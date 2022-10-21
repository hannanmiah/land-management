<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BoughtLand extends Model
{
    use HasFactory, HasUlids, SoftDeletes;

    protected $guarded = [];

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function getAmountAttribute()
    {
        return $this->document->amount;
    }

    public function getRemainingAttribute()
    {
        return $this->document->remaining;
    }
}
