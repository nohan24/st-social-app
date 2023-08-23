<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotisation extends Model
{
    use HasFactory;
    protected $primaryKey = "cotisation_id";
    protected $fillable = ['user_id', 'montant','month', 'year'];
}
