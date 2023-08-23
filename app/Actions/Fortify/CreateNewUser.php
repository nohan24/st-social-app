<?php

namespace App\Actions\Fortify;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'date_embauche' => ['required'],
            'date_naissance' => ['required'],
            'sexe' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
        ])->validate();

        $create = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'date_embauche' => $input['date_embauche'],
            'date_naissance' => $input['date_naissance'],
            'prenom' => $input['prenom'],
            'sexe' => $input['sexe']
        ]);

        Contact::create([
            'telephone' => $input['telephone'],
            'adresse1' => $input['adresse1'],
            'adresse2' => $input['adresse2'],
            'ville' => $input['ville'],
            'pays' => $input['pays'],
            'cp' => $input['cp'],
            'user_id' => $create->user_id
        ]);
        return $create;
    }
}
