<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    public $table = 'todos';

    protected $fillable = [
        'name',
        'description',
        'due_date',
        'is_complete',
    ];

    protected $casts = [
        'is_complete' => 'boolean',
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];
}
