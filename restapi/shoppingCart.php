<?php
require_once('database.php');
$database  = new connection();
$conn = $database->db();
session_start();
if(!$conn->error){
    $req_method = $_SERVER['REQUEST_METHOD'];
    $path = explode('/', trim($_SERVER['PATH_INFO'],'/'));
       
    $data = preg_replace('/[^a-z0-9_]+/i','',array_shift($path));
    
    //Listing the shoppping cart
    if($req_method == 'GET') {
        $arrResult = array();
        if($data =='all_list'){
            $products = $_SESSION['products'];
            $arrResult  = array('status'=>'success','data'=>$products);
        } else{
            $arrResult  = array('status'=>'error','error_msg'=>'Invalid Parameter'); 
        }
      echo  $arrResult = json_encode($arrResult);   
   }
    
    if($req_method == 'POST') {
        if($data=='add'){
            $arrResult = array();
            $arrData = json_decode(file_get_contents('php://input'),true);
            $name = $arrData['name'];
            $desc = $arrData['desc'];
            $price = $arrData['price'];
            $tax = $arrData['tax'];
            $discount = $arrData['discount'];
            $category = $arrData['category'];
            $shoppingCartCart = array();
            if($name !='' || $desc !='' || $price !=''|| $tax!=''||$discount!=''||$category!=''){
                $shoppingCartCart = $_SESSION['products'];
                $shoppingCartCart[] =$arrData;
                
                $_SESSION['products'] = $shoppingCartCart;
                
                if(count($_SESSION)>0){
                    $arrResult = array('status'=>'success');
                }else{
                    $arrResult = array('status'=>'error','error_msg'=>'Database error');
                }
            }else{
                $arrResult  = array('status'=>'error','error_msg'=>'Missing Parameter'); 
            }
        }else{
             $arrResult  = array('status'=>'error','error_msg'=>'Missing Parameter'); 
        }
        
        echo json_encode($arrResult);die;
        
    }


}

