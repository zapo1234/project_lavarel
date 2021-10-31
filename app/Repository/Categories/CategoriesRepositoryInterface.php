<?php

namespace App\Repository\Categories;

interface CategoriesRepositoryInterface

{

  public function  getAll();


  public function getById($id);


  public function create(array $attribues);


  public function udapte($id, array $attribues);

  public function delete($id);

  

}


?>
