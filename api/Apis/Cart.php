<?php

require_once('Database.php');
class Api_Cart extends Api
{
private $dbInstance='';

function __construct(){
	$this->dbInstance=new Database();
}

function getCart($id){
	$sql="select * from cart where cart_id = $id";
	$cart=$this->dbInstance->select($sql);
	return $cart;
}

function getAllCarts(){
	$sql="select * from cart ";
	$cart=$this->dbInstance->select($sql);
	return $cart;
}

function addCart($name,$products){

	
	$sql="select * from products where id in ( $products ) ";
	$result= $this->dbInstance->select($sql);
	$total=0;
	$totalTax=0;
	$totalDiscount=0;
	$grandTotal=0;
	$productTax=0;
	$productDiscount=0;
	//print_r($result);
	foreach($result as $product){
	
		$productTax=0;
		$productDiscount=0;

		$total+=$product['price'];
		$productPrice=$product['price'];

		if($product['tax'] > 0)
			$productTax=$product['price'] * ($product['tax'] / 100);
		
		$productDiscount=$product['price'] * ($product['discount'] / 100);
		
		$totalTax+=$productTax;
		$totalDiscount+=$productDiscount;;
	}
	$grandTotal= $total - $totalDiscount + $totalTax;
	
	$sql="insert into cart (name,products,total,totaltax,discount,grandtotal) values (".$this->dbInstance->quote($name).",".$this->dbInstance->quote($products).",$total,$totalTax,$totalDiscount,$grandTotal)";
	$result=$this->dbInstance->query($sql);
	return $result;
}


public function get($id = null)
    {
		$id=str_replace('/v1.0','',$id);
		$id=str_replace('cart.json','',$id);
		$id=str_replace('/cart','',$id);
		$id=str_replace('/','',$id);
		$id=str_replace('.json','',$id);
        if ($id) {
            return $this->getCart(intval($id));
        } else {
            return $this->getAllCarts();
        }
    }

    public function post()
    {
		$name=$_REQUEST['name'];
		$products=$_REQUEST['products'];
	
		$result= $this->addCart($name,$products);
        return Api::responseOk($result);
    }

        
}

/*
$cateObj=new cart('test','testdesc');
echo $cateObj->getcart(1);
*/
?>