<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;
use App\Categorieshouse;
use Illuminate\Http\Request;

class HouseController extends Controller
{

    public function index()
    {

       $model_categorieshouse = new Categorieshouse;
       $result_categorieshouse = $model_categorieshouse->all();
       //$result_categorieshouse = Categorieshouse::all();

       return view('house/house', ['result_categorieshouse'=>$result_categorieshouse]);
   
    }

    public function addCategory(Request $request)
    {

      $model_categorieshouse = new Categorieshouse;

/*
      $validator=$model_categorieshouse->rules($request);
      if(!$validator->fails()) {
       $model_categorieshouse->category = $request->newcategory;
       $model_categorieshouse->save();

       $result_categorieshouse = $model_categorieshouse->all();
    
       return view('house/house', ['result_categorieshouse'=>$result_categorieshouse, 'error_categorieshouse'=>'']);
      } 
      else {
       $result_categorieshouse = $model_categorieshouse->all();

       return view('house/house', ['result_categorieshouse'=>$result_categorieshouse, 'error_categorieshouse'=>'Field must be fulled']);
      } 
*/

      return view('house/house', ['result_categorieshouse'=>$model_categorieshouse->saveCategory($request)['result_categorieshouse'], 'error_categorieshouse'=>$model_categorieshouse->saveCategory($request)['error_categorieshouse']]);    

    }    

    public function resulthouse($name, $pricefrom, $priceto, $bedroomscount, $bathroomscount, $storeyscount, $garagescount)
    {
       if($name=="0" && $pricefrom=="0" && $priceto=="0" && $bedroomscount=="0" && $bathroomscount=="0" && $storeyscount=="0" && $garagescount=="0") {
          $houses['null']='Please select at least one category';
       }
       else {
           $r="/^(\d+|)$/";
           if(!preg_match($r, $pricefrom) || !preg_match($r, $priceto)) {
              $houses['error']='Bad format of price...';
           }
           else  {
               $houses['error']='&nbsp;';
               if($name=="0") {$name='';}
               if($pricefrom=="0") {$pricefrom=0;}
               if($priceto=="0") {$priceto=1000000;}
               if($bedroomscount==0) {$wherebedrooms='<>';} else {$wherebedrooms='=';}
               if($bathroomscount==0) {$wherebathrooms='<>';} else {$wherebathrooms='=';}
               if($storeyscount==0) {$wherestoreys='<>';} else {$wherestoreys='=';}
               if($garagescount==0) {$wheregarages='<>';} else {$wheregarages='=';}

               $houses['select'] = DB::select('
                    select t1.name, t1.price, t2.count as count_bedrooms, t3.count as count_bathrooms, t4.count as count_storeys, t5.count as count_garages  from
                    house as t1,
                    (select id_house,count from housecategories where id_category=1) as t2,
                    (select id_house,count from housecategories where id_category=2) as t3,
                    (select id_house,count from housecategories where id_category=3) as t4,
                    (select id_house,count from housecategories where id_category=4) as t5
                    where t1.id=t2.id_house
                    and t1.id=t3.id_house
                    and t1.id=t4.id_house
                    and t1.id=t5.id_house
                    and t1.name like ?
                    and t1.price >= ?
                    and t1.price <= ?
                    and t2.count '.$wherebedrooms.' ?
                    and t3.count '.$wherebathrooms.' ?
                    and t4.count '.$wherestoreys.' ?
                    and t5.count '.$wheregarages.' ?
               ', ["%".$name."%", $pricefrom, $priceto, $bedroomscount, $bathroomscount, $storeyscount, $garagescount]);

               if(empty($houses['select'])) {
                  $houses['select_null']='Nothing found on request...';
               }

            }
       }

       echo json_encode($houses);

    }

}
