<!DOCTYPE html>
<html>
    <head>
        <title>Add Category</title>
        <script src="js/jquery-1.10.2.min.js"></script>        
        <script src="js/jquery.json.js"></script>        
        <script src="js/jquery.validate.js"></script>        
    </head>
    <body>
       <?php require_once 'header.php'; ?>
        <form name='addCat' id='addCat'>
            <div><h1>Add Category</h1></div> 
            <div id='successMsg'></div>
            <div id='errorMsg'></div>
        <table cellspacing="0" cellpadding="0" wodth="100%" border='1'>
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
              
                <tr><td colspan="2"><input type='button' name='Submit' id="submitbtn" value='Submit'></td></tr>
        </table>
       </form>

        <script>
        jQuery(document).ready(function(){
         jQuery(document).on('click','#submitbtn',function() {
            if(jQuery('#addCat').valid()){
            jQuery.ajax({
                type: 'POST',
                url: 'category.php/add',
                dataType: 'json',
                data :'{"name":"'+jQuery('#name').val()+'", "desc":"'+jQuery('#desc').val()+'" }',
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
        }else{
        return false;
    }
    });
   
        jQuery("#addCat").validate({
        rules: {
            name: {
                required: true
            },
            desc: {
                required: true                
            }
        },
        messages: {
            name: {
                  required: "This field is required."
            },
            desc: {
                required: "This field is required."
            }
        },
        errorClass: 'input_error'
     });

    });
        
 </script>
        
    </body>    
        
</html>
