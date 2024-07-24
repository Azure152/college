<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnotationFile extends Model
{
    use HasFactory;

    protected $fillable = ['path', 'annotation_id'];
}