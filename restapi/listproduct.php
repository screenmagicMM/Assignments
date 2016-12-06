<?php
require_once('database.php');
$database  = new connection();
$conn = $database->db();
if(!$conn->error){
    $result = $conn->query("SELECT products.id,pName as product,pDesc as product_desc ,price,tax,discount,categories.cName as category FROM products JOIN categories ON products.category =categories.id");
    if($conn->affected_rows>0){
        while($res_final = mysqli_fetch_assoc($result)){
            $finalResult[] = $res_final;
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>List Product</title>
        <script src="js/jquery-1.10.2.min.js"></script>        
        <script src="js/jquery.json.js"></script>        
        <script src="js/jquery.validate.js"></script>        
    </head>
    <body>
        <?php require_once 'header.php'; ?>
         <div><h1>List Product</h1></div> 
            <div id='successMsg'></div>
            <div id='errorMsg'></div>
        <table cellspacing="0" cellpadding="0" wodth="100%" border='1'>
            <tr>
                <td><b>Category</b></td>
                <td><b>Product Name</b></td>
                <td><b>Description</b></td>
                <td><b>Price</b></td>
                <td><b>Tax</b></td>
                <td><b>Discount</b></td>
                <td><b>Action</b></td>
            </tr>
            <?php foreach($finalResult as $res){
                ?>
                <tr>
                   <td id='cat_<?php echo $res['id'];?>' ><?php echo $res['category'];?></td>
                   <td id='prodid_<?php echo $res['id'];?>'><?php echo $res['product'];?></td>
                   <td id='prodes_<?php echo $res['id'];?>'><?php echo $res['product_desc'];?></td>
                   <td id='price_<?php echo $res['id'];?>'><?php echo $res['price'];?></td>
                   <td id='tax_<?php echo $res['id'];?>'><?php echo $res['tax'];?></td>
                   <td id='discount_<?php echo $res['id'];?>'><?php echo $res['discount'];?></td>
                   <td> <input type='button' name='addtocart' prodid='<?php echo $res['id'];?>' id="addtocart" value='Add To Cart'></td>
               </tr>
                <?php
            }?>
        </table>
     <script>
     jQuery(document).ready(function(){
        jQuery(document).on('click','#addtocart',function() {
            var id = $(this).attr('prodid');
            var name = $('#prodid_'+id).text();
            var category = $('#cat_'+id).text();
            var prodes = $('#prodes_'+id).text();
            var price = $('#price_'+id).text();
            var tax = $('#tax_'+id).text();
            var discount = $('#discount_'+id).text();           
                jQuery.ajax({
                    type: 'POST',
                    url: 'shoppingcart.php/add',
                    dataType: 'json',
                    data :'{"name":"'+name+'", "desc":"'+prodes+'", "tax":"'+tax+'", "price":"'+price+'", "discount":"'+discount+'","category":"'+category+'" }',
                    contentType: "application/json",
                    success: function (data) {
                        var messages = JSON.parse(JSON.stringify(data));
                        if(messages.status == 'success') {
                            jQuery('#successMsg').html('Created successfully').css('color','green');
                        }else{
                            jQuery('#errorMsg').html('Error occured').css('color','red');
                        }
                    }
            });
        });
    });
        
 </script>
        
    </body>    
        
</html>

