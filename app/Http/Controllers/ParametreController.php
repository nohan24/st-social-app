<?php

namespace App\Http\Controllers;

use App\Models\Categorie_article;
use App\Models\Categorie_non_dispo;
use App\Models\Evenement;
use App\Models\Prix_cotisation;
use App\Models\Role;
use App\Models\Role_non_dispo;
use App\Models\Type_evenement;
use App\Models\Type_evt_dispo;
use App\Models\Type_evt_non_dispo;
use App\Models\User;
use App\Models\V_categorie_dispo;
use App\Models\V_role_dispos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;


class ParametreController extends Controller
{
    public function index(){
        return Inertia::render('Parametre/Index');
    }

    public function role(){
        return Inertia::render('Parametre/Role', ['roles' => V_role_dispos::all()]);
    }

    public function add_role(Request $request){
        $request->validate([
            'role' => 'required|string'
        ]);

        Role::create([
            'libelle' => $request['role']
        ]);
    }

    public function add_categorie(Request $request){
        $request->validate([
            'categorie' => 'required|string'
        ]);

        Categorie_article::create([
            'nom' => $request['categorie']
        ]);
    }

    public function categorie(){
        return Inertia::render('Parametre/Categorie', ['categories' => V_categorie_dispo::all()]);
    }

    public function delete_role($id){
        Role_non_dispo::create([
            'role_id' => $id
        ]);
    }

    public function delete_categorie($id){
        Categorie_non_dispo::create([
            'categorie_id' => $id
        ]);
    }

    public function montant(){
        return Inertia::render('Cotisation/Montant', ['montant' => Prix_cotisation::all()]);
    }

    public function modif_montant(Request $request){
        $montant = Prix_cotisation::all()[0];
        $montant['montant'] = $request['montant'];
        $montant->save();
    }

    public function evenement(){
        return Inertia::render('Parametre/Evenement', ['evts' => Type_evt_dispo::all()]);
    }

    public function ajoutEvenement(){
        return Inertia::render('Parametre/Evt', ['evts' => Type_evenement::all(), 'users' => User::all('name','prenom','user_id')]);
    }

    public function addEvt(Request $request){
        $request->validate([
            'evt' => 'required|string',
            'montant' => 'required',
            'color' => 'required'
        ]);

        Type_evenement::create([
            'libelle' => $request['evt'],
            'montant' => $request['montant'],
            'color' => $request['color']
        ]);
    }

    public function newEvt(Request $request){
        $request->validate([
            'evt' => 'required',
            'utilisateur' => 'required',
            'date' => 'required',
            'montant' => 'required'
        ]);

        Evenement::create([
            'type_evenement' => $request['evt'],
            'user_id' => $request['utilisateur'],
            'date_evenement' => $request['date'],
            'montant' => $request['montant']
        ]);
    }

    public function deleteEvt($id){
        Type_evt_non_dispo::create([
            'type_id' => $id
        ]);
    }

    public function historique(){
        $users = User::all('name','prenom','user_id','date_embauche');
        foreach ($users as $u) {
            $u['start'] = date("Y",strtotime($u['date_embauche']));
        }
        return Inertia::render('Parametre/Historique',['users' =>$users]);
    }

    public function cotisation(User $user, $year){
        $results = DB::select("SELECT * FROM cotisations WHERE user_id = :user and year = :y", ['user' => $user['user_id'], 'y' => $year]);
        $arr = array();
        for ($i=0; $i < 12; $i++) { 
            array_push($arr, null);
        }
        foreach ($results as $r) {
            $arr[$r->month -1 ] = $r;
        }
        return json_encode($arr);
    }

    public function editEvt(Type_evt_dispo $evt){
        return Inertia::render('Parametre/EditionEvt',['evt' => $evt]);
    }

    public function validModifEvt(Type_evenement $evt, Request $request){
        $request->validate([
            'evt' => 'required',
            'color' => 'required',
            'montant' => 'required'
        ]);

        $evt['libelle'] = $request['evt'];
        $evt['montant'] = $request['montant'];
        $evt['color'] = $request['color'];

        $evt->save();

    }
}
