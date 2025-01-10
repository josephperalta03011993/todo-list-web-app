<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'due_date',
        'is_weekly',
        'completed',
        'user_id',
    ];
    protected $casts = [
        'due_date' => 'datetime',
        'is_weekly' => 'boolean',
        'completed' => 'boolean',
    ];
}
