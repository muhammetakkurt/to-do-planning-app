<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'developer_id', 
        'provider', 
        'level', 
        'estimated_duration',
        'expected_duration'
    ];
}
