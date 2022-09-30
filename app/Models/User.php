<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable;
    
    protected $appends = ['type'];

    public function getTypeAttribute()
    {
        return UserType::find(['id' => $this->user_type_id])->first()->name;
    }

    public function userType()
    {
        return $this->belongsTo('App\Models\UserType', 'user_type_id', 'id');
    }
}
