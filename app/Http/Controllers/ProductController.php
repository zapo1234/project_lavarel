<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Categories;
use App\Products;
use App\Repository\Categories\CategoriesRepositoryInterface;
use App\Repository\Product\ProductRepositoryInterface;



class ProductController extends Controller
{

  /*
 *
 *@ var CategoriesRepositoryInterface
 *
 */

   private $categories;
   private $product;

    /*
 *
 *@ var CategoriesController
 *  constructor
 *
 */

  public function __construct(CategoriesRepositoryInterface $categories, ProductRepositoryInterface $product)

  {
      $this->categories = $categories;
      $this->product = $product;
  }


    public function index(){

     // recupere la liste des categeoris
       $result = $this->categories->getAll();

       return view('product.product', compact('result'));
    }


    public function store(Request $request) {
  // validator pour ecrire les regex
   // validator varialble ;
          $messages = [
			'name.max' => 'le nom dois etre une chaine de caractère.',
			'name.min' => 'Votre nom ne peut depasser :min caractères.',
            'name.required'=>'vou devez saisir le nom du produit',
			'famille.required' => 'Vous devez saisir le nom de famille',
			'categories.required' => 'vous devez choisir la categories',
        ];

		$rules = [
			'name' => 'required|string|min:5|max:55',
			'famille' => 'required|string|min:3|max:255',
            'num' => 'required|string|max:5|regex:/[0-9]{1,3}/',
            'num' => 'required|string|max:30'
		];

        // filtrer les varaible
         $validator = Validator::make($request->all(),$rules,$messages);
		if ($validator->fails()) {
			return redirect('product')
			->withInput()
			->withErrors($validator);
		}

        else{
        
         // on reucpere les variable
         $data = $request->input;

         // insert into prodcut

         $this->product->create([
             'name'=>$data['name'],
             'famille'=>$data['famille'],
             'categories_id'=>$data['categeoris_id'],
             'image'=>$data['image'],
         ]);

         // retun sur la same page
          return redirect('product/list')->with('status'," un product à eté bien crée");
        }

    }

}
