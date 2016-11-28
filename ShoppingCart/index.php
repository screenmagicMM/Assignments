<?php

spl_autoload_register(function($class) {
    include $class . '.php';
});

$html = '<!DOCTYPE html>
	<html>
		<script src="http://localhost/ShoppingCart/jquery-3.1.1.min.js"></script>
		<script src="http://localhost/ShoppingCart/request.js" type="text/javascript"></script>
		<link rel="stylesheet" type="text/css" href="style.css">
		<body>


			<div class="caption">Create New Category</div> 
			<div id="addcategory" >
				<span>Name</span>  <input type="text" id="category_name" name="category_name" maxlength="50" />

				<span>Description</span><input type="text" id="category_desc" name="category_desc" maxlength="250" />
				<button>Add Category</button>
			</div>
			<div id="category_message" class="message"></div><br/>

			<div id="listcategory" class="caption">List All Categories: <button>Show Category</button></div> 
			<div id="category_list"></div>
<br/><br/>

			<div class="caption">Add New Product</div> 
			<div id="addproduct" >
				<span>Category</span>&nbsp;';



$objShoppingCart = new ShoppingCart();
$categoryBox = $objShoppingCart->ListCategories(true);

				$html .= $categoryBox; 				
    
				$html .= '&nbsp;<span>Product Name</span>  <input type="text" id="product_name" name="product_name" maxlength="50" value="" />
				<span>Product Description</span>&nbsp;<input type="text" id="product_desc" name="product_desc" maxlength="250" value="" />
				<br/>
				<span>Price</span>&nbsp;<input type="text" id="price" name="price" value=0 class="num" />
				<span>Tax</span>&nbsp;<input type="text" id="tax" name="tax" value=0 class="num" />
				<span>Discount</span>&nbsp;<input type="text" id="discount" name="discount" value=0 class="num" />
				<button>Add Product</button>
			</div>
			<div id="product_message" class="message"></div><br/>
	
			<div class="caption">Add Cart</div> 
			<div id="addcart" >
				<span>Category</span>';

				$html .= $categoryBox; 				
    
    				$html .= '&nbsp;&nbsp;<span>Product</span>&nbsp;';
    			
    				$html .= '<span id="product_list">'. $objShoppingCart->ListProducts(true) .'</span>';		

    
				$html .= '&nbsp;&nbsp;<button>Add to Cart</button>
			</div>
	<div id="cart_message" class="message"></div><br/>
			<div id="showcart" class="caption">Show Cart: <button>Show Cart</button></div> 
			<div id="cart"></div>
		
	</body>
</html>';

echo $html;


