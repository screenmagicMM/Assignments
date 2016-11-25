<?php
require('products.php');
require ('category.php');
require ('cart.php');
	
#initialise Objects 


#Product functionss
function get_product_by_id($id){
	$produtObj=new Products();

	return $productObj->getProduct($id);
}

function add_product($name,$description,$tax,$discount,$category_id){
	$produtObj=new Products();

	$retRes= $productObj->addProduct($name,$description,$tax,$discount,$category_id);
	return  $retRes?array('success'=>'Successfully Inserted Product'):array('error'=>'Error occurred');
	
}

function get_all_products(){
	$produtObj=new Products();

	return $productObj->getAllProducts();
}

#category functions
function get_category_by_id($id){
	$categoryObj=new Category();
	return $categoryObj->getCategory($id);
}

function add_category($name,$description){
	$categoryObj=new Category();
	$retRes= $categoryObj->addCategory($name,$description);
	return  $retRes?array('success'=>'Successfully Inserted Category'):array('error'=>'Error occurred');
}

function get_all_categories(){
	$categoryObj=new Category();
	return $categoryObj->getAllCategories();
}

#cart functions
function get_cart_by_id($id){
	$cartObj= new Cart();
	$cartInfo=$cartObj->getCart($id);
	$produtObj=new Products();
$products=$cartInfo[0]['PRODUCTS'];
	foreach( $products as $productId){
	$productObj->getProduct(productId);
}
	
}

function add_cart($name,$products){
	$cartObj= new Cart();
	$retRes= $cartObj->addCart($name,$products);
	return  $retRes?array('success'=>'Successfully Inserted Cart'):array('error'=>'Error occurred');
}


$possible_url = array("get_product_by_id", "get_all_products","add_product","get_category_by_id", "get_all_categories","add_category","show_cart","add_cart");

$value = "An error has occurred";

if (isset($_GET["action"]) && in_array($_GET["action"], $possible_url))
{
  switch ($_GET["action"])
    {
      case "get_product_by_id":
		if(isset($_GET["id"]))
			$value = get_product_by_id();
		else $value="Missing Argument: product id";
        break;
	  case "get_all_products":
        $value = get_product_by_id();
        break;
      case "add_product":
        if (isset($_GET["name"]) && isset($_GET["description"]) && isset($_GET["tax"]) && isset($_GET["discount"]) && isset($_GET["category_id"]))
          $value = add_product($_GET["id"] , $_GET["description"] , $_GET["tax"] , $_GET["discount"] , $_GET["category_id"]);
        else
          $value = "Missing argument";
        break;
	
	  case "get_category_by_id":
		if(isset($_GET["id"]))
			$value = get_category_by_id($_GET["id"]);
		else $value="Missing Argument: category id";
        break;		
	  case "get_all_categories":
        $value = get_all_categories();
        break;
      case "add_category":
        if (isset($_GET["name"]) && isset($_GET["description"]))
          $value = add_category($_GET["name"] , $_GET["description"] );
        else
          $value = "Missing argument";
        break;
		
	  case  "show_cart":
			if(isset($_GET["id"]))
				$value = get_cart_by_id($_GET["id"]);
			else $value="Missing Argument: cart id";
		break;
	  case "add_cart":
        if (isset($_GET["name"]) && isset($_GET["products"]))
          $value = add_cart($_GET["name"] , $_GET["products"] );
        else
          $value = "Missing argument ";
        break;
		
	
    }
}

//return JSON array
exit(json_encode($value));
?>