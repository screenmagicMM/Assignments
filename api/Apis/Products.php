<?php
require_once('Database.php');
class Api_Products extends Api{
	
	private $dbInstance='';

	public function __construct()
    {
        // In here you could initialize some shared logic between this API and rest of the project
		$this->dbInstance=new Database();
    }
	private function getProduct($id){
		
		$sql="select * from products where id= $id";
		$result= $this->dbInstance->select($sql);
		
		return Api::responseOk($result);	
		
	}
	private function getAllProducts(){
		
		$sql="select * from products";
		$result= $this->dbInstance->select($sql);
		return Api::responseOk($result);	
		
	}

	private function addProduct($name,$description,$tax,$discount,$price,$category_id){
		$sql="insert into products  (name,description,tax,discount,category_id,price)values (".$this->dbInstance->quote($name).",".$this->dbInstance->quote($description).",$tax,$discount,$category_id,$price)";
		$result=$this->dbInstance->query($sql);
		return $result;
	}
	
	public function get($id = null)
    {
		$id=str_replace('/v1.0','',$id);
		$id=str_replace('products.json','',$id);
		$id=str_replace('/products','',$id);
		$id=str_replace('/','',$id);
		$id=str_replace('.json','',$id);
		if (!empty($id )) {
            return $this->getProduct(intval($id));
        } else {
            return $this->getAllProducts();
        }
    }

    public function post()
    {
		$name=$_REQUEST['name'];
		$description=$_REQUEST['description'];
		$tax=$_REQUEST['tax'];
		$discount=$_REQUEST['discount'];
		$category_id=$_REQUEST['category_id'];
		$price=$_REQUEST['price'];
		$result= $this->addProduct($name,$description,$tax,$discount,$price,$category_id);
        return Api::responseOk($result);
    }
	
	
}
/*
$prodObj=new Products('test','testdesc');
echo $prodObj->addProduct('test','testdesc',10,10,1);
*/
?>