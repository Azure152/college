<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Annotation extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'activity_id'];

    public function attachments(): HasMany
    {
        return $this->hasMany(AnnotationFile::class);
    }
}