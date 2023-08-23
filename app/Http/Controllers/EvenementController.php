<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class EvenementController extends Controller
{
    public function index(){
        $res = DB::select("SELECT e.*,u.name,u.prenom,t.libelle FROM evenements e JOIN users u ON e.user_id = u.user_id JOIN type_evenements t ON e.type_evenement = t.id ORDER BY date_evenement");
        return Inertia::render('Evenement/Index',['evenements' => $res]);
    }
}
