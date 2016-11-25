<?php

require_once('Database.php');
class Api_Category extends Api
{

	private $dbInstance='';

	function __construct(){
		
		$this->dbInstance=new Database();
		
	}

	private function getCategory($id){
		$sql="select * from category where category_id = $id";
		$category=$this->dbInstance->select($sql);
		return Api::responseOk($category);
	}

	private function getAllCategories(){
		$sql="select * from category ";
		$category=$this->dbInstance->select($sql);
		return Api::responseOk($category);
	}

	private function addCategory($name,$description){
		
		$sql="insert into category (name,description) values (".$this->dbInstance->quote($name).",".$this->dbInstance->quote($description).")";
		$result=$this->dbInstance->query($sql);
		return $result;
	}

    public function get($id = null)
    {
		$id=str_replace('/v1.0','',$id);
		$id=str_replace('category.json','',$id);
		$id=str_replace('/category','',$id);
		$id=str_replace('/','',$id);
		$id=str_replace('.json','',$id);
        if ($id) {
            return $this->getCategory(intval($id));
        } else {
            return $this->getAllCategories();
        }
    }

    public function post()
    {
		$name=$_REQUEST['name'];
		$description=$_REQUEST['description'];
		$result= $this->addCategory($name,$description);
        return Api::responseOk($result);
    }

}
/*
$cateObj=new Category();
echo $cateObj->getCategory(1);
*/
?>