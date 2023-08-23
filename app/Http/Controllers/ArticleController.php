<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\V_articles;
use App\Models\V_categorie_dispo;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ArticleController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $post = [];
        $keys = [];
        $articles = V_articles::all();
       
        foreach ($articles as $a) {
            if ($a['parent_id'] == null) {
                array_push($keys, $a['article_id']);
                $post[$a['article_id']] = array(
                    "childs" => array(),
                    "data" => $a
                );
            } else {
                array_push($post[$a['parent_id']]['childs'], $a);
            }
        };
        rsort($keys);
        return Inertia::render('Article/Index', ["categories" => V_categorie_dispo::all(), "articles" => $post,"curr_user" => $user->user_id, "keys" => $keys]);
    }

    public function store(StoreArticleRequest $request)
    {
        $user = Auth::user();
        Article::create([
            'texte' => nl2br($request['texte']),
            'titre' => $request['titre'],
            'categorie_id' => $request['categorie'],
            'user_id' => $user['user_id'],
            'parent_id' => $request['parent_id']
        ]);
    }

    public function update(UpdateArticleRequest $request, Article $article)
    {
        
        $user = Auth::user();
        $arr = $article['rating'];
        if($request["like"]){

            if(($key = array_search($user['user_id'], $article['rating']['likes'])) !== false){
                unset($arr['likes'][$key]);
            }else{
                if(($key = array_search($user['user_id'], $article['rating']['dislikes'])) !== false){
                    unset($arr['dislikes'][$key]);
                }
                array_push($arr['likes'], $user['user_id']);
            }
        }else{
            if(($key = array_search($user['user_id'], $article['rating']['dislikes'])) !== false){
                unset($arr['dislikes'][$key]);
            }else{
                if(($key = array_search($user['user_id'], $article['rating']['likes'])) !== false){
                    unset($arr['likes'][$key]);
                }
                array_push($arr['dislikes'], $user['user_id']);
            }
        }
        $article->rating = $arr;
        $article->save();
    }

}
