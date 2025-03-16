<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'priority',
        'status',
        'deadline',
        'user_id',
        'access_token',
        'access_token_expires_at'
    ];

    protected $dates = [
        'deadline',
        'access_token_expires_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function history()
    {
        return $this->hasMany(TaskHistory::class);
    }
}
