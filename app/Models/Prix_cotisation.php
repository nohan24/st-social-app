<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prix_cotisation extends Model
{
    use HasFactory;

    protected $fillable = ['montant'];
}
