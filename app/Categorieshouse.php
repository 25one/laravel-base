<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Categorieshouse extends Model
{

   protected $table = 'categorieshouse';
   public $timestamps = false;

function rules($request) {
  $validator = Validator::make(

    array(
          'newcategory' => $request->input('newcategory'),
          //'login' => $request->input('login'),
    ),

    array(
          'newcategory' => 'required',
          //'login' => 'regex:/^[\w\d]+$/iu',
    )

  );
  return $validator;
}

function saveCategory($request) {

      if(!$this->rules($request)->fails()) {
         $this->category = $request->newcategory;
         $this->save();
         $error_categorieshouse = '';
      }
      else {
         $error_categorieshouse = 'Field must be fulled';
      }	
      $result_categorieshouse = $this->all();
      $array_return['result_categorieshouse'] = $result_categorieshouse;
      $array_return['error_categorieshouse'] = $error_categorieshouse;
      return $array_return;

}

}
