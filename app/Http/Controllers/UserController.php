<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\V_user_contacts;
use App\Models\User;
use App\Models\User_non_dispo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use PSpell\Config;

class UserController extends Controller
{
    public function index()
    {
        return Inertia::render('User/list', ["data" => V_user_contacts::all()]);
    }

    public function delete($id)
    {
        User_non_dispo::create([
            'user_id' => $id
        ]);

        $user = User::findOrFail($id);
        $user->delete();
    }

    public function update(Request $request)
    {
        $c = Contact::find($request->contact_id);
        $c->telephone = $request->telephone;
        $c->adresse1 = $request->adresse1;
        $c->adresse2 = $request->adresse2;
        $c->ville = $request->ville;
        $c->cp = $request->cp;
        $c->pays = $request->pays;
        $c->save();
    }

    public function contact(Contact $contact,Request $request){
        $request->validate([
            'telephone' => 'required',
            'adresse1' => 'required|string',
            'ville' => 'required|string',
            'pays' => 'required|string',
            'cp' => 'required'
        ]);

        $contact->fill($request->all());
        $contact->save();
    }
}
