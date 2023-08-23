<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $primaryKey = "contact_id";
    protected $fillable = [
        'telephone',
        'adresse1',
        'adresse2',
        'ville',
        'pays',
        'cp',
        'user_id'
    ];
}
