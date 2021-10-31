<?php

namespace App\Repository\Categories;
use App\Categories;

class CategoriesRepository implements CategoriesRepositoryInterface {


/*
 *
 * @var categories
 *
*/

 private $model;


 public function __construct(Categories $model)
 {
   $this->model = $model;
 }


  public function  getAll(){

   return Categories::all();

  }

  public function getById($id){

   return Categories::find($id);

  }


  public function create(array $attribues){

    return $this->model->create($attribues);
  }


  public function udapte($id, array $attribues)

  {
    $categories = $this->model->findOrFail($id);
    $categories ->udapte($attribues);
  }

  public function delete($id)

  {
    $this->getById($id)->delete();

    return true;
 }


 

 }

?>
