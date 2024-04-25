<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'email',
        'government_id',
        'debt_due_date',
        'debt_amount',
        'debt_id'
    ];

    protected $guarded = [
      'id'
    ];
}
