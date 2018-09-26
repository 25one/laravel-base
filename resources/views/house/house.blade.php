<!DOCTYPE html>
<html lang="en">
  <head>
    <title>House</title>
<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" type="text/css" href="{{ asset('css/mine_house.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/mine_house.js') }}"></script>
  </head>

  <body>

<div class="container">

<div class="form_house">

    {{ Form::open(['url' => '../public/house', 'method' => 'post', 'name' => 'form_house']) }}

    <div class="row_td">
    <div class="cell_td cell_form_label">
       {{ Form::label('name', 'Name: ') }}
    </div>
    <div class="cell_td cell_form_field">
       {{ Form::text('name', null, ['class' => 'text_name']) }}
    </div>
    </div>

    <div class="row_td">
    <div class="cell_td cell_form_label">
       {{ Form::label('bedrooms', 'Bedrooms: ') }}
    </div>
    <div class="cell_td cell_form_field">
       {{ Form::select('bedrooms_count', \App\Housecategories::where('id_category', '1')->groupBy('count')->pluck('count', 'count')->toArray()) }}
    </div>
    </div>

    <div class="row_td">
    <div class="cell_td cell_form_label">
       {{ Form::label('bathrooms', 'Bathrooms: ') }}
    </div>
    <div class="cell_td cell_form_field">
       {{ Form::select('bathrooms_count', \App\Housecategories::where('id_category', '2')->groupBy('count')->pluck('count', 'count')->toArray()) }}
    </div>
    </div>

    <div class="row_td">
    <div class="cell_td cell_form_label">
       {{ Form::label('storeys', 'Storeys: ') }}
    </div>
    <div class="cell_td cell_form_field">
       {{ Form::select('storeys_count', \App\Housecategories::where('id_category', '3')->groupBy('count')->pluck('count', 'count')->toArray()) }}
    </div>
    </div>

    <div class="row_td">
    <div class="cell_td cell_form_label">
       {{ Form::label('garages', 'Garages: ') }}
    </div>
    <div class="cell_td cell_form_field">
       {{ Form::select('garages_count', \App\Housecategories::where('id_category', '4')->groupBy('count')->pluck('count', 'count')->toArray()) }}
    </div>
    </div>

    <div class="row_td">
    <div class="cell_td cell_form_label">
    {{ Form::label('price_from', 'Price: from ') }}
    </div>
    <div class="cell_td cell_form_field">
    {{ Form::text('price_from', null, ['class' => 'text_price_from']) }}
    {{ Form::label('price_to', ' to ') }}
    {{ Form::text('price_to', null, ['class' => 'text_price_to']) }}
    </div>
    </div>

    <div class="row_td">
    <div class="cell_td cell_form_label">
    <span class="title_price_validate">(integer)</span>
    </div>
    <div class="cell_td cell_form_field">
    <span class="title_price_error">&nbsp;</span>
    </div>
    </div>

    <div class="row_td">
    <div class="cell_td cell_form_label">
    &nbsp;
    </div>
    <div class="cell_td cell_form_field">
       <img src="{{asset('images/go.jpg')}}" class="img_go" alt />
    </div>
    </div>

    {{ Form::close() }}

<div class="result_categorieshouse">
<?php
foreach($result_categorieshouse as $result_categorieshouse_row) {
   echo $result_categorieshouse_row->category; echo '<br>';
}
?>
</div>

{!! Form::open(['url' => '../public/house/addcategory', 'method' => 'post']) !!}
{!! Form::text('newcategory', '', array('class'=>'text_newcategory')) !!}
{!! Form::submit('Add category') !!}
{!! Form::close() !!}
<span style="color:red;"><?php if(isset($error_categorieshouse) && $error_categorieshouse != '') {echo $error_categorieshouse;} else if(isset($error_categorieshouse) && $error_categorieshouse == '') {echo '&nbsp;';} ?></span>

</div>

<div class="result_house">
<table>
<tbody>
<tr>
<td class="table_result_title_name">Name</td>
<td class="table_result_title_others">Price</td>
<td class="table_result_title_others">Bedrooms</td>
<td class="table_result_title_others">Bathrooms</td>
<td class="table_result_title_others">Storeys</td>
<td class="table_result_title_others">Garages</td>
</tr>
</tbody>
<tbody class="tbody_result">
</tbody>
</table>
</div>

</div>

  </body>
</html>