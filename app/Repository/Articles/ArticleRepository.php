<?php

namespace App\Repository\Articles;
use App\Article;
use App\categories;
use Illuminate\Support\Facades\DB;


class ArticleRepository implements ArticleRepositoryInterface {


/*
 *
 * @var categories
 *
*/

 private $model;


 public function __construct(Article $model)
 {
   $this->model = $model;
 }


  public function  getAll()
  {
    return Article::all();
   }

  public function getById($id){

   return Article::find($id);

  }


  public function create(array $attribues){

    return $this->model->create($attribues);
  }


  public function udapte($id, array $attribues)

  {
    $categories = $this->model->findOrFail($id);
    $categories->udapte($attribues);
  }

  public function delete($id)

  {
    $this->getById($id)->delete();

    return true;
 }

 public function count()
 {
  return Article::count;
 }

 public function list($id)

 {
    return DB::table('categories')
    ->select('categories.name','categories.num','articles.famille')
    ->join('articles', 'categories.id','articles.categories_id')
    ->where('categories.id', $id)
    ->get();

 }

 public function listjoins($id)

 {
    return categories::find($id)->with('articles')->get();

 }

 }

?>
