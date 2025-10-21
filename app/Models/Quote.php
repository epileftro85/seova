<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference', 'name', 'email', 'website', 'budget', 'goal', 'message', 'consent',
        'status', 'ip', 'user_agent',
    ];
}
