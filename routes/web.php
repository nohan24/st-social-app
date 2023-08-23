<?php

use App\Http\Controllers\CotisationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\ParametreController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', [ArticleController::class, 'index']);

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');


    Route::controller(CotisationController::class)->group(function (){
        Route::get('/cotisation', "index")->name('cotisation');
        Route::post('/cotisation/add', "add")->name('cotisation.add');
        Route::get('/cotisation/{user}', "getUserCotisation")->name('cotisation.get');
    });

    Route::resource('article', ArticleController::class)->names([
        'index' => 'article'
    ]);

    Route::controller(EvenementController::class)->group(function (){
        Route::get('/evenement', "index")->name('evenement');
    });

    Route::group(['middleware' => ['admin']], function () {

        Route::controller(UserController::class)->group(function () {  
            Route::put('/utilisateurs/contact/{contact}', "contact")->name('utilisateurs.contact');
            Route::get('utilisateurs', 'index')->name('utilisateurs');
            Route::delete('/utilisateurs/{user}', "delete")->name('utilisateurs.delete');
            Route::post('/utilisateurs/update', "update")->name('utilisateurs.update');
        });

        Route::controller(ParametreController::class)->group(function () {
            Route::get('/parametre', 'index')->name('parametre');
            Route::get('/parametre/montant', 'montant')->name('parametre.montant');
            Route::put('/parametre/montant', 'modif_montant')->name('parametre.montant.update');
            Route::get('/parametre/role', 'role')->name('parametre.role');
            Route::post('/parametre/role', 'add_role')->name('parametre.role.ajout');
            Route::delete('/parametre/role/{id}', 'delete_role')->name('parametre.role.suppression');
            Route::get('/parametre/categorie', 'categorie')->name('parametre.categorie');
            Route::post('/parametre/categorie', 'add_categorie')->name('parametre.categorie.ajout');
            Route::delete('/parametre/categorie/{id}', 'delete_categorie')->name('parametre.categorie.suppression');
            Route::get('/parametre/evenement/type', 'evenement')->name('parametre.type.evenement');
            Route::get('/parametre/evenement', 'ajoutEvenement')->name('parametre.evenement');
            Route::post('/parametre/evenement/type/add', 'addEvt')->name('parametre.evenement.ajout');
            Route::post('/parametre/evenement/add', 'newEvt')->name('parametre.evenement.new');
            Route::delete('/parametre/evenement/{id}', 'deleteEvt')->name('parametre.evenement.delete');
            Route::get('/parametre/historique','historique')->name('parametre.historique');
            Route::get('/parametre/cotisation/{user}/{year}','cotisation')->name('parametre.cotisation');
            Route::get('/parametre/evenement/edit/{evt}','editEvt')->name('parametre.edit.evenement');
            Route::post('/parametre/evenement/edit/{evt}','validModifEvt')->name('parametre.evt.modif');
        });
     });

});
