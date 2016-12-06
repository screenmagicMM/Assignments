<?php
require_once('database.php');
$database  = new connection();
$conn = $database->db();
if(!$conn->error){
    $result = $conn->query("SELECT id,cName as category,cDesc as description FROM categories");
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
        <title>Add Product</title>
        <script src="js/jquery-1.10.2.min.js"></script>        
        <script src="js/jquery.json.js"></script>        
        <script src="js/jquery.validate.js"></script>        
    </head>
    <body>
       <?php require_once 'header.php'; ?>
        <form name='addProduct' id='addProduct'>
            <div><h1>Add Product</h1></div> 
            <div id='successMsg'></div>
            <div id='errorMsg'></div>
        <table cellspacing="0" cellpadding="0" wodth="100%" border='1'>
                <tr><td>Category<font color='red'>*</font></td>
                    <td><select id='category' name='category'>
                            <option value=''>Select Category</option>
                            <?php foreach($finalResult as $val){?>
                                <option value='<?php echo $val['category'];?>'><?php echo $val['category'];?></option>
                            <?php }?>
                        </select> 
                    </td>
                </tr>
                <tr>
                    <td>Name<font color='red'>*</font></td>
                    <td><input type='text' name='name' maxlength="220" id='name' required="required">
                 </td>
                </tr>
                <tr>
                    <td>Description<font color='red'>*</font></td>
                    <td><textarea name='desc' maxlength="950" id='desc'></textarea>
                 </td>
                </tr>
                <tr>
                    <td>Price<font color='red'>*</font></td>
                    <td><input type='text' name='price' maxlength="8" id='price' required="required">
                 </td>
                </tr>
                <tr>
                    <td>Tax<font color='red'>*</font></td>
                    <td><input type='text' name='tax' id='tax' maxlength="6" required="required">
                 </td>
                </tr>
                <tr>
                    <td>Discount<font color='red'>*</font></td>
                    <td><input type='text' name='discount' id='discount' maxlength="6" required="required">
                 </td>
                </tr>
                <tr><td colspan="2"><input type='button' name='Submit' id="submitbtn" value='Submit'>
                    </td></tr>
        </table>
       </form>

     <script>
        jQuery(document).ready(function(){
         jQuery(document).on('click','#submitbtn',function() {
            if(jQuery('#addProduct').valid()){
            jQuery.ajax({
                type: 'POST',
                url: 'product.php/add',
                dataType: 'json',
                data :'{"name":"'+jQuery('#name').val()+'", "desc":"'+jQuery('#desc').val()+'", "tax":"'+jQuery('#tax').val()+'", "price":"'+jQuery('#price').val()+'", "discount":"'+jQuery('#discount').val()+'","category":"'+jQuery('#category').val()+'" }',
                contentType: "application/json",
                success: function (data) {
                    var messages = JSON.parse(JSON.stringify(data));
                    if(messages.status == 'success') {
                        window.location.href="listproduct.php";
                        jQuery('#successMsg').html('Created successfully').css('color','green');
                    }else{
                        jQuery('#errorMsg').html('Error occured').css('color','red');
                    }
                }
            });
        }else{
        return false;
    }
    });
    
    
   jQuery.validator.addMethod(
    "money",
    function(value, element) {
        var isValidMoney = /^\d{0,6}(\.\d{0,2})?$/.test(value);
        return this.optional(element) || isValidMoney;
    },
    "Insert"
    );
        jQuery("#addProduct").validate({
        rules: {
            name: {
                required: true
            },
            desc: {
                required: true                
            },
            price: {
                required: true,
                money:true
            },
            tax: {
                required: true,
                money:true
            },
            discount: {
                required: true,
                money:true
            },
            category: {
                required: true
            }
        },
        messages: {
            name: {
                  required: "This field is required."
            },
            desc: {
                required: "This field is required."
            },
            price: {
                required: "This field is required.",
                money:"Invalid"
            },
            tax: {
                required: "This field is required.",
                money:"Invalid"
            },
            discount: {
                required: "This field is required.",
                money:"Invalid"
            }
        },
        errorClass: 'input_error'
     });

    });
        
 </script>
        
    </body>    
        
</html>
