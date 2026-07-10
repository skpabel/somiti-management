<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoticeRead extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'notice_id',
        'member_id',
        'read_at',
        'deleted_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
}
