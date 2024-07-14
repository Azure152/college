<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'content', 'score', 'asignature_id'];

    public function annotations(): HasMany
    {
        return $this->hasMany(Annotation::class);
    }
}