<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    private $CUSTOMER_TYPES_ID = 1;
    private $STAFF_TYPES_ID = 2;

    protected $fillable = [
        'email',
        'password',
        'user_types_id'
    ];

    protected $hidden = [
        'password'
    ];

    public function scopeCustomers($query)
    {
        $query->where('user_type_id', $this->CUSTOMER_TYPES_ID);
    }

    public function scopeStaff($query)
    {
        $query->where('user_type_id', $this->STAFF_TYPES_ID);
    }

    public function isCustomer()
    {
        return $this->user_type_id == $this->CUSTOMER_TYPES_ID;
    }

    public function isStaff()
    {
        return $this->user_type_id == $this->STAFF_TYPES_ID ? 'true' : 'false';
    }

}
