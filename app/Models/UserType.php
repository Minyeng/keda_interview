<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserType extends Model
{
    protected $table = 'user_types';
    protected $primaryKey = 'id';
    public $timestamps = false;

}
