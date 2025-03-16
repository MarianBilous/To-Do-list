<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskHistory extends Model
{
    protected $fillable = [
        'task_id',
        'action',
        'data',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
