<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable;
    use HasFactory;

    protected $table = 'customers';
    protected $primaryKey = 'Customer_id';
    public $timestamps = false;

    protected $fillable = [
        'FullName',
        'Email',
        'Password',
        'Phone',
        'Address',
        'RegDate',
        'is_admin',
        'google_id'
    ];

    protected $hidden = [
        'Password',
    ];

    public function getAuthPassword()
    {
        return $this->Password;
    }
}