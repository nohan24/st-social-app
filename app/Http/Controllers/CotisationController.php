<?php

namespace App\Http\Controllers;

use App\Models\Cotisation;
use App\Models\Prix_cotisation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CotisationController extends Controller
{

    public function index()
    {
        return Inertia::render('Cotisation/Index', ['prix' => Prix_cotisation::all()[0], 'users' => User::all(['user_id', 'name', 'prenom']), 'cotisations' => Cotisation::all()]);
    }

    public function getUserCotisation(User $user){
        $year = date('Y');
        $results = DB::select("SELECT month FROM cotisations WHERE year = :y and user_id = :user", ['user' => $user['user_id'], 'y' => $year]);
        $start = 1;
        if(date("Y",strtotime($user['date_embauche'])) == $year){
            $start = intval(date("m",strtotime($user['date_embauche'])));
        }
        $m = [];
        for ($i=$start; $i <= 12; $i++) { 
            array_push($m, $i);
        }
        
        foreach ($results as $r) {
            if(in_array($r->month, $m)){
                $m = array_diff($m, array($r->month));
            }
        }
        
        return json_encode($m);
    }

    public function add(Request $request)
    {
        foreach ($request['selected'] as $m) {
            Cotisation::create([
                'month' => $m,
                'year' => date('Y'),
                'montant' => $request['montant'],
                'user_id' => $request['id']
            ]);
        }
    }

}
