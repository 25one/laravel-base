<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\House_start;

class House extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('price');

        }); 

        $model_house = new House_start;
        $result_house = $model_house->all();
        foreach($result_house as $result_house_row) {
            DB::table('house')->insert(
              array(
                'name' => $result_house_row->name,
                'price' => $result_house_row->price,
              )
            );  
        } 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists('house');        
    }
}
