<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Article;
use App\Categories;
use App\Repository\Articles\ArticleRepositoryInterface;
use App\Repository\Categories\CategoriesRepositoryInterface;


class ArticleController extends Controller
{
    //

     /*
 *
 *@ var CategoriesRepositoryInterface
 *
 */

   private $categories;
   private $article;

    /*
 *
 *@ var CategoriesController
 *  constructor
 *
 */

  public function __construct(CategoriesRepositoryInterface $categories, ArticleRepositoryInterface $article)

  {
    $this->categories = $categories;
    $this->article = $article;
  }

    public function index()
    {
      $categories = $this->categories->getAll();
      $article = $this->article->getAll();

      return view('article.article', compact('categories','article'));
    }

    public function store(Request $request, ArticleRepositoryInterface $article){

    // traitement du formulaire

     // validator varialble ;
          $messages = [
			'name.max' => 'le nom dois etre une chaine de caractère.',
			'name.min' => 'Votre nom ne peut depasser :min caractères.',
            'name.required'=>'vous devez saisir le nom du produit',
			'famille.required' => 'Vous devez saisir le nom de famille',
			'categories.required' => 'vous devez remplir la categories',
			
        ];

		$rules = [
			'name' => 'required|string|min:5|max:55',
			'famille' => 'required|string|min:3|max:255',
            
		];

          $validator = Validator::make($request->all(),$rules,$messages);
		if ($validator->fails()) {
			return redirect('article')
			->withInput()
			->withErrors($validator);
		}

        else{

          // recuperation des des variables
          // recupere toute les variable dans un tableau
          $data = $request->input();
          // instancifie la class article

           $this->article->create([
          'name'=>$data['name'],
          'famille'=>$data['famille'],
          'categories_id'=>$data['has'],
          'image'=>$data['image'],
          ]);

          // retun sur la same page
          return redirect('article')->with('status',"vos données sont bien enregsitrées");

        }


    }

    public function show($id)
    {
       // recupere les article d'une categories
       $article = $this->categories->getById($id);
      $articles = $article->articles;
      return view('article.show', compact('articles'));
      
    }

    public function list($id)

    {
     // afficher les nom , famillle de categories et   article issus de la jointure
     $list = $this->article->list($id);
     return view('article.list' , compact('list'));

    }
}
