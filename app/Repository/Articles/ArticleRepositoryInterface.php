<?php


namespace App\Repository\Articles;

interface ArticleRepositoryInterface

{

  public function  getAll();


  public function getById($id);


  public function create(array $attribues);


  public function udapte($id, array $attribues);

  public function delete($id);

  public function count();

  public function list($id);

  public function listjoins($id);

}



