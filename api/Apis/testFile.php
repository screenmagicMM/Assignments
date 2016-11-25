<?php

require('Database.php');
class Category{
private $name;
private $description;
private $id;
private $dbInstance='';

function Category($name,$description,$id=false){
	echo "here1 ";
	/*if($id==false){
		
		$this->id='new';
	}
	else $this->id=$id;
	$this->$name=$name;
	$this->description=$description;*/
	$this->dbInstance=Database()::getInstance();
	
}

function getCategory($id){
	$sql="insert into category values ('".$name."','".$description."')";
	
	$this->dbInstance->getResult($sql);
	
}

function addCategory($name,$description){
	echo "here";
	
	$sql="insert into category values ('".$name."','".$description."')";
	
	$result=$this->dbInstance->executeQuery($sql);
	return $result;
}


}

$cateObj=new Category('test','testdesc');
echo $cateObj->addCategory('test','testdesc');

?>