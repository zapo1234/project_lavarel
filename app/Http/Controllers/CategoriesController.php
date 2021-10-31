<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Categories;
use App\Repository\Categories\CategoriesRepositoryInterface;
use Barryvdh\Debugbar\Facade as Debugbar;

class CategoriesController extends Controller
{


 /*
 *
 *@ var CategoriesRepositoryInterface
 *
 */

   private $categories;

    /*
 *
 *@ var CategoriesController
 *  constructor
 *
 */

  public function __construct(CategoriesRepositoryInterface $categories)

  {
      $this->categories = $categories;
  }

    public function index(){
    return view('product.index');
    }


    public function stores(Request $request)
    {
          // validator varialble ;
          $messages = [
			'name.max' => 'le nom dois etre une chaine de caractère.',
			'name.min' => 'Votre nom ne peut depasser :min caractères.',
            'name.required'=>'vou devez saisir le nom du produit',
			'famille.required' => 'Vous devez saisir le nom de famille',
			'num.required' => 'vous devez saisir votre un nombre',
			'num.regex' => 'votre  doit etre age est un nombre entier',
        ];

		$rules = [
			'name' => 'required|string|min:5|max:55',
			'famille' => 'required|string|min:3|max:255',
            'num' => 'required|string|max:5|regex:/[0-9]{1,3}/',
            'num' => 'required|string|max:30'
		];

        $validator = Validator::make($request->all(),$rules,$messages);
		if ($validator->fails()) {
			return redirect('product/list')
			->withInput()
			->withErrors($validator);
		}

        else{
          // insert into data base
         // recuperation des données
          $data = $request->input();
         // insert into dd
          $this->categories->create([
          'name'=>$data['name'],
          'famille'=>$data['famille'],
          'num'=>$data['num'],
          ]);

          // retun sur la same page
          return redirect('product/list')->with('status',"vos données sont bien enregsitrées");
        }

     }

    
}
