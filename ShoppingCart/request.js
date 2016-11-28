$(document).ready(function(){

    $("#addcategory :button").click(function(){
        $.ajax({
		type: 'POST',
		data: $('#addcategory :input').serialize(),
		url: "/ShoppingCart/addcategory/",
                dataType: 'html',
        }).done(function ( data ) {
  			$('#category_message').html(data);
		})
    });

    $("#listcategory :button").click(function(){
    	$(".message").empty();
        $.ajax({
                type: 'GET',
                url: "/ShoppingCart/category/",
                dataType: 'html',
        }).done(function ( data ) {
  			$('#category_list').html(data);
		})
    });

    $("#addproduct :button").click(function(){
    	$(".message").empty();
        $.ajax({
                type: 'POST',
                data: $("#addproduct").find("select, input").serialize(),
                url: "/ShoppingCart/addproduct/",
                dataType: 'html',
        }).done(function ( data ) {
      			$('#product_message').html(data);
		})
    });

    $("#addcart select").change(function(){
    	$(".message").empty();
        $.ajax({
                type: 'POST',
                data: $('#addcart select').serialize(),
                url: "/ShoppingCart/listproducts/",
                dataType: 'html',
        }).done(function ( data ) {
        	$('#product_list').empty();
  			$('#product_list').html(data);
		})
    });

	$("#addcart button").click(function(){
		$(".message").empty();
        $.ajax({
                type: 'POST',
                data: $("#addcart").find("select").serialize(),
                url: "/ShoppingCart/createcart/",
                dataType: 'html',
        }).done(function ( data ) {
  			$('#cart_message').html(data);
		})
    });

    $("#showcart :button").click(function(){
    	$(".message").empty();
        $.ajax({
                type: 'GET',
                url: "/ShoppingCart/showcart/",
                dataType: 'html',
        }).done(function ( data ) {
  			$('#cart').html(data);
		})
    });
});
