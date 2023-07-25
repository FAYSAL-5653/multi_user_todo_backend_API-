<?php
namespace App\Models;

use App\Models\TodoItem;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['firstName', 'lastName', 'email', 'mobile', 'password', 'otp'];
    protected $attributes = [
        'otp' => '0',
    ];

    public function TodoItem()
    {
        return $this->hasOne(TodoItem::class);
    }
}
