<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileControl extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'file_name',
        'path',
        'status',
        'client_id',
    ];

    protected $guarded = [
        'id'
    ];
}
