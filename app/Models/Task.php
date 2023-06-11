<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'attachment',
        'completed',
        'created_at',
        'completed_at',
        'updated_at',
        'deleted_at',
        'user_id',
    ];

    protected $casts = [
        'completed' => 'boolean',
        'created_at' => 'datetime',
        'completed_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
