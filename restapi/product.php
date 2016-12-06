<?php 
require_once('database.php');
$database  = new connection();
$conn = $database->db();
if(!$conn->error){
    $req_method = $_SERVER['REQUEST_METHOD'];
    $path = explode('/', trim($_SERVER['PATH_INFO'],'/'));
       
    $data = preg_replace('/[^a-z0-9_]+/i','',array_shift($path));
    $key = array_shift($path)+0;
    
    //Listing the product on the basis of cat id
    if($req_method == 'GET') {
        $arrResult = array();
        $finalResult = array();
        if($data =='all_list'){
            $result = $conn->query("SELECT pName as product,pDesc as product_desc ,price,tax,discount,categories.cName as category FROM products JOIN categories ON products.category =categories.id");
            if($conn->affected_rows>0){
                while($res_final = mysqli_fetch_assoc($result)){
                    $finalResult[] = $res_final;
                }
            }
             $arrResult  = array('status'=>'success','data'=>$finalResult);
        }
        else if($data =='list'){
            $cat_id    = $key;
            if($cat_id){
                $result = $conn->query("SELECT pName as product,pDesc as product_desc ,price,tax,discount,categories.cName as category FROM products JOIN categories ON products.category =categories.id WHERE category=".$cat_id); 
                if($conn->affected_rows>0){
                    while($res_final = mysqli_fetch_assoc($result)){
                        $finalResult[] = $res_final;
                    }
                }
                 $arrResult  = array('status'=>'success','data'=>$finalResult);
                
            }else{
                $arrResult  = array('status'=>'error','error_msg'=>'Invalid Key'); 
            }
           
        }else{
            $arrResult  = array('status'=>'error','error_msg'=>'Invalid Parameter'); 
        }
      echo  $arrResult = json_encode($arrResult);   
   }
    
    if($req_method == 'POST') { 
        if($data=='add'){
            $arrData = json_decode(file_get_contents('php://input'),true);
            $arrResult = array();
            $name = $arrData['name'];
            $desc = $arrData['desc'];
            $price = $arrData['price'];
            $tax = $arrData['tax'];
            $discount = $arrData['discount'];
            $category = $arrData['category'];
            if($name !='' || $desc !='' || $price !=''|| $tax!=''||$discount!=''||$category!=''){
                $cat_result = $conn->query("SELECT id FROM categories WHERE cName='".$category."' limit 0,1");
                if($conn->affected_rows>0){
                    $objCat = mysqli_fetch_object($cat_result);

                     $result = $conn->query("INSERT INTO products(pName,pDesc,price,tax,discount,category)
                             VALUES('".$name."','".$desc."','".$price."','".$tax."','".$discount."','".$objCat->id."') ") or die(mysql_error());
                     if($conn->affected_rows){
                         $arrResult = array('status'=>'success');
                     }else{
                         $arrResult = array('status'=>'error','error_msg'=>'Database error');
                     }

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

