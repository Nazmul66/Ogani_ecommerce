<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'currency',
        'phone_one',
        'phone_two',
        'mail_email',
        'support_email',
        'logo',
        'favicon',
        'address',
        'facebook',
        'twitter',
        'youtube',
        'instagram',
        'linkedin'
    ];
}
