<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "phone_number",
        "age",
        "email",
        "user_id",
        "profile_picture"
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
