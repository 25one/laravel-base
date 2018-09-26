var BaseRecord=(function() {
$(document).ready(function() {
  $("select").prepend("<option value='0' selected>not matter</option>");
  $("body").on("change", "select", function(){BaseRecord.validate($(".text_name").val(), $(".text_price_from").val(), $(".text_price_to").val(), form_house.bedrooms_count.options[form_house.bedrooms_count.selectedIndex].value, form_house.bathrooms_count.options[form_house.bathrooms_count.selectedIndex].value, form_house.storeys_count.options[form_house.storeys_count.selectedIndex].value, form_house.garages_count.options[form_house.garages_count.selectedIndex].value);});
  $("body").on("click", ".img_go", function(){BaseRecord.validate($(".text_name").val(), $(".text_price_from").val(), $(".text_price_to").val(), form_house.bedrooms_count.options[form_house.bedrooms_count.selectedIndex].value, form_house.bathrooms_count.options[form_house.bathrooms_count.selectedIndex].value, form_house.storeys_count.options[form_house.storeys_count.selectedIndex].value, form_house.garages_count.options[form_house.garages_count.selectedIndex].value);});
  $(".text_newcategory").val("");
});
return {

   validate:function(name, pricefrom, priceto, bedroomscount, bathroomscount, storeyscount, garagescount) {
      var r=/^(\d+|)$/;
      if(r.test(pricefrom) && r.test(priceto)) {
          $(".title_price_error").html("&nbsp;");
          if(name=="") {name="0";}
          if(pricefrom=="") {pricefrom="0";}
          if(priceto=="") {priceto="0";}
          this.resulthouse(name, pricefrom, priceto, bedroomscount, bathroomscount, storeyscount, garagescount);
      }
      else {
          $(".title_price_error").html("Bad format of price...");
      }
   },

   resulthouse:function(name, pricefrom, priceto, bedroomscount, bathroomscount, storeyscount, garagescount) {
      var ajaxSetting={
          method:"post",
          url:"api/resulthouse/"+encodeURIComponent(name)+"/"+encodeURIComponent(pricefrom)+"/"+encodeURIComponent(priceto)+"/"+encodeURIComponent(bedroomscount)+"/"+encodeURIComponent(bathroomscount)+"/"+encodeURIComponent(storeyscount)+"/"+encodeURIComponent(garagescount),
          success: function(data) {
             var data_json=JSON.parse(data);
             for(var i in data_json) {
                if(i=="null") {alert(data_json[i]);}
                if(i=="error") {$(".title_price_error").html(data_json[i]);}
                if(i=="select_null") {alert(data_json[i]);}
                if(i=="select") {
                   var str_json="";
                   for(var j in data_json[i]) {
                      str_json+="<tr><td>"+data_json[i][j]['name']+"</td><td>"+data_json[i][j]['price']+"</td><td>"+data_json[i][j]['count_bedrooms']+"</td><td>"+data_json[i][j]['count_bathrooms']+"</td><td>"+data_json[i][j]['count_storeys']+"</td><td>"+data_json[i][j]['count_garages']+"</td></tr>";
                   }
                   $(".tbody_result").html(str_json);
                }
             }
          },
      };
      $.ajax(ajaxSetting);
   },

};
})();