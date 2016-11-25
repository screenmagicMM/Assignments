<html>
<head>
    <title>Products test</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript">

       /* function test(method, args) {
            $.ajax({
                type: method,
                url: 'http://localhost/shoppingCart/api/v1.0/products.json',
                processData: true,
                crossDomain: false,
                xhrFields: { withCredentials: true },
                dataType: 'json',
                data: args,
                timeout: 60000,
                success: function (response, general_msg) {
                    console.log(arguments);
					console.log(response);
                },
                error: function (data, general_error) {
                    console.log(arguments);
                }
            });
        }

        window.setTimeout(function(){
            test('POST', {'name':'testProd2','description':'testDescrProd2','category_id':1,'tax':20,'discount':10,'price':200});
        }, 500);
		
		
	
		function test(method, args) {
            $.ajax({
                type: method,
                url: 'http://localhost/shoppingCart/api/v1.0/category.json',
                processData: true,
                crossDomain: false,
                xhrFields: { withCredentials: true },
                dataType: 'json',
                data: args,
                timeout: 60000,
                success: function (response, general_msg) {
                    console.log(arguments);
					console.log(response);
                },
                error: function (data, general_error) {
                    console.log(arguments);
                }
            });
        }

        window.setTimeout(function(){
            test('POST', {'name':'testCat','description':'testCatDescr1'});
        }, 500);
		
		
		
		function test(method, args) {
            $.ajax({
                type: method,
                url: 'http://localhost/shoppingCart/api/v1.0/category.json',
                processData: true,
                crossDomain: false,
                xhrFields: { withCredentials: true },
                dataType: 'json',
                data: args,
                timeout: 60000,
                success: function (response, general_msg) {
                    console.log(arguments);
					console.log(response);
                },
                error: function (data, general_error) {
                    console.log(arguments);
                }
            });
        }

        window.setTimeout(function(){
            test('GET', {});
        }, 500);
		*/
		
		function test(method, args) {
            $.ajax({
                type: method,
                url: 'http://localhost/shoppingCart/api/v1.0/cart.json',
                processData: true,
                crossDomain: false,
                xhrFields: { withCredentials: true },
                dataType: 'json',
                data: args, 	
                timeout: 60000,
                success: function (response, general_msg) {
                    console.log(arguments);
					console.log(response);
                },
                error: function (data, general_error) {
                    console.log(arguments);
                }
            });
        }
		
		window.setTimeout(function(){
            test('POST', {'name':'Cartnew1','products':'1,3'});
        }, 500);
    </script>
</head>
<body>
Shopping Cart
This is to check git username
</body>
</html>


