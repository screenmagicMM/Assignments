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
            $result = $conn->query("SELECT id,cName as category,cDesc as description FROM categories");
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
                $result = $conn->query("SELECT id,cName as category,cDesc as description FROM categories WHERE id=".$cat_id); 
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
            $arrResult  = array();
            $arrData = json_decode(file_get_contents('php://input'),true);
            $name = $arrData['name'];
            $desc = $arrData['desc'];
            
            if($name !='' || $desc !=''){
                $result = $conn->query("INSERT INTO categories(cName,cDesc)
                        VALUES('".$name."','".$desc."') ") or die(mysql_error());
                if($conn->affected_rows){
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

