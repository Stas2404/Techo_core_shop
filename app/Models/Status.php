<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status'; 
    protected $primaryKey = 'Status_id';
    public $timestamps = false;

    protected $fillable = [
        'Name'
    ];
}