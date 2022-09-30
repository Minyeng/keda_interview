<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Chat extends Model
{
    protected $table = 'chats';
    protected $primaryKey = 'id';
    protected $appends = ['sender', 'recipient'];
    public $timestamps = false;

    protected $fillable = [
        'chat', 'datetime', 'status', 'user_id', 'to_user_id'
    ];

    public function getSenderAttribute()
    {
        return User::find(['id' => $this->user_id])->first()->makeHidden(['password', 'api_token']);
    }

    public function getRecipientAttribute()
    {
        return User::find(['id' => $this->to_user_id])->first()->makeHidden(['password', 'api_token']);
    }
}
